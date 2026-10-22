<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Practical 16: Complete Web-Based CRUD Mini Project
|--------------------------------------------------------------------------
*/

// Practical 8: Reusable Blade Template System (Home, About, Contact)
Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', function (\Illuminate\Http\Request $request) {
    return back()->with('success', 'Thank you, ' . $request->input('name') . '! Your message was submitted successfully via @csrf.');
})->name('contact.submit');

// Practical 16: Dashboard Module
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// 2-5. Student CRUD Modules (Index, Create/Store, Show, Edit/Update, Destroy)
Route::resource('students', StudentController::class);

// 6. Departments & Courses Module
Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');

// 7. About & System Architecture Module
Route::get('/about', [AboutController::class, 'index'])->name('about');