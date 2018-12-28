<?php

namespace App\Http\Controllers;
use App\Cities;
use App\Helpers\ApiResponse;


use Illuminate\Http\Request;

class CiudadController extends Controller
{
   public function index(){
      try{
         $ciudades=Cities::all();
         $response = new ApiResponse(200, "Success", $ciudades);
      }
      catch (\Exception $e) {
         $response = new ApiResponse(500, "Error", [$e->getMessage()]);
     }
     return $response->response();
      
   }
   public function store(Request $request)
   {
       $name = $request->input('name');

       //
   }
}
