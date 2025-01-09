<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class apllyAplication extends Model
{
    //

    protected $fillable = [
        'Certificate_Type',
        'Class_name',
        'student_bangla_name',
        'student_arabic_name',
        'student_english_name',
        'student_Father_name_bn',
        'student_Father_name_ar',
        'student_Father_name_en',
        'Roll',
        'reg_id',
        'MID',
        'madrasha_name_en',
        'madrasha_name',
        'photo',
        'status',
        'admin_message'
    ];


    protected $casts = [
        'Roll' => 'integer',
        'reg_id' => 'integer',
        'MID' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
