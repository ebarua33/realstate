<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $data = array(

            //___Admin___//
            [
                'name'=>'Admin',
                'username'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('password'),
                'role'=>'admin',
                'status'=>'active',
            ],

            //___Agent__//
            [
                'name' => 'Agent',
                'username' => 'agent',
                'email' => 'agent@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'agent',
                'status' => 'active',
            ],

            //__User__//
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'status' => 'active',
            ],
        );

        User::insert($data);

    }
}
