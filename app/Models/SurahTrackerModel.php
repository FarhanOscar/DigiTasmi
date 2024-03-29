<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurahTrackerModel extends Model
{
    use HasFactory;

    protected $table = 'tracker_record';

    public function user()
    {
        return $this->belongsTo(User::class, 'TrackerUserId');
    }

    public function surah()
    {
        return $this->belongsTo(Surah::class, 'TrackerSurahId');
    }
}
