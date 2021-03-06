<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Ay;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Course;
use App\Models\Department;
use App\Mail\RequestConfirm;
use Illuminate\Http\Request;
use App\Models\Tutor_comment;
use App\Models\Student_comment;
use App\Models\Available_course;
use App\Models\Tutorial_request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;


class StudentController extends Controller
{
    //**************************************************************/
    private $user_id;
    private $ay_id;

    public function booking_department()
    {
        $deps=Department::get();
        $this->ay_id=Ay::firstwhere('is_active', 1);
        return view('student.booking.index')->with('deps',$deps)
                                            ->with('ay', $this->ay_id);
    }
    //***************************Booking***********************************/


    public function booking_department_selecting($depid)
    {
        $show_TutorCourses=False;
        $show_CourseTutors=False;
        $show_TutorCourse=False;
        $depid=Department::firstwhere('id',$depid);

        $Serchtutor = [];
        $courses = [];       
        $Serchtutor =User::where('department_id',$depid->id)
                         ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                            ->from('tutors')
                            ->where('tutors.active',1)
                            ->whereColumn('tutors.user_id', 'users.id');})->pluck("fullname", "id");
       
        $courses =Course::where('department_id',$depid->id)
                            ->whereExists(function ($query){
                    $query->select(DB::raw(1))
                            ->from('available_courses')
                            ->where('available_courses.active',1)
                            ->whereColumn('available_courses.course_id', 'courses.id'); })->pluck("name", "id");
        
        return view('student.booking.Selected.Selectoption')->with('dep',$depid)
                                                        ->with('show1',$show_TutorCourses)
                                                        ->with('show2',$show_CourseTutors)
                                                        ->with('show3',$show_TutorCourse)
                                                        ->with('Serchtutor',$Serchtutor)
                                                        ->with('courses',$courses);

    }
    
    public function AutoselectingTutor(Request $request,$depid)
    {
    	$Serchtutor = [];  
        $Serchtutor =User::select("id", "fullname")
                         ->where('department_id',$depid)
                         ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                            ->from('tutors')
                            ->where('tutors.active',1)
                            ->whereExists(function ($query) {
                                $query->select(DB::raw(1))
                                      ->from('available_courses')
                                      ->where('available_courses.active',1)
                                      ->whereColumn('available_courses.tutor_id', 'tutors.id');
                            })
                            ->whereColumn('tutors.user_id', 'users.id');})->get();


        

        return response()->json($Serchtutor);
       
            
    
    }
    public function AutoselectingCourse(Request $request,$depid)
    {
    	$courses = [];
        $this->ay_id=Ay::firstwhere('is_active', 1);

        if($request->has('q') && $this->ay_id){
            $search = $request->q;
            $courses =Course::select("id", "name")
            		->where('name', 'LIKE', "%$search%")
                    ->where('department_id',$depid)
                    ->whereExists(function ($query) {
                        $query->select(DB::raw(1))
                              ->from('available_courses')
                              ->where('available_courses.active',1)
                              ->where('avaliable_courses.ay_id',$this->ay_id->id)
                              ->whereColumn('available_courses.course_id', 'courses.id');
                    })->get();
        }
        return response()->json($courses);
    }

    public function ShowbookingTurorial(Request $request,$depid){
        $depid=Department::firstwhere('id',$depid);
        $Aay_id=Ay::firstwhere('is_active', 1);
        $show_TutorCourses=False;
        $show_CourseTutors=False;
        $show_TutorCourse=False;
        $vshow1="";
        $vshow2="";
        $vshow3="active";

        $Serchtutor = [];
        $courses = [];  

        $Serchtutor =User::where('department_id',$depid->id)
                         ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                            ->from('tutors')
                            ->where('tutors.active',1)
                            ->whereColumn('tutors.user_id', 'users.id');})->pluck("fullname", "id");
        
                            
        $courses =Course::where('department_id',$depid->id)
                        ->whereExists(function ($query){
                $query->select(DB::raw(1))
                        ->from('available_courses')
                        ->where('available_courses.active',1)
                        ->whereColumn('available_courses.course_id', 'courses.id'); })->pluck("name", "id");

        $Dep_AVCourses =Course::where('department_id',$depid->id)
                            ->whereExists(function ($query){
                                            $query->select(DB::raw(1))
                                            ->from('available_courses')
                                            ->where('available_courses.active',1)
                                            ->whereColumn('available_courses.course_id', 'courses.id'); })->distinct()
                                            ->get();
        

        if($Aay_id)
        {
           
            if((isset($request->selectC)) && (isset($request->selectT)))
            {
                $userid=$request->input('selectT');
                $tutorid=Tutor::firstwhere('user_id',$userid);
                $courseid=$request->input('selectC');


                $booking_TutCourse= Available_course::get()->where('ay_id',$Aay_id->id)
                                                           ->where('tutor_id',$tutorid->id)
                                                           ->where('course_id',$courseid)
                                                           ->where('active',1);
                
                $listTutorial=Tutorial_request::where('user_id',Auth::User()->id)
                                                ->where('active',1)
                                                ->whereExists(function($query){
                                                    $query->where('accepted',0)
                                                          ->orWhere('accepted',1);})->get();
                $show_TutorCourses=False;
                $show_CourseTutors=False;
                $show_TutorCourse=TRUE;
                return view('student.booking.Selected.Selectoption')->with('dep',$depid)
                                                            ->with('tut_id',$tutorid)
                                                            ->with('booking_TutCourse',$booking_TutCourse)
                                                            ->with('show1',$show_TutorCourses)
                                                            ->with('show2',$show_CourseTutors)
                                                            ->with('show3',$show_TutorCourse)
                                                            ->with('booked',$listTutorial)
                                                            ->with('Serchtutor',$Serchtutor)
                                                            ->with('courses',$courses)
                                                            ->with('vshow1',$vshow1)
                                                            ->with('vshow2',$vshow2)
                                                            ->with('vshow3',$vshow3)
                                                            ->with('Dep_AVCourses',$Dep_AVCourses);
                    
    
    
            }
            elseif((isset($request->selectC)) && !(isset(($request->selectT))))
            {
                $courseid=$request->input('selectC');
               
                $booking_TutCourse= Available_course::get()->where('ay_id',$Aay_id->id)
                                                        ->where('course_id',$courseid)
                                                        ->where('active',1);

                $listTutorial=Tutorial_request::where('user_id',Auth::User()->id)
                                            ->where('active',1)
                                            ->whereExists(function($query){
                                                    $query->where('accepted',0)
                                                        ->orWhere('accepted',1);})->get();

                $show_TutorCourses=False;
                $show_CourseTutors=True;
                $show_TutorCourse=False;

                return view('student.booking.Selected.Selectoption')->with('dep',$depid)
                                                            ->with('booking_TutCourse',$booking_TutCourse)
                                                            ->with('show1',$show_TutorCourses)
                                                            ->with('show2',$show_CourseTutors)
                                                            ->with('show3',$show_TutorCourse)
                                                            ->with('booked',$listTutorial)
                                                            ->with('Serchtutor',$Serchtutor)
                                                            ->with('courses',$courses)
                                                            ->with('vshow1',$vshow1)
                                                            ->with('vshow2',$vshow2)
                                                            ->with('vshow3',$vshow3)
                                                            ->with('Dep_AVCourses',$Dep_AVCourses);

               
    
    
            }
            elseif(!((isset($request->selectC))) && (isset(($request->selectT))))
            {
    
                $userid=$request->input('selectT');
                $tutorid=Tutor::firstwhere('user_id',$userid);
    
                $booking_TutCourse= Available_course::get()->where('ay_id',$Aay_id->id)
                                                           ->where('tutor_id',$tutorid->id)
                                                           ->where('active',1);

                $listTutorial=Tutorial_request::where('user_id',Auth::User()->id)
                                                ->where('active',1)
                                                ->whereExists(function($query){
                                                        $query->where('accepted',0)
                                                            ->orWhere('accepted',1);})->get();
                $show_TutorCourses=TRUE;
                $show_CourseTutors=False;
                $show_TutorCourse=False;
                return view('student.booking.Selected.Selectoption')->with('dep',$depid)
                                                            ->with('tut_id',$tutorid)
                                                            ->with('booking_TutCourse',$booking_TutCourse)
                                                            ->with('show1',$show_TutorCourses)
                                                            ->with('show2',$show_CourseTutors)
                                                            ->with('show3',$show_TutorCourse)
                                                            ->with('booked',$listTutorial)
                                                            ->with('Serchtutor',$Serchtutor)
                                                            ->with('courses',$courses)
                                                            ->with('vshow1',$vshow1)
                                                            ->with('vshow2',$vshow2)
                                                            ->with('vshow3',$vshow3)
                                                            ->with('Dep_AVCourses',$Dep_AVCourses);
    
    
            }
            else{

                return view('student.booking.Selected.Selectoption')->with('dep',$depid)
                                                            ->with('show1',$show_TutorCourses)
                                                            ->with('show2',$show_CourseTutors)
                                                            ->with('show3',$show_TutorCourse)
                                                            ->with('Serchtutor',$Serchtutor)
                                                            ->with('courses',$courses)
                                                            ->with('vshow1',$vshow1)
                                                            ->with('vshow2',$vshow2)
                                                            ->with('vshow3',$vshow3)
                                                            ->with('Dep_AVCourses',$Dep_AVCourses);




            }
        }
        else{

            return view('student.booking.Selected.Selectoption')->with('dep',$depid)
                                                        ->with('show1',$show_TutorCourses)
                                                        ->with('show2',$show_CourseTutors)
                                                        ->with('show3',$show_TutorCourse)
                                                        ->with('Serchtutor',$Serchtutor)
                                                        ->with('courses',$courses)
                                                        ->with('vshow1',$vshow1)
                                                        ->with('vshow2',$vshow2)
                                                        ->with('vshow3',$vshow3)
                                                        ->with('Dep_AVCourses',$Dep_AVCourses);

        }

       

    }

    

    public function tutorialList()
    {
        $listTutorial=[];
        $Tutorcom=[];
        $studentcom=[];
        $this->user_id=User::firstwhere('id',Auth::User()->id);
        $this->ay_id=Ay::firstwhere('is_active', 1);
        

        if($this->user_id && $this->ay_id)
        {

            $listTutorial=Tutorial_request::where('user_id', $this->user_id->id)
                                    ->where('active',1)
                                    ->whereExists(function($query){
                                        $query->where('accepted',0)
                                            ->orWhere('accepted',1);
                                    })
                                    ->whereExists(function($query){
                    $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->ay_id->id)
                                                                        ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
            })->orderBy('created_at','desc')->get();
        }


        if($listTutorial){
            $Tutorcom=Tutor_comment::whereExists(function($query){
            $query->select(DB::raw(1))->from('tutorial_requests')->where('tutorial_requests.active',1)
                                                                 ->where('tutorial_requests.user_id',Auth::User()->id)
                                                                  ->where(function($query){
                                                                        $query->where('tutorial_requests.accepted',0)
                                                                              ->orWhere('tutorial_requests.accepted',1);})
                                                                    ->whereColumn('tutorial_requests.id','tutor_comments.tutorial_request_id');

            })->orderBy('created_at', 'ASC')->get();

            $studentcom=Student_comment::whereExists(function($query){
            $query->select(DB::raw(1))->from('tutorial_requests')->where('tutorial_requests.user_id',Auth::User()->id)
                                                                ->where('tutorial_requests.active',1)
                                                                ->where(function($query){
                                                                    $query->where('tutorial_requests.accepted',0)
                                                                          ->orWhere('tutorial_requests.accepted',1);})
                                                                ->whereColumn('tutorial_requests.id','student_comments.tutorial_request_id');

            })->orderBy('created_at', 'ASC')->get();

 
           
        }

        return view('student.requested.index')->with('lists',$listTutorial)
                                              ->with('tutcomments',$Tutorcom)
                                              ->with('studentcomments',$studentcom);

    }

    public function  AllstudentRequest()
    {
        $listTutorial=[];
        $this->user_id=User::firstwhere('id',Auth::User()->id);
        $this->ay_id=Ay::firstwhere('is_active', 1);
        

        if($this->user_id && $this->ay_id)
        {

            $listTutorial=Tutorial_request::where('user_id', $this->user_id->id)
                                    ->where('active',1)
                                    ->whereExists(function($query){
                    $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->ay_id->id)
                                                                        ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
            })->orderBy('created_at','desc')->get();
        }

        return view('student.requested.allrequest')->with('lists',$listTutorial);

    }
    public function  studenttimetable()
    {
        $listTutorial=[];
        $show_tutorils=FALSE;
        $this->user_id=User::firstwhere('id',Auth::User()->id);
        $this->ay_id=Ay::firstwhere('is_active', 1);
        

        if($this->user_id && $this->ay_id)
        {

            $listTutorial=Tutorial_request::where('user_id', $this->user_id->id)
                                    ->where('active',1)
                                    ->whereExists(function($query){
                                        $query->where('accepted',0)
                                            ->orWhere('accepted',1);
                                    })
                                    ->whereExists(function($query){
                    $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->ay_id->id)
                                                                        ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
            })->orderBy('created_at','desc')->get();
        }
        if ($listTutorial)
        {
            $show_tutorils=TRUE;
        }

        return view('student.requested.timetable')->with('lists',$listTutorial)
                                              ->with('show_tutorils_time',$show_tutorils);

    }

    public function AddTutorialrequest(Request $request,$avaliable_course,$tutorid)
    {
        $wdays=array('Sunday','Monday','Tuseday','Wednesday','Thursday','Friday','Satuday');
        $av = Available_course::findOrFail($avaliable_course);
        $selectedday=0;
        $currentdatetime=new DateTime();
        $currentdate=$currentdatetime->format('Y-m-d');
        $currenthour=$currentdatetime->format('H');
        $dayofweek = date('w', strtotime($currentdate));
        $sotrddate="";
    
        for($i=0; $i<count($wdays);$i++)
        {
            
            if($wdays[$i]==$av->day)
                $selectedday=$i;
                

        }
       
        if($dayofweek>$selectedday)
        {
            $ddate=7-($dayofweek-$selectedday);
            $sotrddate=date('Y-m-d', strtotime($currentdate. ' +'.$ddate.' days'));
            
        }
        elseif($dayofweek<$selectedday)
        {
            $ddate=$selectedday-$dayofweek;
            $sotrddate=date('Y-m-d', strtotime($currentdate. ' +'.$ddate.' days'));
            

        }
        elseif($dayofweek==$selectedday)
        {
            if($currenthour<=$av->time)
            {
                $ddate=$dayofweek-$selectedday;
                $sotrddate=date('Y-m-d', strtotime($currentdate. ' +'.$ddate.' days'));
            }
            elseif($currenthour>$av->time)
            {
                $ddate=7;
                $sotrddate=date('Y-m-d', strtotime($currentdate. ' +'.$ddate.' days'));
               
            }

        }

        
        
        $checkforrequest= Tutorial_request::firstwhere(['available_course_id'=>$avaliable_course,'user_id'=>Auth::User()->id,'tutor_id'=>$tutorid,'date'=>$sotrddate,'accepted'=>0]);

        if(!$checkforrequest)
        {

          
            $studentcomment=Tutorial_request::create(['available_course_id'=>$avaliable_course,'user_id'=>Auth::User()->id,'tutor_id'=>$tutorid,'date'=>$sotrddate]);
            Mail::to($studentcomment->AvaliableCourse->tutor->gettutorname->email)->send(new RequestConfirm($studentcomment));
            if($request->has('comment'))
            {
                
                Student_comment::create(['tutorial_request_id'=>$studentcomment->id,'description'=>$request->comment]);

            }
            Alert::toast('New Tutorial is booked !!','success');
    }
        return redirect()->route('student.tutorial.list');
    }

    public function TutorialrequestDelete($requestid)
    {

        Tutor_comment::where('tutorial_request_id',$requestid)->delete();
        Student_comment::where('tutorial_request_id',$requestid)->delete();
        Tutorial_request::destroy($requestid);
        Alert::toast('Tutorial is Deleted ','warning');
        return redirect()->route('student.tutorial.list');

    }

    public function studensent(Request $request)
    {
        $comment=[];
        if($request->has('request_message')&& $request->has('request_id'))
        {
            $comment=Student_comment::create(['tutorial_request_id'=>$request->request_id,'description'=>$request->request_message]);

        }

        return response()->json($comment);

    }

    public function studentsendcomment(Request $request)
    {
       
        $studcomment = [];
        if($request->has('q')){
            $comment = $request->q;
            $re_id=$request->id;
            $studcomment =Student_comment::create(['tutorial_request_id'=>$re_id,'description'=>$comment]);
        }
        return response()->json(['success'=>'Successfully']);
    }


    #-------------------------------------------------------------------------------------------------------------------------------------------------------


    public function booking_department_availablecourses($depid)
    {
       
        $depid=Department::firstwhere('id',$depid);
        $Dep_AVCourses = [];       
       
        if($depid)
        {

        
        $Dep_AVCourses =Course::where('department_id',$depid->id)
                            ->whereExists(function ($query){
                    $query->select(DB::raw(1))
                            ->from('available_courses')
                            ->where('available_courses.active',1)
                            ->whereColumn('available_courses.course_id', 'courses.id'); })->distinct()
                            ->get();
        }
      
        return view('student.booking.DepartmentAvailablecourses')->with('dep',$depid)
                                                    ->with('Dep_AVCourses',$Dep_AVCourses);

    }

    public function booking_department_availablecourses_tutor($depid,$course)
    {
        $depid=Department::firstwhere('id',$depid);
        $course=Course::firstwhere('id',$course);
        $Aay_id=Ay::firstwhere('is_active', 1);
        $avcourses=[];
        $listTutorial=[];

        if($depid && $Aay_id )
        {


            $avcourses= Available_course::get()->where('ay_id',$Aay_id->id)
                                                        ->where('course_id',$course->id)
                                                        ->where('active',1);
            $listTutorial=Tutorial_request::where('user_id',Auth::User()->id)
                                            ->where('active',1)
                                            ->whereExists(function($query){
                                                    $query->where('accepted',0)
                                                        ->orWhere('accepted',1);})->get();
                                }

        return view('student.booking.DepcourseTutor')->with('dep',$depid)
                                                     ->with('course',$course)
                                                     ->with('listbooked',$listTutorial)
                                                     ->with('avcourses',$avcourses);
    }



    public function selectoption($id)
    {
        $show_TutorCourses=False;
        $show_CourseTutors=False;
        $show_TutorCourse=False;
        $vshow1="active";
        $vshow2="";
        $vshow3="";
        $depid=Department::firstwhere('id',$id);
        $this->ay_id=Ay::firstwhere('is_active', 1);

        $Serchtutor = [];
        $courses = [];       
        $Serchtutor =User::where('department_id',$depid->id)
                         ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                            ->from('tutors')
                            ->where('tutors.active',1)
                            ->whereColumn('tutors.user_id', 'users.id');})->pluck("fullname", "id");
       
        $courses =Course::where('department_id',$depid->id)
                            ->whereExists(function ($query){
                    $query->select(DB::raw(1))
                            ->from('available_courses')
                            ->where('available_courses.active',1)
                            ->whereColumn('available_courses.course_id', 'courses.id'); })->pluck("name", "id");
        
        
        $Dep_AVCourses =Course::where('department_id',$depid->id)
                ->whereExists(function ($query){
                                $query->select(DB::raw(1))
                                ->from('available_courses')
                                ->where('available_courses.active',1)
                                ->where('available_courses.ay_id',$this->ay_id->id)
                                ->whereColumn('available_courses.course_id', 'courses.id'); })->distinct()
                                ->get();

        return view('student.booking.Selected.Selectoption')->with('dep',$depid)
                                                        ->with('show1',$show_TutorCourses)
                                                        ->with('show2',$show_CourseTutors)
                                                        ->with('show3',$show_TutorCourse)
                                                        ->with('Serchtutor',$Serchtutor)
                                                        ->with('courses',$courses)
                                                        ->with('vshow1',$vshow1)
                                                        ->with('vshow2',$vshow2)
                                                        ->with('vshow3',$vshow3)
                                                        ->with('Dep_AVCourses',$Dep_AVCourses);
       
                                                        
    }


    public function studentdashboard()
    {
        $listTutorial=[];
        $Tutorcom=[];
        $studentcom=[];
        $this->user_id=User::firstwhere('id',Auth::User()->id);
        $this->ay_id=Ay::firstwhere('is_active', 1);
        

        if($this->user_id && $this->ay_id)
        {

            $listTutorial=Tutorial_request::where('user_id', $this->user_id->id)
                                    ->where('active',1)
                                    ->whereExists(function($query){
                                        $query->where('accepted',0)
                                            ->orWhere('accepted',1);
                                    })
                                    ->whereExists(function($query){
                    $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->ay_id->id)
                                                                        ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
            })->orderBy('created_at','desc')->get();
        }


        if($listTutorial){
            $Tutorcom=Tutor_comment::whereExists(function($query){
            $query->select(DB::raw(1))->from('tutorial_requests')->where('tutorial_requests.active',1)
                                                                 ->where('tutorial_requests.user_id',Auth::User()->id)
                                                                  ->where(function($query){
                                                                        $query->where('tutorial_requests.accepted',0)
                                                                              ->orWhere('tutorial_requests.accepted',1);})
                                                                    ->whereColumn('tutorial_requests.id','tutor_comments.tutorial_request_id');

            })->orderBy('created_at', 'ASC')->get();

            $studentcom=Student_comment::whereExists(function($query){
            $query->select(DB::raw(1))->from('tutorial_requests')->where('tutorial_requests.user_id',Auth::User()->id)
                                                                ->where('tutorial_requests.active',1)
                                                                ->where(function($query){
                                                                    $query->where('tutorial_requests.accepted',0)
                                                                          ->orWhere('tutorial_requests.accepted',1);})
                                                                ->whereColumn('tutorial_requests.id','student_comments.tutorial_request_id');

            })->orderBy('created_at', 'ASC')->get();

            $AlllistTutorial=Tutorial_request::where('user_id', $this->user_id->id)
                                    ->where('active',1)
                                    ->whereExists(function($query){
                    $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->ay_id->id)
                                                                        ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
            })->orderBy('created_at','desc')->get();

 
           
        }

        return view('student.studentdashboard')->with('lists',$listTutorial)
                                               ->with('Alllists',$AlllistTutorial)
                                               ->with('tutcomments',$Tutorcom)
                                               ->with('studentcomments',$studentcom);

    }




    

}
