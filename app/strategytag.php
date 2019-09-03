<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=b02579b0f098bed0eab7d8b077ecfae3
*/
namespace App;
/*
	strategytag: controls lore.strategytag

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class strategytag extends \App\DURC\Models\strategytag
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
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'strategytag_name', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the person_strategy_strategytag for this strategytag in strategytag
*       but you can extend or override the defaults by editing this function...
*/
	public function person_strategy_strategytag(){
		return parent::person_strategy_strategytag();
	}


//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships


// Last generated SQL Schema
/*
CREATE TABLE `lore`.`strategytag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `strategytag_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end strategytag