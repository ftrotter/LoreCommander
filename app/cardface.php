<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=87017fc5de461825af518dd5e22f664e
*/
namespace App;
/*
	cardface: controls lore.cardface

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class cardface extends \App\DURC\Models\cardface
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
			'cardface_classofc_atag', //from from many
			'cardface_person_atag', //from from many
			'classofc_cardface', //from from many
			'creature_cardface', //from from many
			'person_classofc_cardface', //from from many
			'wincon_strategy', //from from many
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
			//'toughness', //varchar
			//'type_line', //varchar
			//'border_color', //varchar
			//'image_uri_art_crop', //varchar
			//'image_hash_art_crop', //varchar
			//'image_uri_small', //varchar
			//'image_hash_small', //varchar
			//'image_uri_normal', //varchar
			//'image_hash_normal', //varchar
			//'image_uri_large', //varchar
			//'image_hash_large', //varchar
			//'image_uri_png', //varchar
			//'image_hash_png', //varchar
			//'image_uri_border_crop', //varchar
			//'image_hash_border_crop', //varchar
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
			//'for_fulltext_search', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the cardface_classofc_atag for this cardface in cardface
*       but you can extend or override the defaults by editing this function...
*/
	public function cardface_classofc_atag(){
		return parent::cardface_classofc_atag();
	}


/**
*	DURC is handling the cardface_person_atag for this cardface in cardface
*       but you can extend or override the defaults by editing this function...
*/
	public function cardface_person_atag(){
		return parent::cardface_person_atag();
	}


/**
*	DURC is handling the classofc_cardface for this cardface in cardface
*       but you can extend or override the defaults by editing this function...
*/
	public function classofc_cardface(){
		return parent::classofc_cardface();
	}


/**
*	DURC is handling the creature_cardface for this cardface in cardface
*       but you can extend or override the defaults by editing this function...
*/
	public function creature_cardface(){
		return parent::creature_cardface();
	}


/**
*	DURC is handling the person_classofc_cardface for this cardface in cardface
*       but you can extend or override the defaults by editing this function...
*/
	public function person_classofc_cardface(){
		return parent::person_classofc_cardface();
	}


/**
*	DURC is handling the wincon_strategy for this cardface in cardface
*       but you can extend or override the defaults by editing this function...
*/
	public function wincon_strategy(){
		return parent::wincon_strategy();
	}


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
  `toughness` varchar(255) DEFAULT NULL,
  `type_line` varchar(255) NOT NULL,
  `border_color` varchar(255) NOT NULL,
  `image_uri_art_crop` varchar(500) DEFAULT 'NULL',
  `image_hash_art_crop` varchar(32) DEFAULT 'NULL',
  `image_uri_small` varchar(500) DEFAULT NULL,
  `image_hash_small` varchar(32) DEFAULT NULL,
  `image_uri_normal` varchar(500) DEFAULT NULL,
  `image_hash_normal` varchar(32) DEFAULT NULL,
  `image_uri_large` varchar(500) DEFAULT NULL,
  `image_hash_large` varchar(32) DEFAULT NULL,
  `image_uri_png` varchar(500) DEFAULT NULL,
  `image_hash_png` varchar(32) DEFAULT NULL,
  `image_uri_border_crop` varchar(500) DEFAULT NULL,
  `image_hash_border_crop` varchar(32) DEFAULT NULL,
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
  `for_fulltext_search` varchar(2000) DEFAULT '''''',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`card_id`),
  KEY `is_color_green` (`is_color_green`),
  KEY `is_color_red` (`is_color_red`),
  KEY `is_color_blue` (`is_color_blue`),
  KEY `is_color_black` (`is_color_black`),
  KEY `is_color_white` (`is_color_white`),
  KEY `is_colorless` (`is_colorless`),
  FULLTEXT KEY `artist` (`artist`),
  FULLTEXT KEY `flavor_text` (`flavor_text`),
  FULLTEXT KEY `oracle_text` (`oracle_text`),
  FULLTEXT KEY `type_line` (`type_line`),
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `for_fulltext_search` (`for_fulltext_search`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end cardface