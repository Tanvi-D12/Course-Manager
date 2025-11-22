@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')
<div class="section" style="max-width: 500px; margin: 0 auto;">
    <h2>Edit Course</h2>

    <form action="{{ route('admin.courses.update', $course) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Course Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $course->name) }}" required>
            @error('name') <span style="color: red; font-size: 0.9rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="instructor_id">Assign Instructor</label>
            <select id="instructor_id" name="instructor_id" required>
                @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}" {{ $course->instructor_id === $instructor->id ? 'selected' : '' }}>
                        {{ $instructor->name }}
                    </option>
                @endforeach
            </select>
            @error('instructor_id') <span style="color: red; font-size: 0.9rem;">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn">Update Course</button>
        <a href="{{ route('admin.courses.index') }}" class="btn" style="background: #666;">Cancel</a>
    </form>
</div>
@endsection
