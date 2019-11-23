<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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

    public function login(Request $request)
    {

        $username = $request->username;
        $password = $request->password;

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::Search($username)->latest()->first();
        if ($user == null) {
            return response()->json(['status' => 'false', 'message' => 'نام کاربری یا رمز عبور اشتباه است']);
        } else if (Hash::check($password, $user->password)) {
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            Auth::login($user, true);

            return response()->json([
                "status" => 'true',
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'username' => $user->username,
                'userId' => $user->id,
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()

            ]);
        }
    }

    public function CheckLoginStatus(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
