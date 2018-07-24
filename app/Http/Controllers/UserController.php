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

//マイページ(閲覧履歴)の表示
    public function show() {
      // $name = Auth::user($id)->name;
      // $histories = History::where('user_id', Auth::user()->id)->get()->pagenate(5);

      return view ('auth.history');
      // ->with(array('name' => $name, 'history'=> $histories));

    }

    // 以下省略
}