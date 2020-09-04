<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->string('ref_op',5);
            $table->float('montant');
            $table->float('taux_du_jour');
            $table->string('sens');
            $table->text('motif');
            $table->date('date_op');
            $table->string('journal',3);
            $table->string('um',2);
            $table->string('sous_compte_op',10);
            $table->foreign('journal')->references('code_journal')->on('journals');
            $table->foreign('um')->references('numero')->on('unite_monetaires');
            $table->foreign('sous_compte_op')->references('numero')->on('sous_comptes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operations');
    }
}
