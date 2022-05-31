<?php

namespace App\Http\Livewire;

use App\Models\Ay;
use App\Models\Tutor;
use App\Models\Course;
use Livewire\Component;
use App\Models\Tutorial_request;
use Illuminate\Support\Facades\DB;

class Search extends Component
{
    public $tutorid;
    public $courseId;
    public $studentId;
    public $Aay_id;

    public $listTutorial;
    public $avlists;
    public $totalAV;

    PUBLIC $totalRq;
    public $totalWap;
    public $totalAp;
    public $totalRg;
    public $totalComp;
    public $totalIncomp;

    
    public $selectA;
    public $selectS;
    public $selectC;
    public $selectT;
    public $selectST;

    public $years;
    public $semesters;
    public $avaiablesC;
    public $tutors;
    public $Students;
    public $Spage;
    public $Tpage;

    public function mount()
    {
        
    

        $this->years=Ay::get()->pluck('name','name');
        $this->semesters=Ay::get()->pluck('semester','semester');

        $this->Students=\DB::table('users')->leftJoin('model_has_roles','users.id','=','model_has_roles.model_id')
                                     ->where(function($q){
                                         $q->whereIn('model_has_roles.role_id',[4,5])
                                            ->orWhereNull('model_has_roles.role_id');
                                     })
                                    ->where('users.active',1)->get()->pluck('fullname','id');

        $this->tutors=\DB::table('users')->leftJoin('model_has_roles','users.id','=','model_has_roles.model_id')
                                    ->where(function($q){
                                        $q->whereIn('model_has_roles.role_id',[3,5])
                                           ->orWhereNull('model_has_roles.role_id');
                                    })
                                   ->where('users.active',1)->get()->pluck('fullname','id');

       
        $this->Aay_id=Ay::firstwhere('is_active', 1);
        if( $this->Aay_id)
        {
            $this->selectA=$this->Aay_id->name;
            $this->selectS=$this->Aay_id->semester;

            $this->avaiablesC =Course::whereExists(function ($query){
                                $query->select(DB::raw(1))
                                ->from('available_courses')
                                ->where('available_courses.active',1)
                                ->where('available_courses.ay_id',$this->Aay_id->id)
                                ->whereColumn('available_courses.course_id', 'courses.id'); })->distinct()
                                ->get()->pluck('name','id');

        }else{
            $this->selectA=null;
            $this->selectS=null;
            $this->avaiablesC=null;

        }

        $this->selectC=null;
        $this->selectT=null;
        $this->selectST=null;

        $this->avlists=null;
        $this->totalRq=0;
        $this->listTutorial=null;
        $this->Spage=false;
        $this->Tpage=false;



    }


    public function submit()
    {
       
        $this->selectA = $this->selectA;
        $this->selectS = $this->selectS;
        $this->selectC=  $this->selectC;
        $this->selectT=  $this->selectT;
        $this->selectST= $this->selectST;
       
        
       
        if((isset($this->selectA)) && (isset($this->selectS)))
        {
            $this->Aay_id=Ay::firstwhere(['name'=>$this->selectA, 'semester'=>$this->selectS]);
            
           
        
            if($this->Aay_id)
            {
                if((isset($this->selectST)) && (isset($this->selectT)) && (isset($this->selectC)))
                {
                    
                 $this->listTutorial=Tutorial_request::where('tutor_id', $this->selectT)
                                        ->where('user_id',$this->selectST)
                                        ->whereExists(function($query){
                        $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->Aay_id->id)
                                                                             ->where('available_courses.course_id',$this->selectC)
                                                                            ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
                })->orderBy('created_at','desc')->get();
                $this->Spage=true;
                $this->Tpage=false;

                }elseif ((isset($this->selectST)) && (isset($this->selectT)) && (!isset($this->selectC))) {
                    $this->listTutorial=Tutorial_request::where('tutor_id', $this->selectT)
                                        ->where('user_id',$this->selectST)
                                        ->whereExists(function($query){
                                            $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->Aay_id->id)
                                                                                                ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
                                        })->orderBy('created_at','desc')->get();
                    

                    $this->Spage=true;
                    $this->Tpage=false;
    

                }elseif ((isset($this->selectST)) && (!isset($this->selectT)) && (isset($this->selectC))) {
                    $this->listTutorial=Tutorial_request::where('user_id',$this->selectST)
                                        ->whereExists(function($query){
                        $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->Aay_id->id)
                                                                             ->where('available_courses.course_id',$this->selectC)
                                                                            ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
                    })->orderBy('created_at','desc')->get();

                    $this->Spage=true;
                    $this->Tpage=false;
    
                }elseif ((isset($this->selectST)) && (!isset($this->selectT)) && (!isset($this->selectC))) {
                        $this->listTutorial=Tutorial_request::where('user_id',$this->selectST)
                                    ->whereExists(function($query){
                                        $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->Aay_id->id)
                                                                                            ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
                        })->orderBy('created_at','desc')->get();

                    $this->Spage=true;
                    $this->Tpage=false;
    

                }elseif ((!isset($this->selectST)) && (isset($this->selectT)) && (isset($this->selectC))) {
                    $this->listTutorial=Tutorial_request::where('tutor_id', $this->selectT)
                                        ->whereExists(function($query){
                        $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->Aay_id->id)
                                                                            ->where('available_courses.course_id',$this->selectC)
                                                                            ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
                    })->orderBy('created_at','desc')->get();
                    $this->Spage=false;
                    $this->Tpage=true;

                }elseif ((!isset($this->selectST)) && (isset($this->selectT)) && (!isset($this->selectC))) {
                 
                    $this->listTutorial=Tutorial_request::where('tutor_id', $this->selectT)
                                        ->whereExists(function($query){
                        $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->Aay_id->id)
                                                                        
                                                                                ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
                    })->orderBy('created_at','desc')->get();
                    $this->Spage=false;
                    $this->Tpage=true;
                    
                    }
                else {
                    $this->listTutorial=null;
                    $this->Spage=false;
                    $this->Tpage=false;
                    $this->selectC=null;
                    $this->selectT=null;
                    $this->selectST=null;
                }


                
            }
            else{
                $this->listTutorial=null;
                $this->selectC=null;
                $this->selectT=null;
                $this->selectST=null;
                $this->Spage=false;
                $this->Tpage=false;

                
                

            }


            
            
        }
        else{
            $this->listTutorial=null;
            $this->selectC=null;
            $this->selectT=null;
            $this->selectST=null;
            $this->Spage=false;
            $this->Tpage=false;
           
            
        }




    }

    
    public function render()
    {
        return view('livewire.search')->with('Students',$this->Students)
                                      ->with('tutors',$this->tutors)
                                      ->with('years',$this->years)
                                      ->with('semesters',$this->semesters)
                                      ->with('A',$this->selectA)
                                      ->with('S', $this->selectS)
                                      ->with('avlists',$this->avlists)
                                      ->with('totalRq',$this->totalRq)
                                      ->with('avaiablesC',$this->avaiablesC)
                                      ->with('listTutorial',$this->listTutorial)
                                      ->with('Spage', $this->Spage)
                                      ->with('Tpage',$this->Tpage);
}
}
