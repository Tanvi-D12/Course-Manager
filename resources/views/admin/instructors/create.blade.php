@extends('layouts.app')

@section('title', 'Register Instructor')

@section('content')
<div class="section" style="max-width: 500px; margin: 0 auto;">
    <h2>Register New Instructor</h2>

    <form action="{{ route('admin.instructors.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Instructor Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name') <span style="color: red; font-size: 0.9rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email') <span style="color: red; font-size: 0.9rem;">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn">Register Instructor</button>
        <a href="{{ route('admin.instructors.index') }}" class="btn" style="background: #666;">Cancel</a>
    </form>
</div>
@endsection
