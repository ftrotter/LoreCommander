<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=72c764e03a2ce0a7016124e4305e960e
*/
namespace App;
/*
	card: controls lore.card

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class card extends \App\DURC\Models\card
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
			'cardface', //from from many
			'cardprice', //from from many
			'mtgset', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'scryfall_id', //varchar
			//'lang', //varchar
			//'oracle_id', //varchar
			//'rulings_uri', //varchar
			//'scryfall_web_uri', //varchar
			//'scryfall_api_uri', //varchar
			//'layout', //varchar
			//'rarity', //varchar
			//'released_at', //varchar
			//'set_name', //varchar
			//'set_type', //varchar
			//'mtgset_id', //int
			//'collector_number', //varchar
			//'variation_of_scryfall_id', //varchar
			//'edhrec_rank', //int
			//'is_promo', //tinyint
			//'is_reserved', //tinyint
			//'is_story_spotlight', //tinyint
			//'is_reprint', //int
			//'is_variation', //tinyint
			//'is_game_paper', //tinyint
			//'is_game_mtgo', //tinyint
			//'is_game_arena', //tinyint
			//'legal_paupercommander', //tinyint
			//'legal_alchemy', //tinyint
			//'legal_premodern', //tinyint
			//'legal_historicbrawl', //tinyint
			//'legal_pioneer', //tinyint
			//'legal_gladiator', //tinyint
			//'legal_historic', //tinyint
			//'legal_oldschool', //tinyint
			//'legal_duel', //tinyint
			//'legal_commander', //tinyint
			//'legal_brawl', //tinyint
			//'legal_penny', //tinyint
			//'legal_vintage', //tinyint
			//'legal_pauper', //tinyint
			//'legal_legacy', //tinyint
			//'legal_modern', //tinyint
			//'legal_frontier', //tinyint
			//'legal_future', //tinyint
			//'legal_standard', //tinyint
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the cardface for this card in card
*       but you can extend or override the defaults by editing this function...
*/
	public function cardface(){
		return parent::cardface();
	}


/**
*	DURC is handling the cardprice for this card in card
*       but you can extend or override the defaults by editing this function...
*/
	public function cardprice(){
		return parent::cardprice();
	}


//DURC BELONGS_TO SECTION

/**
*	DURC is handling the mtgset for this card in card
*       but you can extend or override the defaults by editing this function...
*/
	public function mtgset(){
		return parent::mtgset();
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
	

}//end card