<?php

namespace App\DURC\Models;

use ftrotter\DURC\DURCModel;
use ftrotter\DURC\DURC;
//use Owen It\Auditing\Contracts\Auditable;
/*
	Note this class was auto-generated from 

lore.classofc by DURC.

	This class will be overwritten during future auto-generation runs..
	Itjust reflects whatever is in the database..
	DO NOT EDIT THIS FILE BY HAND!!
	Your changes go in classofc.php 

*/

class classofc extends DURCModel {

	 //not auditable, configured using is_auditable = 0 in config json

    

    
        // the datbase for this model
        protected $table = 'lore.classofc';

	//DURC will dymanically copy these into the $with variable... which prevents recursion problem: https://laracasts.com/discuss/channels/eloquent/eager-load-deep-recursion-problem?page=1
		protected $DURC_selfish_with = [ 
			'cardface_classofc_atag', //from from many
			'classofc_cardface', //from from many
			'classofc_classofc_vspack', //from from many
			'second_classofc_classofc_vspack', //from from many
			'classofc_creature', //from from many
			'person_classofc_cardface', //from from many
			'person_classofc_tag', //from from many
		];


	//DURC did not detect any date fields

	public $timestamps = true;
	const UPDATED_AT = 'updated_at';
	const CREATED_AT = 'created_at';
	
	

	//for many functions to work, we need to be able to do a lookup on the field_type and get back the MariaDB/MySQL column type.
	static $field_type_map = [
		'id' => 'int',
		'classofc_name' => 'varchar',
		'classofc_img_uri' => 'varchar',
		'classofc_wiki_url' => 'varchar',
		'is_mega_class' => 'tinyint',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	]; //end field_type_map
		
    // Indicate which fields are nullable for the UI to be able to validate required/present form elements
    protected $non_nullable_fields = [
		'id',
		'classofc_name',
		'is_mega_class',
		'created_at',
		'updated_at',
	]; // End of nullable fields

    // Use default_values array to specify the default values for each field (if any) indicated by the DB schema, to be used as placeholder on form elements
    protected $default_values = [
		'id' => null,
		'classofc_name' => null,
		'classofc_img_uri' => 'NULL',
		'classofc_wiki_url' => 'NULL',
		'is_mega_class' => '0',
		'created_at' => 'current_timestamp()',
		'updated_at' => 'current_timestamp()',
	];  // End of attributes
        
    //everything is fillable by default
    protected $guarded = [];
		
    // These are validation rules used by the DURCModel parent to validate data before storage
    protected static $rules = [
		'classofc_name' => 'required',
		'classofc_img_uri' => 'url|nullable',
		'classofc_wiki_url' => 'url|nullable',
		'is_mega_class' => 'boolean|integer',
	]; // End of validation rules
		        
		
//DURC HAS_MANY SECTION

/**
*	get all the cardface_classofc_atag for this classofc
*/
	public function cardface_classofc_atag(){
		return $this->hasMany('App\cardface_classofc_atag','classofc_id','id');
	}


/**
*	get all the classofc_cardface for this classofc
*/
	public function classofc_cardface(){
		return $this->hasMany('App\classofc_cardface','classofc_id','id');
	}


/**
*	get all the classofc_classofc_vspack for this classofc
*/
	public function classofc_classofc_vspack(){
		return $this->hasMany('App\classofc_classofc_vspack','classofc_id','id');
	}


/**
*	get all the second_classofc_classofc_vspack for this classofc
*/
	public function second_classofc_classofc_vspack(){
		return $this->hasMany('App\classofc_classofc_vspack','second_classofc_id','id');
	}


/**
*	get all the classofc_creature for this classofc
*/
	public function classofc_creature(){
		return $this->hasMany('App\classofc_creature','classofc_id','id');
	}


/**
*	get all the person_classofc_cardface for this classofc
*/
	public function person_classofc_cardface(){
		return $this->hasMany('App\person_classofc_cardface','classofc_id','id');
	}


/**
*	get all the person_classofc_tag for this classofc
*/
	public function person_classofc_tag(){
		return $this->hasMany('App\person_classofc_tag','classofc_id','id');
	}


		
		
//DURC HAS_ONE SECTION

			//DURC did not detect any has_one relationships

		
//DURC BELONGS_TO SECTION

			//DURC did not detect any belongs_to relationships

//Originating SQL Schema
/*
CREATE TABLE `lore`.`classofc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classofc_name` varchar(255) NOT NULL,
  `classofc_img_uri` varchar(255) DEFAULT NULL,
  `classofc_wiki_url` varchar(255) DEFAULT NULL,
  `is_mega_class` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `creatureclass_name` (`classofc_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci
*/


}//end of classofc