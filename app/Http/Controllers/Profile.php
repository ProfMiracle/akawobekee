<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Profile extends Controller
{
    public function viewProfile($user = null)
    {
        return view("dashboard.profile", compact("user"));
    }

    public function storeProfile(Request $request, $type)
    {
        switch ($type)
        {
            case "vendor":
                $model = new \App\Models\Vendor();
                $user = Auth::guard("vendor")->user();
                break;
            default:
                $model = new User();
                $user = Auth::user();
                break;
        }

        $u = $model::find($user->id);
        $u->first_name = $request->fname;
        $u->last_name = $request->lname;
        $u->email = $request->email;
        $u->phone = $request->phone;

        /**
         * upload image if need be
         */
        if(isset($_FILES['image']))
        {
            $total = count($_FILES['image']['name']);

            for( $i=0 ; $i < $total ; $i++ ) {
                //Get the temp file path
                $tmpFilePath = $_FILES['image']['tmp_name'][$i];

                //Make sure we have a file path
                if ($tmpFilePath != ""){
                    //Setup our new file path
                    $newFilePath = "./img/uploads/" . $_FILES['image']['name'][$i].time();

                    //Upload the file into the temp dir
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

                        /**
                         * add the new file to model db
                         */
                        $u->photo = $newFilePath;

                    }
                }
            }
        }

        $u->save();

        return redirect()->back();
    }
}
