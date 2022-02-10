<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiplomasTable extends Migration
{
    public function up()
    {
        Schema::create('diplomas', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->integer('years');
            $table->integer('years_min');
            $table->boolean('credits')->default(false);
            $table->boolean('sfe')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diplomas');
    }
}
