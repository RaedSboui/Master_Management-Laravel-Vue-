<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudiesTable extends Migration
{
    public function up()
    {
        Schema::create('studies', function (Blueprint $table) {
            $table->id();
            $table->integer('baccalaureateYear');
            $table->float('baccalaureateAverage');
            $table->integer('nbOfRepetitionsFromBaccalaureate');
            $table->boolean('preparatory');
            $table->integer('nbOfRepetitionsInPreparatory');
            $table->integer('nbOfRegistrationWithdrawals');
            $table->integer('yearOfGraduation');
            $table->string('professionalSituation');
            $table->integer('numberOfInternships');

            //other
            $table->string('otherEstablishment')->nullable();
            $table->string('otherSpeciality')->nullable();

            //RelationsShips
            $table->unsignedBigInteger('candidacy_id');
            $table->foreign('candidacy_id')->references('id')->on('candidacies')->onDelete('cascade');

            $table->unsignedBigInteger('speciality_id')->nullable();
            $table->foreign('speciality_id')->references('id')->on('specialities')->onDelete('cascade');

            $table->unsignedBigInteger('diploma_id');
            $table->foreign('diploma_id')->references('id')->on('diplomas')->onDelete('cascade');
            
            $table->unsignedBigInteger('establishment_id')->nullable();
            $table->foreign('establishment_id')->references('id')->on('establishments')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('studies');
    }
}
