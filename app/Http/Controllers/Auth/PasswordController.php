<?php


namespace App\Http\Controllers\Auth;


use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends \App\Http\Controllers\Controller
{
    public function viewChangePassword()
    {
        return view("auth.change-password");
    }

    public function changePassword(Request $request, $type)
    {
        $request->validate([
            'opass'=>'required',
            'npass'=>'required'
        ]);
        $user = ($type == "vendor")? Auth::guard("vendor")->user():Auth::user();
        if (password_verify($request->opass, $user->password))
        {
            $method = ($type == "vendor")? new Vendor(): new User();

            $d = $method::find($user->id);
            $d->password = Hash::make($request->npass);
            $d->save();

            return redirect()->back();
        }

        return redirect()->back();
    }
}
