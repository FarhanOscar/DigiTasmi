<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\TeacherClass;

class EnrollClass extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'EnrollStudentId');
    }

    public function class()
    {
        return $this->belongsTo(TeacherClass::class, 'EnrollClassId');
    }
}
