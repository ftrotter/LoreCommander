<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScryFallAPIProxy extends Controller
{
    

	public function cardFromMulti($multiverse_id){

		if(!is_numeric($multiverse_id)){
			return response()->json(['result' => 'error', 'error_msg' => 'non-numeric identifier provided instead of multiverse_id']);
		}

		//get the original data from scryfall..
		$scryfall_api = 'https://api.scryfall.com/cards/multiverse/' . $multiverse_id; 
		$scryfall_json = file_get_contents($scryfall_api);
		$scryfall_data = json_decode($scryfall_json,true);

		


		return response()->json($scryfall_data);


	}



}
