<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=66036c99f8e16760ae6a363aa1ab2a4c
*/
namespace App;
/*
	classofcreature: controls lore.classofcreature

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class classofcreature extends \App\DURC\Models\classofcreature
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
			'cardface_classofcreature_atag', //from from many
			'classofcreature_cardface', //from from many
			'classofcreature_creature', //from from many
			'person_classofcreature_tag', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'classofcreature_name', //varchar
			//'classofcreature_img_uri', //varchar
			//'classofcreature_wiki_url', //varchar
			//'is_mega_class', //tinyint
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the cardface_classofcreature_atag for this classofcreature in classofcreature
*       but you can extend or override the defaults by editing this function...
*/
	public function cardface_classofcreature_atag(){
		return parent::cardface_classofcreature_atag();
	}


/**
*	DURC is handling the classofcreature_cardface for this classofcreature in classofcreature
*       but you can extend or override the defaults by editing this function...
*/
	public function classofcreature_cardface(){
		return parent::classofcreature_cardface();
	}


/**
*	DURC is handling the classofcreature_creature for this classofcreature in classofcreature
*       but you can extend or override the defaults by editing this function...
*/
	public function classofcreature_creature(){
		return parent::classofcreature_creature();
	}


/**
*	DURC is handling the person_classofcreature_tag for this classofcreature in classofcreature
*       but you can extend or override the defaults by editing this function...
*/
	public function person_classofcreature_tag(){
		return parent::person_classofcreature_tag();
	}


//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships


// Last generated SQL Schema
/*
CREATE TABLE `lore`.`classofcreature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classofcreature_name` varchar(255) NOT NULL,
  `classofcreature_img_uri` varchar(255) DEFAULT NULL,
  `classofcreature_wiki_url` varchar(255) DEFAULT NULL,
  `is_mega_class` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `creatureclass_name` (`classofcreature_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end classofcreature