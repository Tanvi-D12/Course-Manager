const { DataTypes } = require('sequelize');
const { sequelize } = require('./db');

const Lesson = sequelize.define('Lesson', {
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
  courseId: {
    type: DataTypes.INTEGER,
    allowNull: false,
    references: {
      model: 'courses',
      key: 'id'
    }
  }
}, {
  tableName: 'lessons',
  timestamps: true,
  underscored: true
});

module.exports = Lesson;
