<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=1312a11b087fab9622e2b3dd75047ded
*/
namespace App;
/*
	person_strategy_strategytag: controls lore.person_strategy_strategytag

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class person_strategy_strategytag extends \App\DURC\Models\person_strategy_strategytag
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'person', //from belongs to
			'strategy', //from belongs to
			'strategytag', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'person_id', //int
			//'strategy_id', //int
			//'strategytag_id', //int
			//'is_bulk_linker', //tinyint
			//'link_note', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the person for this person_strategy_strategytag in person_strategy_strategytag
*       but you can extend or override the defaults by editing this function...
*/
	public function person(){
		return parent::person();
	}


/**
*	DURC is handling the strategy for this person_strategy_strategytag in person_strategy_strategytag
*       but you can extend or override the defaults by editing this function...
*/
	public function strategy(){
		return parent::strategy();
	}


/**
*	DURC is handling the strategytag for this person_strategy_strategytag in person_strategy_strategytag
*       but you can extend or override the defaults by editing this function...
*/
	public function strategytag(){
		return parent::strategytag();
	}




// Last generated SQL Schema
/*
CREATE TABLE `lore`.`person_strategy_strategytag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `strategy_id` int(11) NOT NULL,
  `strategytag_id` int(11) NOT NULL,
  `is_bulk_linker` tinyint(1) NOT NULL DEFAULT 0,
  `link_note` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `person_id` (`person_id`,`strategy_id`,`strategytag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end person_strategy_strategytag