<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($course->title); ?> - HungryBird</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        header {
            background: linear-gradient(135deg, #4A70A9 0%, #73AF6F 50%, #5A9454 100%);
            color: white;
            padding: 30px 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        header p {
            opacity: 0.9;
            font-size: 16px;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .course-header {
            background: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .course-header h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 15px;
        }

        .course-meta {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
            color: #666;
        }

        .course-description {
            color: #666;
            line-height: 1.8;
            font-size: 16px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
        }

        .btn-secondary {
            background-color: #f5f5f5;
            color: #333;
            border: 2px solid #ddd;
        }

        .btn-secondary:hover {
            background-color: #eeeeee;
        }

        .lessons-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .lessons-section h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .lessons-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .lesson-card {
            background: #f9f9f9;
            border: 2px solid #eee;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.3s;
        }

        .lesson-card:hover {
            border-color: #667eea;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
        }

        .lesson-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 12px;
        }

        .lesson-content {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .empty-state h3 {
            color: #666;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1><?php echo e($course->title); ?></h1>
        <p>Learn from the best instructors</p>
    </header>

    <div class="container">
        <div class="course-header">
            <h1><?php echo e($course->title); ?></h1>
            
            <div class="course-meta">
                <div class="meta-item">
                    <strong>Instructor:</strong> <?php echo e($course->instructor->name ?? 'Unknown'); ?>

                </div>
                <div class="meta-item">
                    <strong>Lessons:</strong> <?php echo e($course->lessons->count()); ?>

                </div>
            </div>

            <div class="course-description">
                <?php echo e($course->description); ?>

            </div>

            <a href="/courses" class="btn btn-secondary">← Back to Courses</a>
        </div>

        <div class="lessons-section">
            <h2>Course Lessons</h2>

            <?php if($course->lessons->count() > 0): ?>
                <div class="lessons-grid">
                    <?php $__currentLoopData = $course->lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="lesson-card">
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 10px;">
                                <span style="background: #667eea; color: white; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;"><?php echo e($index + 1); ?></span>
                            </div>
                            <div class="lesson-title"><?php echo e($lesson->title); ?></div>
                            <div class="lesson-content"><?php echo e(Str::limit($lesson->content, 100)); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <h3>No lessons yet</h3>
                    <p>Lessons will be added soon for this course.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\tanvi\Desktop\HungryBird\laravel\resources\views/user/courses/show.blade.php ENDPATH**/ ?>