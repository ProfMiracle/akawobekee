<?php


namespace App\Http\Controllers\Auth;


use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware("guest");
        $this->middleware("guest:web");
        $this->middleware("guest:vendor");
    }

    public function showVendorRegisterForm()
    {
        return view("auth.register");
    }

    public function submitVendorRegisterForm(Request $request)
    {
        $this->validate($request, [
            'fname'   => 'required',
            'lname'   => 'required',
            'email'   => 'required|email|unique:vendors',
            'password' => 'required|min:6|confirmed',
            'franchise'=>'required|unique:vendors'
        ]);

        $data = [
            "first_name"=>$request->fname,
            "last_name"=>$request->lname,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
            "franchise"=>$request->franchise
        ];

        Vendor::create($data);

        return redirect()->route("vendor-login")->with("success", "Registration success");
    }

    public function showUserRegisterForm()
    {
        return view("auth.register");
    }

    public function submitUserRegisterForm(Request $request)
    {
        $this->validate($request, [
            'fname'   => 'required',
            'lname'   => 'required',
            'email'   => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = [
            "first_name"=>$request->fname,
            "last_name"=>$request->lname,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
        ];

        User::create($data);

        return redirect()->route("login")->with("success", "Registration success");
    }
}
