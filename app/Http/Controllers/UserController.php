<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Shop;

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

    // 以下省略
}