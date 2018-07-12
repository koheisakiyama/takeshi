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

      $keyword = $request->keyword;
      $area = $request->area;
      $category = $request->category;
      $ar_method = $request->method;

// 絞り込み

      //キーワード検索
      $shops = Shop::where('name', 'LIKE', "%{$request->keyword}%")->get();
      //地域検索
      if(null != $area){
        $shops = $shops->where('area',$area);
      }
      //カテゴリー検索
      if(null != $category){
        $shops = $shops->where('category',$category);
      }
      //支払い方法検索
      if(null != $ar_method){
        //foreach構文内用の箱を用意
        $methodColl = collect();
        foreach( $ar_method as $method ){
        //それぞれのコレクションをに追加する。
          $methodColl = $methodColl->merge($shops->where($method, 1));
        }
      //絞込み結果を$shopsに戻す
        $shops = $methodColl;
      //重複をなくす
        $shops = $shops->unique();
      }

//絞込みここまで

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
          $lat1 = 35.68959;
          $lon1 = 139.69821;
          break;
        case '品川':
          $lat1 = 35.6284; 
          $lon1 = 139.736571;
          break;
        case '渋谷':
          $lat1 = 35.65803;
          $lon1 = 139.699447;
          break;
      }
        
      $lat2 = $shop_id->lat; //取得したレコードのlat,lonを取得。したい。。
      $lon2 = $shop_id->lon; 

      return view('shops.road')->with(array('lat1'=>$lat1,'lon1'=>$lon1, 'lat2'=>$lat2 ,'lon2'=> $lon2));
    }
}
