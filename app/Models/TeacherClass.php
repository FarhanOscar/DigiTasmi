<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\TeacherClass;
use App\models\User;


class TeacherClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'ClassName' => 'required',
        'ClassDesc',
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'ClassMakerId');
}

public function class()
{
    return $this->hasOne(EnrollClass::class, 'EnrollClassId','id');
}

public function record()
{
    return $this->hasOne(TasmiRecord::class, 'TasmiClassId','id');
}


}
