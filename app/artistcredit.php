<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=75a9a8d405b022360d8d552dfb263275
*/
namespace App;
/*
	artistcredit: controls lore.artistcredit

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class artistcredit extends \App\DURC\Models\artistcredit
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
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'artistcredit_name', //varchar
			//'is_plain_credit', //tinyint
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships


// Last generated SQL Schema
/*
CREATE TABLE `lore`.`artistcredit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artistcredit_name` varchar(255) NOT NULL,
  `is_plain_credit` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `artistcredit_name` (`artistcredit_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end artistcredit