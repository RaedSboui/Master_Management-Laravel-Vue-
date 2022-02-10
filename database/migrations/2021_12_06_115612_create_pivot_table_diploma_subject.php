<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTableDiplomaSubject extends Migration
{
    public function up()
    {
        Schema::create('diploma_subject', function (Blueprint $table) {
            $table->foreignId('diploma_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('diploma_subject');
    }
}
