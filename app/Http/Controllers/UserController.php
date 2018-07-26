<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Shop;
use App\History;
use App\User;
use Auth;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', array('except' => 'login'));
    }

    public function login() {
      $login = "ログイン画面";

      return view ('auth.login');
    }
    public function complete(){
      $c_singup = "登録完了";
      return view ('auth.complete');
          }

//閲覧履歴をテーブルに登録する
    public function store(Request $request) {
      $history = History::create(
        array(
          'user_id' => $request->user_id,
          'shop_id' => $request->shop_id
        )
      );
      return response();
      // お手本ではセミコロン以前にjson($memo)がある
    }


//マイページ(閲覧履歴)の表示
    public function show($id) {
      $name = Auth::user($id)->name;
      $history = History::where('user_id', $id)->get();
      $history = $history->unique('shop_id');

      return view ('auth.history')->with(array('name' => $name, 'history'=> $history));

    }

    // 以下省略
}