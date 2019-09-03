<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=876f3cee61071ef2388f2bbb277685f8
*/
namespace App;
/*
	person: controls lore.person

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class person extends \App\DURC\Models\person
{
	//this controls what is downloaded in the json for this object under card_body.. 
	//this function returns the html snippet that should be loaded for the summary of this object in a bootstrap card
	//read about the structure here: https://getbootstrap.com/docs/4.3/components/card/
	//this function should return an html snippet to go in the first 'card-body' div of an HTML interface...
	public function getCardBody() {

		$my_name = "$this->first_name $this->last_name";
		$ue_first_name = urlencode($this->first_name);
		$person_blurb = $this->person_blurb;
		
		$link_fields = [
			'MTG Wiki' => $this->mtgwiki_url,
			'WOtC Story' => $this->wizards_story_url,
			'Scryfall Search' => "https://scryfall.com/search?q=$ue_first_name",
			'Wallpaper' => $this->wallpaper_download_url,
		];
		$li_html = '';
		foreach($link_fields as $label => $url){
			if(!is_null($url)){
				$li_html .= "<li class='list-group-item'><a target='_blank' href='$url'>$label</a>";
			}
		}

		$html  =  "
    <h5 class='card-title'>$my_name</h5>
    <p class='card-text'>
$person_blurb
</p>
  </div>
  <ul class='list-group list-group-flush'>
	$li_html
  </ul>
  <div class='card-body'>
";

		return($html);

	}


	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'cardface_person_atag', //from from many
			'person_classofcreature_tag', //from from many
			'person_creature_tag', //from from many
			'person_strategy_strategytag', //from from many
			'person_strategy_tag', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'last_name', //varchar
			//'first_name', //varchar
			//'image_uri', //varchar
			//'wallpaper_download_url', //varchar
			//'mtgwiki_url', //varchar
			//'wizards_story_url', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the cardface_person_atag for this person in person
*       but you can extend or override the defaults by editing this function...
*/
	public function cardface_person_atag(){
		return parent::cardface_person_atag();
	}


/**
*	DURC is handling the person_classofcreature_tag for this person in person
*       but you can extend or override the defaults by editing this function...
*/
	public function person_classofcreature_tag(){
		return parent::person_classofcreature_tag();
	}


/**
*	DURC is handling the person_creature_tag for this person in person
*       but you can extend or override the defaults by editing this function...
*/
	public function person_creature_tag(){
		return parent::person_creature_tag();
	}


/**
*	DURC is handling the person_strategy_strategytag for this person in person
*       but you can extend or override the defaults by editing this function...
*/
	public function person_strategy_strategytag(){
		return parent::person_strategy_strategytag();
	}


/**
*	DURC is handling the person_strategy_tag for this person in person
*       but you can extend or override the defaults by editing this function...
*/
	public function person_strategy_tag(){
		return parent::person_strategy_tag();
	}


//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships


// Last generated SQL Schema
/*
CREATE TABLE `lore`.`person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `image_uri` varchar(255) DEFAULT NULL,
  `wallpaper_download_url` varchar(500) DEFAULT NULL,
  `mtgwiki_url` varchar(255) DEFAULT NULL,
  `wizards_story_url` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `last_name` (`last_name`,`first_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8
*/

	//your stuff goes here..
	

}//end person
