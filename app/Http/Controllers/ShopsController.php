<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Shop;

class ShopsController extends Controller
{
    public function index() {
      return view ('shops.index');
    }
    public function search() {
      //$shops = Shop::all();
      $shop = "hoge";
      return view ('shops.search') -> with('shop', $shop);
      //return view ('shops.search') -> with('shops', $shops);
    }
}
