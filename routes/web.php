<?php

// Livewire Components
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;

use App\Livewire\Admin\{
    AdminDashboard,
    AssignPriority,
    AssignTechnician,
    BuildingManagement,
    CreateBuilding,
    EditBuilding,
    EditFacility,
    EditUser,
    FacilityManagement,
    FeedbackManagement,
    ReportManagement,
    UserManagement
};

use App\Livewire\Student\{
    AddReport,
    BuildingList,
    FacilityList,
    FeedbackList,
    StudentDashboard,
    StudentReport,
    ViewBuilding
};

use App\Livewire\Lecturer\{
    LecturerReport,
    LecturerBuildingList,
    LecturerFacilityList,
    LecturerFeedbackList
};

use App\Livewire\Staff\{
    StaffDashboard,
    StaffReport,
    BuildingList as StaffBuildingList,
    FacilityList as StaffFacilityList,
    FeedbackList as StaffFeedbackList
};

use App\Livewire\Technician\{
    ManageReportStatus,
    TechnicianDashboard,
    BuildingList as TechnicianBuildingList,
    FacilityList as TechnicianFacilityList
};

use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');


// Lecturer Routes
Route::middleware(['auth', 'verified', 'role:lecturer'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('lecturer.dashboard');
    Route::get('/lecturer/report', LecturerReport::class)->name('lecturer.report');
    Route::get('/lecturer/building', LecturerBuildingList::class)->name('lecturer.building.list');
    Route::get('/lecturer/facility', LecturerFacilityList::class)->name('lecturer.facility.list');
    Route::get('/lecturer/feedback', LecturerFeedbackList::class)->name('lecturer.feedback.list');
 Route::post('/report', [ReportController::class, 'store'])->name('report.store');
    Route::get('/staff/reports', [\App\Http\Controllers\ReportController::class, 'index'])
    ->middleware(['auth'])
    ->name('staff.reports');

});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/admin/report', ReportManagement::class)->name('report.management');
    Route::get('/admin/user', UserManagement::class)->name('user.management');
    Route::get('/admin/feedback', FeedbackManagement::class)->name('feedback.management');
    Route::get('/admin/building', BuildingManagement::class)->name('building.management');
    Route::get('/admin/facility', FacilityManagement::class)->name('facility.management');
    Route::get('/admin/priority', AssignPriority::class)->name('assign.priority');
    Route::get('/admin/technician', AssignTechnician::class)->name('assign.technician');

    Route::get('/admin/edit-building/{id}', EditBuilding::class)->name('admin.menu.building.edit-building');
    Route::get('/admin/edit-facility/{id}', EditFacility::class)->name('admin.menu.facility.edit-facility');
    Route::get('/admin/edit-user/{id}', EditUser::class)->name('admin.menu.user.edit-user');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', StudentDashboard::class)->name('student.dashboard');
    Route::get('/student/report', StudentReport::class)->name('student.report');
    Route::get('/student/list', BuildingList::class)->name('student.building.list');
    Route::get('/student/facility', FacilityList::class)->name('student.facility.list');
    Route::get('/student/feedback', FeedbackList::class)->name('student.feedback.list');
    Route::get('/student/add', AddReport::class)->name('student.add.report');
    Route::get('/student/view', ViewBuilding::class)->name('student.view-building');
});

// Technician Routes
Route::middleware(['auth', 'role:technician'])->group(function () {
    Route::get('/technician/dashboard', TechnicianDashboard::class)->name('technician.dashboard');
    Route::get('/technician/manage', ManageReportStatus::class)->name('manage.report.status');
    Route::get('/technician/list', TechnicianBuildingList::class)->name('technician.building.list');
    Route::get('/technician/facility', TechnicianFacilityList::class)->name('technician.facility.list');
});

// Staff Routes
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard', StaffDashboard::class)->name('staff.dashboard');
    Route::get('/staff/report', StaffReport::class)->name('staff.report');
    Route::get('/staff/list', StaffBuildingList::class)->name('building.list');
    Route::get('/staff/facility', StaffFacilityList::class)->name('facility.list');
    Route::get('/staff/feedback', StaffFeedbackList::class)->name('feedback.list');
});

// Settings Routes (All Authenticated Users)
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// Auth scaffolding routes
require __DIR__.'/auth.php';
