<?php

namespace App\Http\Controllers;

use App\Models\Ay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    public $year;
    public function getADyear()
    {
        $AD_years= Ay::get();

        return view('AcadmicY.index')->with('AD_years', $AD_years);
    }

    public function AddADyear(Request $request)
    {
        $this->validate($request, [
            'yearname' => 'required',
            'status' => 'required',
            'semester'=>'required',
        ]);

        if($request->status==1)
        {  
            
            $affected = DB::table('ays')->where('is_active', '=', 1)->update(array('is_active' => 0));
            $this->year=Ay::create(['name'=>$request->yearname,'semester'=> $request->semester,'is_active'=>1 ]);
            
            $downTutorials=DB::table('tutorial_requests')->update(array('active' => 0));

        }else{ 
            Ay::create(['name'=>$request->yearname,'is_active'=>0]);

        }
        return redirect()->route('AcadmicY.index');
    }

    public function deleteADyear($id)
    {
        AY::destroy($id);
        return redirect()->route('AcadmicY.index');
    }
    public function updateADyear(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
            'semester' => 'required',
        ]);
        $this->year = Ay::findOrFail($request->id);

        if($request->status==1)
        {
            $affected = DB::table('ays')->where('is_active', '=', 1)->update(array('is_active' => 0));

            $downTutorials=DB::table('tutorial_requests')->update(array('active' => 0));
           
            $this->year->update(['name'=>$request->name, 'semester'=> $request->semester, 'is_active'=>1 ]); 
            
            $upTutorials=DB::table('tutorial_requests')->whereExists(function($query){
                $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->year->id)
                                                                    ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');})
                                                                ->update(array('active' => 1));

        }else{ 
            $this->year->update(['name'=>$request->name, 'semester'=> $request->semester ,'is_active'=>0 ]);

            $downTutorials=DB::table('tutorial_requests')->whereExists(function($query){
                $query->select(DB::raw(1))->from('available_courses')->where('available_courses.ay_id', $this->year->id)
                                                                    ->whereColumn('available_courses.id', 'tutorial_requests.available_course_id');})
                                                                ->update(array('active' => 0));
        }
        return redirect()->route('AcadmicY.index');
    }

}
