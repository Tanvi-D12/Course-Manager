const { DataTypes } = require('sequelize');
const { sequelize } = require('./db');

const Course = sequelize.define('Course', {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true
  },
  name: {
    type: DataTypes.STRING,
    allowNull: false,
    validate: {
      notEmpty: true
    }
  },
  instructorId: {
    type: DataTypes.INTEGER,
    allowNull: false,
    references: {
      model: 'instructors',
      key: 'id'
    }
  }
}, {
  tableName: 'courses',
  timestamps: true,
  underscored: true
});

module.exports = Course;
