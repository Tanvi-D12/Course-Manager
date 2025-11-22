<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Courses - HungryBird</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        header {
            background: linear-gradient(135deg, #4A70A9 0%, #73AF6F 50%, #5A9454 100%);
            color: white;
            padding: 30px 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 28px;
            margin-bottom: 10px;
        }

        header p {
            opacity: 0.9;
            font-size: 16px;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-primary {
            background-color: #4A70A9;
            color: white;
        }

        .btn-primary:hover {
            background-color: #3A5A99;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: #f5f5f5;
            color: #333;
            border: 2px solid #ddd;
        }

        .btn-secondary:hover {
            background-color: #eeeeee;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .course-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .course-header {
            background: linear-gradient(135deg, #4A70A9 0%, #73AF6F 100%);
            padding: 20px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .course-title {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
        }

        .course-content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .course-instructor {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .course-instructor::before {
            content: "";
            font-size: 18px;
        }

        .course-description {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
            flex: 1;
        }

        .lesson-count {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #999;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .lesson-count::before {
            content: "";
        }

        .course-actions {
            display: flex;
            gap: 10px;
        }

        .course-btn {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s;
            font-size: 13px;
        }

        .btn-view {
            background-color: #4A70A9;
            color: white;
        }

        .btn-view:hover {
            background-color: #3A5A99;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state h2 {
            color: #666;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .empty-state p {
            color: #999;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .filter-chip {
            padding: 8px 16px;
            border: 2px solid #ddd;
            border-radius: 20px;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
            color: #666;
        }

        .filter-chip:hover,
        .filter-chip.active {
            border-color: #667eea;
            background: #667eea;
            color: white;
        }

        .search-box {
            margin-bottom: 25px;
            display: flex;
            gap: 10px;
        }

        .search-box input {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .search-box input:focus {
            outline: none;
            border-color: #667eea;
        }
    </style>
</head>
<body>
    <header>
        <h1>HungryBird Courses</h1>
        <p>Explore our range of professional courses</p>
    </header>

    <div class="container">
        <div class="button-group">
            <a href="/" class="btn btn-secondary">← Back to Home</a>
            <a href="/instructor-register" class="btn btn-primary">Register as Instructor</a>
        </div>

        @if ($courses->count() > 0)
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search courses..." onkeyup="filterCourses()">
            </div>

            <div class="courses-grid" id="coursesGrid">
                @foreach ($courses as $course)
                    <div class="course-card" data-course="{{ strtolower($course->title) }} {{ strtolower($course->instructor->name ?? '') }}">
                        <div class="course-header">
                            <h3 class="course-title">{{ $course->title }}</h3>
                        </div>
                        <div class="course-content">
                            <div class="course-instructor">
                                {{ $course->instructor->name ?? 'Unknown Instructor' }}
                            </div>
                            <p class="course-description">{{ Str::limit($course->description, 120) }}</p>
                            <div class="lesson-count">
                                {{ $course->lessons->count() }} {{ Str::plural('lesson', $course->lessons->count()) }}
                            </div>
                            <div class="course-actions">
                                <a href="/courses/{{ $course->id }}" class="course-btn btn-view">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <h2>No Courses Available</h2>
                <p>Check back soon for exciting new courses!</p>
            </div>
        @endif
    </div>

    <script>
        function filterCourses() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const courseCards = document.querySelectorAll('.course-card');

            courseCards.forEach(card => {
                const courseData = card.getAttribute('data-course');
                if (courseData.includes(searchInput)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
