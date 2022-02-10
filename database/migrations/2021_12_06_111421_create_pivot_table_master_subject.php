<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTableMasterSubject extends Migration
{
    public function up()
    {
        Schema::create('master_subject', function (Blueprint $table) {
            $table->foreignId('master_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_subject');
    }
}
