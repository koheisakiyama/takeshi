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

    public function result(Request $request) {

      $area = $request->area;
      $category = $request->category;

      //先にエリアとカテゴリーで検索をかける。
      $withoutService = Shop::where('area', $area)->where('category', $category)->get();
      //ビューに渡すようのコレクションを用意する
      $shops = collect(); 
      //それぞれのサービスごとに検索
      foreach((array) $request->method as $method){
        //それぞれのコレクションをshopsに追加する。
        $shops = $shops->merge($withoutService->where($method, 1));
      }
      //重複をなくす
      $shops = $shops->unique();

      //中心の位置座標
      $latlng = ['lat'=>35.6284, 'lng'=>139.736571];
      switch ($area) {
        case '新宿':
          $latlng = ['lat'=>35.68959, 'lng'=>139.69821];
          break;
        case '品川':
          $latlng = ['lat'=>35.6284, 'lng'=>139.736571];
          break;
        case '渋谷':
          $latlng = ['lat'=>35.65803, 'lng'=>139.699447];
          break;
      }
      
      return view ('shops.result') -> with(['shops' => $shops, 'latlng'=>$latlng]);
    }
}
