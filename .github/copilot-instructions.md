# Copilot Instructions for HungryBird

## Project Overview
HungryBird is a Course Management System built with Node.js, Express, Sequelize ORM, and MySQL. It supports three roles: Admin (manages instructors/courses/lessons), Instructor (registers and awaits approval), and User/Student (views courses and lessons). The system demonstrates role-based access control, RESTful API design with nested routes, and relationship modeling using Sequelize.

## Architecture & Key Components

### Major Components
- **Database Layer** (`backend/models/db.js`): Sequelize connection & configuration
- **Data Models** (`backend/models/`): Instructor, Course, Lesson models with relationships
- **Route Handlers** (`backend/routes/`): Role-based route modules (admin, instructor, user)
- **Express Server** (`backend/server.js`): Entry point with route grouping and middleware
- **Frontend** (`frontend/`): Vanilla HTML/CSS/JS pages using Fetch API

### Data Flow
1. **Instructor Registration**: POST `/instructor/register` → Stored with status "pending" → Admin reviews at `/admin/instructors/pending`
2. **Course Management**: Admin creates course via `/admin/courses` with approved instructor_id → Course linked to lessons
3. **User Access**: GET `/courses` → Returns all courses with instructor info → GET `/courses/:id/lessons` → Returns lessons for that course
4. **Approval Workflow**: Instructor submitted → Pending state → Admin approves → Instructor status changes to "approved" → Instructor can now have courses

### Service Boundaries
- **Admin Service**: Complete CRUD for Instructors, Courses, Lessons
- **Instructor Service**: Registration and status viewing only (read-only approval status)
- **User Service**: Read-only access to published courses and lessons
- Each service is isolated in its own router module and doesn't modify other services' data

## Tech Stack
- **Language**: JavaScript (Node.js runtime)
- **Backend Framework**: Express.js with Express Router
- **ORM**: Sequelize (handles MySQL relationships and migrations)
- **Database**: MySQL (version 5.7+)
- **Frontend**: Vanilla HTML5, CSS3, JavaScript (Fetch API)
- **Build Tool**: npm
- **Test Framework**: (To be determined - manual testing currently)
- **Key Dependencies**: express, sequelize, mysql2, body-parser

## Development Workflows

### Setup
```bash
# Initialize Node.js project
npm init -y

# Install dependencies
npm install express sequelize mysql2 body-parser cors dotenv

# Create MySQL database
mysql -u root -p
mysql> CREATE DATABASE hungrybind_db;
mysql> EXIT;

# Start development server
npm start
```

### Build
```bash
# No build step - Node.js runs directly
```

### Run/Dev Server
```bash
# Start server (runs on port 5000)
npm start
# Access: http://localhost:5000
# Admin: http://localhost:5000/admin.html
# Instructor: http://localhost:5000/instructor-register.html
```

### Testing
```bash
# Manual API testing via Fetch API in frontend
# Or use Postman/Thunder Client for REST API testing
# Example POST: POST http://localhost:5000/instructor/register with JSON body
```

### Debugging
- Check `backend/models/db.js` for database connection issues
- Enable Sequelize logging: `sequelize: { logging: console.log }`
- Use browser DevTools Console to debug Fetch API calls
- Check server terminal for error stack traces
- Verify MySQL is running: `mysql -u root -p -e "SELECT 1"`

## Code Patterns & Conventions

### Naming Conventions
- **Variables/Functions**: camelCase (e.g., `getInstructors`, `pendingStatus`)
- **Classes/Models**: PascalCase (e.g., `Instructor`, `Course`, `Lesson`)
- **Database Columns**: snake_case in schema, camelCase in Sequelize models
- **Routes**: lowercase with hyphens (e.g., `/admin/instructors/pending`, `/courses/:id/lessons`)
- **Files**: kebab-case for routes (e.g., `adminRoutes.js`), lowercase for models (e.g., `instructor.js`)

