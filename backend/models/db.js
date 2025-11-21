const { Sequelize } = require('sequelize');

// Create Sequelize instance with MySQL connection
const sequelize = new Sequelize(
  'hungrybind_db',      // database name
  'root',               // username
  'root',               // password
  {
    host: 'localhost',
    port: 3306,
    dialect: 'mysql',
    logging: false,     // Set to console.log for SQL query debugging
    pool: {
      max: 5,
      min: 0,
      acquire: 30000,
      idle: 10000
    }
  }
);

// Test database connection
const connectDB = async () => {
  try {
    await sequelize.authenticate();
    console.log('✅ Database connected successfully');
  } catch (error) {
    console.error('❌ Database connection error:', error.message);
    process.exit(1);
  }
};

module.exports = { sequelize, connectDB };
