# HungryBird - Course Management System

A comprehensive Course Management System built with **Laravel 11**, **PHP**, **MySQL**, and **Blade Templating**. Supports three user roles: Admin, Instructor, and Student with role-based access control and professional UI/UX design.

## Quick Start

### Prerequisites
- PHP 8.2+
- MySQL 5.7+
- Composer
)

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
- Credentials: admin@123 / admin@123
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
- Modern gradient color scheme (#4A70A9, #73AF6F, #5A9454)
- Responsive design across all pages
- Clean navigation with professional typography
- Smooth transitions and hover effects
- Consistent branding throughout application

✅ **Public Features**
- Browse all courses
- Search courses by title and instructor name
- View course details with lessons
- Register as instructor
- Responsive mobile-friendly design

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

## Workflow

### Instructor Registration Workflow
1. User fills registration form at `/instructor-register`
2. Form validates name and email
3. Instructor stored with status `pending`
4. Admin reviews at `/admin` dashboard
5. Admin clicks "Approve" to change status to `approved`
6. Approved instructors can have courses assigned

### Course Creation Workflow
1. Admin goes to admin dashboard
2. Clicks on "Courses" tab
3. Fills course form (title, description, instructor)
4. Course is created and linked to instructor
5. Admin can add lessons to the course
6. Public users can view and access courses

### Student Learning Workflow
1. Student visits `/courses`
2. Browsed available courses
3. Searches by title or instructor name
4. Clicks course to view details
5. Sees all lessons in the course
6. Views lesson content

## Design Features

- **Color Scheme:** Professional blue-green gradient (#4A70A9 → #73AF6F → #5A9454)
- **Typography:** System fonts for modern appearance
- **Spacing:** Clean, readable layouts with proper padding
- **Interactions:** Smooth hover effects and transitions
- **Consistency:** Same design language across all pages

## Important Notes

- **Admin credentials** are hardcoded for MVP phase (admin@123 / admin@123)
- **CSRF protection** is enabled on all forms
- **Session-based authentication** used (no JWT tokens)
- **Cascade delete** enabled for data integrity
- **Responsive design** works on desktop and tablet
- **No emojis** used in UI for professional appearance

## Database Configuration

Default configuration (already set up):
```
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=hungrybind_laravel
DB_USERNAME=root
DB_PASSWORD=root
```

## Future Enhancements

- [ ] JWT-based authentication with refresh tokens
- [ ] Email notifications for instructor approvals
- [ ] Course ratings and reviews system
- [ ] Student enrollment and progress tracking
- [ ] Certificate generation and download
- [ ] Payment integration (Stripe/PayPal)
- [ ] Video course content support
- [ ] Discussion forums per course
- [ ] Mobile app (React Native)
- [ ] Admin analytics dashboard

## Troubleshooting

### Server won't start
```powershell
# Check PHP installation
php -v

# Check Composer dependencies
composer install

# Clear Laravel caches
php artisan cache:clear
php artisan route:clear
```

### Database connection error
```powershell
# Check MySQL is running
# Verify credentials in .env file
# Run migrations
php artisan migrate:fresh
```

### 500 Internal Server Error
```powershell
# Check logs
tail -f storage/logs/laravel.log

# Clear caches
php artisan config:clear
php artisan cache:clear
```

## Support

For issues or questions, please contact the development team.

## License

This project is proprietary and confidential.

---

**Version:** 1.0.0  
**Last Updated:** November 22, 2025  
**Built with:** Laravel 11, PHP 8.2, MySQL 5.7  
**Color Scheme:** #4A70A9, #73AF6F, #5A9454
