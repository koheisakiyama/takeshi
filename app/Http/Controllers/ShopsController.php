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
    
    public function show($id){
    // ルート表示のコントローラー
    //出発地(検索で選択された場所)と目的地(クリックされた店のid)のlatとlonを取得、ビューに渡す。seina

    $shop_id = Shop::find($id); //idからDBにアクセスして取得したレコード。

    //  $start = (35.658034,139.701636); //渋谷駅(一応出発地に設定)
      $lat1 = 35.658034;
      $lon1 = 139.701636;
    //出発地の場合分けをする 江田
      switch ($shop_id->area) {
        case '新宿':
          $lat1 = 35.691976;
          $lon1 = 139.701383;
          break;
        case '品川':
          $lat1 = 35.628848;
          $lon1 = 139.738642;
          break;
        case '渋谷':
          $lat1 = 35.658034;
          $lon1 = 139.701636;
          break;
      }
        
      $lat2 = $shop_id->lat; //取得したレコードのlat,lonを取得。したい。。
      $lon2 = $shop_id->lon; 

      return view('shops.road')->with(array('lat1'=>$lat1,'lon1'=>$lon1, 'lat2'=>$lat2 ,'lon2'=> $lon2));
    }
}
