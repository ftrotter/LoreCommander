<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=e21c709b37a43fa2c8ab455068503cea
*/
namespace App;
/*
	classofc_cardface: controls lore.classofc_cardface

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class classofc_cardface extends \App\DURC\Models\classofc_cardface
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
			'cardface', //from belongs to
			'classofc', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'cardface_id', //int
			//'classofc_id', //int
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the cardface for this classofc_cardface in classofc_cardface
*       but you can extend or override the defaults by editing this function...
*/
	public function cardface(){
		return parent::cardface();
	}


/**
*	DURC is handling the classofc for this classofc_cardface in classofc_cardface
*       but you can extend or override the defaults by editing this function...
*/
	public function classofc(){
		return parent::classofc();
	}




// Last generated SQL Schema
/*
CREATE TABLE `lore`.`classofc_cardface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardface_id` int(11) NOT NULL,
  `classofc_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `cardface_id` (`cardface_id`,`classofc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end classofc_cardface