### File Structure
```
backend/
  ├── models/
  │   ├── db.js              # Sequelize config & connection
  │   ├── instructor.js      # Instructor model definition
  │   ├── course.js          # Course model definition
  │   └── lesson.js          # Lesson model definition
  ├── routes/
  │   ├── adminRoutes.js     # /admin/* endpoints
  │   ├── instructorRoutes.js # /instructor/* endpoints
  │   └── userRoutes.js      # /courses/* endpoints
  └── server.js              # Express app & route mounting

frontend/
  ├── index.html             # Home page (public courses list)
  ├── courses.html           # Detailed courses view for users
  ├── course-details.html    # Single course + lessons view
  ├── admin.html             # Admin dashboard
  ├── instructor-register.html # Instructor registration
  ├── css/
  │   └── styles.css         # Global styles (shared across pages)
  └── js/
      ├── api.js             # Fetch API helper functions
      ├── admin.js           # Admin page logic
      ├── instructor.js      # Instructor registration logic
      └── user.js            # User courses view logic

package.json
.env (credentials & config)
.gitignore
```

### Common Patterns
- **Error Response Format**: All endpoints return `{ success: bool, message: string, data: any }` JSON
- **Route Grouping**: Express Router used for `/admin`, `/instructor`, `/courses` prefixes in `server.js`
- **Database Sync**: `sequelize.sync({ force: false, alter: true })` on server startup
- **Relationship Queries**: Use Sequelize `include` for eager loading (e.g., `Course.findAll({ include: Instructor })`)
- **Nested Routes**: `/admin/courses/:courseId/lessons` handled via route parameters in single endpoint

### Error Handling
- Try-catch blocks in all route handlers
- Return consistent error structure: `res.status(400).json({ success: false, message: error.message })`
- Log errors to console with context (e.g., "Error creating course: ...")
- Validate required fields before database operations

### Configuration
- **Database**: MySQL credentials in `backend/models/db.js` (username: root, password: root, host: localhost, port: 3306)
- **Admin Credentials**: Hardcoded in frontend - username: `admin@123`, password: `admin@123`
- **Server Port**: 5000 (configurable via `.env` later)
- **API Base URL**: `http://localhost:5000` (used in frontend Fetch API calls)

## Integration Points

### External Dependencies
- **MySQL Database**: Backend connects via Sequelize at startup
- **Sequelize ORM**: Abstracts SQL queries and handles relationships
- **Fetch API**: Frontend communicates with backend RESTful endpoints

### Cross-Component Communication
- **Frontend → Backend**: Fetch API calls to `/admin/*`, `/instructor/*`, `/courses/*` endpoints
- **Backend Models → Database**: Sequelize models map to MySQL tables automatically
- **Routes → Models**: Each route handler calls Sequelize methods (create, findAll, update, destroy)
- **Inter-Model Communication**: Relationships defined in models enable eager loading via `include` in queries

## Common Tasks for AI Agents

### Adding a New Feature
1. Define the data model in `backend/models/` if new entity needed
2. Create/update route handler in appropriate module (`adminRoutes.js`, etc.)
3. Use Sequelize methods for database operations
4. Return consistent error response format
5. Test with Fetch API calls from frontend
6. Update frontend page if needed

### Debugging Issues
1. Check `backend/models/db.js` for database connection errors
2. Review route handler in appropriate file (`adminRoutes.js`, `instructorRoutes.js`, `userRoutes.js`)
3. Check browser console for Fetch API errors
4. Verify MySQL is running and database exists: `mysql -u root -p`
5. Enable Sequelize logging in `db.js` to see generated SQL queries
6. Use try-catch blocks to isolate error sources

### Performance Optimization
- Use Sequelize `include` for eager loading instead of multiple queries
- Index frequently queried columns in MySQL (id, status, instructor_id)
- Use Sequelize `attributes` to select only needed columns
- Cache instructor list on frontend to reduce API calls
- Lazy load lessons only when course is selected

## Critical Files Reference
- **Entry point(s)**: `backend/server.js`
- **Configuration**: `backend/models/db.js` (database credentials)
- **Tests**: Manual testing via Fetch API in browser, Postman for advanced scenarios
- **Documentation**: This file, inline comments in route handlers

## Important Notes
- **No Authentication Middleware Yet**: Admin credentials hardcoded in frontend for MVP - add JWT/sessions for production
- **Database Cascade**: Deleting an instructor will cascade delete their courses and lessons
- **Status Enum**: Instructor status is either "pending" or "approved" - only approved instructors can have courses
- **Nested Routes**: `/admin/courses/:courseId/lessons/:lessonId` shows parent-child relationship pattern
- **CORS**: May need to enable CORS middleware if frontend is served from different port
- **Technical Debt**: Consider adding input validation, role-based middleware, and migration scripts for production
