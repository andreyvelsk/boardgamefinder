<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Game;

class GamesController extends Controller
{
    public function execute(Request $request){
        if(view()->exists('admin.games')) {
            $games = Game::orderBy('id', 'DESC')->paginate();
            $search=null;
            if ( !empty( $request->input('q') ) ) {
                $input = $request->except('_token');
                $search = $input['q'];
                $games = Game::where('title', 'like', '%'.$search.'%')->paginate()->setPath ( '' );
                $games->appends ( array (
                    'q' => $search
                ) );
            }
            $data=[
                'title'=>'Games',
                'games'=>$games,
                'q'=> $search
            ];
            return view('admin.games', $data);
        }

        abort(404);
    }
}
