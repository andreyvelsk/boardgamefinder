<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Game;

class GameEditController extends Controller
{
    //
    public function execute($id) {
        $game = Game::where('id', $id)->with('categories', 'mechanics', 'families', 'types', 'publishers')->firstOrFail();
        
        $data=[
            'title'=>$game->title,
            'data'=>$game
        ];
        return view('admin.gameedit', $data);
    }
}
