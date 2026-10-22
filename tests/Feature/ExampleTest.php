<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Practical 16: Test Dashboard page loads successfully.
     */
    public function test_dashboard_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Academic Management Dashboard');
        $response->assertSee('Government Polytechnic, Jamnagar');
    }

    /**
     * Practical 16: Test Student Directory (Index) with search and filters.
     */
    public function test_student_directory_page_loads_and_filters(): void
    {
        Student::create([
            'name'          => 'Aarav Patel',
            'enrollment_no' => '236250307001',
            'college'       => 'Government Polytechnic, Jamnagar',
            'semester'      => 'Semester 6',
            'subject'       => 'Vibe Coding',
            'email'         => 'aarav@example.com',
        ]);

        Student::create([
            'name'          => 'Dev Joshi',
            'enrollment_no' => '236250307028',
            'college'       => 'Government Polytechnic, Jamnagar',
            'semester'      => 'Semester 4',
            'subject'       => 'DBMS',
            'email'         => 'dev@example.com',
        ]);

        $response = $this->get('/students');
        $response->assertStatus(200);
        $response->assertSee('Aarav Patel');
        $response->assertSee('Dev Joshi');

        // Test search
        $searchResponse = $this->get('/students?search=Aarav');
        $searchResponse->assertSee('Aarav Patel');
        $searchResponse->assertDontSee('dev@example.com');
    }

    /**
     * Practical 16: Test Create Student form loads.
     */
    public function test_create_student_page_loads(): void
    {
        $response = $this->get('/students/create');
        $response->assertStatus(200);
        $response->assertSee('Student Registration Form');
        $response->assertSee('Save Student to MySQL');
    }

    /**
     * Practical 16: Test storing a new student record (Create).
     */
    public function test_can_store_student_record(): void
    {
        $response = $this->post('/students', [
            'name'          => 'Pooja Vaghela',
            'enrollment_no' => '236250307042',
            'college'       => 'Government Polytechnic, Jamnagar',
            'semester'      => 'Semester 6',
            'subject'       => 'Advanced Software Eng',
            'email'         => 'pooja@example.com',
            'phone'         => '9876543210',
        ]);

        $student = Student::where('email', 'pooja@example.com')->first();
        $this->assertNotNull($student);

        $response->assertRedirect('/students/' . $student->id);
        $response->assertSessionHas('success');
    }

    /**
     * Practical 16: Test showing student profile (Read Single).
     */
    public function test_can_view_student_profile(): void
    {
        $student = Student::create([
            'name'          => 'Kavya Sharma',
            'enrollment_no' => '236250307015',
            'college'       => 'Government Polytechnic, Jamnagar',
            'semester'      => 'Semester 6',
            'subject'       => 'Web Tech',
            'email'         => 'kavya@example.com',
        ]);

        $response = $this->get('/students/' . $student->id);
        $response->assertStatus(200);
        $response->assertSee('Kavya Sharma');
        $response->assertSee('Academic Credentials');
    }

    /**
     * Practical 16: Test editing and updating student record (Update).
     */
    public function test_can_edit_and_update_student_record(): void
    {
        $student = Student::create([
            'name'     => 'Original Name',
            'email'    => 'orig@example.com',
            'semester' => 'Semester 4',
        ]);

        // Edit form loads
        $editResponse = $this->get('/students/' . $student->id . '/edit');
        $editResponse->assertStatus(200);
        $editResponse->assertSee('Update Student Details');

        // Update request
        $updateResponse = $this->put('/students/' . $student->id, [
            'name'     => 'Updated Name',
            'email'    => 'orig@example.com',
            'semester' => 'Semester 6',
        ]);

        $updateResponse->assertRedirect('/students/' . $student->id);
        $this->assertDatabaseHas('students', [
            'id'       => $student->id,
            'name'     => 'Updated Name',
            'semester' => 'Semester 6',
        ]);
    }

    /**
     * Practical 16: Test deleting student record (Delete).
     */
    public function test_can_delete_student_record(): void
    {
        $student = Student::create([
            'name'  => 'Delete Me',
            'email' => 'del@example.com',
        ]);

        $response = $this->delete('/students/' . $student->id);
        $response->assertRedirect('/students');
        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    /**
     * Practical 16: Test Departments and About pages load.
     */
    public function test_departments_and_about_pages_load(): void
    {
        $deptResponse = $this->get('/departments');
        $deptResponse->assertStatus(200);
        $deptResponse->assertSee('Computer Engineering');

        $aboutResponse = $this->get('/about');
        $aboutResponse->assertStatus(200);
        $aboutResponse->assertSee('Practical 16: Mini Project Overview');
    }
}
