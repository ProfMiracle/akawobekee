<?php


namespace App\Http\Controllers;


use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\Vendor;

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
        $plans = Plan::where("vendor_id", $request->id);
        return view("dashboard.single-vendor", compact("vendor", "plans"));
    }
}
