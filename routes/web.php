<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Practical 29: Major Project - I (EduPulse Pro Coaching & Academy SaaS)
|--------------------------------------------------------------------------
*/

// Practical 29: Full-Featured Commercial Tuition & Academic Management System
Route::get('/', function () {
    return view('edupulse');
})->name('edupulse.home');

Route::get('/tuition', function () {
    return view('edupulse');
})->name('edupulse.dashboard');

// Practical 8 & 16 Legacy Views & CRUD Modules
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', function (\Illuminate\Http\Request $request) {
    return back()->with('success', 'Thank you, ' . $request->input('name') . '! Your message was submitted successfully via @csrf.');
})->name('contact.submit');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('students', StudentController::class);
Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('/about', [AboutController::class, 'index'])->name('about');
