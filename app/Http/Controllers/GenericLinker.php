<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GenericLinker extends Controller
{

	public function linkMaker($durc_type_left,$durc_type_right,$link_type){



		if(!class_exists("\App\\$durc_type_left")){
			return("Error $durc_type_left does not exist");
		}
		if(!class_exists("\App\\$durc_type_right")){
			return("Error $durc_type_right does not exist");
		}
		if(!class_exists("\App\\$link_type")){
			return("Error $link_type does not exist");
		}

		$pdo = \DB::connection()->getPdo();

		$db = \Config::get('database.connections.'.\Config::get('database.default').'.database');
		$db = 'lore';

		$pdo->query("USE $db");


		$link_table = $durc_type_left."_$durc_type_right"."_$link_type";

		if(!class_exists("\App\\$link_table")){
			//so the class does not exist yet. Thats fine.
			//we support autolinking as long as the left, right and tag tables exist...
			//so see if we have a database table.
		
			$create_table_sql = "
CREATE TABLE IF NOT EXISTS $db.$link_table  ( 
	`id` INT(11) NOT NULL AUTO_INCREMENT ,  
	`$durc_type_left"."_id` INT(11) NOT NULL ,  
	`$durc_type_right"."_id` INT(11) NOT NULL ,  
	`$link_type"."_id` INT(11) NOT NULL ,  
	`is_generic_linker` TINYINT(1) NOT NULL DEFAULT '0' ,  
	`link_note` VARCHAR(255) NOT NULL ,  
	`created_at` DATETIME NOT NULL ,  
	`updated_at` DATETIME NOT NULL ,    
	PRIMARY KEY  (`id`)) ENGINE = MyISAM 
;
";

			$pdo->query($create_table_sql);
			
		}

	
		return("durc_type_left: $durc_type_left durc_type_right:$durc_type_right link_type:$link_type");

	}

}
