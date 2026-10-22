<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sampleStudents = [
            [
                'name' => 'Aarav Patel',
                'enrollment_no' => '236250307001',
                'college' => 'Government Polytechnic, Jamnagar',
                'semester' => 'Semester 6',
                'subject' => 'Vibe Coding (Laravel)',
                'email' => 'aarav.patel@gpcjamnagar.edu.in',
                'phone' => '+91 98765 43210',
            ],
            [
                'name' => 'Kavya Sharma',
                'enrollment_no' => '236250307015',
                'college' => 'Government Polytechnic, Jamnagar',
                'semester' => 'Semester 6',
                'subject' => 'Web Technologies & PHP',
                'email' => 'kavya.sharma@gpcjamnagar.edu.in',
                'phone' => '+91 98250 12345',
            ],
            [
                'name' => 'Dev Joshi',
                'enrollment_no' => '236250307028',
                'college' => 'Government Polytechnic, Jamnagar',
                'semester' => 'Semester 4',
                'subject' => 'Database Management Systems',
                'email' => 'dev.joshi@gpcjamnagar.edu.in',
                'phone' => '+91 94280 67890',
            ],
            [
                'name' => 'Pooja Vaghela',
                'enrollment_no' => '236250307042',
                'college' => 'Government Polytechnic, Jamnagar',
                'semester' => 'Semester 6',
                'subject' => 'Advanced Software Engineering',
                'email' => 'pooja.vaghela@gpcjamnagar.edu.in',
                'phone' => '+91 97240 33445',
            ],
        ];

        foreach ($sampleStudents as $student) {
            Student::firstOrCreate(['email' => $student['email']], $student);
        }
    }
}
