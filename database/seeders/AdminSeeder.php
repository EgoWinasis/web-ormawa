<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $adminData = [
            [
                'name' => 'mas super admin',
                'role' => 'super_admin',
                'email' => 'super@gmail.com',
                'nama_organisasi' => 'kesiswaan',
                'visi' => 'kerja kerja kerja',
                'misi' => 'kerja kerja kerja',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'mas bem',
                'role' => 'admin',
                'email' => 'bem@gmail.com',
                'nama_organisasi' => 'bem',
                'visi' => 'kerja kerja kerja',
                'misi' => 'kerja kerja kerja',
                'password' => Hash::make('123456'),
            ],
        ];

        foreach ($adminData as $admin) {
            Admin::create($admin);
        }
    }
}
