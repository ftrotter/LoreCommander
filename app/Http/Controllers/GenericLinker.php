<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GenericLinker extends Controller
{

	public function linkSaver(Request $request, $durc_type_left,$durc_type_right,$durc_type_tag){


		$link_table = $durc_type_left."_$durc_type_right"."_$durc_type_tag";
	
		$left_ids = $request->input($durc_type_left."_id");
		$right_ids = $request->input($durc_type_right."_id");
		$tag_ids = $request->input($durc_type_tag."_id");
		$link_note = $request->input('link_note');


		$left_id = $durc_type_left."_id";
		$right_id = $durc_type_right."_id";
		$tag_id = $durc_type_tag."_id";

		$total_links_created = 0;
		
		foreach($left_ids as $this_left_id){
			foreach($right_ids as $this_right_id){
				foreach($tag_ids as $this_tag_id){
	
					
					$link_array = [
						$left_id => $this_left_id,
						$right_id => $this_right_id,
						$tag_id => $this_tag_id,
						'is_bulk_linker' => 1,
						'link_note' => $link_note,							
					];

					$class_name = "\App\\$link_table";

					$linker_object = $class_name::firstOrCreate($link_array);
	
					$total_links_created++;

				}
			}
		}


		return("Created $total_links_created");



	}



	public function linkForm($durc_type_left,$durc_type_right,$durc_type_tag){



		if(!class_exists("\App\\$durc_type_left")){
			return("Error $durc_type_left does not exist");
		}
		if(!class_exists("\App\\$durc_type_right")){
			return("Error $durc_type_right does not exist");
		}
		if(!class_exists("\App\\$durc_type_tag")){
			return("Error $durc_type_tag does not exist");
		}

		$pdo = \DB::connection()->getPdo();

		$db = \Config::get('database.connections.'.\Config::get('database.default').'.database');
		$db = 'lore';

		$pdo->query("USE $db");


		$link_table = $durc_type_left."_$durc_type_right"."_$durc_type_tag";

		if(!class_exists("\App\\$link_table")){
			//so the class does not exist yet. Thats fine.
			//we support autolinking as long as the left, right and tag tables exist...
			//so see if we have a database table.
		
			$create_table_sql = "
CREATE TABLE IF NOT EXISTS $db.$link_table  ( 
	`id` INT(11) NOT NULL AUTO_INCREMENT ,  
	`$durc_type_left"."_id` INT(11) NOT NULL ,  
	`$durc_type_right"."_id` INT(11) NOT NULL ,  
	`$durc_type_tag"."_id` INT(11) NOT NULL ,  
	`is_bulk_linker` TINYINT(1) NOT NULL DEFAULT '0' ,  
	`link_note` VARCHAR(255) NOT NULL ,  
	`created_at` DATETIME NOT NULL ,  
	`updated_at` DATETIME NOT NULL ,    
	PRIMARY KEY  (`id`)) ENGINE = MyISAM 
;
";

			// this is horribly risky from a security standpoint... leading to obvious DOS
			//instead we throw this back to the user...
			//$pdo->query($create_table_sql);
			return view('create_table',['create_table_sql' => $create_table_sql]);	
		}

		//here we know that we have DURC classes for all 4 of the relevant data contructs...
		//the list of tags, the object that sits to the right and the left of the tag relation...
		//we are ready to show the Select2 heavy interface that will allow for really fast tagging...
		
		$view_data = [
			'durc_type_left' => $durc_type_left,
			'durc_type_right' => $durc_type_right,
			'durc_type_tag' => $durc_type_tag,
			'durc_linker' => $link_table,
		];

		return view('genericLinker',$view_data);

	}

}
