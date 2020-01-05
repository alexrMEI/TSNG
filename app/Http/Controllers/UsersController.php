<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class AnimaisController extends Controller
{
	public function updateRaspberryIP(Request $request){
		//DB::table('users')->where('id', Auth::id())->update(['raspberry_ip' => $request->('raspberry_ip')]);

		//TODO: Acknowledge ip update
	}
}