# HungryBird - Course Management System

A comprehensive Course Management System built with **Laravel 11**, **PHP**, **MySQL**, and **Blade Templating**. Supports three user roles: Admin, Instructor, and Student with role-based access control and professional UI/UX design.

## Quick Start

### Prerequisites
- PHP 8.2+
- MySQL 5.7+
- Composer


### Installation Steps

1. **Navigate to Laravel folder**
```powershell
cd c:\Users\tanvi\Desktop\HungryBird\laravel
```

2. **Install dependencies** (if not already installed)
```powershell
composer install
```

3. **Setup environment**
- Database is already configured with credentials:
  - **Host:** localhost
  - **Database:** hungrybind_laravel
  - **User:** root
  - **Password:** root

4. **Reset database** (first time only)
```powershell
php artisan migrate:fresh
```

5. **Start the server**
```powershell
php artisan serve --host=localhost --port=8000
```

The server will run on `http://localhost:8000`

## Access Points

| Feature | URL | Credentials |
|---------|-----|-------------|
| **Home Page** | http://localhost:8000/ | - |
| **View Courses** | http://localhost:8000/courses | - |
| **Register as Instructor** | http://localhost:8000/instructor-register | - |
| **Admin Login** | http://localhost:8000/admin/login | admin@123 / admin@123 |
| **Admin Dashboard** | http://localhost:8000/admin | (After login) |

## User Roles

### Admin
- **Login Credentials:** 
  - Username: `admin@123`
  - Password: `admin@123`
- **Capabilities:**
  - View all pending and approved instructors
  - Approve/reject instructor registrations
  - Create and manage courses
  - Create and manage lessons for courses
  - Delete instructors, courses, and lessons
  - Secure session-based authentication

### Instructor
- **Registration:** Public registration form available
- **Process:**
  - Register via `/instructor-register`
  - Status becomes "pending"
  - Wait for admin approval
  - After approval, can have courses assigned
- **Capabilities (After Approval):**
  - View approval status
  - Have courses managed by admin

### Student/User
- **Access:** Public access to all features
- **Capabilities:**
  - Browse all available courses
  - View course details and lessons
  - Search courses by title and instructor
  - View lesson content

## Project Structure

```
HungryBird/
├── laravel/                          # Main Laravel application
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   │   ├── Admin/
│   │   │   │   │   ├── AuthController.php      # Admin login/logout
│   │   │   │   │   ├── DashboardController.php # Dashboard logic
│   │   │   │   │   ├── InstructorController.php
│   │   │   │   │   ├── CourseController.php
│   │   │   │   │   └── LessonController.php
│   │   │   │   └── User/
│   │   │   │       └── CourseController.php    # Public course viewing
│   │   │   └── Middleware/
│   │   │       └── AdminAuthenticate.php       # Session-based auth
│   │   └── Models/
│   │       ├── Instructor.php
│   │       ├── Course.php
│   │       └── Lesson.php
│   ├── database/
│   │   └── migrations/                # Database schema
│   ├── resources/
│   │   └── views/
│   │       ├── welcome.blade.php      # Homepage
│   │       ├── admin/
│   │       │   ├── login.blade.php
│   │       │   └── dashboard.blade.php
│   │       └── user/
│   │           ├── instructor-register.blade.php
│   │           └── courses/
│   │               ├── index.blade.php
│   │               └── show.blade.php
│   ├── routes/
│   │   └── web.php                    # All routes
│   └── artisan                        # Laravel CLI
├── backend/                           # Original Node.js backend (reference)
└── frontend/                          # Original frontend files (reference)
```

## Database Schema

### Instructors Table
```
- id (Primary Key)
- name (string)
- email (string, unique)
- status (enum: 'pending', 'approved')
- created_at, updated_at
```

### Courses Table
```
- id (Primary Key)
- title (string)
- description (text)
- instructor_id (Foreign Key)
- created_at, updated_at
```

### Lessons Table
```
- id (Primary Key)
- title (string)
- content (text)
- course_id (Foreign Key)
- created_at, updated_at
```

## Features

✅ **Admin Authentication**
- Secure session-based login system
- Hardcoded credentials for MVP (admin@123 / admin@123)
- Logout functionality with session clearing
- Protected routes with middleware

✅ **Instructor Management**
- Public registration form
- Pending status workflow
- Admin approval/rejection system
- Delete instructor with cascade deletion

✅ **Course Management**
- Create courses (admin only)
- Assign courses to approved instructors
- View all courses (public)
- Delete courses with cascade

✅ **Lesson Management**
- Add lessons to courses
- View lesson content
- Delete lessons with cascade
- Nested lesson organization

