<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=4cba195e9ab1129a8b8bf18d5f2557d6
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
			'person_creature_relation', //from from many
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
*	DURC is handling the person_creature_relation for this creature in creature
*       but you can extend or override the defaults by editing this function...
*/
	public function person_creature_relation(){
		return parent::person_creature_relation();
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1
*/

	//your stuff goes here..
	

}//end creature