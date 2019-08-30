<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=f90c9308ba593791b3f523c10f877c8b
*/
namespace App;
/*
	person_classofcreature_tag: controls lore.person_classofcreature_tag

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class person_classofcreature_tag extends \App\DURC\Models\person_classofcreature_tag
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'person', //from belongs to
			'classofcreature', //from belongs to
			'tag', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'person_id', //int
			//'classofcreature_id', //int
			//'tag_id', //int
			//'is_bulk_linker', //tinyint
			//'link_note', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the person for this person_classofcreature_tag in person_classofcreature_tag
*       but you can extend or override the defaults by editing this function...
*/
	public function person(){
		return parent::person();
	}


/**
*	DURC is handling the classofcreature for this person_classofcreature_tag in person_classofcreature_tag
*       but you can extend or override the defaults by editing this function...
*/
	public function classofcreature(){
		return parent::classofcreature();
	}


/**
*	DURC is handling the tag for this person_classofcreature_tag in person_classofcreature_tag
*       but you can extend or override the defaults by editing this function...
*/
	public function tag(){
		return parent::tag();
	}




// Last generated SQL Schema
/*
CREATE TABLE `lore`.`person_classofcreature_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `classofcreature_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `is_bulk_linker` tinyint(1) NOT NULL DEFAULT 0,
  `link_note` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `person_id` (`person_id`,`classofcreature_id`,`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end person_classofcreature_tag