✅ **Professional UI/UX**
- Modern gradient color scheme (#4A70A9, #73AF6F)
- Responsive design
- Clean navigation
- Professional typography
- Smooth transitions and hover effects

## Technology Stack

| Layer | Technology |
|-------|-----------|
| **Framework** | Laravel 11 |
| **Language** | PHP 8.2+ |
| **Database** | MySQL 5.7+ |
| **ORM** | Eloquent (Laravel) |
| **Frontend** | Blade Templating |
| **Styling** | CSS3 (Inline) |
| **Authentication** | Session-based |

## API Routes

### Public Routes
```
GET  /                           # Homepage
GET  /courses                    # List all courses
GET  /courses/{id}              # View course details
GET  /instructor-register       # Registration form
POST /instructor-register       # Submit registration
```

### Admin Routes (Protected)
```
GET  /admin/login               # Login form
POST /admin/login               # Submit login
GET  /admin                     # Admin dashboard
POST /admin/logout              # Logout

# Instructors
GET    /admin/instructors               # List all instructors
POST   /admin/instructors/{id}/approve  # Approve instructor
DELETE /admin/instructors/{id}          # Delete instructor

# Courses
POST   /admin/courses           # Create course
PUT    /admin/courses/{id}      # Update course
DELETE /admin/courses/{id}      # Delete course

# Lessons
POST   /admin/courses/{id}/lessons           # Create lesson
PUT    /admin/courses/{id}/lessons/{lid}     # Update lesson
DELETE /admin/courses/{id}/lessons/{lid}     # Delete lesson
```

## Running the Project

### Start Development Server
```powershell
cd c:\Users\tanvi\Desktop\HungryBird\laravel
php artisan serve --host=localhost --port=8000
```

### Stop Server
```
Press Ctrl+C in the terminal
```

### Fresh Database Setup
```powershell
php artisan migrate:fresh
```

### Clear Caches
```powershell
php artisan cache:clear
php artisan route:clear
php artisan config:clear
```

## Important Notes

- **Admin credentials** are hardcoded for MVP phase
- **CSRF protection** is enabled on all forms
- **Session-based authentication** used (no JWT tokens)
- **Cascade delete** enabled for data integrity
- **Responsive design** works on desktop and tablet
- **Color scheme** uses blue-green gradient throughout

## Future Enhancements

- [ ] JWT-based authentication
- [ ] Email notifications
- [ ] Course ratings and reviews
- [ ] Student enrollment system
- [ ] Progress tracking
- [ ] Certificate generation
- [ ] Payment integration
- [ ] File upload for course materials

## Support

For issues or questions, please contact the development team.

## License

This project is proprietary and confidential.

---

**Version:** 1.0.0  
**Last Updated:** November 22, 2025  
**Built with:** Laravel 11, PHP 8.2, MySQL 5.7

  - Create, edit, delete courses
  - Manage lessons under courses
  - Assign instructors to courses

### 👨‍🏫 Instructor
- **Register** with name and email
- **Track approval status** using registration ID
- Can only view courses once approved by admin

### 👨‍🎓 Student/User
- View all published courses
- Browse course details
- View lessons under each course
- Read-only access (no editing)

## 🏗️ Project Structure

```
backend/
  ├── models/
  │   ├── db.js              # Sequelize database config
  │   ├── instructor.js      # Instructor model
  │   ├── course.js          # Course model
  │   ├── lesson.js          # Lesson model
  │   └── index.js           # Model relationships
  ├── routes/
  │   ├── adminRoutes.js     # Admin endpoints (/admin/*)
  │   ├── instructorRoutes.js# Instructor endpoints (/instructor/*)
  │   └── userRoutes.js      # User endpoints (/courses/*)
  └── server.js              # Express app entry point

frontend/
  ├── index.html             # Public courses listing
  ├── course-details.html    # Single course & lessons
  ├── instructor-register.html# Instructor registration
  ├── admin.html             # Admin dashboard
  ├── css/
  │   └── styles.css         # Global stylesheet
  └── js/
      └── api.js             # Fetch API helper functions

.github/
  └── copilot-instructions.md # AI agent guidelines
```

## 📡 API Endpoints

### Admin Routes (`/admin/*)`)
```
GET    /admin/instructors              # List approved instructors
GET    /admin/instructors/pending      # List pending instructors
PUT    /admin/instructors/:id/approve  # Approve instructor

POST   /admin/courses                  # Create course
GET    /admin/courses                  # List all courses
PUT    /admin/courses/:id              # Edit course
DELETE /admin/courses/:id              # Delete course

POST   /admin/courses/:courseId/lessons              # Create lesson
GET    /admin/courses/:courseId/lessons              # List lessons
PUT    /admin/courses/:courseId/lessons/:lessonId   # Edit lesson
DELETE /admin/courses/:courseId/lessons/:lessonId   # Delete lesson
```

### Instructor Routes (`/instructor/*)`)
```
POST   /instructor/register            # Register as instructor
GET    /instructor/:id/status          # Check approval status
```

### User Routes (`/courses/*)`)
```
GET    /courses                        # List all courses
GET    /courses/:id                    # Get course details
GET    /courses/:courseId/lessons      # List lessons in course
```

## 📊 Database Schema

### Instructor
- `id` (INT, PK, AI)
- `name` (VARCHAR)
- `email` (VARCHAR, UNIQUE)
- `status` (ENUM: 'pending', 'approved')
- `createdAt`, `updatedAt` (TIMESTAMPS)

### Course
- `id` (INT, PK, AI)
- `name` (VARCHAR)
- `instructorId` (INT, FK)
- `createdAt`, `updatedAt` (TIMESTAMPS)

### Lesson
- `id` (INT, PK, AI)
- `name` (VARCHAR)
- `courseId` (INT, FK)
- `createdAt`, `updatedAt` (TIMESTAMPS)

### Relationships
- Instructor (1) ← → (Many) Course
- Course (1) ← → (Many) Lesson
- ON DELETE CASCADE enabled

## 🔑 Key Features

✅ **Role-Based Access Control** - Three distinct user roles with specific capabilities
✅ **Instructor Approval Workflow** - Admins review and approve instructors before they can teach
✅ **Nested Resource Management** - Lessons organized under courses with proper hierarchy
✅ **User-Friendly Frontend** - Vanilla HTML/CSS with responsive design
✅ **RESTful API** - Consistent JSON responses and proper HTTP status codes
✅ **Data Relationships** - Proper foreign keys and cascade delete handling

## 🛠️ Development Tips

### Enable Database Query Logging
Edit `backend/models/db.js`:
```javascript
logging: console.log  // Instead of: false
```

### Common Issues & Solutions

**Database Connection Error**
- Ensure MySQL is running: `mysql -u root -p -e "SELECT 1"`
- Verify credentials in `backend/models/db.js`

**Port 5000 Already in Use**
- Change PORT in `backend/server.js` or kill process on port 5000

**CORS Errors**
- Ensure frontend and backend are running on same host or enable CORS headers

**Instructor Cannot Create Courses**
- Verify instructor status is "approved" in database
- Check admin has approved the instructor registration

## 📝 Common Workflows

### Adding a New Course
1. Admin logs in at `/admin.html`
2. Go to "Courses" tab
3. Select approved instructor
4. Click "Create Course"
5. Course appears in public view

### Approving an Instructor
1. Instructor registers at `/instructor-register.html`
2. Admin goes to "Instructors" tab
3. Clicks "Approve" on pending instructor
4. Instructor can now have courses assigned

### Creating Lessons
1. Admin logs in and goes to "Lessons" tab
2. Select course from dropdown
3. Enter lesson name and click "Create Lesson"
4. Lessons appear in course details page

## 🔒 Security Notes

⚠️ **Current State (MVP)**
- Admin credentials hardcoded in frontend (not production-safe)
- No input validation on backend (add soon!)
- No rate limiting
- No authentication middleware

✅ **Recommendations for Production**
- Implement JWT-based authentication
- Add role-based middleware
- Add input validation & sanitization
- Implement rate limiting
- Use environment variables for credentials
- Add API request logging
- Implement database migrations

## 📚 Testing the System

### Manual Testing Workflow
1. **Register as Instructor**
   - Go to `/instructor-register.html`
   - Enter name and email
   - Save the registration ID shown
   - Check status later using the same ID

2. **Approve as Admin**
   - Login at `/admin.html` (admin@123 / admin@123)
   - Go to "Instructors" tab
   - Click "Approve" on the pending instructor

3. **Create a Course**
   - In Admin dashboard, go to "Courses" tab
   - Select the approved instructor
   - Enter course name and create

4. **Add Lessons**
   - Go to "Lessons" tab
   - Select the course you just created
   - Add lesson names

5. **View as Student**
   - Go to `/index.html`
   - Click on a course to see details and lessons

## 📞 Support

For issues or questions:
- Check `.github/copilot-instructions.md` for architecture details
- Review error logs in terminal where server is running
- Check browser console (F12) for frontend errors
- Verify MySQL is running and database exists

---

**Happy Learning with HungryBird! 🐦**
