<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminrole = Role::create(['name' => 'admin']);
        $tutrole = Role::create(['name' => 'tutor-role']);
        $studentrole= Role::create(['name' => 'student-role']);
        $studenttutorrole= Role::create(['name' => 'student-tutor']);
     
        $tutorpermissions = Permission::whereBetween('id',[37,39])->get();
        $studentpermissions=Permission::whereBetween('id',[32,36])->get();
        $studenttutorpermissions=Permission::whereBetween('id',[32,39])->get();
        $adminpermissions=Permission::whereBetween('id',[19,31])
                                      ->orWhere('id',39)->get();
                    
   
        $adminrole->syncPermissions($adminpermissions);
        $tutrole->syncPermissions($tutorpermissions);
        $studentrole->syncPermissions($studentpermissions);
        $studenttutorrole->syncPermissions($studenttutorpermissions);
    }
}
