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
    private $ay_id=[];
    private $months=[];
    private $countR=[];
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


        
        $reall = Tutorial_request::select(DB::raw('count(date) as count'), DB::raw('MONTH(date) as month'))
                                ->whereExists(function($query){         
                                    $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->ay_id->id)
                                        ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');
                                    })
                                ->groupBy('month')->get();


        foreach($reall as $re)
        {

            $dateObj=DateTime::createFromFormat('Y-m-d', $re->count);
            $currentmonth=$re->month;
            $MonthName=DateTime::createFromFormat('!m', $currentmonth);
          

            array_push($this->months, $MonthName->format('F'));

            
            array_push($this->countR,(int)$re->count);



        }
       
        return view('report.index')->with('deps',$deps)
                                   ->with('totalT',$totalTutor)
                                   ->with('totalS',$totalstudent)
                                   ->with('months',json_encode ($this->months))
                                   ->with('countR',json_encode($this->countR));
    }
}
