const { DataTypes } = require('sequelize');
const { sequelize } = require('./db');

const Instructor = sequelize.define('Instructor', {
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
  email: {
    type: DataTypes.STRING,
    allowNull: false,
    unique: true,
    validate: {
      isEmail: true
    }
  },
  status: {
    type: DataTypes.ENUM('pending', 'approved'),
    defaultValue: 'pending',
    allowNull: false
  }
}, {
  tableName: 'instructors',
  timestamps: true,
  underscored: true
});

module.exports = Instructor;
