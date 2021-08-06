<?php


namespace App\Http\Controllers;


use App\Models\Plan;
use App\Models\PlanUser;
use App\Models\Wallet as WalletAlias;
use Illuminate\Support\Facades\Auth;

class Home extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $plans = null;
        if (Auth::guard('vendor')->check())
        {
           $plan = Plan::where('vendor_id', $user->id)
                    ->distinct('id')
                    ->count();
            $type = 'vendor';
        }else{
            $plan = PlanUser::where('user_id', $user->id)->distinct('id')->count();
            $type = 'user';
        }
        $wallet = WalletAlias::where('user_id', $user->id)
            ->where('user_type', $type)
            ->first();
        //dd($wallet);
        return view("dashboard.index", compact('wallet', 'plan'));
    }
}
