<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=417440b574a186290b2215df9199d1e9
*/
namespace App;
/*
	classofcreature_cardface: controls lore.classofcreature_cardface

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class classofcreature_cardface extends \App\DURC\Models\classofcreature_cardface
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'cardface', //from belongs to
			'classofcreature', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'cardface_id', //int
			//'classofcreature_id', //int
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the cardface for this classofcreature_cardface in classofcreature_cardface
*       but you can extend or override the defaults by editing this function...
*/
	public function cardface(){
		return parent::cardface();
	}


/**
*	DURC is handling the classofcreature for this classofcreature_cardface in classofcreature_cardface
*       but you can extend or override the defaults by editing this function...
*/
	public function classofcreature(){
		return parent::classofcreature();
	}




// Last generated SQL Schema
/*
CREATE TABLE `lore`.`classofcreature_cardface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardface_id` int(11) NOT NULL,
  `classofcreature_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `cardface_id` (`cardface_id`,`classofcreature_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end classofcreature_cardface