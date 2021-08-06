<?php


namespace App\Http\Controllers;


use App\Models\AccountDetail;
use App\Models\PlanUser;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Wallet
{
    public function showWallet($type=null)
    {
        $wallet = ($type == "vendor")? \App\Models\Wallet::find(Auth::guard("vendor")->user()->id)
            :\App\Models\Wallet::find(Auth::id());
        $account = ($type == "vendor")? \App\Models\AccountDetail::where('user_id',Auth::guard("vendor")->user()->id)
            ->where('user_type', 'vendor')->first()
            :\App\Models\AccountDetail::where('user_id', Auth::id())
            ->where('user_type', 'user')->first();
        return view("dashboard.wallet", compact("wallet", "account"));
    }

    public function addBankAccount(Request $request, $type=null)
    {
        /**
         * this route is used for both adding and updating account details
         */
        if ($type == "vendor")
        {
            $user = Auth::guard("vendor")->user();
            $user_type= 'vendor';
        }
        else
        {
            $user = Auth::user();
            $user_type= 'user';
        }

        /**
         * check if to update or insert
         */

        $a = AccountDetail::where("user_id", $user->id)
            ->where('user_type', $user_type)->get();

        if ($a->isEmpty())
        {
            AccountDetail::create([
                "user_id"=>$user->id,
                "user_type"=>$user_type,
                "account_name"=>$request->aname,
                "account_number"=>$request->anumber,
                "bank_name"=>$request->bname,
                "sort_code"=>$request->scode
            ]);
        }else
        {
            $a = new AccountDetail();
            $a->account_name = $request->aname;
            $a->account_number = $request->anumber;
            $a->bank_name = $request->bname;
            $a->sort_code = $request->acode;
            $a->save();
        }

        return redirect()->back()->with("success", "update was successful");
    }

    public function showWithdrawRequest($type = null)
    {
        $type = ($type == "vendor")? 'vendor':'user';
        return view("dashboard.withdraw", compact("type"));
    }

    public function withdrawRequestAjax(Request $request)
    {
        $user = Auth::user();
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = WithdrawRequest::select('count(*) as allcount')->count();
        $totalRecordswithFilter = WithdrawRequest::select('count(*) as allcount')->where('amount', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = WithdrawRequest::orderBy($columnName,$columnSortOrder)
            ->where('user_id', $user->id)
            ->where('user_type', $request->type)
            ->where('withdraw_requests.amount', 'like', '%' .$searchValue . '%')
            ->select('withdraw_requests.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        $x = 1;
        foreach($records as $record){
            $id = $x;

            $data_arr[] = array(
                "id" => $id,
                "amount" => $record->amount,
                "date" => $record->created_at,
                "status" => ($record->status == 0)?'<span class="alert-info">pending</span>':'<span class="alert-success">fulfilled</span>',
            );
            $x++;
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        return;
    }

    public function withdrawSubmit(Request $request, $type = null)
    {
        $user= Auth::user();
        if ($type == 'vendor'):
            $user_type = 'vendor';
        else:
            $user_type = 'user';
        endif;

        $w = WithdrawRequest::where('user_id', $user->id)
            ->where('user_type', $user_type)
            ->get();
        if ($w->isEmpty()):
            WithdrawRequest::create([
                'user_id'=>$user->id,
                'user_type'=>$user_type,
                'amount'=>$request->amount
            ]);
        else:
            $w->amount = $w->amount + $request->amount;
            $w->save();
        endif;

        return redirect()->back()->with('success', 'Withdraw request placed successfully');
    }
}
