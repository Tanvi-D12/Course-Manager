// API Base URL
const API_BASE = 'http://localhost:5000';

// Show alert message
function showAlert(message, type = 'success') {
  const alertDiv = document.createElement('div');
  alertDiv.className = `alert alert-${type} show`;
  alertDiv.textContent = message;
  
  const container = document.querySelector('.container');
  container.insertBefore(alertDiv, container.firstChild);
  
  setTimeout(() => alertDiv.remove(), 4000);
}

// =====================
// ADMIN API CALLS
// =====================

async function getPendingInstructors() {
  try {
    const response = await fetch(`${API_BASE}/admin/instructors/pending`);
    const result = await response.json();
    return result.data || [];
  } catch (error) {
    console.error('Error fetching pending instructors:', error);
    showAlert('Failed to fetch pending instructors', 'danger');
    return [];
  }
}

async function approveInstructor(instructorId) {
  try {
    const response = await fetch(`${API_BASE}/admin/instructors/${instructorId}/approve`, {
      method: 'PUT'
    });
    const result = await response.json();
    if (result.success) {
      showAlert('Instructor approved successfully!', 'success');
    }
    return result;
  } catch (error) {
    console.error('Error approving instructor:', error);
    showAlert('Failed to approve instructor', 'danger');
  }
}

async function deleteInstructor(instructorId) {
  try {
    const response = await fetch(`${API_BASE}/admin/instructors/${instructorId}`, {
      method: 'DELETE'
    });
    const result = await response.json();
    if (result.success) {
      showAlert('Instructor deleted successfully!', 'success');
      return result;
    } else {
      showAlert(result.message || 'Failed to delete instructor', 'danger');
      return result;
    }
  } catch (error) {
    console.error('Error deleting instructor:', error);
    showAlert('Failed to delete instructor: ' + error.message, 'danger');
    return { success: false, message: error.message };
  }
}

async function getApprovedInstructors() {
  try {
    const response = await fetch(`${API_BASE}/admin/instructors`);
    const result = await response.json();
    return result.data || [];
  } catch (error) {
    console.error('Error fetching instructors:', error);
    return [];
  }
}

async function getAllCoursesAdmin() {
  try {
    const response = await fetch(`${API_BASE}/admin/courses`);
    const result = await response.json();
    return result.data || [];
  } catch (error) {
    console.error('Error fetching courses:', error);
    showAlert('Failed to fetch courses', 'danger');
    return [];
  }
}

async function createCourse(name, instructorId) {
  try {
    const response = await fetch(`${API_BASE}/admin/courses`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ name, instructorId: parseInt(instructorId) })
    });
    const result = await response.json();
    if (result.success) {
      showAlert('Course created successfully!', 'success');
    } else {
      showAlert(result.message || 'Failed to create course', 'danger');
    }
    return result;
  } catch (error) {
    console.error('Error creating course:', error);
    showAlert('Failed to create course', 'danger');
  }
}

async function updateCourse(courseId, name, instructorId) {
  try {
    const response = await fetch(`${API_BASE}/admin/courses/${courseId}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ name, instructorId: parseInt(instructorId) })
    });
    const result = await response.json();
    if (result.success) {
      showAlert('Course updated successfully!', 'success');
    } else {
      showAlert(result.message || 'Failed to update course', 'danger');
    }
    return result;
  } catch (error) {
    console.error('Error updating course:', error);
    showAlert('Failed to update course', 'danger');
  }
}

async function deleteCourse(courseId) {
  try {
    const response = await fetch(`${API_BASE}/admin/courses/${courseId}`, {
      method: 'DELETE'
    });
    const result = await response.json();
    if (result.success) {
      showAlert('Course deleted successfully!', 'success');
    }
    return result;
  } catch (error) {
    console.error('Error deleting course:', error);
    showAlert('Failed to delete course', 'danger');
  }
}

async function createLesson(courseId, name) {
  try {
    const response = await fetch(`${API_BASE}/admin/courses/${courseId}/lessons`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ name })
    });
    const result = await response.json();
    if (result.success) {
      showAlert('Lesson created successfully!', 'success');
    } else {
      showAlert(result.message || 'Failed to create lesson', 'danger');
    }
    return result;
  } catch (error) {
    console.error('Error creating lesson:', error);
    showAlert('Failed to create lesson', 'danger');
  }
}

async function getCourseLessons(courseId) {
  try {
    const response = await fetch(`${API_BASE}/admin/courses/${courseId}/lessons`);
    const result = await response.json();
    return result.data || [];
  } catch (error) {
    console.error('Error fetching lessons:', error);
    return [];
  }
}

async function updateLesson(courseId, lessonId, name) {
  try {
    const response = await fetch(`${API_BASE}/admin/courses/${courseId}/lessons/${lessonId}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ name })
    });
    const result = await response.json();
    if (result.success) {
      showAlert('Lesson updated successfully!', 'success');
    }
    return result;
  } catch (error) {
    console.error('Error updating lesson:', error);
    showAlert('Failed to update lesson', 'danger');
  }
}

async function deleteLesson(courseId, lessonId) {
  try {
    const response = await fetch(`${API_BASE}/admin/courses/${courseId}/lessons/${lessonId}`, {
      method: 'DELETE'
    });
    const result = await response.json();
    if (result.success) {
      showAlert('Lesson deleted successfully!', 'success');
    }
    return result;
  } catch (error) {
    console.error('Error deleting lesson:', error);
    showAlert('Failed to delete lesson', 'danger');
  }
}

// =====================
// INSTRUCTOR API CALLS
// =====================

async function registerInstructor(name, email) {
  try {
    const response = await fetch(`${API_BASE}/instructor/register`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ name, email })
    });
    const result = await response.json();
    if (result.success) {
      showAlert('Registration successful! Please wait for admin approval.', 'success');
      localStorage.setItem('instructorId', result.data.id);
    } else {
      showAlert(result.message || 'Registration failed', 'danger');
    }
    return result;
  } catch (error) {
    console.error('Error registering instructor:', error);
    showAlert('Registration failed', 'danger');
  }
}

async function getInstructorStatus(instructorId) {
  try {
    const response = await fetch(`${API_BASE}/instructor/${instructorId}/status`);
    const result = await response.json();
    return result.data;
  } catch (error) {
    console.error('Error fetching instructor status:', error);
    return null;
  }
}

// =====================
// USER/STUDENT API CALLS
// =====================

async function getAllCourses() {
  try {
    const response = await fetch(`${API_BASE}/courses`);
    const result = await response.json();
    return result.data || [];
  } catch (error) {
    console.error('Error fetching courses:', error);
    showAlert('Failed to fetch courses', 'danger');
    return [];
  }
}

async function getCourseDetails(courseId) {
  try {
    const response = await fetch(`${API_BASE}/courses/${courseId}`);
    const result = await response.json();
    return result.data;
  } catch (error) {
    console.error('Error fetching course details:', error);
    showAlert('Failed to fetch course details', 'danger');
    return null;
  }
}

async function getCourseLessonsUser(courseId) {
  try {
    const response = await fetch(`${API_BASE}/courses/${courseId}/lessons`);
    const result = await response.json();
    return result.data || [];
  } catch (error) {
    console.error('Error fetching lessons:', error);
    return [];
  }
}
