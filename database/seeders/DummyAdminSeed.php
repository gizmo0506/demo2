<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DummyAdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $userData = [
            [
               'name'=>'Admin',
               'email'=>'admin1@admin.com',
                'is_admin'=>'1',
               'password'=> Hash::make('12345'),
            ],
            [
               'name'=>'Regular User',
               'email'=>'user@regular.com',
                'is_admin'=>'0',
               'password'=> Hash::make('12345'),
            ],
        ];
  
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
