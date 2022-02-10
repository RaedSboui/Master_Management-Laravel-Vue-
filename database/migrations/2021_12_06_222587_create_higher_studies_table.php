<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHigherStudiesTable extends Migration
{
    public function up()
    {
        Schema::create('higher_studies', function (Blueprint $table) {
            $table->id();
            $table->string('schoolYear');
            $table->integer('level');
            $table->string('continuingStudies');
            $table->float('mean');
            $table->float('credit')->nullable();
            $table->integer('redouble');
            $table->string('mention');
            $table->string('session');

            //RelationsShips
            $table->unsignedBigInteger('candidacy_id');
            $table->foreign('candidacy_id')->references('id')->on('candidacies')->onDelete('cascade');
            $table->unsignedBigInteger('establishment_id')->nullable();
            $table->foreign('establishment_id')->references('id')->on('establishments')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('higher_studies');
    }
}
