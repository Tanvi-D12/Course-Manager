<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display all courses to users (public)
     */
    public function index()
    {
        $courses = Course::with('instructor')->get();
        return view('user.courses.index', compact('courses'));
    }

    /**
     * Show course details with lessons
     */
    public function show(Course $course)
    {
        $course->load('instructor', 'lessons');
        return view('user.courses.show', compact('course'));
    }
}
