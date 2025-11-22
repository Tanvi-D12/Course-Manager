<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display list of pending and approved instructors
     */
    public function index()
    {
        $pending = Instructor::where('status', 'pending')->get();
        $approved = Instructor::where('status', 'approved')->get();

        return view('admin.instructors.index', compact('pending', 'approved'));
    }

    /**
     * Show form for registering new instructor
     */
    public function create()
    {
        return view('admin.instructors.create');
    }

    /**
     * Store a new instructor (registration)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors',
        ]);

        Instructor::create($validated);

        return redirect('/instructor-register')
                       ->with('success', 'Registration successful! An admin will review your application shortly.');
    }

    /**
     * Approve an instructor
     */
    public function approve(Instructor $instructor)
    {
        $instructor->update(['status' => 'approved']);

        return redirect('/admin')
                       ->with('success', 'Instructor approved successfully');
    }

    /**
     * Delete an instructor
     */
    public function destroy(Instructor $instructor)
    {
        $instructor->delete();

        return redirect('/admin')
                       ->with('success', 'Instructor deleted successfully');
    }
}
