<?php

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name' => 'Krishna Timilsina',
            'email' => 'admin@admin.com',
            'password' => Hash::make('1234'),
            'role' => 'admin',
        ]);
    }
}
