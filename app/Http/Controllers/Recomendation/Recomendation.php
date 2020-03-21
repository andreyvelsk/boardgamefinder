<?php

namespace App\Http\Controllers\Recomendation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Game;
use App\Type;
use App\Category;
use App\Family;
use App\Mechanic;
class Recomendation extends Controller
{
    private function getBayesValue($R, $v) {
        $m = 4;
        $C = 5.978;
        return round( (($v / ($v+$m)) * $R + ($m / ($v+$m)) * $C), 3);
    }

    public function getRelations (Request $request) {
        $result=[];
        $rules = array(
            'games.*.id' => 'required|int|exists:games',
            'games.*.rating' => 'required|int|min:1|max:10'
        );
        $v = Validator::make($request->all(), $rules);
        if ($v->fails()) {
            $errors = $v->errors();
            $result['status']='bad';
            $result['message']=$errors->toJson();
            return $result;
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
        $returned=[];
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
            $returned[$key]=$res;
        }
        $result['status']='ok';
        $result['relations']=$returned;
        return $result;
    }

    public function getRecomendations(Request $request) {
        $relations = $this->getRelations($request);
        if($relations['status']!='ok') return $relations;
        $games=collect();
        foreach ($relations['relations'] as $key => $relation) {
            $types=[];
            foreach ($relation as $rel) {
                $types['ids'][] = $rel['id'];
                $types['bayes'][] = $rel['bayes'];
            }

            switch ($key) {
                case "types":
                    $items = Type::whereIn('id', $types['ids'])->with('games')->get();
                break;
                case "categories":
                    $items = Category::whereIn('id', $types['ids'])->with('games')->get();
                break;
                case "families":
                    $items = Family::whereIn('id', $types['ids'])->with('games')->get();
                break;
                case "mechanics":
                    $items = Mechanic::whereIn('id', $types['ids'])->with('games')->get();
                break;
                default: 
                    $items = ["games"=>[]];
                break;
            }
            foreach ($items as $keytype => $type) {
                $type->games->each(function($item,$k) use ($types, $keytype) {
                    $item->bayes = $types['bayes'][$keytype];
                });
            }
            $items = $items->pluck('games')->collapse();
            $games[]=$items;
        }
        $games = $games->collapse()->where('isexpansion', '!=', 1)->groupBy('id')->sortByDesc('bgggeekrating')->map(function ($row, $key) {
            return [
                'id' => $key,
                'title' => $row[0]['title'],
                'rating' => $row[0]['bgggeekrating'],
                'matches' => $row->count(),
                'weight' => $this->getBayesValue($row->average('bayes'),$row->count())
            ];
        })->sortByDesc('weight');
        return($games);
    }
}
