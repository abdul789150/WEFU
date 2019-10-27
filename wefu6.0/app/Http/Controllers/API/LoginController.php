<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public $success_status = 200;
    public $unauth_error = 401;

    public function login(Request $request)
    {
        // The name of input field is "username_email"/

        $username_email = $request->username_email;
        
        // dd($username_email);

        if ( filter_var($username_email, FILTER_VALIDATE_EMAIL) )
        {   //IF user has entered their email address
            Auth::attempt( [ 'email'=>$username_email, 'password'=>$request->password ] );

        } else{
            Auth::attempt( [ 'username'=>$username_email, 'password'=>$request->password ] );
        }
        
        // If any of those conditions were true
        if( Auth::check() ){
            $user = Auth::user();
            $success['token'] = $user->createToken('WEFU Password Grant Client')->accessToken;
            return response()->json(['success' => $success, 'user' => $user], $this->success_status);
        }
        
        return response()->json(['error' => 'Email/Username or Password Error'], $this->unauth_error);
    }
}
