<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxrefTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxref', function (Blueprint $table) {
            $table->increments('id');
            $table->string('regne');
            $table->string('phylum');
            $table->string('classe');
            $table->string('ordre');
            $table->string('famille');
            $table->integer('cdNom');
            $table->integer('cdTaxSup');
            $table->integer('cdRef');
            $table->string('rang');
            $table->string('lbNom');
            $table->string('lbAuteur');
            $table->string('nomComplet');
            $table->string('nomValide');
            $table->string('nomVern');
            $table->string('nomVernEng');
            $table->tinyInteger('habitat');
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
        Schema::dropIfExists('taxref');
    }
}
