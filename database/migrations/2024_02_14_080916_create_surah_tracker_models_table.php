<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tracker_record', function (Blueprint $table) {
            $table->id();
            $table->string('TrackerSurahId');  //Class id
            $table->string('TrackerStatus'); 
            $table->string('TrackerSurahPage'); 
            $table->string('TrackerSurahAyat'); 
            $table->string('TrackerSurahJuz');  
            $table->string('TrackerDeadLine');
            $table->string('TrackerUserId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracker_record');
    }
};
