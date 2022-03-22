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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('caracteristiques');
            $table->string('designation');
            $table->string('marque');
            $table->string('reference');
            $table->string('qtestock');
            $table->string('prixAchat');
            $table->string('prixVente');
            $table->string('prixSolde');
            $table->string('imageartpetitf');
            $table->string('imageartgrandf');
            $table->unsignedBigInteger('categorieID');
            $table->foreign('categorieID')
            ->references('id')
            ->on('categories')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->unsignedBigInteger('scategorieID');
            $table->foreign('scategorieID')
            ->references('id')
            ->on('scategories')
            ->onDelete('restrict')
            ->onUpdate('restrict');
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
        Schema::dropIfExists('articles');
    }
};
