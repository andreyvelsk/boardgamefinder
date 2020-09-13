<?php

namespace App\Http\Controllers\Recomendation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Game;
use App\Attribute;
use App\Type;
use App\Category;
use App\Family;
use App\Mechanic;
class Recomendation extends Controller
{
    private function getBayesValue($R, $v) {
        $m = 4;
        $C = 5.978;
        return round( (($v / ($v+$m)) * $R + ($m / ($v+$m)) * $C), 5);
    }

    public function getRelations (Request $request) {
        //get list of ids with ratings
        foreach ($request->games as $key => $ugame) {
            $garray['ids'][] =  $ugame['id'];
            $garray['ratings'][] = $ugame['rating'];
        }
        $games = Game::whereIn('id', $garray['ids'])->select('id')->with('attributes')->get();
        //set ratings to $games collection
        foreach ($request->games as $key => $ugame) {
            $game = $games->find($ugame['id']);
            foreach ($game->attributes as $key => $category) {
                $category->userrating=$ugame['rating'];
            }
        }
        $relation = $games->pluck('attributes')->collapse();
        $returned=collect();
        if(!$relation->isEmpty()) {
            $res = $relation->groupBy('id')->map(function ($row, $key) {
                return [
                    'id' => $key,
                    'name' => $row[0]['bggname'],
                    'avgrating' => $row->average('userrating'),
                    'type' => $row[0]->type->bggname,
                    'count' => $row->count(),
                    'bayes' => $this->getBayesValue($row->average('userrating'),$row->count())
                ];
            })->sortByDesc('bayes')->values();
            $returned=$res;
        }
        return $returned;
    }

    public function getRecomendations(Request $request) {
        $result=[];
        $rules = array(
            'games' => 'required',
            'games.*.id' => 'required|int|exists:games',
            'games.*.rating' => 'required|int|min:1|max:10'
        );
        $v = Validator::make($request->all(), $rules);
        if ($v->fails()) {
            $errors = $v->errors();
            $result['status']='ok';
            $result['message']=$errors->toJson();
            $games = Game::orderBy('bgggeekrating', 'desc')->take(100)->get();
            $result['games']=$games;
            return $result;
        }
        $relations = $this->getRelations($request);
        $types['ids']=[];
        foreach ($relations as $rel) {
            $types['ids'][] = $rel['id'];
            $types['bayes'][] = $rel['bayes'];
        }
        $attributes = Attribute::whereIn('id', $types['ids'])->with('games')->get();
        foreach ($attributes as $keytype => $attribute) {
            $attribute->games->each(function($item,$k) use ($types, $keytype) {
                $item->bayes = $types['bayes'][$keytype];
            });
        }
        $games = $attributes->pluck('games')->collapse()->groupBy('id')->map(function ($row, $key) {
            return [
                'id' => $key,
                'title' => $row[0]['title'],
                'thumbnail' => $row[0]['thumbnail'],
                'bgggeekrating' => (float)$row[0]['bgggeekrating'],
                'matches' => $row->count(),
                'gameweight' => $this->getBayesValue($row->avg('bayes'), $row->count())
            ];
        })->sortByDesc('gameweight')->values()->take(100);
        $result['status']='ok';
        $result['attributes']=$relations->groupBy('type');
        $result['games']=$games;
        return $result;
    }
}
