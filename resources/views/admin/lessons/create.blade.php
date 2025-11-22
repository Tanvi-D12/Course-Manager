@extends('layouts.app')

@section('title', 'Create Lesson')

@section('content')
<div class="section" style="max-width: 500px; margin: 0 auto;">
    <h2>Add New Lesson</h2>
    <p style="color: #999; margin-bottom: 20px;">Course: <strong>{{ $course->name }}</strong></p>

    <form action="{{ route('admin.lessons.store', $course) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Lesson Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name') <span style="color: red; font-size: 0.9rem;">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn">Create Lesson</button>
        <a href="{{ route('admin.lessons.index', $course) }}" class="btn" style="background: #666;">Cancel</a>
    </form>
</div>
@endsection
