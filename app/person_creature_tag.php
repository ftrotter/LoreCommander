<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=12eb68f30db86a64807ff0a800aef07d
*/
namespace App;
/*
	person_creature_tag: controls lore.person_creature_tag

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class person_creature_tag extends \App\DURC\Models\person_creature_tag
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'person', //from belongs to
			'creature', //from belongs to
			'tag', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'person_id', //int
			//'creature_id', //int
			//'tag_id', //int
			//'is_generic_linker', //tinyint
			//'link_note', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the person for this person_creature_tag in person_creature_tag
*       but you can extend or override the defaults by editing this function...
*/
	public function person(){
		return parent::person();
	}


/**
*	DURC is handling the creature for this person_creature_tag in person_creature_tag
*       but you can extend or override the defaults by editing this function...
*/
	public function creature(){
		return parent::creature();
	}


/**
*	DURC is handling the tag for this person_creature_tag in person_creature_tag
*       but you can extend or override the defaults by editing this function...
*/
	public function tag(){
		return parent::tag();
	}




// Last generated SQL Schema
/*
CREATE TABLE `lore`.`person_creature_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `creature_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `is_generic_linker` tinyint(1) NOT NULL DEFAULT 0,
  `link_note` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end person_creature_tag