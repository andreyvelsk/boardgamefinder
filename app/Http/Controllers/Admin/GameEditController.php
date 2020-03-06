<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Game;

class GameEditController extends Controller
{
    //
    public function getGame($id) {
        $game = Game::where('id', $id)->with('categories', 'mechanics', 'families', 'types', 'publishers')->firstOrFail();
        
        $data=[
            'title'=>$game->title,
            'data'=>$game
        ];
        return view('admin.gameedit.game', $data);
    }

    public function postGame(Game $game, Request $request) {
        $input = $request->except('_token');

        $game->fill($input);
        $game->save();
        if($game->save()) {
            return redirect()->route('gameEdit', $game->id)->with('status','Страница успешно обновлена!');
        }
    }
}
