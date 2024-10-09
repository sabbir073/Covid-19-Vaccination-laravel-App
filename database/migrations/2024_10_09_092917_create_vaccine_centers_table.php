<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('vaccine_centers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('daily_limit'); // Number of people the center can serve per day
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vaccine_centers');
    }
};
