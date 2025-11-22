<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Store a new course
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructor_id' => 'required|exists:instructors,id',
        ]);

        Course::create($validated);

        return redirect()->route('admin.dashboard')
                       ->with('success', 'Course created successfully');
    }

    /**
     * Update course
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructor_id' => 'required|exists:instructors,id',
        ]);

        $course->update($validated);

        return redirect()->route('admin.dashboard')
                       ->with('success', 'Course updated successfully');
    }

    /**
     * Delete course (cascades to lessons)
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.dashboard')
                       ->with('success', 'Course deleted');
    }
}
