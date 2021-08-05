<?php


namespace App\Http\Controllers;


use App\Models\Wallet as WalletAlias;
use Illuminate\Support\Facades\Auth;

class Home extends Controller
{
    public function index()
    {
        if (Auth::guard('vendor')->check())
        {
            $type = 'vendor';
        }else{
            $type = 'user';
        }
        $user = Auth::user();
        $wallet = WalletAlias::where('user_id', $user->id)
            ->where('user_type', $type)
            ->get();
        return view("dashboard.index", compact('wallet'));
    }
}
