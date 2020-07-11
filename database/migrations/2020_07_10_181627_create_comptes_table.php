<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comptes', function (Blueprint $table) {
            $table->string('numero_compte',5);
            $table->primary('numero_compte');
            $table->string('libelle',200);
            $table->string('classe',2);
            $table->index('classe');
            $table->foreign('classe')->references('code')->on('classes');
            $table->string('sorte_compte',2);
            $table->index('sorte_compte');
            $table->foreign('sorte_compte')->references('numero')->on('sorte_comptes');
            $table->string('type_compte',2);
            $table->index('type_compte');
            $table->foreign('type_compte')->references('numero')->on('type_comptes');
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
        Schema::dropIfExists('comptes');
    }
}
