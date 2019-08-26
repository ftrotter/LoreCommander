<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=f043b1a51a6cd15ddc638c0abdc2f198
*/
namespace App;
/*
	classofcreature_creature: controls lore.classofcreature_creature

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class classofcreature_creature extends \App\DURC\Models\classofcreature_creature
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'classofcreature', //from belongs to
			'creature', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'classofcreature_id', //int
			//'creature_id', //int
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the classofcreature for this classofcreature_creature in classofcreature_creature
*       but you can extend or override the defaults by editing this function...
*/
	public function classofcreature(){
		return parent::classofcreature();
	}


/**
*	DURC is handling the creature for this classofcreature_creature in classofcreature_creature
*       but you can extend or override the defaults by editing this function...
*/
	public function creature(){
		return parent::creature();
	}




// Last generated SQL Schema
/*
CREATE TABLE `lore`.`classofcreature_creature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classofcreature_id` int(11) NOT NULL,
  `creature_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `classofcreature_id` (`classofcreature_id`,`creature_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end classofcreature_creature