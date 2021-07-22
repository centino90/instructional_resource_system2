<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password',
        'firstname',
        'lastname',
        'grade_first_sem',
        'grade_second_sem',
        'class_description',
        'year_level',
        'section',
        'student_count',
        'room_no',
        'building_no',
        'pdf_data'
    ];
}
