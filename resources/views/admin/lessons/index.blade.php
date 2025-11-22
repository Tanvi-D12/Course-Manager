@extends('layouts.app')

@section('title', 'Manage Lessons')

@section('content')
<div class="section">
    <h2>Lesson Management - {{ $course->name }}</h2>

    <div style="margin-bottom: 20px; background: rgba(165, 182, 141, 0.08); padding: 15px; border-radius: 8px;">
        <a href="{{ route('admin.lessons.create', $course) }}" class="btn">Add New Lesson</a>
        <a href="{{ route('admin.courses.index') }}" class="btn" style="background: #666; margin-left: 10px;">Back to Courses</a>
    </div>

    @if($lessons->isEmpty())
        <p style="color: #999;">No lessons in this course yet.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Lesson Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->name }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.lessons.edit', [$course, $lesson]) }}" class="btn">Edit</a>
                                <form action="{{ route('admin.lessons.destroy', [$course, $lesson]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this lesson?')">Delete</button>
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
