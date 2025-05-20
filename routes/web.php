<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;

use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Student\StudentDashboard;
use App\Livewire\Technician\TechnicianDashboard;
use App\Livewire\Staff\StaffDashboard;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Lecturer
Route::middleware(['auth', 'verified', 'role:lecturer'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('lecturer.dashboard');
});

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
});

// Student
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', StudentDashboard::class)->name('student.dashboard');
});

// Technician
Route::middleware(['auth', 'role:technician'])->group(function () {
    Route::get('/technician/dashboard', TechnicianDashboard::class)->name('technician.dashboard');
});

// Staff
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard', StaffDashboard::class)->name('staff.dashboard');
});

// Settings - semua role authenticated bisa akses
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';

