<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoseadoresComidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doseadores_comida', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('portaAberta')->default(0);
            $table->double('luminosidade', 10, 2);
            $table->boolean('comer')->default(0);
            $table->boolean('altifalante')->default(0);
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
        Schema::dropIfExists('doseadores_comida');
    }
}
