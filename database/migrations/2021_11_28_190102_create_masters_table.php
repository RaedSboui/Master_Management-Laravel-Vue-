<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMastersTable extends Migration
{
    public function up()
    {
        Schema::create('masters', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->unique();
            $table->boolean('isActive')->default(true);
            $table->longText('description');
            $table->string('createdBy', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('masters');
    }
}
