const Instructor = require('./instructor');
const Course = require('./course');
const Lesson = require('./lesson');

// Define relationships
Instructor.hasMany(Course, {
  foreignKey: 'instructorId',
  onDelete: 'CASCADE',
  onUpdate: 'CASCADE'
});

Course.belongsTo(Instructor, {
  foreignKey: 'instructorId'
});

Course.hasMany(Lesson, {
  foreignKey: 'courseId',
  onDelete: 'CASCADE',
  onUpdate: 'CASCADE'
});

Lesson.belongsTo(Course, {
  foreignKey: 'courseId'
});

module.exports = { Instructor, Course, Lesson };
