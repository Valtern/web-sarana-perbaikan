<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

// Settings (shared)
use App\Livewire\Settings\{Profile, Password, Appearance};

use App\Livewire\faq\{Appearancefaq};
// Admin
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

// Lecturer
use App\Livewire\Lecturer\{
    LecturerReport,
    LecturerBuildingList,
    LecturerFacilityList,
    LecturerFeedbackList
};

// Student
use App\Livewire\Student\{
    BuildingList as StudentBuildingList,
    FacilityList as StudentFacilityList,
    FeedbackList as StudentFeedbackList,
    StudentDashboard,
    StudentReport,
    ViewBuilding,
    ViewFacility,
    ReportHistory as StudentReportHistory,
    SubmitReport as StudentSubmitReport
};

// Staff
use App\Livewire\Staff\{
    StaffDashboard,
    StaffReport,
    BuildingList as StaffBuildingList,
    FacilityList as StaffFacilityList,
    FeedbackList as StaffFeedbackList,
    ReportHistory as StaffReportHistory,
    SubmitReport as StaffSubmitReport
};

// Technician
use App\Livewire\Technician\{
    ManageAssignmentStatus,
    TechnicianDashboard,
    BuildingList as TechnicianBuildingList,
    FacilityList as TechnicianFacilityList
};

// Public route
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

    // Report store and view
    Route::post('/report', [ReportController::class, 'store'])->name('report.store');
    Route::get('/lecturer/reports', [ReportController::class, 'index'])->name('lecturer.reports');
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
    Route::get('/student/list', StudentBuildingList::class)->name('student.building.list');
    Route::get('/student/facility', StudentFacilityList::class)->name('student.facility.list');
    Route::get('/student/feedback', StudentFeedbackList::class)->name('student.feedback.list');
    Route::get('/student/report-history', StudentReportHistory::class)->name('student.report-history');
    Route::get('/student/submit-report', StudentSubmitReport::class)->name('student.submit-report');
    // Report store and view
    Route::get('/student/reports', [ReportController::class, 'index'])->name('student.reports');
});

// Technician Routes
Route::middleware(['auth', 'role:technician'])->group(function () {
    Route::get('/technician/dashboard', TechnicianDashboard::class)->name('technician.dashboard');
    Route::get('/technician/manage', ManageAssignmentStatus::class)->name('manage.report.status');
    Route::get('/technician/list', TechnicianBuildingList::class)->name('technician.building.list');
    Route::get('/technician/facility', TechnicianFacilityList::class)->name('technician.facility.list');

    // Report store
    Route::post('/report', [ReportController::class, 'store'])->name('report.store');
});

// Staff Routes
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard', StaffDashboard::class)->name('staff.dashboard');
    Route::get('/staff/report', StaffReport::class)->name('staff.report');
    Route::get('/staff/list', StaffBuildingList::class)->name('building.list');
    Route::get('/staff/facility', StaffFacilityList::class)->name('facility.list');
    Route::get('/staff/feedback', StaffFeedbackList::class)->name('feedback.list');
    Route::get('/staff/report-history', StaffReportHistory::class)->name('staff.report-history');
    Route::get('/staff/submit-report', StaffSubmitReport::class)->name('staff.submit-report');

    // Report store and view
    Route::post('/report', [ReportController::class, 'store'])->name('report.store');
    Route::get('/staff/reports', [ReportController::class, 'index'])->name('staff.reports');
});

// Settings (all roles)
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('faq', 'faq/appearancefaq');
    Route::get('faq/appearancefaq', Appearancefaq::class)->name('faq.appearancefaq');
});

// Auth scaffolding
require __DIR__ . '/auth.php';
