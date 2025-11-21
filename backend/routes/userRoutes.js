const express = require('express');
const router = express.Router();
const { Course, Lesson, Instructor } = require('../models');

// GET all courses (public view)
router.get('/', async (req, res) => {
  try {
    const courses = await Course.findAll({ 
      include: Instructor,
      attributes: ['id', 'name', 'instructorId'],
      order: [['id', 'DESC']]
    });
    res.json({ success: true, message: 'Courses fetched', data: courses });
  } catch (error) {
    console.error('Error fetching courses:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

// GET single course
router.get('/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const course = await Course.findByPk(id, { include: Instructor });

    if (!course) {
      return res.status(404).json({ success: false, message: 'Course not found' });
    }

    res.json({ success: true, message: 'Course fetched', data: course });
  } catch (error) {
    console.error('Error fetching course:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

// GET lessons under a course (nested route)
router.get('/:courseId/lessons', async (req, res) => {
  try {
    const { courseId } = req.params;

    const course = await Course.findByPk(courseId);
    if (!course) {
      return res.status(404).json({ success: false, message: 'Course not found' });
    }

    const lessons = await Lesson.findAll({ 
      where: { courseId },
      order: [['id', 'DESC']]
    });

    res.json({ success: true, message: 'Lessons fetched', data: lessons });
  } catch (error) {
    console.error('Error fetching lessons:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

module.exports = router;
