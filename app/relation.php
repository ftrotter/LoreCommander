<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=196eceb9f58f4b07411b1225596d4c82
*/
namespace App;
/*
	relation: controls lore.relation

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class relation extends \App\DURC\Models\relation
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
			//'relation_name', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the person_creature_relation for this relation in relation
*       but you can extend or override the defaults by editing this function...
*/
	public function person_creature_relation(){
		return parent::person_creature_relation();
	}


//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships


// Last generated SQL Schema
/*
CREATE TABLE `lore`.`relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `relation_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1
*/

	//your stuff goes here..
	

}//end relation