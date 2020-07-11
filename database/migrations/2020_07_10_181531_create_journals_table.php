<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->string('code_journal',3);
            $table->primary('code_journal');
            $table->string('exercice',3);
            $table->index('exercice');
            $table->foreign('exercice')->references('num_exercice')->on('exercices');
            $table->string('activite',2);
            $table->index('activite');
            $table->foreign('activite')->references('num_activite')->on('activites');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journals');
    }
}
