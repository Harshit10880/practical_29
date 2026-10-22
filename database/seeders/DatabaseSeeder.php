<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        Student::create([
            'name' => 'Rahul Sharma',
            'enrollment_no' => '216090307001',
            'college' => 'Government Polytechnic Jamnagar',
            'semester' => '5th',
            'subject' => 'Computer Engineering',
            'email' => 'rahul.sharma@example.com',
            'phone' => '9876543210',
        ]);

        Student::create([
            'name' => 'Priya Dave',
            'enrollment_no' => '216090307002',
            'college' => 'Government Polytechnic Jamnagar',
            'semester' => '5th',
            'subject' => 'Information Technology',
            'email' => 'priya.dave@example.com',
            'phone' => '9825123456',
        ]);

        Student::create([
            'name' => 'Hani Pandya',
            'enrollment_no' => '216090307003',
            'college' => 'Government Polytechnic Jamnagar',
            'semester' => '5th',
            'subject' => 'Computer Engineering',
            'email' => 'hani.pandya@example.com',
            'phone' => '9426812345',
        ]);
    }
}
