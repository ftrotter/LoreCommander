<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=e9e8d637ba579c55aca35f9ac8d4e80c
*/
namespace App;
/*
	tag: controls lore.tag

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class tag extends \App\DURC\Models\tag
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
			'person_classofc_tag', //from from many
			'person_creature_tag', //from from many
			'person_strategy_tag', //from from many
			'excludes_tag', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'tag_name', //varchar
			//'is_directed', //tinyint
			//'excludes_tag_id', //int
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the person_classofc_tag for this tag in tag
*       but you can extend or override the defaults by editing this function...
*/
	public function person_classofc_tag(){
		return parent::person_classofc_tag();
	}


/**
*	DURC is handling the person_creature_tag for this tag in tag
*       but you can extend or override the defaults by editing this function...
*/
	public function person_creature_tag(){
		return parent::person_creature_tag();
	}


/**
*	DURC is handling the person_strategy_tag for this tag in tag
*       but you can extend or override the defaults by editing this function...
*/
	public function person_strategy_tag(){
		return parent::person_strategy_tag();
	}


/**
*	DURC is handling the excludes_tag for this tag in tag
*       but you can extend or override the defaults by editing this function...
*/
	public function excludes_tag(){
		return parent::excludes_tag();
	}


//DURC BELONGS_TO SECTION

		//DURC would have added excludes_tag but it was already used in has_many. 
		//You will have to resolve these recursive relationships in your code.

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
	

}//end tag