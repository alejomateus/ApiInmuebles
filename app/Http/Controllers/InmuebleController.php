<?php

namespace App\Http\Controllers;
use App\Inmuebles;
use App\Requests\InmueblesRequest;
use App\Helpers\ApiResponse;

class InmuebleController extends Controller
{
    public function index(){
        try{
           $inmuebles=Inmuebles::all();
           $response = new ApiResponse(200, "Success", $inmuebles);
        }
        catch (\Exception $e) {
            $response = new ApiResponse(500, "Error", [$e->getMessage()]);
       }
       return $response->response();
        
     }
     public function store(InmueblesRequest $request)
     {
        try{
            $inmuebles=Inmuebles::all();
            $response = new ApiResponse(200, "Success", $inmuebles);
         }
         catch (\Exception $e) {
             $response = new ApiResponse(500, "Error", [$e->getMessage()]);
        }
        return $response->response();
     }
}
