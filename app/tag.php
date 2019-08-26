<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=6d708ba6d7c439335447b3c4a81cc3b6
*/
namespace App;
/*
	tag: controls lore.tag

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class tag extends \App\DURC\Models\tag
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'person_creature_tag', //from from many
			'person_strategy_tag', //from from many
			'excludes_tag', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'tag_name', //varchar
			//'is_directed', //tinyint
			//'excludes_tag_id', //int
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the person_creature_tag for this tag in tag
*       but you can extend or override the defaults by editing this function...
*/
	public function person_creature_tag(){
		return parent::person_creature_tag();
	}


/**
*	DURC is handling the person_strategy_tag for this tag in tag
*       but you can extend or override the defaults by editing this function...
*/
	public function person_strategy_tag(){
		return parent::person_strategy_tag();
	}


/**
*	DURC is handling the excludes_tag for this tag in tag
*       but you can extend or override the defaults by editing this function...
*/
	public function excludes_tag(){
		return parent::excludes_tag();
	}


//DURC BELONGS_TO SECTION

		//DURC would have added excludes_tag but it was already used in has_many. 
		//You will have to resolve these recursive relationships in your code.


// Last generated SQL Schema
/*
CREATE TABLE `lore`.`tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) NOT NULL,
  `is_directed` tinyint(1) NOT NULL DEFAULT 0,
  `excludes_tag_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name` (`tag_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end tag