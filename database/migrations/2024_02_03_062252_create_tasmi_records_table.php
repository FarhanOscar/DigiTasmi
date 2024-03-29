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
        Schema::create('tasmi_records', function (Blueprint $table) {
            $table->id();
            $table->string('TasmiClassId');  //Class id
            $table->string('TasmiStudentId'); 
            $table->string('TasmiSurahId'); 
            $table->string('TasmiSurahPage');  
            $table->string('TasmiSurahAyat'); 
            $table->string('TasmiSurahJuz');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasmi_records');
    }
};
