<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=5ade43a25f7e5cfa174c23a527fd7bd3
*/
namespace App;
/*
	strategy: controls lore.strategy

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class strategy extends \App\DURC\Models\strategy
{
	//this controls what is downloaded in the json for this object under card_body.. 
	//this function returns the html snippet that should be loaded for the summary of this object in a bootstrap card
	//read about the structure here: https://getbootstrap.com/docs/4.3/components/card/
	//this function should return an html snippet to go in the first 'card-body' div of an HTML interface...
	public function getCardFace() {
		return parent::getCardFace(); //just use the standard one unless a user over-rides this..
	}


	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'person_strategy_strategytag', //from from many
			'person_strategy_tag', //from from many
			'wincon_cardface', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'strategy_name', //varchar
			//'strategy_description', //varchar
			//'strategy_url', //varchar
			//'wincon_cardface_id', //int
			//'WOTC_rule_reference', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the person_strategy_strategytag for this strategy in strategy
*       but you can extend or override the defaults by editing this function...
*/
	public function person_strategy_strategytag(){
		return parent::person_strategy_strategytag();
	}


/**
*	DURC is handling the person_strategy_tag for this strategy in strategy
*       but you can extend or override the defaults by editing this function...
*/
	public function person_strategy_tag(){
		return parent::person_strategy_tag();
	}


//DURC BELONGS_TO SECTION

/**
*	DURC is handling the wincon_cardface for this strategy in strategy
*       but you can extend or override the defaults by editing this function...
*/
	public function wincon_cardface(){
		return parent::wincon_cardface();
	}




// Last generated SQL Schema
/*
CREATE TABLE `lore`.`strategy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `strategy_name` varchar(255) NOT NULL,
  `strategy_description` varchar(2000) NOT NULL,
  `strategy_url` varchar(500) NOT NULL,
  `wincon_cardface_id` int(11) DEFAULT NULL,
  `WOTC_rule_reference` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end strategy