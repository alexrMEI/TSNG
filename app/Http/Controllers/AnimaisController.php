<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Animal;
use App\DoseadorAgua;
use App\DoseadorComida;
use App\RaspberryInfo;
use Auth;
use GuzzleHttp\Psr7\Request as Psr7;

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
        $doseadoresAgua = DB::table('animais')->where('doseador_agua_id', '!=', null)->where('id', '!=', $animal)->where('user_id', Auth::id())->get();
        $doseadoresComida = DB::table('animais')->where('doseador_comida_id', '!=', null)->where('id', '!=', $animal)->where('user_id', Auth::id())->get();
        $doseadorAguaAnimal = DB::table('doseadores_agua')->where('id', $animalClass->doseador_agua_id)->first();
        $doseadorComidaAnimal = DB::table('doseadores_comida')->where('id', $animalClass->doseador_comida_id)->first();
        return view('layouts.animal.viewAnimal')->with(compact('animalClass', 'doseadoresAgua', 'doseadoresComida', 'doseadorAguaAnimal', 'doseadorComidaAnimal'));
    }

    public function deleteAnimal($id) {
        $animais = Animal::findOrFail($id);
        $animais->delete();
        return redirect()->route('home');
    }

    public function addDoseadorAgua($animal){

        $doseador = new DoseadorAgua;

        $doseador->quantidade = 0;
        $doseador->temperatura = 18.0;
        $doseador->identificador = "ESPWater_" . $this->geraCodigo();

        $doseador->save();


        DB::table('animais')->where('id', $animal)->update(['doseador_agua_id' => $doseador->id]);

        $raspIP = DB::table('users')->select('raspberry_ip')->where('id', Auth::id())->first();
        if($raspIP->raspberry_ip != null && $raspIP->raspberry_ip != ""){
            $client = new \GuzzleHttp\Client();
            $url = "http://" . $raspIP->raspberry_ip . ":1880/idAgua";

            $r = $client->request('POST', $url, [
                'body' => $doseador->identificador
            ]);
        }
        return redirect()->route('viewAnimal', ['animal' => $animal]);
    }

    public function deleteDoseadorAgua($id) {
        $animal = Animal::findOrFail($id);
        $doseador = DoseadorAgua::findOrFail($animal->doseador_agua_id);
        $animal->doseador_agua_id = null;
        $animal->save();
        //$doseador = DoseadorAgua::findOrFail($doseador_agua_aux);
        $doseador->delete();
        
        return redirect()->route('viewAnimal', ['animal' => $id]);
    }

    public function addDoseadorComida($animal){
        $doseador = new DoseadorComida;

        $doseador->vazio = true;
        $doseador->identificador = "ESPFood_" . $this->geraCodigo(); 

        $doseador->save();

        DB::table('animais')->where('id', $animal)->update(['doseador_comida_id' => $doseador->id]);

        $raspIP = DB::table('users')->select('raspberry_ip')->where('id', Auth::id())->first();
        if($raspIP->raspberry_ip != null && $raspIP->raspberry_ip != ""){
            $client = new \GuzzleHttp\Client();
            $url = "http://" . $raspIP->raspberry_ip . ":1880/idComida";

            $r = $client->request('POST', $url, [
                'body' => $doseador->identificador
            ]);
        }

        return redirect()->route('viewAnimal', ['animal' => $animal]);
    }

    public function deleteDoseadorComida($id) {
        $animal = Animal::findOrFail($id);
        $doseador = DoseadorComida::findOrFail($animal->doseador_comida_id);
        $animal->doseador_comida_id = null;
        $animal->save();
        //$doseador = DoseadorAgua::findOrFail($doseador_agua_aux);
        $doseador->delete();
        
        return redirect()->route('viewAnimal', ['animal' => $id]);
    }

    public function updateDoseadorAgua($animal, $doseador){
        DB::table('animais')->where('id', $animal)->update(['doseador_agua_id' => $doseador]);

        return redirect()->route('viewAnimal', ['animal' => $animal]);
    }

    public function updateDoseadorComida($animal, $doseador){
        DB::table('animais')->where('id', $animal)->update(['doseador_comida_id' => $doseador]);

        return redirect()->route('viewAnimal', ['animal' => $animal]);
    }

    public function darAgua($doseador, $animal){
        $identificador = DB::table('doseadores_agua')->select('identificador')->where('id', $doseador)->first();
        $raspIP = DB::table('users')->select('raspberry_ip')->where('id', Auth::id())->first();

        if ($identificador->identificador != null && $identificador->identificador != "" && $raspIP->raspberry_ip != null && $raspIP->raspberry_ip != ""){
            $client = new \GuzzleHttp\Client();
            $url = "http://" . $raspIP->raspberry_ip . ":1880/darAgua";

            $r = $client->request('POST', $url, [
                'body' => 'Encher:' . $identificador->identificador
            ]);
            
            DB::table('doseadores_agua')->where('id', $doseador)->update(['quantidade' => 1]);
        }

        return redirect()->route('viewAnimal', ['animal' => $animal]);
    }

    public function darComida($doseador, $animal){
        $identificador = DB::table('doseadores_comida')->select('identificador')->where('id', $doseador)->first();
        $raspIP = DB::table('users')->select('raspberry_ip')->where('id', Auth::id())->first();

        if ($identificador->identificador != null && $identificador->identificador != "" && $raspIP->raspberry_ip != null && $raspIP->raspberry_ip != ""){
            $client = new \GuzzleHttp\Client();
            $url = "http://" . $raspIP->raspberry_ip . ":1880/darComida";

            $r = $client->request('POST', $url, [
                'body' => 'Encher:' . $identificador->identificador
            ]);
        }

        return redirect()->route('viewAnimal', ['animal' => $animal]);
    }

    ///////// ## API ## /////////
    public function updateTemperaturaAgua(Request $request, $doseadorId){
        $temperatura = $request->temperatura;
        $lastUpdate = $request->timestamp;
        
        if($temperatura != null){
            DB::table('doseadores_agua')
            ->where('identificador', $doseadorId)
            ->update(['temperatura' => $temperatura, 'last_update' => $lastUpdate]);
        }
    }

    public function updateQuantidadeAgua(Request $request, $doseadorId){
        $quantidade = $request->quantidade;

        if ($quantidade != null){
            DB::table('doseadores_agua')
            ->where('identificador', $doseadorId)
            ->update(['quantidade' => $quantidade]);
        }
    }

    public function updateQuantidadeComida(Request $request, $doseadorId){
        $quantidade = $request->quantidade;

        if ($quantidade != null){
            DB::table('doseadores_comida')
            ->where('identificador', $doseadorId)
            ->update(['quantidade' => $quantidade]);
        }
    }

    public function identifiers(Request $request){
        $rpiIP = $request->rpiIP;
        $key = $request->rpiID;

        if(!DB::table('raspberry_info')->where('key', $key)->count()){
            $raspInfo = new RaspberryInfo;
            $raspInfo->rasp_ip = $rpiIP;
            $raspInfo->key = $key;
            $raspInfo->save();
        }
    }
    ///////// ## API ## /////////

    public function geraCodigo(){
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($permitted_chars), 0, 8);
    }

    public function infoSistema(Request $request){
        $key = $request->key;

        if($key != null && $key != ""){
            if(DB::table('raspberry_info')->where('key', $key)->count()){
                $raspIP = DB::table('raspberry_info')->where('key', $key)->select('rasp_ip')->first();

                DB::table('users')->where('id', Auth::id())->update(['raspberry_ip' => $raspIP->rasp_ip]);

                DB::table('raspberry_info')->where('key', $key)->delete();
            }
        }

        $animaisArray = DB::table('animais')->where('user_id', Auth::id())->get();
        return redirect()->route('home')->with(compact('animaisArray'));
    }
}