<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=9e662ecf634454ed524ffbfbf38b2211
*/
namespace App;
/*
	cardprice: controls lore.cardprice

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class cardprice extends \App\DURC\Models\cardprice
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
			'card', //from belongs to
			'pricetype', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //bigint
			//'card_id', //int
			//'scryfall_id', //varchar
			//'pricetype_id', //int
			//'price', //decimal
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the card for this cardprice in cardprice
*       but you can extend or override the defaults by editing this function...
*/
	public function card(){
		return parent::card();
	}


/**
*	DURC is handling the pricetype for this cardprice in cardprice
*       but you can extend or override the defaults by editing this function...
*/
	public function pricetype(){
		return parent::pricetype();
	}




// Last generated SQL Schema
/*
CREATE TABLE `lore`.`cardprice` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `card_id` int(11) NOT NULL,
  `scryfall_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pricetype_id` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `card_id` (`card_id`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
*/

	//your stuff goes here..
	

}//end cardprice