<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Game;

class GamesController extends Controller
{
    public function index()
    {
        return response(Game::paginate()->jsonSerialize(), Response::HTTP_OK);
    }
}
