<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = array(
            array(
                'name' => 'Yasir Naeem',
                'email' => 'yasir.sherwani@gmail.com',
                'password' => Hash::make('12345678'),
                'photo' => null,
                'is_super_admin' => 1,
                'status' => 'active'
            ),
            array(
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'photo' => null,
                'is_super_admin' => 1,
                'status' => 'active'
            ),
        );

        if(count($admins) > 0) {
            foreach($admins as $admin) {
                Admin::updateOrCreate([
                    'email' => $admin['email']
                ],[
                    'name' => $admin['name'],
                    'password' => $admin['password'],
                    'photo' => $admin['photo'],
                    'is_super_admin' => $admin['is_super_admin'],
                    'status' => $admin['status']
                ]);
            }
        }
    }
}
