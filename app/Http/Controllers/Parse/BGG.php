<?php

namespace App\Http\Controllers\Parse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Game;
use App\Category;
use App\Mechanic;
use App\Family;
use App\Publisher;
use App\Artist;
use App\Designer;
use App\Type;

class BGG extends Controller
{
    public function getBggInfo(Game $game, Request $request) {
        if($game->idbgg) {
            $this->getBggApi($game);
            $this->getBggHtml($game);
        }
        else echo "no idbgg";
        $input = $request->except('_token');
        if($input['refresh'])
            return redirect()->route('gameEdit', $game->id)->with('status','Загружены данные с bgg!');
    }

    public function getBggInfoAll() {
        $games = Game::whereNotNull('idbgg')->orderBy('updated_at', 'ASC')->take(10)->get();
        foreach ($games as $key => $game) {
            if($game->idbgg) {
                if($this->getBggApi($game))
                    $this->getBggHtml($game);
            }
        }
    }

    public function getBggApi(Game $game) {
        $xml = simplexml_load_file("https://api.geekdo.com/xmlapi2/thing?id=".$game->idbgg);
        $xmlGame = $xml->item;
        $result = [];
        switch ($xmlGame['type']) {
            case "boardgame":
                $isExpansion = false;
                break;
            case "boardgameexpansion":
                $isExpansion = true;
                break;
            default:
                $isExpansion = false;
        }
        if($xmlGame['type']) {
            $data['thumbnail'] = $xmlGame->thumbnail->__toString();
            $data['yearpublished'] = intval($xmlGame->yearpublished['value']);
            $data['minplayers'] = intval($xmlGame->minplayers['value']);
            $data['maxplayers'] = intval($xmlGame->maxplayers['value']);
            $data['minage'] = intval($xmlGame->minage['value']);
            $data['minplaytime'] = intval($xmlGame->minplaytime['value']);
            $data['maxplaytime'] = intval($xmlGame->maxplaytime['value']);
            $data['isexpansion'] = $isExpansion;
    
            $game->fill($data);
            try {
                $game->save();
                $result['apimessage'] = "api game ".$game->id." data saved";
            } catch (\Throwable $th) {
                $result['apimessage'] = $th->getMessage();
            }
    
            //SET game mechanics, categories and etc.
            foreach ($xml->item->link as $link) {
                $catid = NULL;
                if($link['inbound'] != "true") $catid = $link['id']->__toString();
                $item['id']=$catid;
                $item['name']=$link['value'];
    
                switch ($link['type']) {
                    case 'boardgamecategory':
                            $relation = Category::firstOrNew(array('id' => $item['id']));
                            $relation->name = $item['name'];
                            $relation->save();
                            try {
                                $game->categories()->save($relation);
                                $result['relations'][] =  "pivot saved: " . $item['name'];
                            } catch (\Throwable $th) {
                                $result['relations'][] = $th->getMessage();
                            }
                    break;
    
                    case 'boardgamemechanic':
                        $relation = Mechanic::firstOrNew(array('id' => $item['id']));
                        $relation->name = $item['name'];
                        $relation->save();
                        try {
                            $game->mechanics()->save($relation);
                            $result['relations'][] =  "pivot saved: " . $item['name'];
                        } catch (\Throwable $th) {
                            $result['relations'][] = $th->getMessage();
                        }
                    break;
    
                    case 'boardgamefamily':
                        $relation = Family::firstOrNew(array('id' => $item['id']));
                        $relation->name = $item['name'];
                        $relation->save();
                        try {
                            $game->families()->save($relation);
                            $result['relations'][] =  "pivot saved: " . $item['name'];
                        } catch (\Throwable $th) {
                            $result['relations'][] = $th->getMessage();
                        }
                    break;
    
                    case 'boardgamepublisher':
                        $relation = Publisher::firstOrNew(array('id' => $item['id']));
                        $relation->name = $item['name'];
                        $relation->save();
                        try {
                            $game->publishers()->save($relation);
                            $result['relations'][] =  "pivot saved: " . $item['name'];
                        } catch (\Throwable $th) {
                            $result['relations'][] = $th->getMessage();
                        }
                    break;
    
                    case 'boardgameartist':
                        $relation = Artist::firstOrNew(array('id' => $item['id']));
                        $relation->name = $item['name'];
                        $relation->save();
                        try {
                            $game->artists()->save($relation);
                            $result['relations'][] =  "pivot saved: " . $item['name'];
                        } catch (\Throwable $th) {
                            $result['relations'][] = $th->getMessage();
                        }
                    break;
    
                    case 'boardgamedesigner':
                        $relation = Designer::firstOrNew(array('id' => $item['id']));
                        $relation->name = $item['name'];
                        $relation->save();
                        try {
                            $game->designers()->save($relation);
                            $result['relations'][] =  "pivot saved: " . $item['name'];
                        } catch (\Throwable $th) {
                            $result['relations'][] = $th->getMessage();
                        }
                    break;

                    case 'boardgameexpansion':
                        if($item['id']) {
                            $relation = Game::firstOrNew(array('idbgg' => $item['id']));
                            if(!$relation->exists) {
                                $relation->title = $item['name'];
                                $relation->save();
                            }
                            try {
                                $game->expansions()->save($relation);
                                $result['relations'][] =  "pivot saved: " . $item['name'];
                            } catch (\Throwable $th) {
                                $result['relations'][] = $th->getMessage();
                            }
                        }
                    break;
                    
                    default:
                        # code...
                    break;
                }
            }
            return true;
        }
        else {
            $game->idbgg=NULL;
            $game->save();
            return false;
        }

        print_r(json_encode($result));
    }

    function getBggHtml(Game $game) {
        $htmlData = file_get_contents("https://boardgamegeek.com/boardgame/" . $game->idbgg);

        $weightSearchString = 'averageweight":';
        $weightStringStart = strpos($htmlData, $weightSearchString) + strlen($weightSearchString);
        $weightString = round(substr($htmlData, $weightStringStart, 5), 2);
        if ($weightString)
            $weight = floatval($weightString);
        else $weightString = NULL;
        $data['gameweight'] = $weightString;
        $game->fill($data);
        $game->save();

        $typeSearchString = 'boardgamesubdomain":[';
        $typeStringStart = strpos($htmlData, $typeSearchString) + strlen($typeSearchString) - 1;
        $typeStringEnd = strpos($htmlData, "]", $typeStringStart);
        $typeString = substr($htmlData, $typeStringStart, $typeStringEnd - $typeStringStart + 1);
        $types = json_decode($typeString);

        if($types){
            foreach ($types as $type) {
                $relation = Type::firstOrNew(array('id' => $type->objectid));
                $relation->name = $type->name;
                $relation->save();
                try {
                    $game->types()->save($relation);
                } catch (\Throwable $th) {
    
                }
            }
        }

    }
}
