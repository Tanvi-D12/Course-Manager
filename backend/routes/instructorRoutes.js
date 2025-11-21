const express = require('express');
const router = express.Router();
const { Instructor } = require('../models');

// POST register instructor
router.post('/register', async (req, res) => {
  try {
    const { name, email } = req.body;

    if (!name || !email) {
      return res.status(400).json({ success: false, message: 'Name and email are required' });
    }

    // Check if instructor already exists
    const existingInstructor = await Instructor.findOne({ where: { email } });
    if (existingInstructor) {
      return res.status(400).json({ success: false, message: 'Email already registered' });
    }

    const instructor = await Instructor.create({ name, email, status: 'pending' });
    res.status(201).json({ 
      success: true, 
      message: 'Instructor registered successfully. Awaiting admin approval.', 
      data: instructor 
    });
  } catch (error) {
    console.error('Error registering instructor:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

// GET instructor status
router.get('/:id/status', async (req, res) => {
  try {
    const { id } = req.params;
    const instructor = await Instructor.findByPk(id);

    if (!instructor) {
      return res.status(404).json({ success: false, message: 'Instructor not found' });
    }

    res.json({ 
      success: true, 
      message: 'Instructor status fetched', 
      data: { 
        id: instructor.id, 
        name: instructor.name, 
        email: instructor.email, 
        status: instructor.status 
      } 
    });
  } catch (error) {
    console.error('Error fetching instructor status:', error.message);
    res.status(500).json({ success: false, message: error.message });
  }
});

module.exports = router;
