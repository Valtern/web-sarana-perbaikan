<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use Illuminate\Support\Str;

class ReportController extends Controller
{
public function store(Request $request)
{
    $request->validate([
        'facility_name' => 'required|string|max:50',
        'location' => 'nullable|string|max:200',
        'description' => 'nullable|string|max:200',
        'category' => 'required|in:Electronic,Table,Chair,Desk,Computer,Miscellaneous',
        'picture_proof' => 'nullable|image|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('picture_proof')) {
    $file = $request->file('picture_proof');
    $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
    $file->move(public_path('proof'), $filename);
    $imagePath = 'proof/' . $filename;
}


    Report::create([
        'user_ID' => Auth::id(),
        'facility_name' => $request->facility_name,
        'location' => $request->location,
        'description' => $request->description,
        'category' => $request->category,
        'picture_proof' => $imagePath,
    ]);

    return redirect()->back()->with('success', 'Report submitted successfully.');
}


public function index()
{
    $reports = Report::with('user')
        ->where('user_ID', auth()->id())
        ->latest()
        ->get();

    $role = Auth::user()->role; // assuming 'role' is a field in the users table

    if ($role === 'staff') {
        return view('livewire.staff.staff-report', compact('reports'));
    } elseif ($role === 'lecturer') {
        return view('livewire.lecturer.lecturer-report', compact('reports'));
    } else {
        return view('livewire.student.student-report', compact('reports'));
    }
}


}
