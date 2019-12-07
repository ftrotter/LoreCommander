<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=95fc3e7ea0aa236c48be0fc58472b278
*/
namespace App;
/*
	creature: controls lore.creature

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class creature extends \App\DURC\Models\creature
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
			'classofc_creature', //from from many
			'creature_cardface', //from from many
			'person_creature_tag', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'creature_name', //varchar
			//'creature_image_uri', //varchar
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the classofc_creature for this creature in creature
*       but you can extend or override the defaults by editing this function...
*/
	public function classofc_creature(){
		return parent::classofc_creature();
	}


/**
*	DURC is handling the creature_cardface for this creature in creature
*       but you can extend or override the defaults by editing this function...
*/
	public function creature_cardface(){
		return parent::creature_cardface();
	}


/**
*	DURC is handling the person_creature_tag for this creature in creature
*       but you can extend or override the defaults by editing this function...
*/
	public function person_creature_tag(){
		return parent::person_creature_tag();
	}


//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships

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
	

}//end creature