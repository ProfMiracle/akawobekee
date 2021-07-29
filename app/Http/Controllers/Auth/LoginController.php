<?php


namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware("guest")->except("logout");
        $this->middleware("guest:web")->except("logout");
        $this->middleware("guest:vendor")->except("logout");
    }

    public function showVendorLoginForm()
    {
        return view("auth.login");
    }

    public function submitVendorLoginForm(Request $request)
    {
        $request->validate([
            "email"=>'required|email',
            "password"=>"required"
        ]);

        if (Auth::guard('vendor')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/vendor/dashboard');
        }

        return back()->withInput($request->only('email', 'remember'))->with("error", "Invalid login credentials");
    }

    public function showUserLoginForm()
    {
        return view("auth.login");
    }

    public function submitUserLoginForm(Request $request)
    {
        $request->validate([
            "email"=>'required|email',
            "password"=>"required"
        ]);

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/vendor/dashboard');
        }

        return back()->withInput($request->only('email', 'remember'))->with("error", "Invalid login credentials");
    }

    public function logout()
    {
        if (Auth::guard("vendor")->check())
        {
            Auth::guard("vendor")->logout();
        }else{
            Auth::logout();
        }
    }
}
