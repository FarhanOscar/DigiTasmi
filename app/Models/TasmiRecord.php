<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasmiRecord extends Model
{
    use HasFactory;

    public function surah()
    {
        return $this->belongsTo(Surah::class, 'TasmiSurahId');
    }

    public function class()
    {
        return $this->belongsTo(TeacherClass::class, 'TasmiClassId');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'TasmiStudentId');
    }

    
}
