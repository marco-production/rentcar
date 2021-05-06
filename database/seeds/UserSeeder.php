<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
    
        User::create([
            'full_name'=>'Marco Antonio',
            'email'=>'admin@hotmail.com',
            'cedula'=>'124345535',
            'tanda'=>'Matutina,Nocturnas',
            'comision'=>'15%',
            'fecha_ingreso'=>'2019-06-04',
            'password'=>bcrypt('12345678'),
            'slug'=>'marco-antonio',
            'role_id'=>1
        ]);

        User::create([
            'full_name'=>'Jose Santos',
            'email'=>'user@hotmail.com',
            'cedula'=>'124345537',
            'tanda'=>'Matutina,Nocturnas',
            'comision'=>'15%',
            'fecha_ingreso'=>'2020-06-04',
            'password'=>bcrypt('12345678'),
            'slug'=>'jose-santos',
            'role_id'=>2
        ]);
    }
}
