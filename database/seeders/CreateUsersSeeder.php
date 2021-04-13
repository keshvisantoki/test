<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
            	'fname' =>'adminf',
            	'lname' => 'adminl',
            	'email' => 'admin@gmail.com',
            	'phone' => '1234567890',	
            	'password' => bcrypt('123456'),
            	'confirmpassword' => bcrypt('123456'),
            	'hobbies' => 'reading',
            	'city' => 'rajkot',
            	'gender' => 'Female',
            	'is_admin' => '1',
            ],
            [
            	'fname' =>'userf',
            	'lname' => 'userl',
            	'email' => 'user@gmail.com',
            	'phone' => '1234567890',	
            	'password' => bcrypt('123456'),
            	'confirmpassword' => bcrypt('123456'),
            	'hobbies' => 'reading',
            	'city' => 'rajkot',
            	'gender' => 'Female',
            	'is_admin' => '0',
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
