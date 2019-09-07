<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=0fda7abed85fcd91fefe0d261d420928
*/
namespace App;
/*
	classofc_creature: controls lore.classofc_creature

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class classofc_creature extends \App\DURC\Models\classofc_creature
{
	//this controls what is downloaded in the json for this object under card_body.. 
	//this function returns the html snippet that should be loaded for the summary of this object in a bootstrap card
	//read about the structure here: https://getbootstrap.com/docs/4.3/components/card/
	//this function should return an html snippet to go in the first 'card-body' div of an HTML interface...
	public function getCardBody() {
		return parent::getCardBody(); //just use the standard one unless a user over-rides this..
	}


	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'classofc', //from belongs to
			'creature', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'classofc_id', //int
			//'creature_id', //int
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the classofc for this classofc_creature in classofc_creature
*       but you can extend or override the defaults by editing this function...
*/
	public function classofc(){
		return parent::classofc();
	}


/**
*	DURC is handling the creature for this classofc_creature in classofc_creature
*       but you can extend or override the defaults by editing this function...
*/
	public function creature(){
		return parent::creature();
	}




// Last generated SQL Schema
/*
CREATE TABLE `lore`.`classofc_creature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classofc_id` int(11) NOT NULL,
  `creature_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `classofcreature_id` (`classofc_id`,`creature_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end classofc_creature