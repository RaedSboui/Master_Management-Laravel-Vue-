<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidaciesTable extends Migration
{
    public function up()
    {
        Schema::create('candidacies', function (Blueprint $table) {
            $table->id();
            $table->string('identity')->unique();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('maidenName')->nullable();
            $table->string('gender')->nullable();
            $table->string('dateOfBirth');
            $table->string('placeOfBirth');
            $table->string('nationality');
            //location
            $table->string('address');
            $table->string('country');
            $table->string('government');
            $table->string('city');
            $table->string('postalCode');
            $table->string('phone')->unique();
            $table->string('email')->unique();

            $table->float('sfe')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('candidacies');
    }
}
