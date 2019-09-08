<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=93c3c179609dac9c456ee8f264a12968
*/
namespace App;
/*
	pack: controls lore.pack

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class pack extends \App\DURC\Models\pack
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
			//'pack_name', //varchar
			//'pack_wizards_url', //varchar
			//'pack_wiki_url', //varchar
			//'pack_img_url', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships


// Last generated SQL Schema
/*
CREATE TABLE `lore`.`pack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pack_name` varchar(255) NOT NULL,
  `pack_wizards_url` varchar(2000) NOT NULL,
  `pack_wiki_url` varchar(2000) NOT NULL,
  `pack_img_url` varchar(2000) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end pack