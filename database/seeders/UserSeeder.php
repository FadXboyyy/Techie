<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrator = User::create([
            'name' => 'Administrator',
            'email' => 'administrator@mail.com',
            'password' => bcrypt('admin@123')
        ]);

        $administrator->assignRole('administrator');
    }
}
