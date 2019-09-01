<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=299ca215a38268aa66dd12d3bef584dd
*/
namespace App;
/*
	creature_cardface: controls lore.creature_cardface

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class creature_cardface extends \App\DURC\Models\creature_cardface
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'cardface', //from belongs to
			'creature', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'cardface_id', //int
			//'creature_id', //int
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the cardface for this creature_cardface in creature_cardface
*       but you can extend or override the defaults by editing this function...
*/
	public function cardface(){
		return parent::cardface();
	}


/**
*	DURC is handling the creature for this creature_cardface in creature_cardface
*       but you can extend or override the defaults by editing this function...
*/
	public function creature(){
		return parent::creature();
	}




// Last generated SQL Schema
/*
CREATE TABLE `lore`.`creature_cardface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardface_id` int(11) NOT NULL,
  `creature_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `cardface_id` (`cardface_id`,`creature_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end creature_cardface