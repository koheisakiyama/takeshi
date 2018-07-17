
<!-- ログイン・会員登録用のコントローラー -->

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Shop;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', array());
    }

    public function login() {
      return view ('content');
    }

    // 以下省略
}