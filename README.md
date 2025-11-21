# 🐦 HungryBird - Course Management System

A comprehensive Course Management System built with Node.js, Express, Sequelize ORM, and MySQL. Supports three user roles: Admin, Instructor, and Student with role-based access control.

## 🚀 Quick Start

### Prerequisites
- Node.js (v14+)
- MySQL (v5.7+)
- npm

### Installation Steps

1. **Clone/Navigate to project folder**
```bash
cd c:\Users\tanvi\Desktop\HungryBird
```

2. **Install dependencies**
```bash
npm install
```

3. **Create MySQL Database**
```bash
mysql -u root -p
mysql> CREATE DATABASE hungrybind_db;
mysql> EXIT;
```

4. **Start the server**
```bash
npm start
```

The server will run on `http://localhost:5000`

### 📍 Access Points
- **Public Courses**: http://localhost:5000/index.html
- **Course Details**: http://localhost:5000/course-details.html?id=[courseId]
- **Instructor Registration**: http://localhost:5000/instructor-register.html
- **Admin Dashboard**: http://localhost:5000/admin.html

## 👥 User Roles

### 🔐 Admin
- **Credentials**: admin@123 / admin@123
- **Capabilities**:
  - Review pending instructor registrations
  - Approve/reject instructors
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
