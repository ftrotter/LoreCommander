<?php

namespace App\DURC\Models;

use ftrotter\DURC\DURCModel;
use ftrotter\DURC\DURC;
//use Owen It\Auditing\Contracts\Auditable;
/*
	Note this class was auto-generated from 

lore.strategy by DURC.

	This class will be overwritten during future auto-generation runs..
	Itjust reflects whatever is in the database..
	DO NOT EDIT THIS FILE BY HAND!!
	Your changes go in strategy.php 

*/

class strategy extends DURCModel {

	 //not auditable, configured using is_auditable = 0 in config json

    

    
        // the datbase for this model
        protected $table = 'lore.strategy';

	//DURC will dymanically copy these into the $with variable... which prevents recursion problem: https://laracasts.com/discuss/channels/eloquent/eager-load-deep-recursion-problem?page=1
		protected $DURC_selfish_with = [ 
			'person_strategy_strategytag', //from from many
			'person_strategy_tag', //from from many
			'wincon_cardface', //from belongs to
		];


	//DURC did not detect any date fields

	public $timestamps = true;
	const UPDATED_AT = 'updated_at';
	const CREATED_AT = 'created_at';
	
	

	//for many functions to work, we need to be able to do a lookup on the field_type and get back the MariaDB/MySQL column type.
	static $field_type_map = [
		'id' => 'int',
		'strategy_name' => 'varchar',
		'strategy_description' => 'varchar',
		'strategy_url' => 'varchar',
		'wincon_cardface_id' => 'int',
		'WOTC_rule_reference' => 'varchar',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	]; //end field_type_map
		
    // Indicate which fields are nullable for the UI to be able to validate required/present form elements
    protected $non_nullable_fields = [
		'id',
		'strategy_name',
		'strategy_description',
		'strategy_url',
		'created_at',
		'updated_at',
	]; // End of nullable fields

    // Use default_values array to specify the default values for each field (if any) indicated by the DB schema, to be used as placeholder on form elements
    protected $default_values = [
		'id' => null,
		'strategy_name' => null,
		'strategy_description' => null,
		'strategy_url' => null,
		'wincon_cardface_id' => 'NULL',
		'WOTC_rule_reference' => 'NULL',
		'created_at' => 'current_timestamp()',
		'updated_at' => 'current_timestamp()',
	];  // End of attributes
        
    //everything is fillable by default
    protected $guarded = [];
		
    // These are validation rules used by the DURCModel parent to validate data before storage
    protected static $rules = [
		'strategy_name' => 'required',
		'strategy_description' => 'required',
		'strategy_url' => 'url|required',
		'wincon_cardface_id' => 'integer|nullable',
		'WOTC_rule_reference' => 'nullable',
	]; // End of validation rules
		        
		
//DURC HAS_MANY SECTION

/**
*	get all the person_strategy_strategytag for this strategy
*/
	public function person_strategy_strategytag(){
		return $this->hasMany('App\person_strategy_strategytag','strategy_id','id');
	}


/**
*	get all the person_strategy_tag for this strategy
*/
	public function person_strategy_tag(){
		return $this->hasMany('App\person_strategy_tag','strategy_id','id');
	}


		
		
//DURC HAS_ONE SECTION

			//DURC did not detect any has_one relationships

		
//DURC BELONGS_TO SECTION

/**
*	get the single wincon_cardface for this strategy
*/
	public function wincon_cardface(){
		return $this->belongsTo('App\cardface','wincon_cardface_id','id');
	}



//Originating SQL Schema
/*
CREATE TABLE `lore`.`strategy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `strategy_name` varchar(255) NOT NULL,
  `strategy_description` varchar(2000) NOT NULL,
  `strategy_url` varchar(500) NOT NULL,
  `wincon_cardface_id` int(11) DEFAULT NULL,
  `WOTC_rule_reference` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci
*/


}//end of strategy