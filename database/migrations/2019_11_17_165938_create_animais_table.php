<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 191);
            $table->double('peso', 10, 2); 
            $table->string('raca', 191);
            $table->unsignedInteger('idade');
            $table->string('tipo_animal', 191);
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('doseador_agua_id');
            $table->foreign('doseador_agua_id')->references('id')->on('doseadores_agua');

            $table->unsignedBigInteger('doseador_comida_id');
            $table->foreign('doseador_comida_id')->references('id')->on('doseadores_comida');
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
        Schema::dropIfExists('animais');
    }
}
