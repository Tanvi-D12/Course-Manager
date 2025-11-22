@extends('layouts.app')

@section('title', 'Instructors')

@section('content')
<div class="section">
    <h2>Instructor Management</h2>
    
    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.instructors.create') }}" class="btn">Register New Instructor</a>
    </div>

    <div style="margin-bottom: 30px;">
        <h3 style="color: #A5B68D; margin-bottom: 15px;">Pending Instructors</h3>
        @if($pending->isEmpty())
            <p style="color: #999;">No pending instructors.</p>
        @else
            @foreach($pending as $instructor)
                <div class="card">
                    <h3>{{ $instructor->name }}</h3>
                    <p><strong>Email:</strong> {{ $instructor->email }}</p>
                    <p><strong>Status:</strong> <span class="badge pending">Pending</span></p>
                    <div class="btn-group">
                        <form action="{{ route('instructors.approve', $instructor) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <form action="{{ route('admin.instructors.destroy', $instructor) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this instructor?')">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div>
        <h3 style="color: #A5B68D; margin-bottom: 15px;">Approved Instructors</h3>
        @if($approved->isEmpty())
            <p style="color: #999;">No approved instructors.</p>
        @else
            @foreach($approved as $instructor)
                <div class="card">
                    <h3>{{ $instructor->name }}</h3>
                    <p><strong>Email:</strong> {{ $instructor->email }}</p>
                    <p><strong>Status:</strong> <span class="badge approved">Approved</span></p>
                    <div class="btn-group">
                        <form action="{{ route('admin.instructors.destroy', $instructor) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this instructor?')">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
