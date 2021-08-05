<?php


namespace App\Http\Controllers;


use App\Models\TransactionReference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use KingFlamez\Rave\Facades\Rave;

class Pay extends Controller
{
    public function fundWallet()
    {
        return view("dashboard.fund-wallet");
    }

    public function fundWalletCallback()
    {
        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {

            $transactionID = Rave::getTransactionIDFromCallback();
            $data = Rave::verifyTransaction($transactionID);

            return redirect()->back()->with("success", "Payment was successful");
            dd($data);
        }
        elseif ($status ==  'cancelled'){
            return redirect()->back()->with("error", "Payment was canceled");
            //Put desired action/code after transaction has been cancelled here
        }
        else{
            return redirect()->back()->with("error", "Payment was not successful");
            //Put desired action/code after transaction has failed here
        }
    }

    public function initialize(Request $request)
    {
        $user = Auth::user();

        TransactionReference::create([
            'user_id'=>$user->id,
            'type'=>'fund',
            'reference'=>$reference = Rave::generateReference(),
        ]);

        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => $request->amount,
            'email' => $user->email,
            'tx_ref' => $reference,
            'currency' => "NGN",
            'redirect_url' => route('fund-callback'),
            'customer' => [
                'email' => $user->email,
                "phone_number" => '',
                "name" => $user->name
            ],

            "customizations" => [
                "title" => 'Fund wallet',
                "description" => "Fund wallet on akawobekee"
            ]
        ];

        $payment = Rave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return;
        }

        return redirect($payment['data']['link']);
    }
}
