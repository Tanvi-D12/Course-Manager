<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HungryBird') - Course Management</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f6f4ee;
            color: #4a4a4a;
            line-height: 1.6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background: #A5B68D;
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.12);
            margin-bottom: 30px;
        }
        header h1 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 12px;
        }
        nav {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        nav a, nav button {
            background: rgba(237, 232, 220, 0.4);
            backdrop-filter: blur(4px);
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.25s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        nav a:hover, nav button:hover {
            background: rgba(237, 232, 220, 0.6);
        }
        .section {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(6px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.12);
        }
        .section h2 {
            color: #A5B68D;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }
        .btn {
            background: #A5B68D;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.25s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            background: #92a075;
        }
        .btn-danger {
            background: #d9534f;
        }
        .btn-danger:hover {
            background: #c9302c;
        }
        .btn-success {
            background: #5cb85c;
        }
        .btn-success:hover {
            background: #47a447;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #4a4a4a;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid rgba(165, 182, 141, 0.3);
            border-radius: 6px;
            font-family: inherit;
            font-size: 1rem;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #A5B68D;
            box-shadow: 0 0 0 2px rgba(165, 182, 141, 0.1);
        }
        .card {
            background: rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(4px);
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        .card h3 {
            color: #A5B68D;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table thead {
            background: rgba(165, 182, 141, 0.2);
        }
        table th {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid rgba(165, 182, 141, 0.3);
            color: #A5B68D;
            font-weight: 600;
        }
        table td {
            padding: 12px;
            border-bottom: 1px solid rgba(165, 182, 141, 0.15);
        }
        table tbody tr:hover {
            background: rgba(165, 182, 141, 0.08);
        }
        .alert {
            padding: 14px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #A5B68D;
            background: rgba(165, 182, 141, 0.15);
            color: #4a4a4a;
        }
        .alert.alert-success {
            border-left-color: #5cb85c;
            background: rgba(92, 184, 92, 0.15);
        }
        .alert.alert-danger {
            border-left-color: #d9534f;
            background: rgba(217, 83, 79, 0.15);
        }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .badge.pending {
            background: rgba(255, 193, 7, 0.3);
            color: #ff9800;
        }
        .badge.approved {
            background: rgba(76, 175, 80, 0.3);
            color: #4caf50;
        }
        footer {
            text-align: center;
            padding: 20px;
            color: #666;
            margin-top: 50px;
            border-top: 1px solid rgba(165, 182, 141, 0.2);
        }
        .btn-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>HungryBird</h1>
            <nav>
                <a href="{{ route('courses.index') }}">Courses</a>
                @if(request()->is('admin/*'))
                    <a href="{{ route('admin.instructors.index') }}">Instructors</a>
                    <a href="{{ route('admin.courses.index') }}">Manage Courses</a>
                @endif
            </nav>
        </div>
    </header>

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <footer>
        <p>&copy; 2025 HungryBird Course Management. Made with care.</p>
    </footer>
</body>
</html>
