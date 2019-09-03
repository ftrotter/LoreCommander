<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=ed7eaae91775bea40075519ca4116f7c
*/
namespace App;
/*
	atag: controls lore.atag

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class atag extends \App\DURC\Models\atag
{
	//this controls what is downloaded in the json for this object under card_body.. 
	//this function returns the html snippet that should be loaded for the summary of this object in a bootstrap card
	//read about the structure here: https://getbootstrap.com/docs/4.3/components/card/
	//this function should return an html snippet to go in the first 'card-body' div of an HTML interface...
	public function getCardFace() {
		return parent::getCardFace(); //just use the standard one unless a user over-rides this..
	}


	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'cardface_classofcreature_atag', //from from many
			'cardface_person_atag', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'arttag_name', //varchar
			//'is_directed', //tinyint
			//'excludes_arttag_id', //int
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the cardface_classofcreature_atag for this atag in atag
*       but you can extend or override the defaults by editing this function...
*/
	public function cardface_classofcreature_atag(){
		return parent::cardface_classofcreature_atag();
	}


/**
*	DURC is handling the cardface_person_atag for this atag in atag
*       but you can extend or override the defaults by editing this function...
*/
	public function cardface_person_atag(){
		return parent::cardface_person_atag();
	}


//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships


// Last generated SQL Schema
/*
CREATE TABLE `lore`.`atag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arttag_name` varchar(255) NOT NULL,
  `is_directed` tinyint(1) NOT NULL DEFAULT 0,
  `excludes_arttag_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name` (`arttag_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end atag