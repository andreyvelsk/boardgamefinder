<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Artist;

class ArtistsController extends Controller
{
    public function getAllJSON()
    {
        return response(Artist::all()->jsonSerialize(), Response::HTTP_OK);
    }
}