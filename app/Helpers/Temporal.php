<?php
/**
 * Created by PhpStorm.
 * User: DIECLA
 * Date: 18/05/2018
 * Time: 10:01
 */

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class Temporal
{

    public static function all($token){
        return collect(Session::get($token));
    }


    public static function create($token, Request $request, $except = null){
        $collection = collect(Session::get($token));
        if(!$collection->contains($request->get('index'), $request->get('search'))) {
            $request->merge(['id' => $collection->count() + 1]);
            $collection->push($request->except($except));
            Session::put($token, $collection);
            return ($collection->where('id', $collection->count()));
        }else{
            //App::abort(404);
            //return false;
            throw new \Exception('Existe registro');
        }
    }

    public static function update($token, Request $request, $id, $except = null){
        $collections = collect(Session::get($token));
        if($collections->contains('id', $id)){
            $cls = ($collections->where('id', '<>', $id));
            $cl = ($collections->firstWhere('id', $id));
            $cl = collect($cl)->merge($request->except($except));
            $cls->push($cl);
            Session::put($token, $cls);
            return true;
        }
        return false;
    }

    public static function updateOrCreate($token, Request $request, $except = null, $column, $search){
        $collections = collect(Session::get($token));
        if($collections->contains($column, $search)){
            $cls = ($collections->where($column, '<>', $search));
            $cl = ($collections->firstWhere($column, $search));
            $request->merge(['cantidad' => collect($cl)->get('cantidad')+$request->get('cantidad')]);
            $cl = collect($cl)->merge($request->except($except));
            $cls->push($cl);
            Session::put($token, $cls);
        }else{
            $request->merge(['id' => $collections->count() + 1]);
            $collections->push($request->except($except));
            Session::put($token, $collections);
        }
        return ($collections->where($column, $search));
    }

    public static function updateOrCreateEditable($token, Request $request, $except = null, $column, $search){
        $collections = collect(Session::get($token));
        if($collections->contains($column, $search)){
            $cls = ($collections->where($column, '<>', $search));
            $cl = ($collections->firstWhere($column, $search));
            $cl = collect($cl)->merge($request->except($except));
            $cls->push($cl);
            Session::put($token, $cls);
        }else{
            $request->merge(['id' => $collections->count() + 1]);
            $collections->push($request->except($except));
            Session::put($token, $collections);
        }
        return ($collections->where($column, $search));
    }

    public static function destroy($token, $id){
        $collections = collect(Session::get($token));
        if($collections->contains('id', $id)){
            $cls = ($collections->where('id', '<>', $id));
            $row = ($collections->firstWhere('id', $id));
            if (is_null($cls)) {
                $field = collect($row);
                $field->each(function ($item, $key) use($row){
                    $row->merge([$key => null]);
                });
                $cls->push($row);
            }
            Session::put($token, $cls);
            return true;
        }
        return false;
    }
}