<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display lessons for a course
     */
    public function index(Course $course)
    {
        $lessons = $course->lessons()->get();
        $courses = Course::all();
        
        return view('admin.lessons.index', compact('course', 'lessons', 'courses'));
    }

    /**
     * Show form for creating lesson
     */
    public function create(Course $course)
    {
        $courses = Course::all();
        return view('admin.lessons.create', compact('course', 'courses'));
    }

    /**
     * Store a new lesson
     */
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $course->lessons()->create($validated);

        return redirect()->route('admin.dashboard')
                       ->with('success', 'Lesson created successfully');
    }

    /**
     * Update lesson
     */
    public function update(Request $request, Course $course, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $lesson->update($validated);

        return redirect()->route('admin.dashboard')
                       ->with('success', 'Lesson updated successfully');
    }

    /**
     * Delete lesson
     */
    public function destroy(Course $course, Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('admin.dashboard')
                       ->with('success', 'Lesson deleted');
    }
}
