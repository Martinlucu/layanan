<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
}


public function showmhsLoginForm()
{
    return view('auth.login', ['url' => 'mhs']);
}

public function mhsLogin(Request $request)
{
    $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
    ]);

    if (Auth::guard('mhs')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

        return redirect()->intended("/mhs");
    }
    return back()->withInput($request->only('email', 'remember'));
}

public function showaakLoginForm()
{
    return view('auth.login', ['url' => 'aak']);
}

public function aakLogin(Request $request)
{
    $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
    ]);

    if (Auth::guard('aak')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

        return redirect()->intended("/aak");
    }
    return back()->withInput($request->only('email', 'remember'));
}
public function logout(Request $request)
{
    $this->performLogout($request);
    return redirect()->route('logaak');
}
}
    