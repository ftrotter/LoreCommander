<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=b879d2412bfdb21a6efbab23757451bc
*/
namespace App;
/*
	theme: controls lore.theme

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class theme extends \App\DURC\Models\theme
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
			'emblematic_person', //from belongs to
			'emblematic_cardface', //from belongs to
			'emblematic_creature', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'theme_name', //varchar
			//'theme_description', //text
			//'emblematic_person_id', //int
			//'emblematic_cardface_id', //int
			//'emblematic_creature_id', //int
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the emblematic_person for this theme in theme
*       but you can extend or override the defaults by editing this function...
*/
	public function emblematic_person(){
		return parent::emblematic_person();
	}


/**
*	DURC is handling the emblematic_cardface for this theme in theme
*       but you can extend or override the defaults by editing this function...
*/
	public function emblematic_cardface(){
		return parent::emblematic_cardface();
	}


/**
*	DURC is handling the emblematic_creature for this theme in theme
*       but you can extend or override the defaults by editing this function...
*/
	public function emblematic_creature(){
		return parent::emblematic_creature();
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
	

}//end theme