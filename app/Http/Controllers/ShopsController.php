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
      $area = '渋谷';
      $category = 'レストラン';

      //空のコレクション(Laravelで使える配列みたいなもの)を用意する
      $origami = collect(); 
      $rakuten = collect(); 
      $line    = collect(); 

      //先にエリアとカテゴリーで検索をかける。
      $withoutService = Shop::where('area', $area)->where('category', $category)->get();
      //それぞれのサービスごとに検索
      if(true) $origami = $withoutService->where('origami', 1);
      if(true) $rakuten = $withoutService->where('rakuten', 1);
      if(true) $line = $withoutService->where('line', 1);

      //ビューに渡すようのコレクションを用意する
      $shops = collect(); 
      //それぞれのコレクションをshopsに追加する。
      $shops = $shops->merge($origami); 
      $shops = $shops->merge($rakuten);
      $shops = $shops->merge($line);
      //重複をなくす
      $shops = $shops->unique();
      
      $test = Shop::take(5)->get();
      return view ('shops.result') -> with(['shops' => $shops, 'test' => $test]);
    }
    
    public function show()
    {
    // ルート表示のコントローラー。。seina

      return view('shops.road');
    }
}