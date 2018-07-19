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

//マイページの表示
    public function show() {
      $name = Auth::user()->name;
      // $history = History::where('id', Auth::user()->id)->pagenate(5);

      return view ('auth.history');
    }

    // 以下省略
}