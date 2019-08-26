<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=6997f6e606ce61c92b0ff7055e105059
*/
namespace App;
/*
	arttag: controls lore.arttag

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class arttag extends \App\DURC\Models\arttag
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'excludes_arttag', //from from many
			'cardface_classofcreature_arttag', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'arttag_name', //varchar
			//'is_directed', //tinyint
			//'excludes_arttag_id', //int
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the excludes_arttag for this arttag in arttag
*       but you can extend or override the defaults by editing this function...
*/
	public function excludes_arttag(){
		return parent::excludes_arttag();
	}


/**
*	DURC is handling the cardface_classofcreature_arttag for this arttag in arttag
*       but you can extend or override the defaults by editing this function...
*/
	public function cardface_classofcreature_arttag(){
		return parent::cardface_classofcreature_arttag();
	}


//DURC BELONGS_TO SECTION

		//DURC would have added excludes_arttag but it was already used in has_many. 
		//You will have to resolve these recursive relationships in your code.


// Last generated SQL Schema
/*
CREATE TABLE `lore`.`arttag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arttag_name` varchar(255) NOT NULL,
  `is_directed` tinyint(1) NOT NULL DEFAULT 0,
  `excludes_arttag_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name` (`arttag_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end arttag