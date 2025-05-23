<?php

use App\Livewire\Lecturer\LecturerBuildingList;
use App\Livewire\Lecturer\LecturerFeedbackList;
use App\Livewire\Lecturer\LecturerReport;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use App\Livewire\Staff\StaffReport;
use App\Livewire\Staff\StaffDashboard;

use App\Livewire\Student\FacilityList;
use App\Livewire\Student\FeedbackList;
use App\Livewire\Student\BuildingList;
use App\Livewire\Student\StudentDashboard;
use App\Livewire\Student\StudentReport;
use Illuminate\Support\Facades\Route;

use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\AssignPriority;
use App\Livewire\Admin\AssignTechnician;
use App\Livewire\Admin\BuildingManagement;
use App\Livewire\Admin\FacilityManagement;
use App\Livewire\Admin\FeedbackManagement;
use App\Livewire\Admin\ReportManagement;
use App\Livewire\Admin\UserManagement;
use App\Livewire\Lecturer\LecturerFacilityList;
use App\Livewire\Technician\ManageReportStatus;
use App\Livewire\Technician\TechnicianDashboard;

use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Lecturer
Route::middleware(['auth', 'verified', 'role:lecturer'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('lecturer.dashboard');
    Route::get('/lecturer/report', LecturerReport::class)->name('lecturer.report');
    Route::get('/lecturer/building', LecturerBuildingList::class)->name('lecturer.building.list');
    Route::get('/lecturer/facility', LecturerFacilityList::class)->name('lecturer.facility.list');
    Route::get('/lecturer/feedback', LecturerFeedbackList::class)->name('lecturer.feedback.list');
});

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/admin/report', ReportManagement::class)->name('report.management');
    Route::get('/admin/user', UserManagement::class)->name('user.management');
    Route::get('/admin/feedback', FeedbackManagement::class)->name('feedback.management');
    Route::get('/admin/building', BuildingManagement::class)->name('building.management');
    Route::get('/admin/facility', FacilityManagement::class)->name('facility.management');
    Route::get('/admin/priority', AssignPriority::class)->name('assign.priority');
    Route::get('/admin/technician', AssignTechnician::class)->name('assign.technician');

});

// Student
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', StudentDashboard::class)->name('student.dashboard');
    Route::get('/student/report', StudentReport::class)->name('student.report');
    Route::get('/student/list', BuildingList::class)->name('student.building.list');
    Route::get('/student/facility', FacilityList::class)->name('student.facility.list');
    Route::get('/student/feedback', FeedbackList::class)->name('student.feedback.list');
    Route::post('/report', [ReportController::class, 'store'])->name('report.store');
    Route::get('/student/reports', [\App\Http\Controllers\ReportController::class, 'index'])
    ->middleware(['auth'])
    ->name('student.reports');
});

// Technician
Route::middleware(['auth', 'role:technician'])->group(function () {
    Route::get('/technician/dashboard', TechnicianDashboard::class)->name('technician.dashboard');
    Route::get('/technician/manage', ManageReportStatus::class)->name('manage.report.status');
    Route::get('/technician/list', \App\Livewire\Technician\BuildingList::class)->name('technician.building.list');
    Route::get('/technician/facility', \App\Livewire\Technician\FacilityList::class)->name('technician.facility.list');
    Route::post('/report', [ReportController::class, 'store'])->middleware('auth')->name('report.store');
});

// Staff
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard', StaffDashboard::class)->name('staff.dashboard');
    Route::get('/staff/report', StaffReport::class)->name('staff.report');
    Route::get('/staff/list', \App\Livewire\Staff\BuildingList::class)->name('building.list');
    Route::get('/staff/facility', \App\Livewire\Staff\FacilityList::class)->name('facility.list');
    Route::get('/staff/feedback', \App\Livewire\Staff\FeedbackList::class)->name('feedback.list');
});

// Settings - semua role authenticated bisa akses
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});



require __DIR__.'/auth.php';

