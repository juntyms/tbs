<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('departments')->delete();
        Department::create(['name'=>'English Language Center','is_academic'=>'1']);
        Department::create(['name'=>'Educational Technology Center','is_academic'=>'0']);
        Department::create(['name'=>'Business Studies Department','is_academic'=>'1']);
        Department::create(['name'=>'Information Technology Department','is_academic'=>'1']);
        Department::create(['name'=>'Engineering Department','is_academic'=>'1']);

    }
}
