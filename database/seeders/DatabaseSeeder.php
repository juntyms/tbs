<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(PrivilegesTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateSuperUserSeeder::class);
        $this->call(RoleSeeder::class);
        
       // \App\Models\User::factory(10)->create();
    }
}
