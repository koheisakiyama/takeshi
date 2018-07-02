<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ShopsController extends Controller
{
    //
  public function show()
    {
    // ルート表示のコントローラー。。seina

      return view('shops.road');
    }
}
