<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class CreateSuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'administrator',
            'email' => 'administrator@sct.edu.om',            
            'password' => bcrypt('admin@2020'), // password
            'fullname' => 'Super User ',
            'department_id'=>'2',
            'remember_token' => Str::random(10),
        ]);
    
        $role = Role::create(['name' => 'superuser']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}
