<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $primaryKey = 'course_id';
    public $incrementing = true;

    protected $fillable = [
        'course_code',
        'course_name',
        'credits',
    ];

    /**
     * Relasi many-to-many ke Student melalui takes
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'takes', 'course_id', 'student_id')
                    ->withPivot('enroll_date');
    }

    /**
     * Relasi one-to-many ke Take
     */
    public function takes()
    {
        return $this->hasMany(Take::class, 'course_id', 'course_id');
    }
}
