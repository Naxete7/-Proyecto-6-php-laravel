<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parties_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player');
            $table->unsignedBigInteger('party');

            $table->foreign('player')->references('id')->on('users');
            $table->foreign('party')->references('id')->on('parties');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parties_users');
    }
};
