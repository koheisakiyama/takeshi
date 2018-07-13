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


    // 以下省略
}