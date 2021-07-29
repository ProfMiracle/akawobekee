<?php


namespace App\Http\Controllers;


use App\Models\AccountDetail;
use App\Models\PlanUser;
use App\Models\WithrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Wallet
{
    public function showWallet($type=null)
    {
        $wallet = ($type == "vendor")? \App\Models\Wallet::find(Auth::guard("vendor")->user()->id)
            :\App\Models\Wallet::find(Auth::id());
        $account = ($type == "vendor")? \App\Models\AccountDetail::find(Auth::guard("vendor")->user()->id)
            :\App\Models\AccountDetail::find(Auth::id());
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
        }
        else
        {
            $user = Auth::user();
        }

        /**
         * check if to update or insert
         */

        $a = AccountDetail::where("user_id", $user->id);
        if (empty($a))
        {
            AccountDetail::create([
                "user_id"=>$user->id,
                "account_name"=>$request->aname,
                "account_number"=>$request->anum,
                "bank_name"=>$request->bname,
                "sort_code"=>$request->scode
            ]);
        }else
        {
            $a->account_name = $request->aname;
            $a->account_number = $request->anum;
            $a->bank_name = $request->bname;
            $a->sought_code = $request->acode;
            $a->save();
        }

        return redirect()->back()->with("success", "update was successful");
    }

    public function showWithdrawRequest($type = null)
    {
        $user = ($type == "vendor")? Auth::guard("vendor")->user():Auth::user();
        return view("dashboard.withdraw", compact("user"));
    }

    public function withdrawRequestAjax(Request $request)
    {
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
        $totalRecords = WithrawRequest::select('count(*) as allcount')->count();
        $totalRecordswithFilter = WithrawRequest::select('count(*) as allcount')->where('amount', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = WithrawRequest::orderBy($columnName,$columnSortOrder)
            ->where('user_id', $request->user)
            ->where('withraw_requests.amount', 'like', '%' .$searchValue . '%')
            ->select('withraw_requests.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        $x = 1;
        foreach($records as $record){
            $id = $x;

            $data_arr[] = array(
                "id" => $id,
                "amount" => $record->name,
                "date" => $record->created_at,
                "status" => $record->status,
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
}
