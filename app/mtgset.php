<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=25a3729402d108aab5c244810e3fac0e
*/
namespace App;
/*
	mtgset: controls lore.mtgset

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class mtgset extends \App\DURC\Models\mtgset
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'scryfall_identifier', //varchar
			//'code', //varchar
			//'mtgo_code', //varchar
			//'tcgplayer_id', //int
			//'name', //varchar
			//'set_type', //varchar
			//'released_at', //varchar
			//'block_code', //varchar
			//'block', //varchar
			//'parenth_set_code', //varchar
			//'card_count', //int
			//'is_digital', //tinyint
			//'is_foil_only', //tinyint
			//'scryfall_url', //varchar
			//'set_url', //varchar
			//'icon_svg_url', //varchar
			//'search_url', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships


// Last generated SQL Schema
/*
CREATE TABLE `lore`.`mtgset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scryfall_identifier` varchar(255) NOT NULL,
  `code` varchar(5) NOT NULL,
  `mtgo_code` varchar(255) DEFAULT NULL,
  `tcgplayer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `set_type` varchar(255) NOT NULL,
  `released_at` varchar(255) NOT NULL,
  `block_code` varchar(255) NOT NULL,
  `block` varchar(255) NOT NULL,
  `parenth_set_code` varchar(255) NOT NULL,
  `card_count` int(11) NOT NULL,
  `is_digital` tinyint(1) NOT NULL,
  `is_foil_only` tinyint(1) NOT NULL,
  `scryfall_url` varchar(255) NOT NULL,
  `set_url` varchar(255) NOT NULL,
  `icon_svg_url` varchar(255) NOT NULL,
  `search_url` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1
*/

	//your stuff goes here..
	

}//end mtgset