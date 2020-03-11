<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Category;

class CategoriesController extends Controller
{
    public function getAllJSON()
    {
        return response(Category::all()->jsonSerialize(), Response::HTTP_OK);
    }
}