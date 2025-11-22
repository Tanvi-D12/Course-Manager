<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'instructor_id'];

    /**
     * Get the instructor for this course
     */
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    /**
     * Get all lessons for this course
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
