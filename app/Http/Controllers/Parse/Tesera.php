<?php

namespace App\Http\Controllers\Parse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Game;

class Tesera extends Controller
{

    private function getApiInfo($string) {
        $apistring = "https://api.tesera.ru/games" . $string;
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $json = file_get_contents($apistring, false, stream_context_create($arrContextOptions));
        return json_decode($json, true);   
    }

    public function getGamesAll() {
        $i = 0;
        while ($this->getGamesList($i)) {
            $i++;
        }
    }

    public function getGamesList($page) {
        $gamesTesera = $this->getApiInfo("?limit=100&offset=".$page);
        if (sizeof($gamesTesera) > 0) {
            foreach ($gamesTesera as $gameInfo) {
                if($gameInfo['creationDateUtc'] < "2000-01-01T00:00:00") {
                    return false;
                }
                $game = Game::firstOrNew(array('idtesera' => $gameInfo['teseraId']));
                if($gameInfo['bggId'] != 0) {
                    $game1 = Game::firstOrNew(array('idbgg' => $gameInfo['bggId']));
                    if($game1->exists) $game = $game1;
                    $game->idbgg = $gameInfo['bggId'];
                }
                $game->idtesera = $gameInfo['teseraId'];
                $game->title = $gameInfo['title'];
                if(array_key_exists('bggGeekRating', $gameInfo))
                    $game->bgggeekrating = $gameInfo['bggGeekRating'];
                if(array_key_exists('bggRating', $gameInfo))
                    $game->bggavgrating = $gameInfo['bggRating'];
                if(array_key_exists('bggNumVotes', $gameInfo))
                    $game->bggnumvotes = $gameInfo['bggNumVotes'];
                if(array_key_exists('description', $gameInfo))
                    $game->description = $gameInfo['description'];
                try {
                    $game->save();
                } catch (\Throwable $th) {

                }
            }
            return true;
        }
        else return false;
    }

    public function getGameInfo(Game $game) {
        if($game->idtesera) {
            $gameInfo = $this->getApiInfo("/".$game->idtesera)['game'];
            $game->idbgg = $gameInfo['bggId'];
            $game->bgggeekrating = $gameInfo['bggGeekRating'];
            $game->bggavgrating = $gameInfo['bggRating'];
            $game->bggnumvotes = $gameInfo['bggNumVotes'];
            try {
                $game->save();
                return "api game data saved";
            } catch (\Throwable $th) {
                return $th;
            }
        }
        else return "no game";
    }
}