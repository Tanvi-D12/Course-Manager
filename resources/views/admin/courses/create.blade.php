@extends('layouts.app')

@section('title', 'Create Course')

@section('content')
<div class="section" style="max-width: 500px; margin: 0 auto;">
    <h2>Create New Course</h2>

    <form action="{{ route('admin.courses.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Course Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name') <span style="color: red; font-size: 0.9rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="instructor_id">Assign Instructor</label>
            <select id="instructor_id" name="instructor_id" required>
                <option value="">-- Select an Instructor --</option>
                @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                @endforeach
            </select>
            @error('instructor_id') <span style="color: red; font-size: 0.9rem;">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn">Create Course</button>
        <a href="{{ route('admin.courses.index') }}" class="btn" style="background: #666;">Cancel</a>
    </form>
</div>
@endsection
