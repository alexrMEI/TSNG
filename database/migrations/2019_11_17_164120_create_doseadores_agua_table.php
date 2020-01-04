<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoseadoresAguaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doseadores_agua', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('temperatura', 10, 2);
            $table->double('quantidade', 10, 2);
            $table->string('identificador', 191)->default('');
            $table->string('last_update', 191)->nullable();
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
        Schema::dropIfExists('doseadores_agua');
    }
}
