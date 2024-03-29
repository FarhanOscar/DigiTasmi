<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    use HasFactory;

    public function tasmiRec()
    {
        return $this->hasOne(TasmiRecord::class, 'SurahId','id');
    }

    public function tracker()
    {
        return $this->hasOne(SurahTrackerModel::class, 'TrackerSurahId','id');
    }
}
