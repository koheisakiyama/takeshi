<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Shop;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', array('except' => 'login'));
    }

    public function login() {
      $login = "ログイン画面";
      return view ('user.login');
    }

//マイページ(閲覧履歴)の表示
    public function show() {
      $name = Auth::user($id)->name;
      $history = History::where('user_id', $id)->pagenate(5);

      return view ('auth.history')->with(array('history' => $history));


    }

    // 以下省略
}