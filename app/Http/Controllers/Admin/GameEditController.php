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

    public function deleteMechanic(Game $game, Request $request) {
        $input = $request->except('_token');
        if($game->mechanics()->detach($input['mechanicid']))
            return redirect()->route('gameEdit', $game->id)->with('status','Механика удалена!');
    }

    public function deleteFamily(Game $game, Request $request) {
        $input = $request->except('_token');
        if($game->families()->detach($input['familyid']))
            return redirect()->route('gameEdit', $game->id)->with('status','Семейство удалено!');
    }

    public function deletePublisher(Game $game, Request $request) {
        $input = $request->except('_token');
        if($game->publishers()->detach($input['publisherid']))
            return redirect()->route('gameEdit', $game->id)->with('status','Издатель удален!');
    }
    public function deleteType(Game $game, Request $request) {
        $input = $request->except('_token');
        if($game->types()->detach($input['typeid']))
            return redirect()->route('gameEdit', $game->id)->with('status','Тип удален!');
    }
}
