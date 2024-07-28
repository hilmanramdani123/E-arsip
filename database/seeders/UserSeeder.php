<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Hilman Ramdani',
                'username' => 'Hilman_arsipkawasan',
                'password' => Hash::make('Hilman12345'),
            ],
            [
                'name' => 'Giri Sari Ratu Timur',
                'username' => 'Giri_arsipkawasan',
                'password' => Hash::make('Giri12345'),
            ],
            [
                'name' => 'Aulia Majid Lubis',
                'username' => 'Majid_arsipkawasan',
                'password' => Hash::make('Majid12345'),
            ],
            [
                'name' => 'Fahrial',
                'username' => 'Fahrial_arsipkawasan',
                'password' => Hash::make('Fahrial12345'),
            ],
            [
                'name' => 'Agung Cahyono',
                'username' => 'Agung_arsipkawasan',
                'password' => Hash::make('Agung12345'),
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['username' => $user['username']], // Kondisi pencocokan
                $user // Data yang akan dibuat jika tidak ada
            );
        }
    }
}
