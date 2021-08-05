<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Auth\PasswordController;
use App\Models\Plan;
use App\Models\PlanUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Vendor extends Controller
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $user;

    public function __construct()
    {
        $this->user = Auth::guard("vendor")->user();
    }

    public function addPlan()
    {
        return view("dashboard.add_plan");
    }

    public function storePlan(Request $request)
    {
        $this->user = Auth::guard("vendor")->user();
        $request->validate([
            'name'=>'required|string',
            'amount'=>'required',
            'duration'=>'required',
            'commission'=>'required'
        ]);

        Plan::create([
            'vendor_id'=>$this->user->id,
            'name'=>$request->name,
            'amount'=>$request->amount,
            'duration'=>$request->duration,
            'commission'=>$request->duration
        ]);
        return redirect()->back()->with("success", "plan created successfully");
    }

    public function viewPlans()
    {
        return view("dashboard.plan-view");
    }

    public function plansDatatableAjax(Request $request)
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
        $query = Plan::query();
        $q = clone $query;
        $totalRecords = $q->select('count(*) as allcount')->count();
        $totalRecordswithFilter = Plan::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Plan::orderBy($columnName,$columnSortOrder)
            ->where('plans.name', 'like', '%' .$searchValue . '%')
            ->select('plans.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        $x = 1;
        foreach($records as $record){
            $id = $x;

            $data_arr[] = array(
                "id" => $id,
                "name" => $record->name,
                "amount" => $record->amount,
                "duration" => $record->duration,
                "commission" => $record->commission,
                "action"=>"<a href=\"plan/$record->id\" class=\"btn btn-primary\"><i class=\"\"></i>View</a>
                            <a href=\"plan/$record->id/edit\" class=\"btn btn-secondary\"><i class=\"\"></i>Edit</a>
                            <a href=\"\" class=\"btn btn-warning\"><i class=\"\"></i>Delete</a>"
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

    public function viewPlan(Request $request)
    {
        $plan = Plan::findOrFail($request->id);
        return view("dashboard.view-plan", compact("plan"));
    }

    public function viewPlanUsersAjax(Request $request)
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
        $totalRecords = PlanUser::select('count(*) as allcount')->count();
        $totalRecordswithFilter = PlanUser::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = PlanUser::orderBy($columnName,$columnSortOrder)
            ->where('plan_id', $request->id)
            ->where('plan_users.name', 'like', '%' .$searchValue . '%')
            ->select('plan_users.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        $x = 1;
        foreach($records as $record){
            $id = $x;

            $data_arr[] = array(
                "id" => $id,
                "name" => $record->name,
                "email" => $record->email,
                "phone" => $record->phone,
                "join_date" => $record->join,
                "mature_date" => $record->mature,
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

    public function viewPlanUsers(Request $request)
    {
        $plan = $request->id;
        return view("dashboard.view-plan", compact("plan"));
    }

    public function editPlan(Request $request)
    {
        /**
         * if people are already on this plan, don't permit amount, duration and commission edit
         */
        //TODO
        $p = Plan::find($request->id);
        $p->name = "";
        $p->amount = "";
        $p->duration = "";
        $p->commission = "";
        $p->save();

        return redirect()->back()->with("");
    }

    public function showEditPlan(Request $request)
    {
        $plan = $request->id;
        return view("dashboard.plan-edit", compact("plan"));
    }

    public function profileView()
    {
        return (new Profile())->viewProfile(Auth::guard("vendor")->user());
    }

    public function storeProfile(Request $request)
    {
        return (new Profile())->storeProfile($request, "vendor");
    }

    public function showChangePassword()
    {
        return (new PasswordController())->viewChangePassword();
    }

    public function changePassword(Request $request)
    {
        return (new PasswordController())->changePassword($request, "vendor");
    }

    public function showWallet()
    {
        return (new Wallet())->showWallet("vendor");
    }

    public function addAccount(Request $request)
    {
        return (new Wallet())->addBankAccount($request, "vendor");
    }

    public function showWithdraw()
    {
        return (new Wallet())->showWithdrawRequest("vendor");
    }
}
