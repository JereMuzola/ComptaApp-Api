<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompteDivisionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compte_divisionnaires', function (Blueprint $table) {
            $table->string('numero_compte_div',5);
            $table->primary('numero_compte_div');
            $table->string('libelle',200)->unique();
            $table->string('compte',5);
            $table->foreign('compte')->references('numero_compte')->on('comptes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compte_divisionnaires');
    }
}
