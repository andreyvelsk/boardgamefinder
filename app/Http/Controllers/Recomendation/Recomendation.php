<?php

namespace App\Http\Controllers\Recomendation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Game;
use App\Category;
class Recomendation extends Controller
{
    private function getBayesValue($R, $v) {
        $m = 4;
        $C = 5.978;
        return round( (($v / ($v+$m)) * $R + ($m / ($v+$m)) * $C), 3);
    }

    public function getCategories (Request $request) {
        $rules = array(
            'games.*.id' => 'required|int|exists:games',
            'games.*.rating' => 'required|int|min:1|max:10'
        );
        $v = Validator::make($request->all(), $rules);
        if ($v->fails()) {
            $errors = $v->errors();
            return $errors->toJson();
        }
        //get list of ids with ratings
        foreach ($request->games as $key => $ugame) {
            $garray['ids'][] =  $ugame['id'];
            $garray['ratings'][] = $ugame['rating'];
        }

        $games = Game::whereIn('id', $garray['ids'])->with('types', 'categories', 'families', 'mechanics')->get();
        //set ratings to $games collection
        foreach ($request->games as $key => $ugame) {
            $game = $games->find($ugame['id']);
            foreach ($game->types as $key => $category) {
                $category->userrating=$ugame['rating'];
            }
            foreach ($game->categories as $key => $category) {
                $category->userrating=$ugame['rating'];
            }
            foreach ($game->families as $key => $category) {
                $category->userrating=$ugame['rating'];
            }
            foreach ($game->mechanics as $key => $category) {
                $category->userrating=$ugame['rating'];
            }
        }
        $relations['types'] = $games->pluck('types')->collapse();
        $relations['categories'] = $games->pluck('categories')->collapse();
        $relations['families'] = $games->pluck('families')->collapse();
        $relations['mechanics'] = $games->pluck('mechanics')->collapse();
        $result=[];
        foreach ($relations as $key => $relation) {
            $res = $relation->groupBy('id')->map(function ($row, $key) {
                return [
                    'id' => $key,
                    'name' => $row[0]['name'],
                    'avgrating' => $row->average('userrating'),
                    'count' => $row->count(),
                    'bayes' => $this->getBayesValue($row->average('userrating'),$row->count())
                ];
            })->sortByDesc('bayes');
            $result[$key]=$res;
        }

        return $result;
    }
}
