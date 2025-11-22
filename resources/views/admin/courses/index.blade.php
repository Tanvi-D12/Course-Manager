@extends('layouts.app')

@section('title', 'Manage Courses')

@section('content')
<div class="section">
    <h2>Course Management</h2>

    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.courses.create') }}" class="btn">Create New Course</a>
    </div>

    @if($courses->isEmpty())
        <p style="color: #999;">No courses available yet.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Instructor</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->instructor->name ?? 'N/A' }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.courses.edit', $course) }}" class="btn">Edit</a>
                                <a href="{{ route('admin.lessons.index', $course) }}" class="btn">Lessons</a>
                                <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this course?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
