<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=cfde3d73531da593d91d7734efe6f4a3
*/
namespace App;
/*
	cardface_classofcreature_arttag: controls lore.cardface_classofcreature_arttag

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class cardface_classofcreature_arttag extends \App\DURC\Models\cardface_classofcreature_arttag
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'cardface', //from belongs to
			'classofcreature', //from belongs to
			'arttag', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'cardface_id', //int
			//'classofcreature_id', //int
			//'arttag_id', //int
			//'is_bulk_linker', //tinyint
			//'link_note', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the cardface for this cardface_classofcreature_arttag in cardface_classofcreature_arttag
*       but you can extend or override the defaults by editing this function...
*/
	public function cardface(){
		return parent::cardface();
	}


/**
*	DURC is handling the classofcreature for this cardface_classofcreature_arttag in cardface_classofcreature_arttag
*       but you can extend or override the defaults by editing this function...
*/
	public function classofcreature(){
		return parent::classofcreature();
	}


/**
*	DURC is handling the arttag for this cardface_classofcreature_arttag in cardface_classofcreature_arttag
*       but you can extend or override the defaults by editing this function...
*/
	public function arttag(){
		return parent::arttag();
	}




// Last generated SQL Schema
/*
CREATE TABLE `lore`.`cardface_classofcreature_arttag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardface_id` int(11) NOT NULL,
  `classofcreature_id` int(11) NOT NULL,
  `arttag_id` int(11) NOT NULL,
  `is_bulk_linker` tinyint(1) NOT NULL DEFAULT 0,
  `link_note` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cardface_id` (`cardface_id`,`classofcreature_id`,`arttag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end cardface_classofcreature_arttag