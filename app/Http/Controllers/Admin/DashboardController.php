<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Lesson;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard with all data
     */
    public function index()
    {
        $pending = Instructor::where('status', 'pending')->get();
        $approved = Instructor::where('status', 'approved')->get();
        $courses = Course::with(['instructor', 'lessons'])->get();

        return view('admin.dashboard', compact('pending', 'approved', 'courses'));
    }
}
