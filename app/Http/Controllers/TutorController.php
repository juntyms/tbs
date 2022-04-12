<?php

namespace App\Http\Controllers;

use App\Models\Ay;
use App\Models\Tutor;
use Illuminate\Http\Request;
use App\Models\Tutor_comment;
use App\Models\Student_comment;
use App\Models\Available_course;
use App\Models\Tutorial_request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TutorController extends Controller
{
    
    private  $tutorid=[];
    private  $Aay_id=[];
    private $av_id=[];
    public function tutor_tutuorials()
    {


        $listTutorial=[];
        $Tutorcom=[];
        $studentcom=[];
       
        $this->tutorid=Tutor::firstwhere('user_id',Auth::User()->id);
        $this->Aay_id=Ay::firstwhere('is_active', 1);
        

        if($this->tutorid && $this->Aay_id)
        {

            $listTutorial=Tutorial_request::where('tutor_id', $this->tutorid->id)
                                    ->where('active',1)
                                    ->whereExists(function($query){
                                        $query->where('accepted',0)
                                            ->orWhere('accepted',1);
                                    })
                                    ->whereExists(function($query){
                    $query->select(DB::raw(1))->from('available_courses')->where('available_courses.tutor_id',$this->tutorid->id)
                                                                        ->where('available_courses.ay_id', $this->Aay_id->id)
                                                                        ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
            })->get();

            $Tutorcom=Tutor_comment::whereExists(function($query){
                $query->select(DB::raw(1))->from('tutorial_requests')->where('tutorial_requests.tutor_id',$this->tutorid->id)
                                                                     ->where('tutorial_requests.active',1)
                                                                     ->where(function($query){
                                                                        $query->where('tutorial_requests.accepted',0)
                                                                              ->orWhere('tutorial_requests.accepted',1);})
                                                                    ->whereColumn('tutorial_requests.id','tutor_comments.tutorial_request_id');

            })->orderBy('created_at', 'ASC')->get();

            $studentcom=Student_comment::whereExists(function($query){
                $query->select(DB::raw(1))->from('tutorial_requests')->where('tutorial_requests.tutor_id',$this->tutorid->id)
                                                                     ->where('tutorial_requests.active',1)
                                                                     ->where(function($query){
                                                                        $query->where('tutorial_requests.accepted',0)
                                                                              ->orWhere('tutorial_requests.accepted',1);})
                                                                    ->whereColumn('tutorial_requests.id','student_comments.tutorial_request_id');

            })->orderBy('created_at', 'ASC')->get();
        }



        return view('Tutors.index')->with('lists',$listTutorial)
                                   ->with('tutcomments',$Tutorcom)
                                   ->with('studentcomments',$studentcom);


    }
    public function  AlltutorialsRequest()
    {
        $listTutorial=[];
        $this->tutorid=Tutor::firstwhere('user_id',Auth::User()->id);
        $this->Aay_id=Ay::firstwhere('is_active', 1);
        

        if($this->tutorid && $this->Aay_id)
        {

            $listTutorial=Tutorial_request::where('tutor_id', $this->tutorid->id)
                                    ->where('active',1)
                                    ->whereExists(function($query){
                    $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->Aay_id->id)
                                                                        ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
            })->orderBy('created_at','desc')->get();
        }

        return view('Tutors.allrequest')->with('lists',$listTutorial);

    }
    public function tutortimetable()
    {
        $booking_TutCourse=[];
        $show_tutorils=FALSE;
        $this->tutorid=Tutor::firstwhere('user_id',Auth::User()->id);
        $this->Aay_id=Ay::firstwhere('is_active', 1);
        

        if($this->tutorid && $this->Aay_id)
        {

            $booking_TutCourse= Available_course::get()->where('ay_id',$this->Aay_id->id)
                                                        ->where('tutor_id',$this->tutorid->id)
                                                           ->where('active',1);
        }
        if ($booking_TutCourse)
        {
            $show_tutorils=TRUE;
        }
        return view('Tutors.timetable')->with('lists',$booking_TutCourse)
                                                  ->with('show_tutorils_time',$show_tutorils);
    }

    public function courserequest($id)
    {
        $listTutorial=[];
        $Tutorcom=[];
        $studentcom=[];
       
        $this->tutorid=Tutor::firstwhere('user_id',Auth::User()->id);
        $this->av_id=Available_course::firstwhere('id',$id);
        $this->Aay_id=Ay::firstwhere('is_active', 1);
        

        if($this->tutorid && $this->Aay_id && $this->av_id)
        {

            $listTutorial=Tutorial_request::where('tutor_id', $this->tutorid->id)
                                    ->where('active',1)
                                    ->whereExists(function($query){
                                        $query->where('accepted',0)
                                            ->orWhere('accepted',1);
                                    })
                                    ->whereExists(function($query){
                    $query->select(DB::raw(1))->from('available_courses')->where('available_courses.id', $this->av_id->id)
                                                                         ->where('available_courses.tutor_id',$this->tutorid->id)
                                                                        ->where('available_courses.ay_id', $this->Aay_id->id)
                                                                        ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
            })->get();

            $Tutorcom=Tutor_comment::whereExists(function($query){
                $query->select(DB::raw(1))->from('tutorial_requests')->where('tutorial_requests.tutor_id',$this->tutorid->id)
                                                                     ->where('tutorial_requests.active',1)
                                                                     ->where(function($query){
                                                                        $query->where('tutorial_requests.accepted',0)
                                                                              ->orWhere('tutorial_requests.accepted',1);})
                                                                    ->whereColumn('tutorial_requests.id','tutor_comments.tutorial_request_id');

            })->orderBy('created_at', 'ASC')->get();

            $studentcom=Student_comment::whereExists(function($query){
                $query->select(DB::raw(1))->from('tutorial_requests')->where('tutorial_requests.tutor_id',$this->tutorid->id)
                                                                     ->where('tutorial_requests.active',1)
                                                                     ->where(function($query){
                                                                        $query->where('tutorial_requests.accepted',0)
                                                                              ->orWhere('tutorial_requests.accepted',1);})
                                                                    ->whereColumn('tutorial_requests.id','student_comments.tutorial_request_id');

            })->orderBy('created_at', 'ASC')->get();
        }



        return view('Tutors.index')->with('lists',$listTutorial)
                                   ->with('tutcomments',$Tutorcom)
                                   ->with('studentcomments',$studentcom);

    }
    
    public function Tutorialstatus($id,$status)
    {
        $updateRequest = Tutorial_request::findOrFail($id);
        if($status==1 || $status==2 || $status==3 || $status==4)
        {
            $updateRequest->update(['accepted'=>$status]);
            if($status==1)
            {
                Alert::toast('Request approved ','success');
            }
            if($status==2)
            {
                Alert::toast('Request Rejected ','warning');
            }
            if($status==3)
            {
                Alert::toast('Request completed ','success');
            }
            if($status==4)
            {
                Alert::toast('Request incompleted ','warning');
            }

        }
        

        return redirect()->back();

    }

    public function sendcomment(Request $request)
    {
       
        $tutcomment = [];
        if($request->has('q')){
            $comment = $request->q;
            $re_id=$request->id;
            $tutcomment =Tutor_comment::create(['tutorial_request_id'=>$re_id,'description'=>$comment]);
        }
        return response()->json(['success'=>'Successfully']);
    }


    public function  tutordashboard()
    {
        $listTutorial=[];
        $Tutorcom=[];
        $studentcom=[];
        $AlllistTutorial=[];

       
       
        $this->tutorid=Tutor::firstwhere('user_id',Auth::User()->id);
        $this->Aay_id=Ay::firstwhere('is_active', 1);
        

        if($this->tutorid && $this->Aay_id)
        {

            $listTutorial=Tutorial_request::where('tutor_id', $this->tutorid->id)
                                    ->where('active',1)
                                    ->whereExists(function($query){
                                        $query->where('accepted',0)
                                            ->orWhere('accepted',1);
                                    })
                                    ->whereExists(function($query){
                    $query->select(DB::raw(1))->from('available_courses')->where('available_courses.tutor_id',$this->tutorid->id)
                                                                        ->where('available_courses.ay_id', $this->Aay_id->id)
                                                                        ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
            })->get();

            $Tutorcom=Tutor_comment::whereExists(function($query){
                $query->select(DB::raw(1))->from('tutorial_requests')->where('tutorial_requests.tutor_id',$this->tutorid->id)
                                                                     ->where('tutorial_requests.active',1)
                                                                     ->where(function($query){
                                                                        $query->where('tutorial_requests.accepted',0)
                                                                              ->orWhere('tutorial_requests.accepted',1);})
                                                                    ->whereColumn('tutorial_requests.id','tutor_comments.tutorial_request_id');

            })->orderBy('created_at', 'ASC')->get();

            $studentcom=Student_comment::whereExists(function($query){
                $query->select(DB::raw(1))->from('tutorial_requests')->where('tutorial_requests.tutor_id',$this->tutorid->id)
                                                                     ->where('tutorial_requests.active',1)
                                                                     ->where(function($query){
                                                                        $query->where('tutorial_requests.accepted',0)
                                                                              ->orWhere('tutorial_requests.accepted',1);})
                                                                    ->whereColumn('tutorial_requests.id','student_comments.tutorial_request_id');

            })->orderBy('created_at', 'ASC')->get();

            $AlllistTutorial=Tutorial_request::where('tutor_id', $this->tutorid->id)
                                    ->where('active',1)
                                    ->whereExists(function($query){
                    $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->Aay_id->id)
                                                                        ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
            })->orderBy('created_at','desc')->get();

           
        }



        return view('Tutors.tutordashboard')->with('lists',$listTutorial)
                                            ->with('Alllists',$AlllistTutorial)
                                            ->with('tutcomments',$Tutorcom)
                                            ->with('studentcomments',$studentcom);


    }

}
