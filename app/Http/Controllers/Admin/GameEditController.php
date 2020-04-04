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
        $game = Game::where('id', $id)->firstOrFail();
        
        $data=[
            'title'=>$game->title,
            'data'=>$game,
            'attributes'=>$game->attributes->groupBy('idattribute_type')
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
            'minage' => 'integer|nullable|min:0|max:99',
            'suggestedage' => 'integer|nullable|min:0|max:99',
            'gameweight' => 'nullable|regex:/^(-)?[0-9]{1}+(\.[0-9]{1,3})?$/',
            'minplaytime' => 'integer|nullable|min:0|max:999',
            'maxplaytime' => 'integer|nullable|min:0|max:999',
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

    public function deleteAttribute(Game $game, Request $request) {
        $input = $request->except('_token');
        if($game->attributes()->detach($input['attributeid']))
            return redirect()->route('gameEdit', $game->id)->with('status','Атрибут удален!');
    }
}
