<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use function Termwind\render;

class porductController extends Controller
{
  public function show(request $request){

    $product = Model::get($request->productCode);



  }
}
