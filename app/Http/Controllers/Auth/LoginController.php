<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    */

    use AuthenticatesUsers;

    // protected $redirectTo = 'post';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $username = $request->input('username');
        $password = $request->input('password');

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::Search($username)->latest()->first();
        if ($user == null) {
            return response()->json(['status' => 'false', 'message' => 'نام کاربری یا رمز عبور اشتباه است']);
            // return redirect()->back()->with('message', 'username or password is wrong');
        } else if (Hash::check($password, $user->password)) {

            $session_id = session()->getId();
            Auth::login($user, true);
            return response()->json([
                'status' => 'true',
                'username' => $request->username,
                'userId' => $user->id,
                'sessionId' => $session_id
            ]);
        }
    }
}
