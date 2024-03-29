<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Ay;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Available_course;
use App\Models\Tutorial_request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;


class AdminCourseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:dep-course', ['only' => ['showcourse']]);
        $this->middleware('permission:dep-course-add', ['only' => ['addcoursepost']]);
        $this->middleware('permission:dep-course-edit', ['only' => ['updatecourse']]);
        $this->middleware('permission:dep-course-delete', ['only' => ['deletecourse']]);
        

        $this->middleware('permission:dep-user', ['only' => ['getuseres']]);
        $this->middleware('permission:dep-tutor-list', ['only' => ['getutor']]);
        $this->middleware('permission:dep-tutor-add', ['only' => ['postAssigntutor']]);
        $this->middleware('permission:dep-tutor-delete', ['only' => ['deletetutor']]);

        $this->middleware('permission:dep-AVcourse-list', ['only' => ['showcourseA']]);
        $this->middleware('permission:dep-AVcourse-add', ['only' => ['selectSearch','AddcourseA','Select_AV_Tutor_T','Addvaliablecourse','']]);
        $this->middleware('permission:dep-AVcourse-delete', ['only' => ['deleteAvaliableCourse']]);





    }
    /****************************************Add Delete update  courses ***************************************** */
    public function showcourse(Request $request)
    {
        
        $Dep_Courses=Course::where("department_id",Auth::User()->department_id)
                            ->where('active',1)->get();
        return view('course.index')->with('Dep_Courses', $Dep_Courses);
    }

    public function addcoursepost(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'courscode' => 'required',
        ]);
        $checkifExist=Course::firstwhere(['code'=>$request->courscode,'active'=>1]);
        if(!$checkifExist){

            Course::create(['name'=>$request->name,'code'=>$request->courscode,'department_id'=>Auth::User()->department_id ]);
            Alert::toast('course is Created successfully!! ','success');
            return redirect()->route('course.index');
        }else{
            Alert::toast('course is already exist!! ','warning');
            return redirect()->back();

        }

    }

    public function deletecourse($id)
    {
        $decourse = Course::findOrFail($id);
        if($decourse)
        {
            $Deltrequest_tutorial=[];
            $DeltAvaliable_course=[];
            $DeltAvaliable_course=Available_course::where(['course_id'=>$id,'active'=>1])->get();
          
            if(!$DeltAvaliable_course->isEmpty()){
                foreach($DeltAvaliable_course as $Rup)
                {
                    $DeleteR=Available_course::findOrFail($Rup->id);
                    $DeleteR->update(['active'=>0]);
                    $Deltrequest_tutorial=Tutorial_request::where(['available_course_id'=>$DeleteR->id,'active'=>1])
                                                ->where('accepted',0)
                                                ->orWhere('accepted',1)->get();

        
                    if(!$Deltrequest_tutorial->isEmpty()){
                        foreach($Deltrequest_tutorial as $DRq)
                        {
                            $DeleteRq=Tutorial_request::findOrFail($DRq->id);
                            $DeleteRq->update(['active'=>0,'accepted'=>4]);

                        }
                    }
                }
           
            }
            $decourse->update(['active'=>0]);
            Alert::toast('course is Delete successfully!! ','warning');
            return redirect()->route('course.index');
        }
    
        Alert::toast('course not found ','warning');       
    }
    
    public function updatecourse(Request $request,$id)
    {
        $course = Course::findOrFail($request->id);
      
        $course->update(['name'=>$request->name, 'code'=>$request->coursecode]);

        Alert::toast('course is updated successfully !! ','success');
        return redirect()->route('course.index');
    }

    //*******************************************Add Delete tutor ******************************************** */

    public function getuseres()
    {
        
        $Dep_users=\DB::table('users')->leftJoin('model_has_roles','users.id','=','model_has_roles.model_id')
                                     ->where(function($q){
                                         $q->whereIn('model_has_roles.role_id',['3','4','5'])
                                            ->orWhereNull('model_has_roles.role_id');
                                     })
                                    ->where('users.department_id',Auth::User()->department_id)
                                    ->where('users.active',1)->get();

        
        
        return view('user.index')->with('Dep_users', $Dep_users);
    }
    public function getutor()
    {
        $Dep_tutors=Tutor::where("department_id",Auth::User()->department_id)
                          ->where('active',1)->get();
        return view('user.showtutor')->with('Dep_tutors', $Dep_tutors);
    }


    public function postAssigntutor(Request $request,$id,$dep)
    {
        $this->validate($request, [
            'usertype' => 'required',
        ]);
        $checkuser=User::firstwhere('id', $id);
        if($checkuser)
        {

            $checkifExist=Tutor::firstwhere(['user_id'=>$id]);
            if(!$checkifExist)
            {
                $user = User::find($id);
                DB::table('model_has_roles')->where('model_id',$user->id)->delete();
                $user->assignRole($request->input('roles'));
                
                if($request->usertype==1)
                {
                
                    $user->assignRole('tutor-role');
                
                    Tutor::create(['user_id'=>$id,'department_id'=>$dep,'is_staff'=>1,'is_student'=> 0]);

                }elseif ($request->usertype==2){ 
                    $user->assignRole('student-tutor');
                    Tutor::create(['user_id'=>$id,'department_id'=>$dep,'is_student'=> 1,'is_staff'=>0]);

                }
                Alert::toast('Tutor Created successfully ','success');
                return redirect()->route('user.tutor');
            }else
            {
                if($checkifExist->active==0)
                {
                    $user = User::find($id);
                    DB::table('model_has_roles')->where('model_id',$user->id)->delete();
                    $user->assignRole($request->input('roles'));
                    
                    if($request->usertype==1)
                    {
                    
                        $user->assignRole('tutor-role');
                    
                        $checkifExist->update(['active'=>1,'is_student'=> 0,'is_staff'=>1]);
    
                    }elseif ($request->usertype==2){ 
                        $user->assignRole('student-tutor');
                        $checkifExist->update(['active'=>1,'is_student'=> 1,'is_staff'=>0]);
    
                    }
                    Alert::toast('Tutor Created successfully ','success');
                    return redirect()->route('user.tutor');
                }
                else{

              
                    Alert::toast('the Tutor is already exist!!','warning');
                    return redirect()->back();
                }


            }
        }else{
            Alert::toast('the Tutor is not exist!!','warning');
            return redirect()->back();


        }
        

    }

    
    public function deletetutor($id)
    {
        $detutor = Tutor::firstwhere(['id'=>$id,'active'=>1]);
        
        if($detutor)
        {
            $Deltrequest_tutorial=[];
            $DeltAvaliable_course=[];

            $Deltrequest_tutorial=Tutorial_request::where(['tutor_id'=>$detutor->id,'active'=>1])
                                                ->where('accepted',0)
                                                ->orWhere('accepted',1)->get();

           
            $DeltAvaliable_course=Available_course::where(['tutor_id'=>$detutor->id,'active'=>1])->get();
           
            if(!$Deltrequest_tutorial->isEmpty()){
              
                foreach($Deltrequest_tutorial as $Rup)
                {
                    $DeleteR=Tutorial_request::findOrFail($Rup->id);
                    $DeleteR->update(['active'=>0,'accepted'=>4]);

                }
                
            }
            if(!$DeltAvaliable_course->isEmpty()){
              
                foreach($DeltAvaliable_course as $Dav)
                {
                    $DeleteAv=Available_course::findOrFail($Dav->id);
                    $DeleteAv->update(['active'=>0]);

                }
            }
            $user = User::find($detutor->user_id);
            DB::table('model_has_roles')->where('model_id',$user->id)->delete();
            $user->assignRole('student-role');

            $detutor->update(['active'=>0]);
            Alert::toast('Tutor Deleted successfully ','warning');
            return redirect()->route('user.tutor');
           
        }
        Alert::toast('Tutor is not Delete!! ','warning');
        return redirect()->route('user.tutor');
    }

    //#################################Avaliable courses ###################################
   
   
   
   
    public function showcourseA(Request $request)
    {
        $Aay_id=Ay::firstwhere('is_active', 1);
        $Dep_Courses=[];
        if($Aay_id)
        {
            $Dep_Courses=Available_course::where('ay_id',$Aay_id->id)
                                                ->where('active',1)
                                                ->whereExists(function ($query) {
                                                    $query->select('courses.id')
                                                          ->from('courses')
                                                          ->where('courses.department_id',Auth::User()->department_id)
                                                          ->whereColumn('courses.id','available_courses.course_id');})->get();


        }
        
        return view('avaliableCourse.index')->with('Dep_Courses', $Dep_Courses);
    }
    
    public function selectSearch(Request $request)
    {
    	$tut = [];
        $Aay_id=Ay::firstwhere('is_active', 1);
        if($Aay_id)
        {

            if($request->has('q')){
                $search = $request->q;
                $tut =User::select("id", "fullname")
                        ->where('fullname', 'LIKE', "%$search%")
                        ->where('department_id',Auth::User()->department_id)
                        ->whereExists(function ($query) {
                            $query->select(DB::raw(1))
                                ->from('tutors')
                                ->where('tutors.active',1)
                                ->whereColumn('tutors.user_id', 'users.id');
                        })
                        ->get();
            }
        }
        return response()->json($tut);
    }

    public function AddcourseA()
    {
        $show_AV_time=FALSE;
        return view('avaliableCourse.Addcourse')->with('$show_AV_time', $show_AV_time)
                                                ->with('show_AV_time',$show_AV_time);
    }
    public function Select_AV_Tutor_T(Request $request)
    {
        $show_AV_time=FALSE;
        $tutorid=null;
        $DepC=[];
        $Aay_id=Ay::firstwhere('is_active', 1);
        if($request->has('livesearch'))
        {
            $show_AV_time=TRUE;
            $DepC=Course::selectraw(\DB::raw("concat(courses.code,'- ',courses.name) as name,courses.id"))
           ->where('department_id',Auth::User()->department_id)
                                ->where('active',1)->orderBy('courses.name')->pluck('name','id');
            $userid=$request->input('livesearch.0');
            if($userid)
            {
                $tutorid=Tutor::firstwhere('user_id',$userid);
            }else{
                $userid=$request->input('livesearch');
                $tutorid=Tutor::firstwhere('user_id',$userid);
            }

            if($Aay_id && $tutorid){
            $Dep_Courses= Available_course::get()->where('ay_id',$Aay_id->id)
                                                 ->where('tutor_id',$tutorid->id)
                                                 ->where('active',1);

            return view('avaliableCourse.Addcourse')->with('Dep_Courses', $Dep_Courses)
                                                ->with('show_AV_time',$show_AV_time)
                                                ->with('tutorid',$tutorid)
                                                ->with('DepC',$DepC);
           
            }



        }
        
        $Dep_Courses=Available_course::get()->where('active',1);
        return view('avaliableCourse.Addcourse')->with('Dep_Courses', $Dep_Courses)
                                                ->with('tutorid',$tutorid)
                                                ->with('show_AV_time',$show_AV_time)
                                                ->with('DepC',$DepC);
    }

    public function Addvaliablecourse(Request $request,$tutorid)
    {
        $this->validate($request, [
            'day' => 'required',
            'time' => 'required',
            'course' => 'required',
            'location' => 'required',
        ]);
        
        $Aay_id=Ay::firstwhere('is_active', 1);

        if($Aay_id)
        {
            if($request->link)
            {
                Available_course::create(['course_id'=>$request->course,'ay_id'=>$Aay_id->id,'tutor_id'=>$tutorid,'day'=>$request->day,
                                    'time'=>$request->time,'location'=>$request->location,'link'=>$request->link]);

            }else{
                Available_course::create(['course_id'=>$request->course,'ay_id'=>$Aay_id->id,'tutor_id'=>$tutorid,'day'=>$request->day,
                'time'=>$request->time,'location'=>$request->location]);

            }

           
            Alert::toast('avaliable course added  successfully ','success');
            return redirect()->route('Acourse.index');
        }
        else
        {

            Alert::toast('avaliable course note added  ','warning');
            return redirect()->route('Acourse.index');

        }


    }
    public function deleteAvaliableCourse($id)
    {
      
        $DeltAvaliable_course = Available_course::firstwhere(['id'=>$id,'active'=>1]);
        
        if($DeltAvaliable_course)
        {
            $Deltrequest_tutorial=[];
            

            $Deltrequest_tutorial=Tutorial_request::where(['available_course_id'=>$DeltAvaliable_course->id,'active'=>1])
                                                ->where('accepted',0)
                                                ->orWhere('accepted',1)->get();
          
            if($Deltrequest_tutorial){
                foreach($Deltrequest_tutorial as $Rup)
                {
                    $DeleteR=Tutorial_request::findOrFail($Rup->id);
                    $DeleteR->update(['active'=>1,'accepted'=>4]);

                }
                
            }
            
            $DeltAvaliable_course->update(['active'=>0]);
            Alert::toast('avaliable course is Delete!! ','warning');
            return back();
           
        }
        Alert::toast('avaliable course is note exist','warning');
        return back();
    }


    public function  departmentReport()
    {
        $listTutorial=[];
        $AlllistTutorial=[];
        $totalstudent=0;
        $totalTutor=0;
        
        $this->months=[];
        $this->countR=[];

        $currentdatetime=new DateTime();
        $currentdate=$currentdatetime->format('Y-m-d');
        $currenthour=$currentdatetime->format('H');
        $currentmonth=$currentdatetime->format('m');

        $currentMonthIndex=0;

        $acadmicMonth=[9,10,11,12,1,2,3,4,5,6,7];

        for($i=0;$i < sizeof($acadmicMonth); $i++)
        {
            if($acadmicMonth[$i]==$currentmonth)
            {
                $currentMonthIndex=$i;
            }
        }

        

        $this->tutorid=Tutor::firstwhere('user_id',Auth::User()->id);
        $this->Aay_id=Ay::firstwhere('is_active', 1);
        $this->depReported=Department::firstwhere('id',Auth::User()->department_id);

        if($this->depReported){

           
        }

        if($this->depReported)
        {
            $sctuser=User::where('department_id',$this->depReported->id)->get();


            foreach( $sctuser as $user)
            {

                if($user->hasRole('student-role'))
                {
                    $totalstudent+=1;
                }
                elseif($user->hasRole('tutor-role') || $user->hasRole('student-tutor'))
                {
                    $totalTutor+=1;

                }
            } 
        }
        if($this->depReported && $this->Aay_id){

            $listTutorial=Tutorial_request::where('active',1)
                                    ->whereExists(function($query){
                                        $query->where('accepted',0)
                                            ->orWhere('accepted',1);
                                    })
                                    ->whereExists(function($query){
                    $query->select(DB::raw(1))->from('tutors')->where('tutors.department_id',$this->depReported->id)
                                                                        
                                                               ->whereColumn('tutors.id', 'tutorial_requests.tutor_id');
            })->orderBy('accepted', 'asc')->get();

            $AlllistTutorial=Tutorial_request::where('active',1)
                                               ->whereExists(function($query){
                                                    $query->where('accepted',2)
                                                           ->orWhere('accepted',3)
                                                           ->orWhere('accepted',4);
                                                })
                                                ->whereExists(function($query){
                                                    $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->Aay_id->id)
                                                                                                        ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');})
                                               ->whereExists(function($query){
                                                    $query->select(DB::raw(1))->from('tutors')->where('tutors.department_id',$this->depReported->id)                
                                                    ->whereColumn('tutors.id', 'tutorial_requests.tutor_id');
            })->orderBy('accepted', 'DESC')->get();



            $reall = Tutorial_request::select(DB::raw('count(date) as count'), DB::raw('MONTH(date) as month'))
                                        ->whereExists(function($query){         
                                                                $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id',$this->Aay_id->id)
                                                                                        ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');})
                                        ->whereExists(function($query){
                                                                $query->select(DB::raw(1))->from('tutors')->where('tutors.department_id',$this->depReported->id)
                                                                                        ->whereColumn('tutors.id', 'tutorial_requests.tutor_id');})
                    ->groupBy('month')->orderBy('date', 'asc')->get();

            for($i=0; $i <= $currentMonthIndex ; $i++)
            {
                $Notthere=True;
                foreach($reall as $re)
                {
                    if($re->month == $acadmicMonth[$i])
                    {
                        $getmonth=$re->month;
                    
                        $MonthName=DateTime::createFromFormat('!m', $getmonth);
                        
            
                        array_push($this->months, $MonthName->format('F'));
            
                        
                        array_push($this->countR,(int)$re->count);

                        $Notthere=False;

                    }
        
                }

                if($Notthere)
                {
                    $getmonth=$acadmicMonth[$i];
                    
                    $MonthName=DateTime::createFromFormat('!m', $getmonth);
                    
        
                    array_push($this->months, $MonthName->format('F'));
        
                    
                    array_push($this->countR,0);


                }
            }

      
        }



        return view('report.departmentReport')->with('lists',$listTutorial)
                                              ->with('Alllists',$AlllistTutorial)
                                              ->with('dep',$this->depReported)
                                              ->with('totalT',$totalTutor)
                                              ->with('totalS',$totalstudent)
                                              ->with('months',json_encode ($this->months))
                                              ->with('countR',json_encode($this->countR))
                                              ->with('ay', $this->Aay_id);

    }


}