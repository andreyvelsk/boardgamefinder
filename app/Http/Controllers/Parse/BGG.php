<?php

namespace App\Http\Controllers\Parse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Game;
use App\Attribute;
use App\AttributeType;

class BGG extends Controller
{
    public function getBggInfo(Game $game, Request $request) {
        if($game->idbgg) {
            $this->getBggApi($game);
            $this->getBggHtml($game);
        }
        else echo "no idbgg";
        $input = $request->except('_token');
        if(isset($input['refresh']))
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
            $data['title'] = $xmlGame->name['value']->__toString();
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
            $classesToSave = array(
                'boardgamecategory', 
                'boardgamemechanic', 
                'boardgamefamily', 
                'boardgamedesigner',
                'boardgameartist',
                'boardgamepublisher'
            );
            foreach ($xml->item->link as $link) {
                if(in_array ($link['type'], $classesToSave)) {
                    $catid = NULL;
                    if($link['inbound'] != "true") $catid = $link['id']->__toString();
                    $item['id']=$catid;
                    $item['name']=$link['value']->__toString();
                    $item['type']=$link['type']->__toString();
                    
                    $attribute = $this->saveAttribute($item['type'], $item['id'], $item['name']);
                    try {
                        $game->attributes()->save($attribute);
                        $result['apimessage'] = "api game ".$game->id." data saved";
                    } catch (\Throwable $th) {
                        $result['apimessage'] = $th->getMessage();
                    }
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
                $attribute = $this->saveAttribute('boardgametype', $type->objectid, $type->name);
                try {
                    $game->attributes()->save($attribute);
                    $result['apimessage'] = "api game ".$game->id." data saved";
                } catch (\Throwable $th) {
                    $result['apimessage'] = $th->getMessage();
                }
            }
        }

    }

    private function saveAttribute($attrType, $attrId, $attrName) {
        $attributeType = AttributeType::firstOrCreate(array('bggname' => $attrType));
        $attribute = Attribute::firstOrNew(array('idbgg' => $attrId));
        $attribute->bggname = $attrName;
        $attribute->idattribute_type = $attributeType->id;
        $attribute->save();
        return $attribute;
    }
}
