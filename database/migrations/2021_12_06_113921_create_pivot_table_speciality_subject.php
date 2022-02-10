<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTableSpecialitySubject extends Migration
{
    public function up()
    {
        Schema::create('speciality_subject', function (Blueprint $table) {
            $table->foreignId('speciality_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('speciality_subject');
    }
}
