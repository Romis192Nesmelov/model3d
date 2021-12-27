<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $userData = [
            [
                'name' => 'Romis',
                'email' => 'romis.nesmelov@gmail.com',
                'password' => bcrypt('apg192'),
                'type' => 2,
                'active' => 1,
                'send_mail' => 1
            ],
        ];

        foreach ($userData as $k => $user) {
            User::create($user);
        }
    }
}