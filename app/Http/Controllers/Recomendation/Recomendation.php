<?php

namespace App\Http\Controllers\Recomendation;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use App\Game;
use App\Attribute;
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
        $relation = DB::table('games_attributes AS ga')
                ->leftJoin('attributes AS a', 'ga.idattribute', '=', 'a.id')
                ->leftJoin('attributes_types AS att', 'a.idattribute_type', '=', 'att.id')
                ->whereIn('ga.idgame', $garray['ids'])
                ->whereIn('att.id', [1,2,3,7])
                ->select(
                    'ga.idgame', 
                    'ga.idattribute', 
                    'a.bggname', 
                    'att.bggname AS typename', 
                    DB::raw('10 AS userrating')
                    )
                ->get();
        $returned=collect();
        if(!$relation->isEmpty()) {
            $returned = $relation->groupBy('idattribute')->map(function ($row, $key) {
                return [
                    'id' => $key,
                    'name' => $row[0]->bggname,
                    'avgrating' => $row->average('userrating'),
                    'type' => $row[0]->typename,
                    'count' => $row->count(),
                    'bayes' => $this->getBayesValue($row->average('userrating'),$row->count())
                ];
            })->sortByDesc('bayes')->values();
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
            $result['status']='bad';
            $result['message']=$errors->toJson();
            return $result;
        }
        $relations = $this->getRelations($request);
        $types['ids']=[];
        $sqlCase='';
        foreach ($relations as $rel) {
            $types['ids'][] = $rel['id'];
            $types['bayes'][] = $rel['bayes'];
            $sqlCase.='WHEN ga.idattribute='.(float)$rel['id'].' THEN '.(float)$rel['bayes'] .' ';
        }
        $games = DB::table('games_attributes AS ga')
                ->leftJoin('games AS g', 'ga.idgame', '=', 'g.id')
                ->whereIn('ga.idattribute', $types['ids'])
                ->where('g.isexpansion', '!=', '1')
                ->select(
                    'ga.idgame',
                    'g.title',
                    'g.thumbnail',
                    'ga.idattribute',
                    DB::raw('(CASE '.$sqlCase.' ELSE 0 END) AS bayes')
                )
                ->get();
        $res=collect();
        if(!$games->isEmpty()) {
            $res = $games->groupBy('idgame')->map(function ($row, $key) {
                return [
                    'id' => $key,
                    'title' => $row[0]->title,
                    'thumbnail' => $row[0]->thumbnail,
                    'matches' => $row->count(),
                    'attravg' => $row->avg('bayes'),
                    'gameweight' => $this->getBayesValue($row->avg('bayes'), $row->count())
                ];
            })->sortByDesc('gameweight')->values()->take(100);
        }
        unset($games);
        $result['status']='ok';
        $result['attributes']=$relations->groupBy('type');
        $result['games']=$res;
        return($result);
    }
}
