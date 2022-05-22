<?php

namespace App\Http\Livewire;

use App\Models\Ay;
use App\Models\Tutor;
use Livewire\Component;
use App\Models\Tutorial_request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class History extends Component
{
    public $tutorid;
    public $Aay_id;
    public $listTutorial;
    
    public $selectA;
    public $selectS;
    public $years;
    public $semesters;

    public function mount()
    {
        
    

        $this->years=Ay::get()->pluck('name','name');
        $this->semesters=Ay::get()->pluck('semester','semester');

       
        $this->tutorid=Tutor::firstwhere('user_id',Auth::User()->id);
        $this->Aay_id=Ay::firstwhere('is_active', 1);
        if( $this->Aay_id)
        {
            $this->selectA=$this->Aay_id->name;
            $this->selectS=$this->Aay_id->semester;

        }else{
            $this->selectA=null;
            $this->selectS=null;

        }
        

        
        

        if($this->tutorid && $this->Aay_id)
        {

            $this->listTutorial=Tutorial_request::where('tutor_id', $this->tutorid->id)
                                    ->where('active',1)
                                    ->whereExists(function($query){
                    $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->Aay_id->id)
                                                                        ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
            })->orderBy('created_at','desc')->get();
        }

    }


    public function submit()
    {
        $this->selectA = $this->selectA;
        $this->selectS = $this->selectS;
       
        if((isset($this->selectA)) && (isset($this->selectS)))
        {
            $this->Aay_id=Ay::firstwhere(['name'=>$this->selectA, 'semester'=>$this->selectS]);
            $this->tutorid=Tutor::firstwhere('user_id',Auth::User()->id);
           
        
            if($this->tutorid && $this->Aay_id)
            {

                $this->listTutorial=Tutorial_request::where('tutor_id', $this->tutorid->id)
                                        ->where('active',1)
                                        ->whereExists(function($query){
                        $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->Aay_id->id)
                                                                            ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
                })->orderBy('created_at','desc')->get();
                
            }
            else{

                Alert::toast('Incorrect Entery Data !!','warning');
                

            }


            
            
        }
        else{
            Alert::toast('Please Select Academic Year and Semester !!', 'warning');
            
        }




    }

    

    public function render()
    {
        
        return view('livewire.history')->with('lists',$this->listTutorial)
                                                        ->with('years',$this->years)
                                                        ->with('semesters',$this->semesters)
                                                        ->with('A',$this->selectA)
                                                        ->with('S', $this->selectS);
    }

   
}
