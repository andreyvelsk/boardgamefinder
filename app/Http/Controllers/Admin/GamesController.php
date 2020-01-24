<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Game;

class GamesController extends Controller
{
    public function execute(){
        if(view()->exists('admin.games')) {
            $games = Game::paginate();
            $data=[
                'title'=>'Games',
                'games'=>$games
            ];
            
            return view('admin.games', $data);
        }

        abort(404);
    }
}
