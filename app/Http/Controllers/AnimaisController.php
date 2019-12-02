<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Animal;
use Auth;

class AnimaisController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
    }

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
        return view('home')->with(compact('animaisArray'));
    }
}