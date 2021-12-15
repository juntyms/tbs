<?php

namespace Database\Seeders;

use App\Models\Privilege;
use Illuminate\Database\Seeder;

class PrivilegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('privileges')->delete();
        Privilege::create(['name'=>'admin']);
        Privilege::create(['name'=>'department admin']);
        Privilege::create(['name'=>'course creator']);
    }
}
