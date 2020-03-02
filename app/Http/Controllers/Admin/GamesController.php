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

    public function search(Request $request) {
        if(view()->exists('admin.games')) {
            $input = $request->except('_token');
            $games = Game::where('title', 'like', '%'.$input['q'].'%')->paginate()->setPath ( '' );
            $pagination = $games->appends ( array (
                'q' => $input['q']
              ) );
            $data=[
                'title'=>'Games',
                'games'=>$games,
            ];
            
            return view('admin.games', $data);
        }

        abort(404);
    }
}
