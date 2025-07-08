<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin Master',
                'document' => '22233333323',
                'phone' => '1122222222',
                'email' => 'admin@local.dev',
                'password' => 'password',
                'role' => 'admin'
            ],
            [
                'name' => 'Thiago Entregador',
                'document' => '33344444444',
                'phone' => '1133333333',
                'email' => 'tmelophp@gmail.com',
                'password' => 'password',
                'role' => 'courier'
            ],
            [
                'name' => 'Thiago Cliente',
                'document' => '33344455555',
                'phone' => '1166666666',
                'email' => 'thiago_melo18@yahoo.com.br',
                'password' => 'password',
                'role' => 'customer'
            ],
        ];

        foreach ($users as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'document' => $data['document'],
                    'phone' => $data['phone'],
                    'name' => $data['name'],
                    'password' => Hash::make($data['password'])
                ]
            );

            $user->assignRole($data['role']);
        }
    }
}