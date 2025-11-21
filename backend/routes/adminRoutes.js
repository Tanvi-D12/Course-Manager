const express = require('express');
const router = express.Router();
const { Instructor, Course, Lesson } = require('../models');

// =====================
// INSTRUCTOR MANAGEMENT
// =====================

// GET pending instructors
router.get('/instructors/pending', async (req, res) => {
  try {
    const instructors = await Instructor.findAll({ where: { status: 'pending' } });
    res.json({ success: true, message: 'Pending instructors fetched', data: instructors });
  } catch (error) {
    console.error('Error fetching pending instructors:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

// GET all approved instructors
router.get('/instructors', async (req, res) => {
  try {
    const instructors = await Instructor.findAll({ where: { status: 'approved' } });
    res.json({ success: true, message: 'Approved instructors fetched', data: instructors });
  } catch (error) {
    console.error('Error fetching instructors:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

// PUT approve an instructor
router.put('/instructors/:id/approve', async (req, res) => {
  try {
    const { id } = req.params;
    const instructor = await Instructor.findByPk(id);
    
    if (!instructor) {
      return res.status(404).json({ success: false, message: 'Instructor not found' });
    }

    instructor.status = 'approved';
    await instructor.save();
    
    res.json({ success: true, message: 'Instructor approved successfully', data: instructor });
  } catch (error) {
    console.error('Error approving instructor:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

// DELETE instructor
router.delete('/instructors/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const instructor = await Instructor.findByPk(id);

    if (!instructor) {
      return res.status(404).json({ success: false, message: 'Instructor not found' });
    }

    await instructor.destroy();
    res.json({ success: true, message: 'Instructor deleted successfully' });
  } catch (error) {
    console.error('Error deleting instructor:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

// =====================
// COURSE MANAGEMENT
// =====================

// POST create course
router.post('/courses', async (req, res) => {
  try {
    const { name, instructorId } = req.body;
    
    if (!name || !instructorId) {
      return res.status(400).json({ success: false, message: 'Name and instructorId are required' });
    }

    // Check if instructor exists and is approved
    const instructor = await Instructor.findByPk(instructorId);
    if (!instructor || instructor.status !== 'approved') {
      return res.status(400).json({ success: false, message: 'Instructor not found or not approved' });
    }

    const course = await Course.create({ name, instructorId });
    res.status(201).json({ success: true, message: 'Course created successfully', data: course });
  } catch (error) {
    console.error('Error creating course:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

// GET all courses (admin view)
router.get('/courses', async (req, res) => {
  try {
    const courses = await Course.findAll({ include: Instructor });
    res.json({ success: true, message: 'Courses fetched', data: courses });
  } catch (error) {
    console.error('Error fetching courses:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

// PUT edit course
router.put('/courses/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const { name, instructorId } = req.body;

    const course = await Course.findByPk(id);
    if (!course) {
      return res.status(404).json({ success: false, message: 'Course not found' });
    }

    if (instructorId) {
      const instructor = await Instructor.findByPk(instructorId);
      if (!instructor || instructor.status !== 'approved') {
        return res.status(400).json({ success: false, message: 'Instructor not found or not approved' });
      }
      course.instructorId = instructorId;
    }

    if (name) course.name = name;
    await course.save();

    res.json({ success: true, message: 'Course updated successfully', data: course });
  } catch (error) {
    console.error('Error updating course:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

// DELETE course
router.delete('/courses/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const course = await Course.findByPk(id);

    if (!course) {
      return res.status(404).json({ success: false, message: 'Course not found' });
    }

    await course.destroy();
    res.json({ success: true, message: 'Course deleted successfully' });
  } catch (error) {
    console.error('Error deleting course:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

// =====================
// LESSON MANAGEMENT (NESTED)
// =====================

// POST create lesson under a course
router.post('/courses/:courseId/lessons', async (req, res) => {
  try {
    const { courseId } = req.params;
    const { name } = req.body;

    if (!name) {
      return res.status(400).json({ success: false, message: 'Lesson name is required' });
    }

    const course = await Course.findByPk(courseId);
    if (!course) {
      return res.status(404).json({ success: false, message: 'Course not found' });
    }

    const lesson = await Lesson.create({ name, courseId });
    res.status(201).json({ success: true, message: 'Lesson created successfully', data: lesson });
  } catch (error) {
    console.error('Error creating lesson:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

// GET lessons under a course
router.get('/courses/:courseId/lessons', async (req, res) => {
  try {
    const { courseId } = req.params;
    
    const course = await Course.findByPk(courseId);
    if (!course) {
      return res.status(404).json({ success: false, message: 'Course not found' });
    }

    const lessons = await Lesson.findAll({ where: { courseId } });
    res.json({ success: true, message: 'Lessons fetched', data: lessons });
  } catch (error) {
    console.error('Error fetching lessons:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

// PUT edit lesson
router.put('/courses/:courseId/lessons/:lessonId', async (req, res) => {
  try {
    const { courseId, lessonId } = req.params;
    const { name } = req.body;

    const lesson = await Lesson.findByPk(lessonId);
    if (!lesson || lesson.courseId !== parseInt(courseId)) {
      return res.status(404).json({ success: false, message: 'Lesson not found' });
    }

    if (name) lesson.name = name;
    await lesson.save();

    res.json({ success: true, message: 'Lesson updated successfully', data: lesson });
  } catch (error) {
    console.error('Error updating lesson:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

// DELETE lesson
router.delete('/courses/:courseId/lessons/:lessonId', async (req, res) => {
  try {
    const { courseId, lessonId } = req.params;
    
    const lesson = await Lesson.findByPk(lessonId);
    if (!lesson || lesson.courseId !== parseInt(courseId)) {
      return res.status(404).json({ success: false, message: 'Lesson not found' });
    }

    await lesson.destroy();
    res.json({ success: true, message: 'Lesson deleted successfully' });
  } catch (error) {
    console.error('Error deleting lesson:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

module.exports = router;
