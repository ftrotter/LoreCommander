<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=1ed0600e9eea7d073fca62868c32f1a2
*/
namespace App;
/*
	person: controls lore.person

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class person extends \App\DURC\Models\person
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'cardface_person_atag', //from from many
			'person_classofcreature_tag', //from from many
			'person_creature_tag', //from from many
			'person_strategy_strategytag', //from from many
			'person_strategy_tag', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'last_name', //varchar
			//'first_name', //varchar
			//'image_uri', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the cardface_person_atag for this person in person
*       but you can extend or override the defaults by editing this function...
*/
	public function cardface_person_atag(){
		return parent::cardface_person_atag();
	}


/**
*	DURC is handling the person_classofcreature_tag for this person in person
*       but you can extend or override the defaults by editing this function...
*/
	public function person_classofcreature_tag(){
		return parent::person_classofcreature_tag();
	}


/**
*	DURC is handling the person_creature_tag for this person in person
*       but you can extend or override the defaults by editing this function...
*/
	public function person_creature_tag(){
		return parent::person_creature_tag();
	}


/**
*	DURC is handling the person_strategy_strategytag for this person in person
*       but you can extend or override the defaults by editing this function...
*/
	public function person_strategy_strategytag(){
		return parent::person_strategy_strategytag();
	}


/**
*	DURC is handling the person_strategy_tag for this person in person
*       but you can extend or override the defaults by editing this function...
*/
	public function person_strategy_tag(){
		return parent::person_strategy_tag();
	}


//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships


// Last generated SQL Schema
/*
CREATE TABLE `lore`.`person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `image_uri` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `last_name` (`last_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end person