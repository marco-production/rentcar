<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
    
        Role::create([
            'name'=>'Administrador',
        ]);

        Role::create([
            'name'=>'Empleado',
        ]);
    }
}
