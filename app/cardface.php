<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=10469e6d425377e407b53a9eba3a1125
*/
namespace App;
/*
	cardface: controls lore.cardface

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class cardface extends \App\DURC\Models\cardface
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'card', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'card_id', //int
			//'cardface_index', //int
			//'illustration_id', //varchar
			//'artist', //varchar
			//'color', //varchar
			//'color_identity', //varchar
			//'flavor_text', //varchar
			//'image_uri', //varchar
			//'mana_cost', //varchar
			//'name', //varchar
			//'oracle_text', //varchar
			//'power', //varchar
			//'type_line', //varchar
			//'border_color', //varchar
			//'is_foil', //tinyint
			//'is_nonfoil', //tinyint
			//'is_oversized', //tinyint
			//'is_color_green', //tinyint
			//'is_color_red', //tinyint
			//'is_color_blue', //tinyint
			//'is_color_black', //tinyint
			//'is_color_white', //tinyint
			//'is_colorless', //tinyint
			//'color_count', //int
			//'is_snow', //tinyint
			//'has_phyrexian_mana', //tinyint
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the card for this cardface in cardface
*       but you can extend or override the defaults by editing this function...
*/
	public function card(){
		return parent::card();
	}




// Last generated SQL Schema
/*
CREATE TABLE `lore`.`cardface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_id` int(11) NOT NULL,
  `cardface_index` int(11) NOT NULL,
  `illustration_id` varchar(255) NOT NULL,
  `artist` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `color_identity` varchar(255) DEFAULT NULL,
  `flavor_text` varchar(1000) DEFAULT NULL,
  `image_uri` varchar(255) NOT NULL,
  `mana_cost` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `oracle_text` varchar(1000) NOT NULL,
  `power` varchar(255) DEFAULT NULL,
  `type_line` varchar(255) NOT NULL,
  `border_color` varchar(255) NOT NULL,
  `is_foil` tinyint(1) NOT NULL,
  `is_nonfoil` tinyint(1) NOT NULL,
  `is_oversized` tinyint(1) NOT NULL DEFAULT 0,
  `is_color_green` tinyint(1) NOT NULL,
  `is_color_red` tinyint(1) NOT NULL,
  `is_color_blue` tinyint(1) NOT NULL,
  `is_color_black` tinyint(1) NOT NULL,
  `is_color_white` tinyint(1) NOT NULL,
  `is_colorless` tinyint(1) NOT NULL,
  `color_count` int(11) NOT NULL DEFAULT 0,
  `is_snow` tinyint(1) NOT NULL,
  `has_phyrexian_mana` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1
*/

	//your stuff goes here..
	

}//end cardface