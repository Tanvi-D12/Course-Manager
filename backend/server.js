const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const path = require('path');

const { connectDB, sequelize } = require('./models/db');
const { Instructor, Course, Lesson } = require('./models');

// Import route handlers
const adminRoutes = require('./routes/adminRoutes');
const instructorRoutes = require('./routes/instructorRoutes');
const userRoutes = require('./routes/userRoutes');

const app = express();
const PORT = process.env.PORT || 5000;

// =====================
// MIDDLEWARE
// =====================

// Enable CORS
app.use(cors());

// Parse JSON bodies
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Serve static files from frontend folder
app.use(express.static(path.join(__dirname, '../frontend')));

// =====================
// ROUTE GROUPING
// =====================

// Admin routes
app.use('/admin', adminRoutes);

// Instructor routes
app.use('/instructor', instructorRoutes);

// User/Student routes
app.use('/courses', userRoutes);

// =====================
// HOME ROUTE
// =====================

app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, '../frontend/index.html'));
});

// =====================
// DATABASE SYNC & SERVER STARTUP
// =====================

const startServer = async () => {
  try {
    // Connect to database
    await connectDB();

    // Sync models with database (creates tables if they don't exist)
    await sequelize.sync({ alter: false, force: false });
    console.log('✅ Database models synchronized');

    // Start server
    app.listen(PORT, () => {
      console.log(`🚀 Server running on http://localhost:${PORT}`);
      console.log(`📚 Admin Dashboard: http://localhost:${PORT}/admin.html`);
      console.log(`👨‍🏫 Instructor Register: http://localhost:${PORT}/instructor-register.html`);
      console.log(`📖 Courses (Public): http://localhost:${PORT}/index.html`);
    });
  } catch (error) {
    console.error('❌ Failed to start server:', error.message);
    process.exit(1);
  }
};

startServer();

module.exports = app;
