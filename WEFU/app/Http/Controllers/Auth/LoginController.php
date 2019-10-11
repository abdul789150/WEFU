<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

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
            return redirect()->intended('home');
        }
        
        return redirect()->back()->withErrors( [
            'username_email' => 'Please, check your credentials',
        ] );

    }

}
