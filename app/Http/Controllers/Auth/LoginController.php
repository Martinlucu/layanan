<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\Admin as Authenticatable;
use Illuminate\Http\Request;
use Auth;

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

    use AuthenticatesUsers{
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('guest')->except('logout');
       $this->middleware('guest:aak')->except('logout');
       $this->middleware('guest:mhs')->except('logout');
       
    }
   
   public function login(Request $request)
    {   
        $input = $request->all();
  
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
  
       $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'email';
        if(auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password'])))
        {
            return redirect()->route('home');
        }
        if (Auth::guard('aak')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $details = Auth::guard('aak')->user();
            $aak = $details['original'];
            return redirect()->intended("/aak");
        } else if (Auth::guard('mhs')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $details = Auth::guard('mhs')->user();
            $aak = $details['original'];
            return redirect()->intended("/mhs");
        } else {
            return redirect()->intended("/login");
        }
}


public function logout(Request $request)
{
    $this->performLogout($request);
    return redirect()->route('login');
}
}
    