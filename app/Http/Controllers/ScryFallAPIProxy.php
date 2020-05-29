<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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

		$best_art_img_url = $scryfall_data['image_uris']['art_crop'];

		$highres_img_sql = "
SELECT MAX(wallpaper_url) AS wallpaper_url, MAX(wallpaper.id) AS wallpaper_id   
FROM lore.mverse 
JOIN lore.cardface ON 
	cardface_id =
    cardface.id 
JOIN lore.wallpaper_illustration ON 
	wallpaper_illustration.illustration_id =
    cardface.illustration_id
JOIN lore.wallpaper ON 
	wallpaper.art_name = 
    wallpaper_illustration.wallpaper_name
JOIN wallpaper_url ON 
	wallpaper_url.wallpaper_id =
    wallpaper.id
    
WHERE `multiverse_id` = $multiverse_id AND is_highest_resolution = 1
GROUP BY multiverse_id
";			
		$high_res_wallpaper_url = false;

		$pdo = DB::connection()->getPdo();
		$result = $pdo->query($highres_img_sql);
		$rows = $result->fetchAll(\PDO::FETCH_ASSOC);

		foreach($rows as $this_row){
			$high_res_wallpaper_url = $this_row['wallpaper_url'];
		}	

		if($high_res_wallpaper_url){
			$best_art_img_url = $high_res_wallpaper_url;
		}

		$scryfall_data['best_art_img_url'] = $best_art_img_url;

		return response()->json($scryfall_data);


	}



}
