<?php

namespace Database\Seeders;

use App\Models\Instructor;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create pending instructors
        $pending1 = Instructor::create([
            'name' => 'John Smith',
            'email' => 'john@example.com',
            'status' => 'pending',
        ]);

        $pending2 = Instructor::create([
            'name' => 'Sarah Johnson',
            'email' => 'sarah@example.com',
            'status' => 'pending',
        ]);

        // Create approved instructors
        $approved1 = Instructor::create([
            'name' => 'Michael Brown',
            'email' => 'michael@example.com',
            'status' => 'approved',
        ]);

        $approved2 = Instructor::create([
            'name' => 'Emma Davis',
            'email' => 'emma@example.com',
            'status' => 'approved',
        ]);

        // Create courses with approved instructors
        $course1 = Course::create([
            'name' => 'Introduction to Web Development',
            'instructor_id' => $approved1->id,
        ]);

        $course2 = Course::create([
            'name' => 'Advanced Laravel',
            'instructor_id' => $approved1->id,
        ]);

        $course3 = Course::create([
            'name' => 'Database Design',
            'instructor_id' => $approved2->id,
        ]);

        // Create lessons for courses
        Lesson::create(['name' => 'HTML Basics', 'course_id' => $course1->id]);
        Lesson::create(['name' => 'CSS Styling', 'course_id' => $course1->id]);
        Lesson::create(['name' => 'JavaScript Fundamentals', 'course_id' => $course1->id]);

        Lesson::create(['name' => 'Eloquent ORM', 'course_id' => $course2->id]);
        Lesson::create(['name' => 'Middleware', 'course_id' => $course2->id]);
        Lesson::create(['name' => 'Testing in Laravel', 'course_id' => $course2->id]);

        Lesson::create(['name' => 'Normalization', 'course_id' => $course3->id]);
        Lesson::create(['name' => 'Indexing Strategies', 'course_id' => $course3->id]);
    }
}
