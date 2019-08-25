<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=4481c74cdf5f0beec1a95a022f13b78f
*/
namespace App;
/*
	creature: controls lore.creature

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class creature extends \App\DURC\Models\creature
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'person_creature_tag', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'creature_name', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the person_creature_tag for this creature in creature
*       but you can extend or override the defaults by editing this function...
*/
	public function person_creature_tag(){
		return parent::person_creature_tag();
	}


//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships


// Last generated SQL Schema
/*
CREATE TABLE `lore`.`creature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creature_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `creature_name` (`creature_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end creature