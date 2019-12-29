<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Animal;
use App\DoseadorAgua;
use App\DoseadorComida;
use Auth;

class AnimaisController extends Controller
{
    public function addForm(){
    	return view('layouts.animal.addAnimal');
    }

    public function guardarAnimal(Request $request){
    	$animal = new Animal;

    	$animal->nome = $request->nome;
    	$animal->peso = $request->peso;
    	$animal->raca = $request->raca;
    	$animal->idade = $request->idade;
    	$animal->tipo_animal = $request->tipoAnimal;
    	$animal->user_id = Auth::user()->id;
    	$animal->doseador_agua_id = null;
    	$animal->doseador_comida_id = null;

    	$animal->save();

        $animaisArray = DB::table('animais')->where('user_id', Auth::id())->get();
        return redirect()->route('home')->with(compact('animaisArray'));
    }

    public function viewAnimal($animal){
        $animalClass = DB::table('animais')->where('id', $animal)->first();
        $doseadoresAgua = DB::table('animais')->where('doseador_agua_id', '!=', null)->where('id', '!=', $animal)->get();
        $doseadoresComida = DB::table('animais')->where('doseador_comida_id', '!=', null)->where('id', '!=', $animal)->get();
        $doseadorAguaAnimal = DB::table('doseadores_agua')->where('id', $animalClass->doseador_agua_id)->first();
        $doseadorComidaAnimal = DB::table('doseadores_comida')->where('id', $animalClass->doseador_comida_id)->first();
        return view('layouts.animal.viewAnimal')->with(compact('animalClass', 'doseadoresAgua', 'doseadoresComida', 'doseadorAguaAnimal', 'doseadorComidaAnimal'));
    }

    public function addDoseadorAgua($animal){

        $doseador = new DoseadorAgua;

        $doseador->vazio = true;
        $doseador->temperatura = 18.0;

        $doseador->save();


        DB::table('animais')->where('id', $animal)->update(['doseador_agua_id' => $doseador->id]);

        return $this->viewAnimal($animal);
    }

    public function addDoseadorComida($animal){
        $doseador = new DoseadorComida;

        $doseador->vazio = true;

        $doseador->save();

        DB::table('animais')->where('id', $animal)->update(['doseador_comida_id' => $doseador->id]);

        return $this->viewAnimal($animal);
    }

    public function updateDoseadorAgua($animal, $doseador){
        DB::table('animais')->where('id', $animal)->update(['doseador_agua_id' => $doseador]);

        return $this->viewAnimal($animal);
    }

    public function updateDoseadorComida($animal, $doseador){
        DB::table('animais')->where('id', $animal)->update(['doseador_comida_id' => $doseador]);

        return $this->viewAnimal($animal);
    }




    ///////// ## API ## /////////

    public function updateTemperaturaAgua(Request $request, $doseadorId){
        $temperatura = $request->('temperatura');
        
        if($temperatura != null){
            DB::table('doseadores_agua')->where('identificador', $doseadorId)->update(['temperatura', $temperatura]);
        }
    }

    public function updateQuantidadeAgua(Request $request, $doseadorId){
        $quantidade = $request->('quantidade');

        if ($quantidade != null){
            DB::table('doseadores_agua')->where('identificador', $doseadorId)->update(['quantidade', $quantidade]);
        }
    }

    public function updateQuantidadeComida(Request $request, $doseadorId){
        $quantidade = $request->('quantidade');

        if ($quantidade != null){
            DB::table('doseadores_comida')->where('identificador', $doseadorId)->update(['quantidade', $quantidade]);
        }
    }

    ///////// ## API ## /////////
}