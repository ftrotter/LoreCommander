<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=4b45a67be4ad762b9e285e2c0aed31a7
*/
namespace App;
/*
	person_creature_relation: controls lore.person_creature_relation

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class person_creature_relation extends \App\DURC\Models\person_creature_relation
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'person', //from belongs to
			'relation', //from belongs to
			'creature', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'person_id', //int
			//'relation_id', //int
			//'creature_id', //int
			//'justification_note', //varchar
			//'justification_url', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the person for this person_creature_relation in person_creature_relation
*       but you can extend or override the defaults by editing this function...
*/
	public function person(){
		return parent::person();
	}


/**
*	DURC is handling the relation for this person_creature_relation in person_creature_relation
*       but you can extend or override the defaults by editing this function...
*/
	public function relation(){
		return parent::relation();
	}


/**
*	DURC is handling the creature for this person_creature_relation in person_creature_relation
*       but you can extend or override the defaults by editing this function...
*/
	public function creature(){
		return parent::creature();
	}




// Last generated SQL Schema
/*
CREATE TABLE `lore`.`person_creature_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `relation_id` int(11) NOT NULL,
  `creature_id` int(11) NOT NULL,
  `justification_note` varchar(1000) NOT NULL,
  `justification_url` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `person_id` (`person_id`,`relation_id`,`creature_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1
*/

	//your stuff goes here..
	

}//end person_creature_relation