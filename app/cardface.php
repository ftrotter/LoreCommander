<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=60b30e0b07df02b8bdcdd093441eda23
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
			'emblematic_theme', //from from many
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
			//'cmc', //decimal
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
			//'is_color_identity_green', //tinyint
			//'is_color_identity_red', //tinyint
			//'is_color_identity_blue', //tinyint
			//'is_color_identity_black', //tinyint
			//'is_color_identity_white', //tinyint
			//'color_identity_count', //int
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


/**
*	DURC is handling the emblematic_theme for this cardface in cardface
*       but you can extend or override the defaults by editing this function...
*/
	public function emblematic_theme(){
		return parent::emblematic_theme();
	}


//DURC BELONGS_TO SECTION

/**
*	DURC is handling the card for this cardface in cardface
*       but you can extend or override the defaults by editing this function...
*/
	public function card(){
		return parent::card();
	}



	//look in the parent class for the SQL used to generate the underlying table

	//add fields here to entirely hide them in the default DURC web interface.
        public static $UX_hidden_col = [
        ];

        public static function isFieldHiddenInGenericDurcEditor($field){
                if(in_array($field,self::$UX_hidden_col)){
                        return(true);
                }
        }

	//add fields here to make them view-only in the default DURC web interface
        public static $UX_view_only_col = [
        ];

        public static function isFieldViewOnlyInGenericDurcEditor($field){
                if(in_array($field,self::$UX_view_only_col)){
                        return(true);
                }
        }

	//your stuff goes here..
	

}//end cardface