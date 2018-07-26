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
        $shops = $shops->unique('shop_id');
      }
      //絞込みここまで

      //中心の位置座標 何も入れなければ現在地にしたい。
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
        default:
          $latlng = null;
          break;
      }

      return view ('shops.result') -> with(['shops' => $shops, 'latlng'=>$latlng]);
    }
    

    // ナビのスタートと手段の選択
    public function select($id){
      $shop = Shop::find($id); //idからDBにアクセスして取得したレコード。
      $latlng = ['lat'=>$shop->lat, 'lng'=>$shop->lon];
      return view('shops.select')->with(['shop' => $shop, 'latlng'=>$latlng]);
    }

    // ナビゲーションのアクション
    public function navi(Request $request, $id){
      // ルート表示のコントローラー
      //出発地(検索で選択された場所)と目的地(クリックされた店のid)のlatとlonを取得、ビューに渡す。seina
      $shop = Shop::find($id); //idからDBにアクセスして取得したレコード。
      $s_latlng = null;
      if(is_numeric($request->startLat) and is_numeric($request->startLng)){
        $s_latlng = ['lat'=>floatval($request->startLat), 'lng'=>floatval($request->startLng)];
      } else {
        $s_latlng = null;
      }
      $modeType = $request->modeType;
      return view('shops.navi')->with(['shop' => $shop, 's_latlng' => $s_latlng, 'modeType'=>$modeType]);
    }
}
