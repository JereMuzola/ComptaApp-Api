<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExercicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('exercices', function (Blueprint $table) {
            $table->string('num_exercice',3);
            $table->primary('num_exercice');
            $table->string('libelle',25)->unique();
            $table->integer('annee')->unique();
            $table->text('commentaire');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercices');
    }
}
