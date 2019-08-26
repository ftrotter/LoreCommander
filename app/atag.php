<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=da7233429a69763d64957ca022491479
*/
namespace App;
/*
	atag: controls lore.atag

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class atag extends \App\DURC\Models\atag
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
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
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships


// Last generated SQL Schema
/*
CREATE TABLE `lore`.`atag` (
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
	

}//end atag