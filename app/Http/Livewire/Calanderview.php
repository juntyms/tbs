<?php

namespace App\Http\Livewire;

use App\Models\Ay;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Course;
use Livewire\Component;
use App\Models\Department;
use App\Models\Available_course;
use App\Models\Tutorial_request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Calanderview extends Component

{
    public $selectT;
    public $selectC;
    public $dep;
    public  $show_TutorCourses;
    public $show_CourseTutors;
    public $show_TutorCourse;
    public $Serchtutor;
    public $courses;
    public $Dep_AVCourses;
    public $booking_TutCourse;
    public $listTutorial;
    public $vshow1;
    public $vshow2;
    public $vshow3;
    public $tutorid;
    public $selectedCourse;
    public $Aay_id;

    public function mount($depid)
    {
        $this->show_TutorCourses=False;
        $this->show_CourseTutors=False;
        $this->show_TutorCourse=False;
        $this->vshow1="";
        $this->vshow2="";
        $this->vshow3="active";
        $depid=Department::firstwhere('id',$depid);
        $this->dep=$depid;
        $this->Serchtutor = [];
        $this->courses = [];
        $this->listTutorial=[];
        $this->booking_TutCourse=[];
        $this->Aay_id=null;
       
/*
        $this->Serchtutor =User::where('department_id',$depid->id)
                         ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                            ->from('tutors')
                            ->where('tutors.active',1)
                            ->whereColumn('tutors.user_id', 'users.id');})
                            ->pluck("fullname", "id");
                             
                            
    */
    $this->Aay_id=Ay::firstwhere('is_active', 1);
       
    if($this->Aay_id)
    {
        $this->Serchtutor = \DB::table('tutors')
                    ->leftjoin('available_courses', 'available_courses.tutor_id', '=', 'tutors.id','available_courses.ay_id','=',$this->Aay_id->id)
                    ->leftjoin('users', 'users.id', '=', 'tutors.user_id')
                    ->where('tutors.active', 1)
                    ->where('users.department_id', $depid->id)
                    ->where('available_courses.active', 1)
                    ->select('users.fullname', 'users.id')
                    ->pluck('users.fullname', 'users.id');

                            
        $this->courses =Course::selectraw(\DB::raw("concat(courses.code,'- ',courses.name) as name,courses.id"))->where('department_id',$depid->id)
                        ->whereExists(function ($query){
                $query->select(DB::raw(1))
                        ->from('available_courses')
                        ->where('available_courses.active',1)
                        ->where('available_courses.ay_id',$this->Aay_id->id)
                        ->whereColumn('available_courses.course_id', 'courses.id'); })->pluck("name", "id");

        $this->Dep_AVCourses =Course::where('department_id',$depid->id)
                            ->whereExists(function ($query){
                                            $query->select(DB::raw(1))
                                            ->from('available_courses')
                                            ->where('available_courses.active',1)
                                            ->where('available_courses.ay_id',$this->Aay_id->id)
                                            ->whereColumn('available_courses.course_id', 'courses.id'); })->distinct()
                                            ->get();
    }
     
        

    }

    public function submit($dep_id)
    {
        //$this->selectT=$selectT;

        $this->selectC=$this->selectC;
        $this->selectT=$this->selectT;
        
       
       
        $depid=Department::firstwhere('id',$dep_id);
        $this->dep=$depid;
        $this->Aay_id=Ay::firstwhere('is_active', 1);
        $this->show_TutorCourses=False;
        $this->show_CourseTutors=False;
        $this->show_TutorCourse=False;
        $this->vshow1="";
        $this->vshow2="";
        $this->vshow3="active";

        $this->Serchtutor = [];
        $this->courses = [];  

       
        
        

        if($this->Aay_id)
        {
            $this->Serchtutor = \DB::table('tutors')
                        ->leftjoin('available_courses', 'available_courses.tutor_id', '=', 'tutors.id','available_courses.ay_id','=',$this->Aay_id->id)
                        ->leftjoin('users', 'users.id', '=', 'tutors.user_id')
                        ->where('tutors.active', 1)
                        ->where('users.department_id', $depid->id)
                        ->where('available_courses.active', 1)
                        ->select('users.fullname', 'users.id')
                        ->pluck('users.fullname', 'users.id');
    
            $this->courses =Course::where('department_id',$depid->id)
                                    ->where('active',1)
                            ->whereExists(function ($query){
                            $query->select(DB::raw(1))
                                    ->from('available_courses')
                                    ->where('available_courses.active',1)
                                    ->where('available_courses.ay_id',$this->Aay_id->id)
                                    ->whereColumn('available_courses.course_id', 'courses.id'); })->pluck("name", "id");

            $this->Dep_AVCourses =Course::where('department_id',$depid->id)
                                ->whereExists(function ($query){
                                                $query->select(DB::raw(1))
                                                ->from('available_courses')
                                                ->where('available_courses.active',1)
                                                ->where('available_courses.ay_id',$this->Aay_id->id)
                                                ->whereColumn('available_courses.course_id', 'courses.id'); })->distinct()
                                                ->get();
           
            if((isset($this->selectT)) && (isset($this->selectC)))
            {
                $userid=$this->selectT;
                $this->tutorid=Tutor::firstwhere('user_id',$userid);
                $courseid=$this->selectC;
                $this->selectedCourse=Course::firstwhere('id',$courseid);


                $this->booking_TutCourse= Available_course::get()->where('ay_id',$this->Aay_id->id)
                                                           ->where('tutor_id',$this->tutorid->id)
                                                           ->where('course_id',$courseid)
                                                           ->where('active',1);
                
                $this->listTutorial=Tutorial_request::where('user_id',Auth::User()->id)
                                                ->where('active',1)
                                                ->whereExists(function($query){
                                                    $query->where('accepted',0)
                                                          ->orWhere('accepted',1);})->get();
                $this->show_TutorCourses=False;
                $this->show_CourseTutors=False;
                $this->show_TutorCourse=TRUE;
                
            }
            elseif(!(isset($this->selectT)) && (isset(($this->selectC))))
            {
                $courseid=$this->selectC;

                $this->selectedCourse=Course::firstwhere('id',$courseid);
               
                $this->booking_TutCourse= Available_course::get()->where('ay_id',$this->Aay_id->id)
                                                        ->where('course_id',$courseid)
                                                        ->where('active',1);

                $this->listTutorial=Tutorial_request::where('user_id',Auth::User()->id)
                                            ->where('active',1)
                                            ->whereExists(function($query){
                                                    $query->where('accepted',0)
                                                        ->orWhere('accepted',1);})->get();

                $this->show_TutorCourses=False;
                $this->show_CourseTutors=True;
                $this->show_TutorCourse=False;

    
            }
            elseif(((isset($this->selectT))) && !(isset(($this->selectC))))
            {
    
                $userid=$this->selectT;
                $this->tutorid=Tutor::firstwhere('user_id',$userid);
               
    
                $this->booking_TutCourse= Available_course::get()->where('ay_id',$this->Aay_id->id)
                                                           ->where('tutor_id',$this->tutorid->id)
                                                           ->where('active',1);

                $this->listTutorial=Tutorial_request::where('user_id',Auth::User()->id)
                                                ->where('active',1)
                                                ->whereExists(function($query){
                                                        $query->where('accepted',0)
                                                            ->orWhere('accepted',1);})->get();
                $this->show_TutorCourses=TRUE;
                $this->show_CourseTutors=False;
                $this->show_TutorCourse=False;
               
    
    
            }
            
        }

        $this->selectC=null;
        $this->selectT=null;
      

  
        
    }

    
    public function render()
    {
        return view('livewire.selectbooking')->with('dep',$this->dep)
                                                        ->with('show1',$this->show_TutorCourses)
                                                        ->with('show2',$this->show_CourseTutors)
                                                        ->with('show3',$this->show_TutorCourse)
                                                        ->with('Serchtutor',$this->Serchtutor)
                                                        ->with('courses',$this->courses)
                                                        ->with('Dep_AVCourses',$this->Dep_AVCourses)
                                                        ->with('tut_id',$this->tutorid)
                                                        ->with('vshow1',$this->vshow1)
                                                        ->with('vshow2',$this->vshow2)
                                                        ->with('vshow3',$this->vshow3)
                                                        ->with('booked',$this->listTutorial)
                                                        ->with('booking_TutCourse',$this->booking_TutCourse)
                                                        ->with('selectedCourse', $this->selectedCourse);
        

       
    }

}
