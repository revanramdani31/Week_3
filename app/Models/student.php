<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'student_id',
        'nim',
        'entry_year',
    ];

    /**
     * Relasi ke User (1 Student = 1 User)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    /**
     * Relasi many-to-many ke Course melalui takes
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'takes', 'student_id', 'course_id')
                    ->withPivot('enroll_date');
    }

    /**
     * Relasi one-to-many ke Take
     */
    public function takes()
    {
        return $this->hasMany(Take::class, 'student_id', 'student_id');
    }
}
