<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=a2b79b334c3c207aec21da9b77f4a6c5
*/
namespace App;
/*
	classofcreature_copy: controls lore.classofcreature_copy

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class classofcreature_copy extends \App\DURC\Models\classofcreature_copy
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'classofcreature_name', //varchar
			//'is_mega_class', //tinyint
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships


// Last generated SQL Schema
/*
CREATE TABLE `lore`.`classofcreature_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classofcreature_name` varchar(255) NOT NULL,
  `is_mega_class` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `creatureclass_name` (`classofcreature_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end classofcreature_copy