<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;

class CookieController extends Controller
{
    public function setCookie(Request $request)
    {
        $minutes = 1;


        return response()->json(['item' => 'added'])->withCookie(cookie('product', 'MyValue', $minutes));;
    }
    public function getCookie(Request $request)
    {
        $value = $request->cookie('name');
        echo $value;
    }
}
