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
      return view ('shops.search');
    }

    public function result() {
      //$shop = Shop::find(1);
      $shops = Shop::orderBy('id', 'ASC')->take(5)->get();
      //$shops = Shop::all();
      //$shop = "hoge";
      //return view ('shops.result') -> with('shop', $shop);
      return view ('shops.result') -> with('shops', $shops);
    }
}
