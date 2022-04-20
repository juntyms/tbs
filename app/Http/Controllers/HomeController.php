<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Tutor;
use Illuminate\Http\Request;
use App\Models\Model_has_role;
use App\Models\Tutorial_request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $superUser=False;
        $DepAdminUser=False;
        $TutorUser=False;
        $StudentUser=False;
       


        $checkrols= Model_has_role::firstwhere('model_id',Auth::User()->id);
       
        if($checkrols)
        {
            $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id',$checkrols->role_id)->get();

            if($rolePermissions)
            {
                foreach($rolePermissions as $permission)
                {
                    if($permission->permission_id==1)
                    {
                        $superUser=True;
                    }
                    elseif($permission->permission_id==19)
                    {
                        $DepAdminUser=True;
                    }
                    elseif($permission->permission_id==37)
                    {
                        $TutorUser=True;
                    }
                    elseif($permission->permission_id==32)
                    {
                        $StudentUser=True;
                    }
                }

            }

        }
        if($superUser)
        {
            return view('home');

        }elseif($DepAdminUser)
        {
            return view('home');

        }elseif($TutorUser && $StudentUser)
        {
           


            
            return redirect()->route('tutordashboard');
        }elseif($StudentUser)
        {
           

            
            return redirect()->route('studentdashboard');

        }elseif($TutorUser)
        {
            
            return redirect()->route('tutordashboard');

        }else{
            Auth::logout();
            return redirect('/');
            

        }
       
    }

    public function profile()
    {

        $userprofile=User::findOrFail(Auth::User()->id);

        return view('users.profile')->with('userpofile',$userprofile);
    }

    public function Editeprofile(Request $request)
    {
        $userprofile=User::findOrFail(Auth::User()->id);

        if($request->hasFile('photo')){
            $filename = $request->photo->extension();

            $filename=$userprofile->username.'.'.$filename;

            
            $path = $request->file('photo')->storeAs('public/images', $filename);
            $userprofile->update(['photo'=>$filename]);
        }
        if($request->has('about'))
        {
            $userprofile->update(['about'=>$request->about]);

        }
        if($request->has('phone'))
        {
          $userprofile->update(['phone'=>$request->phone]);

        }
        Alert::toast('Profile updated!','success');
        return redirect()->route('user.profile');


    }
}
