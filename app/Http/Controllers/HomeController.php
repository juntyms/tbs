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
        $currentdatetime=new DateTime();
        $currentdate=$currentdatetime->format('Y-m-d');
        $currenthour=$currentdatetime->format('H');
       


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
            return redirect()->route('superuserpage',($page ='users'));

        }elseif($DepAdminUser)
        {
            return redirect()->route('user.index');

        }elseif($TutorUser && $StudentUser)
        {
            $listTutorial=Tutorial_request::where('user_id',Auth::User()->id)
                                        ->where('active',1)
                                        ->whereExists(function($query){
                                                $query->where('accepted',0)
                                                    ->orWhere('accepted',1);})->get();

            if($listTutorial)
            {
                foreach($listTutorial as $list)
                {
                    if($list->date<$currentdate)
                    {
                        $list->update(['accepted'=>4]);
                    }elseif($list->date==$currentdate)
                    {
                        if($list->time<$currenthour)
                        {
                            $list->update(['accepted'=>4]);

                        }
                    }
                }
            }
                                        

            $tutorid=Tutor::firstwhere('user_id',Auth::User()->id);

            if($tutorid)
            {
            $tutorlistTutorial=Tutorial_request::where('tutor_id',$tutorid->id)
                                                ->where('active',1)
                                                ->whereExists(function($query){
                                                        $query->where('accepted',0)
                                                            ->orWhere('accepted',1);})->get();
                if($tutorlistTutorial)
                {
                    foreach($tutorlistTutorial as $list)
                    {
                        if($list->date<$currentdate)
                        {
                            $list->update(['accepted'=>4]);
                        }elseif($list->date==$currentdate)
                        {
                            if($list->time<$currenthour)
                            {
                                $list->update(['accepted'=>4]);

                            }
                        }
                    }
                }
            }


            
            return redirect()->route('student.tutorial.list');

        }elseif($StudentUser)
        {
            $listTutorial=Tutorial_request::where('user_id',Auth::User()->id)
                                        ->where('active',1)
                                        ->whereExists(function($query){
                                                $query->where('accepted',0)
                                                    ->orWhere('accepted',1);})->get();
            
            if($listTutorial)
            {
                foreach($listTutorial as $list)
                {
                    if($list->date<$currentdate)
                    {
                        $list->update(['accepted'=>4]);
                    }elseif($list->date==$currentdate)
                    {
                        if($list->time<$currenthour)
                        {
                            $list->update(['accepted'=>4]);

                        }
                    }
                }
            }


            
            return redirect()->route('student.tutorial.list');

        }elseif($TutorUser)
        {
            $tutorid=Tutor::firstwhere('user_id',Auth::User()->id);

            if($tutorid)
            {
            $tutorlistTutorial=Tutorial_request::where('tutor_id',$tutorid->id)
                                                ->where('active',1)
                                                ->whereExists(function($query){
                                                        $query->where('accepted',0)
                                                            ->orWhere('accepted',1);})->get();
                if($tutorlistTutorial)
                {
                    foreach($tutorlistTutorial as $list)
                    {
                        if($list->date<$currentdate)
                        {
                            $list->update(['accepted'=>4]);
                        }elseif($list->date==$currentdate)
                        {
                            if($list->time<$currenthour)
                            {
                                $list->update(['accepted'=>4]);

                            }
                        }
                    }
                }
            }
            return redirect()->route('Tutor.tutorial.list');

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
