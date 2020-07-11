<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSousComptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sous_comptes', function (Blueprint $table) {
            $table->string('numero',10);
            $table->primary('numero');
            $table->string('libelle');
            $table->text('description');
            $table->string('compte_divisionaire',5);
            $table->foreign('compte_divisionaire')->references('numero_compte_div')->on('compte_divisionnaires');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sous_comptes');
    }
}
