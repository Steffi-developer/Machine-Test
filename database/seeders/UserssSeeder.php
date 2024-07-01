<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 


class UserssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'fk_department' => 1,
                'fk_designation' => 2,
                'phone_number' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'fk_department' => 2,
                'fk_designation' => 3,
                'phone_number' => '0987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John',
                'fk_department' => 2,
                'fk_designation' => 4,
                'phone_number' => '9876543210',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jacky',
                'fk_department' => 3,
                'fk_designation' => 6,
                'phone_number' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    
    }
}
