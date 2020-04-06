<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Game;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Game::paginate()->jsonSerialize(), Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::select('id', 'idbgg', 'title', 'yearpublished', 'bgggeekrating')->where('id', $id)->with(['attributes' => function($query) {
            $query->join('attributes_types', 'attributes.idattribute_type', '=', 'attributes_types.id')->select('attributes.id', 'attributes.bggname as name', 'attributes_types.bggname as type');
        }])->firstOrFail();
        $attributes = $game->attributes->groupBy('type')->toArray();
        $res = $game->makeHidden('attributes')->toArray();
        $res['attributes'] = $attributes;
        return($res);
    }

    /**
     * Display search result
     */
     public function search($request)
     {
        $result = Game::whereNotNull('idbgg')->where('isexpansion', '!=', '1')->search($request, null, true)->select('id','title')->take(10)->get();
         return $result;
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
