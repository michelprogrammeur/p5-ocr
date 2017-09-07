<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('taxref_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('matureStage');
            $table->string('plumage');
            $table->string('nidification');
            $table->integer('quantity');
            $table->date('dateAt');
            $table->time('hourAt');
            $table->string('department');
            $table->string('latitude');
            $table->string('longitude');
            $table->text('comment')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->foreign('taxref_id')->references('id')->on('taxref')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->dateTime('publishedAt');
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
        Schema::dropIfExists('observations');
    }
}
