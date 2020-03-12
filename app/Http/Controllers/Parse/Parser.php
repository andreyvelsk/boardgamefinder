<?php

namespace App\Http\Controllers\Parse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Game;
use App\Category;
use App\Mechanic;
use App\Family;
use App\Publisher;
use App\Artist;
use App\Designer;

class Parser extends Controller
{
    public function getBggApi(Game $game) {
        if($game->idbgg) {
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
                    $isExpansion = NULL; 
            }

            $data['thumbnail'] = $xmlGame->thumbnail->__toString();
            $data['minplayers'] = intval($xmlGame->minplayers['value']);
            $data['maxplayers'] = intval($xmlGame->maxplayers['value']);
            $data['minage'] = intval($xmlGame->minage['value']);
            $data['minplaytime'] = intval($xmlGame->minplaytime['value']);
            $data['maxplaytime'] = intval($xmlGame->maxplaytime['value']);
            $data['isexpansion'] = $isExpansion;

            $game->fill($data);
            try {
                $game->save();
                $result['apimessage'] = "api game data saved";
            } catch (\Throwable $th) {
                $result['apimessage'] = $th->getMessage();
            }

            //SET game mechanics, categories and etc.
            foreach ($xml->item->link as $link) {
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
                    
                    default:
                        # code...
                    break;
                }
            }
            print_r($result);
        }
        else echo "no idbgg";        
    }
}