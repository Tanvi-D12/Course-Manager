

<?php $__env->startSection('title', 'Manage Courses'); ?>

<?php $__env->startSection('content'); ?>
<div class="section">
    <h2>Course Management</h2>

    <div style="margin-bottom: 20px;">
        <a href="<?php echo e(route('admin.courses.create')); ?>" class="btn">Create New Course</a>
    </div>

    <?php if($courses->isEmpty()): ?>
        <p style="color: #999;">No courses available yet.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Instructor</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($course->name); ?></td>
                        <td><?php echo e($course->instructor->name ?? 'N/A'); ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo e(route('admin.courses.edit', $course)); ?>" class="btn">Edit</a>
                                <a href="<?php echo e(route('admin.lessons.index', $course)); ?>" class="btn">Lessons</a>
                                <form action="<?php echo e(route('admin.courses.destroy', $course)); ?>" method="POST" style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this course?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\tanvi\Desktop\HungryBird\laravel\resources\views/admin/courses/index.blade.php ENDPATH**/ ?>