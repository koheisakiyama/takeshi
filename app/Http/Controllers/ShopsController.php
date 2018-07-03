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
    
    public function show($id){
    // ルート表示のコントローラー
    //出発地(検索で選択された場所)と目的地(クリックされた店のid)のlatとlonを取得、ビューに渡す。seina

    //  $start = (35.658034,139.701636); //渋谷駅(一応出発地に設定)
      $lat1 = 35.658034;
      $lon1 = 139.701636;

      $shop_id = Shop::find($id); //idからDBにアクセスして取得したレコード。

      $lat2 = $shop_id->lat; //取得したレコードのlat,lonを取得。したい。。
      $lon2 = $shop_id->lon; 

      return view('shops.road')->with(array('lat1'=>$lat1,'lon1'=>$lon1, 'lat2'=>$lat2 ,'lon2'=> $lon2));
    }
}