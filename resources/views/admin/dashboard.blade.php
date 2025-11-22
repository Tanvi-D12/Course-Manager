<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - HungryBird</title>
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
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
        }

        header a {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            transition: background 0.3s;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        header a:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        header form {
            margin: 0;
        }

        header button {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            transition: background 0.3s;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
        }

        header button:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            border-bottom: 2px solid #ddd;
        }

        .tab-button {
            padding: 12px 24px;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            color: #666;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }

        .tab-button.active {
            color: #4A70A9;
            border-bottom-color: #4A70A9;
        }

        .tab-button:hover {
            color: #4A70A9;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .section-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #4A70A9;
            color: white;
        }

        .btn-primary:hover {
            background-color: #3A5A99;
        }

        .btn-danger {
            background-color: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-success {
            background-color: #10b981;
            color: white;
        }

        .btn-success:hover {
            background-color: #059669;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #ddd;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-approved {
            background-color: #d1fae5;
            color: #065f46;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 8px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #666;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 8px;
            color: #999;
        }

        .success-message {
            background-color: #d1fae5;
            color: #065f46;
            padding: 12px 16px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #10b981;
        }

        .error-message {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #ef4444;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
    <header>
        <h1>HungryBird Admin Dashboard</h1>
        <div style="display: flex; gap: 15px;">
            <a href="/">← Back to Home</a>
            <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </header>

    <div class="container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="error-message">{{ $error }}</div>
            @endforeach
        @endif

        @if (session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <div class="tabs">
            <button class="tab-button active" data-tab="instructors">Instructors</button>
            <button class="tab-button" data-tab="courses">Courses</button>
            <button class="tab-button" data-tab="lessons">Lessons</button>
        </div>

        <!-- Instructors Tab -->
        <div id="instructors" class="tab-content active">
            <div class="section-title">
                <span>Instructor Management</span>
                <button class="btn btn-primary" onclick="openAddInstructorModal()">+ Add Instructor</button>
            </div>

            <h3 style="margin-top: 30px; margin-bottom: 15px;">Pending Approvals</h3>
            @if ($pending->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pending as $instructor)
                            <tr>
                                <td>{{ $instructor->name }}</td>
                                <td>{{ $instructor->email }}</td>
                                <td><span class="badge badge-pending">{{ ucfirst($instructor->status) }}</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <form action="{{ route('instructors.approve', $instructor->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                        <form action="{{ route('instructors.destroy', $instructor->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">No pending instructor approvals</div>
            @endif

            <h3 style="margin-top: 30px; margin-bottom: 15px;">Approved Instructors</h3>
            @if ($approved->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($approved as $instructor)
                            <tr>
                                <td>{{ $instructor->name }}</td>
                                <td>{{ $instructor->email }}</td>
                                <td><span class="badge badge-approved">{{ ucfirst($instructor->status) }}</span></td>
                                <td>
                                    <form action="{{ route('instructors.destroy', $instructor->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">No approved instructors</div>
            @endif
        </div>

        <!-- Courses Tab -->
        <div id="courses" class="tab-content">
            <div class="section-title">
                <span>Course Management</span>
                <button class="btn btn-primary" onclick="openAddCourseModal()">+ Add Course</button>
            </div>

            @if ($courses->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Instructor</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <td><strong>{{ $course->title }}</strong></td>
                                <td>{{ $course->instructor->name ?? 'N/A' }}</td>
                                <td>{{ Str::limit($course->description, 50) }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary btn-sm" onclick="openEditCourseModal({{ $course->id }})">Edit</button>
                                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">No courses yet. Click "Add Course" to create one.</div>
            @endif
        </div>

        <!-- Lessons Tab -->
        <div id="lessons" class="tab-content">
            <div class="section-title">
                <span>Lesson Management</span>
            </div>

            @if ($courses->count() > 0)
                @foreach ($courses as $course)
                    <h3 style="margin-top: 25px; margin-bottom: 15px;">{{ $course->title }}</h3>
                    @if ($course->lessons->count() > 0)
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course->lessons as $lesson)
                                    <tr>
                                        <td><strong>{{ $lesson->title }}</strong></td>
                                        <td>{{ Str::limit($lesson->content, 50) }}</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-primary btn-sm" onclick="openEditLessonModal({{ $lesson->id }})">Edit</button>
                                                <form action="{{ route('courses.lessons.destroy', [$course->id, $lesson->id]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state">No lessons for this course</div>
                    @endif
                    <button class="btn btn-primary" onclick="openAddLessonModal({{ $course->id }})" style="margin-top: 10px;">+ Add Lesson</button>
                @endforeach
            @else
                <div class="empty-state">No courses available. Create a course first.</div>
            @endif
        </div>
    </div>

    <!-- Add Instructor Modal -->
    <div id="addInstructorModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span>Add New Instructor</span>
                <button class="close-btn" onclick="closeModal('addInstructorModal')">&times;</button>
            </div>
            <form action="{{ route('instructors.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="instructor_name">Name</label>
                    <input type="text" id="instructor_name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="instructor_email">Email</label>
                    <input type="email" id="instructor_email" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Add Instructor</button>
            </form>
        </div>
    </div>

    <!-- Add Course Modal -->
    <div id="addCourseModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span>Add New Course</span>
                <button class="close-btn" onclick="closeModal('addCourseModal')">&times;</button>
            </div>
            <form action="{{ route('courses.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="course_title">Title</label>
                    <input type="text" id="course_title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="course_description">Description</label>
                    <textarea id="course_description" name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="course_instructor">Instructor</label>
                    <select id="course_instructor" name="instructor_id" required>
                        <option value="">Select an instructor</option>
                        @foreach ($approved as $instructor)
                            <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Add Course</button>
            </form>
        </div>
    </div>

    <!-- Add Lesson Modal -->
    <div id="addLessonModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span>Add New Lesson</span>
                <button class="close-btn" onclick="closeModal('addLessonModal')">&times;</button>
            </div>
            <form id="lessonForm" method="POST">
                @csrf
                <div class="form-group">
                    <label for="lesson_title">Title</label>
                    <input type="text" id="lesson_title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="lesson_content">Content</label>
                    <textarea id="lesson_content" name="content" rows="6" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Add Lesson</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        function openAddInstructorModal() {
            openModal('addInstructorModal');
        }

        function openAddCourseModal() {
            openModal('addCourseModal');
        }

        function openAddLessonModal(courseId) {
            const form = document.getElementById('lessonForm');
            form.action = `/admin/courses/${courseId}/lessons`;
            openModal('addLessonModal');
        }

        function openEditCourseModal(courseId) {
            // Placeholder for edit functionality
            alert('Edit course functionality - to be implemented');
        }

        function openEditLessonModal(lessonId) {
            // Placeholder for edit functionality
            alert('Edit lesson functionality - to be implemented');
        }

        // Tab switching
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                const tabName = this.dataset.tab;
                
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('active');
                });
                
                document.getElementById(tabName).classList.add('active');
                this.classList.add('active');
            });
        });

        // Close modal when clicking outside
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
