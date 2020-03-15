<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Game;
use Validator;

class GameEditController extends Controller
{
    //
    public function getGame($id) {
        $game = Game::where('id', $id)->with('categories', 'mechanics', 'families', 'types', 'publishers', 'artists', 'designers', 'expansions', 'expansionFor')->firstOrFail();
        
        $data=[
            'title'=>$game->title,
            'data'=>$game
        ];
        return view('admin.gameedit.game', $data);
    }

    public function postGame(Game $game, Request $request) {
        $input = $request->except('_token');
        $rules = array(
            'title' => 'required',
            'idtesera'  => 'nullable|int|unique:games,idtesera,'.$game->id,
            'idbgg'  => 'nullable|int|unique:games,idbgg,'.$game->id,
            'yearpublished' => 'digits:4|integer|nullable|min:1900',
            'bgggeekrating' => 'nullable|regex:/^(-)?[0-9]{1,2}+(\.[0-9]{1,3})?$/',
            'bggavgrating' => 'nullable|regex:/^(-)?[0-9]{1,2}+(\.[0-9]{1,3})?$/',
            'bggnumvotes' => 'integer|nullable',
            'minplayers' => 'integer|nullable|min:1|max:99',
            'maxplayers' => 'integer|nullable|min:1|max:99',
            'suggestedplayers' => 'integer|nullable|min:1|max:99',
            'minage' => 'integer|nullable|min:1|max:99',
            'suggestedage' => 'integer|nullable|min:1|max:99',
            'gameweight' => 'nullable|regex:/^(-)?[0-9]{1}+(\.[0-9]{1,3})?$/',
            'minplaytime' => 'integer|nullable|min:1|max:999',
            'maxplaytime' => 'integer|nullable|min:1|max:999',
        );
        $v = Validator::make($input, $rules);
        if ($v->fails())
        {
            return redirect()->route('gameEdit', $game->id)->with('error',$v->errors());
        }
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

    public function deleteExpansion(Game $game, Request $request) {
        $input = $request->except('_token');
        if($game->expansions()->detach($input['expansionid']))
            return redirect()->route('gameEdit', $game->id)->with('status','Дополнение удалено!');
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

    public function deleteArtist(Game $game, Request $request) {
        $input = $request->except('_token');
        if($game->artists()->detach($input['artistid']))
            return redirect()->route('gameEdit', $game->id)->with('status','Создатель удален!');
    }

    public function deleteDesigner(Game $game, Request $request) {
        $input = $request->except('_token');
        if($game->designers()->detach($input['designerid']))
            return redirect()->route('gameEdit', $game->id)->with('status','Дизайнер удален!');
    }
}
