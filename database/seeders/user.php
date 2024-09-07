<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class user extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_data = array(
            'name'=>'Vishnu NM',
            'email'=>'vishnunmms@gmail.com',
            'mobile'=>'0101010101',
            'password'=>Hash::make('Vishnu NM'),
        );

        DB::table('admin_users')->insert($user_data);
    }
}
