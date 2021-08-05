<?php


namespace App\Http\Controllers;


use App\Models\Plan;
use App\Models\PlanUser;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class User extends Controller
{
    public function vendorList()
    {
        return view("dashboard.vendor");
    }

    public function vendorListAjax(Request $request)
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
        $query = Vendor::query();
        $q = clone $query;
        $totalRecords = $q->select('count(*) as allcount')->count();
        $totalRecordswithFilter = Vendor::select('count(*) as allcount')->where('franchise', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Vendor::orderBy($columnName,$columnSortOrder)
            ->where('vendors.franchise', 'like', '%' .$searchValue . '%')
            ->select('vendors.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        $x = 1;
        foreach($records as $record){
            $id = $x;

            $data_arr[] = array(
                "id" => $id,
                "franchise" => $record->franchise,
                "vendor name" => $record->first_name. " " .$record->last_name,
                "email" => $record->email,
                "action"=>"<a href=\"vendor/$record->id\" class=\"btn-primary\"><i class=\"fa fa-eye\"></i>View</a>"
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

    public function viewSingleVendor(Request $request)
    {
        $vendor = Vendor::find($request->id);
        $plans = Plan::where("vendor_id", $request->id)->get();
        return view("dashboard.single-vendor", compact("vendor", "plans"));
    }

    public function myPlans(Request $request)
    {
        $user = Auth::user();
        /**
         * use datatable to get plans
         */

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
        $query = PlanUser::query();
        $q = clone $query;
        $totalRecords = $q->select('count(*) as allcount')->count();
        $totalRecordswithFilter = PlanUser::select('count(*) as allcount')->where('status', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Plan::orderBy($columnName,$columnSortOrder)
            ->join('plan_users', 'plans.id', '=', 'plan_users.plan_id')
            ->join('vendors', 'vendors.id', '=', 'plans.vendor_id')
            ->where('plan_users.user_id', $user->id)
            ->where('plans.name', 'like', '%' .$searchValue . '%')
            ->select('plans.name','plans.amount','plans.duration', 'plan_users.join_date','plan_users.mature_date', 'vendors.franchise')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        $x = 1;
        foreach($records as $record){
            $id = $x;

            $data_arr[] = array(
                /*"id" => $id,*/
                "franchise" => $record->franchise,
                "name" => $record->name,
                "amount" => $record->amount,
                "duration" => $record->duration,
                "join date" => $record->join_date,
                "mature date" => $record->mature_date,
                /*"status"=>($record->status == 1)?"in progress": "finished"*/
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

    public function viewMyPlans()
    {
        return view("dashboard.view-plans");
    }

    public function subscribeToPlan(Request $request)
    {
        $user = Auth::user();
        $already = PlanUser::where("user_id", $user->id)
            ->where("plan_id", $request->id)
            ->get();

        if (!$already->isEmpty()):
            return redirect()->back()->with("error", "you are subscribed to this plan");
        endif;

        $plan = Plan::find($request->id);

        PlanUser::create([
            "user_id"=>$user->id,
            "plan_id"=>$request->id,
            "join_date"=>Carbon::now(),
            "mature_date"=>Carbon::now()->addMonths($plan->duration)
        ]);

        return redirect()->back()->with("success", "you have subscribed successfully to this plan");
    }

    public function accountDetails()
    {
        return (new Wallet())->showWallet("web");
    }

    public function addAccount(Request $request)
    {
        return (new Wallet())->addBankAccount($request, "user");
    }

    public function withdraw()
    {
        return (new Wallet())->showWithdrawRequest();
    }

    public function submitWithdraw(Request $request)
    {
        return (new Wallet())->withdrawSubmit($request);
    }

    public function profileView()
    {
        return (new Profile())->viewProfile(Auth::guard("web")->user());
    }

    public function storeProfile(Request $request)
    {
        return (new Profile())->storeProfile($request, "user");
    }
}
