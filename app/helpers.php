<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('dashboard_route_for')) {
    function dashboard_route_for($role)
    {
        return match ($role) {
            'admin' => route('admin.dashboard'),
            'lecturer' => route('lecturer.dashboard'),
            'student' => route('student.dashboard'),
            'staff' => route('staff.dashboard'),
            'technician' => route('technician.dashboard'),
            default => route('home'),
        };
    }
}
