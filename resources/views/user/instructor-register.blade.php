<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as Instructor - HungryBird</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #4A70A9 0%, #73AF6F 50%, #5A9454 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 8px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #eee;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
            font-family: inherit;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4A70A9;
            box-shadow: 0 0 0 3px rgba(74, 112, 169, 0.1);
        }

        .form-group input::placeholder {
            color: #999;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4A70A9 0%, #73AF6F 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(74, 112, 169, 0.3);
        }

        .btn-secondary {
            background: #f5f5f5;
            color: #333;
        }

        .btn-secondary:hover {
            background: #eeeeee;
        }

        .success-message {
            background-color: #d1fae5;
            color: #065f46;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #10b981;
        }

        .error-message {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #ef4444;
        }

        .error-list {
            list-style: none;
        }

        .error-list li {
            margin: 5px 0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .footer a {
            color: #4A70A9;
            text-decoration: none;
            font-weight: 600;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .info-box {
            background: #f0f9ff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #555;
            border-left: 4px solid #4A70A9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>Register as Instructor</h1>
                <p>Join HungryBird and start teaching</p>
            </div>

            @if (session('success'))
                <div class="success-message">
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error-message">
                    <strong>Please fix the following errors:</strong>
                    <ul class="error-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="info-box">
                <strong>Registration Process:</strong><br>
                Fill out the form below and submit. An admin will review your application and approve/reject it.
            </div>

            <form action="{{ route('instructors.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Full Name <span style="color: #ef4444;">*</span></label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        placeholder="John Doe"
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                        <small style="color: #ef4444;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Address <span style="color: #ef4444;">*</span></label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="john@example.com"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <small style="color: #ef4444;">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
                <a href="/" style="text-decoration: none;">
                    <button type="button" class="btn btn-secondary">← Back to Home</button>
                </a>
            </form>

            <div class="footer">
                <p>Already have courses? <a href="/courses">Browse all courses</a></p>
            </div>
        </div>
    </div>
</body>
</html>
