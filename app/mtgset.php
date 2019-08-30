<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=1b83122be194addd0fcac90e20186d70
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
			'card', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'scryfall_id', //varchar
			//'code', //varchar
			//'mtgo_code', //varchar
			//'tcgplayer_id', //int
			//'name', //varchar
			//'set_type', //varchar
			//'released_at', //varchar
			//'block_code', //varchar
			//'block', //varchar
			//'parent_set_code', //varchar
			//'card_count', //int
			//'is_digital', //tinyint
			//'is_foil_only', //tinyint
			//'scryfall_uri', //varchar
			//'mtgset_uri', //varchar
			//'icon_svg_uri', //varchar
			//'search_uri', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the card for this mtgset in mtgset
*       but you can extend or override the defaults by editing this function...
*/
	public function card(){
		return parent::card();
	}


//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships


// Last generated SQL Schema
/*
CREATE TABLE `lore`.`mtgset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scryfall_id` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `mtgo_code` varchar(255) DEFAULT NULL,
  `tcgplayer_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `set_type` varchar(255) NOT NULL,
  `released_at` varchar(255) NOT NULL,
  `block_code` varchar(255) DEFAULT NULL,
  `block` varchar(255) DEFAULT NULL,
  `parent_set_code` varchar(255) DEFAULT NULL,
  `card_count` int(11) NOT NULL,
  `is_digital` tinyint(1) NOT NULL,
  `is_foil_only` tinyint(1) NOT NULL,
  `scryfall_uri` varchar(255) NOT NULL,
  `mtgset_uri` varchar(255) NOT NULL,
  `icon_svg_uri` varchar(255) NOT NULL,
  `search_uri` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `scryfall_id` (`scryfall_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end mtgset