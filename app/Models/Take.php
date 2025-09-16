<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Take extends Model
{
    use HasFactory;

    protected $table = 'takes';
    public $incrementing = false;
    
    // ======================================================
    // == INI PERBAIKANNYA ==
    // Tetapkan satu kolom sebagai primary key untuk memenuhi kebutuhan internal Laravel.
    // Logika di bawah akan memastikan operasi delete tetap menggunakan composite key.
    // ======================================================
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'student_id',
        'course_id',
        'enroll_date',
    ];

    /**
     * Override builder agar bisa handle composite key
     */
    public function newEloquentBuilder($query)
    {
        // Kode ini sudah benar, tidak perlu diubah
        return new class($query) extends Builder {
            public function find($id, $columns = ['*'])
            {
                if (is_array($id)) {
                    $this->where($id);
                }
                return $this->first($columns);
            }
        };
    }

    /**
     * Override method ini untuk memastikan operasi save dan delete
     * menggunakan DUA kolom (composite key).
     */
    protected function setKeysForSaveQuery($query)
    {
        $keys = ['student_id', 'course_id']; // Definisikan composite key di sini

        foreach ($keys as $key) {
            $query->where($key, '=', $this->getAttribute($key));
        }
        return $query;
    }

    /**
     * Relasi ke Student
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    /**
     * Relasi ke Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }
}