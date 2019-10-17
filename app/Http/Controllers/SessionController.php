<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        $session_id = request()->session()->getId();
        return response()->json(['session_id' => $session_id]);
    }
}
