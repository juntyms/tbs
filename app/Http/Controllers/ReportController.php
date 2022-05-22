<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Ay;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Tutorial_request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    private $ay_id;
    private $months;
    private $countR;
    public function reporting_department()
    {
        $totalstudent=0;
        $totalTutor=0;
        $deps=Department::get();
        $this->ay_id=Ay::firstwhere('is_active', 1);
        $currentdatetime=new DateTime();
        $currentdate=$currentdatetime->format('Y-m-d');
        $currenthour=$currentdatetime->format('H');
        $currentmonth=$currentdatetime->format('m');
        $reall=[];
        $this->months=[];
        $this->countR=[];

        $currentMonthIndex=0;
        $currentAVcourses=[];

        $acadmicMonth=[9,10,11,12,1,2,3,4,5,6,7];

        for($i=0;$i < sizeof($acadmicMonth); $i++)
        {
            if($acadmicMonth[$i]==$currentmonth)
            {
                $currentMonthIndex=$i;
            }
        }

        $sctuser=User::get();


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


        if($this->ay_id){
            $reall = Tutorial_request::select(DB::raw('count(date) as count'), DB::raw('MONTH(date) as month'))
                                    ->whereExists(function($query){         
                                        $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->ay_id->id)
                                            ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
                                        })
                                    ->groupBy('month')->orderBy('date', 'asc')->get();
            


            $currentAVcourses = Tutorial_request::whereExists(function($query){         
                                        $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->ay_id->id)
                                                                                            ->where('available_courses.active',1)
                                            ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
                                        })
                                    ->get();
        }

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
                    
       
        return view('report.index')->with('deps',$deps)
                                   ->with('totalT',$totalTutor)
                                   ->with('totalS',$totalstudent)
                                   ->with('CurrentCourse',$currentAVcourses)
                                   ->with('months',json_encode ($this->months))
                                   ->with('countR',json_encode($this->countR))
                                   ->with('ay', $this->ay_id);
    }





    public function  eachDepartmentReport($depid) 
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

        

        
        $this->Aay_id=Ay::firstwhere('is_active', 1);
        $this->depReported=Department::firstwhere('id',$depid);

       

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
        if($this->depReported && $this->Aay_id)
        {

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



        return view('report.eachDepartmentReport')->with('lists',$listTutorial)
                                              ->with('Alllists',$AlllistTutorial)
                                              ->with('dep',$this->depReported)
                                              ->with('totalT',$totalTutor)
                                              ->with('totalS',$totalstudent)
                                              ->with('months',json_encode ($this->months))
                                              ->with('countR',json_encode($this->countR))
                                              ->with('ay', $this->Aay_id);

    }

}
