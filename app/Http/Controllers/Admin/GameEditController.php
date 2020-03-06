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

    public function deleteGame(Game $game) {
        if($game->delete()){
            return redirect()->route('gamesList')->with('status','Игра '.$game->title.' удалена!');
        }
    }

    public function deleteCategory(Game $game, Request $request) {
        $input = $request->except('_token');
        if($game->categories()->detach($input['categoryid']))
            return redirect()->route('gameEdit', $game->id)->with('status','Категория удалена!');
    }
}
