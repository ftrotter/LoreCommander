<?php

namespace App\DURC\Models;

use ftrotter\DURC\DURCModel;
use ftrotter\DURC\DURC;
//use Owen It\Auditing\Contracts\Auditable;
/*
	Note this class was auto-generated from 

mirrulation.llm_reply_per_comment by DURC.

	This class will be overwritten during future auto-generation runs..
	Itjust reflects whatever is in the database..
	DO NOT EDIT THIS FILE BY HAND!!
	Your changes go in llm_reply_per_comment.php 

*/

class llm_reply_per_comment extends DURCModel {

	 //not auditable, configured using is_auditable = 0 in config json

    

    
        // the datbase for this model
        protected $table = 'mirrulation.llm_reply_per_comment';

	//DURC will dymanically copy these into the $with variable... which prevents recursion problem: https://laracasts.com/discuss/channels/eloquent/eager-load-deep-recursion-problem?page=1
		protected $DURC_selfish_with = [ 
		];


	//DURC did not detect any date fields

	public $timestamps = true;
	const UPDATED_AT = 'updated_at';
	const CREATED_AT = 'created_at';
	
	

	//for many functions to work, we need to be able to do a lookup on the field_type and get back the MariaDB/MySQL column type.
	static $field_type_map = [
		'id' => 'int',
		'question_id' => 'int',
		'answer' => 'varchar',
		'commentId' => 'varchar',
		'chatbot_id' => 'int',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	]; //end field_type_map
		
    // Indicate which fields are nullable for the UI to be able to validate required/present form elements
    protected $non_nullable_fields = [
		'id',
		'question_id',
		'answer',
		'commentId',
		'chatbot_id',
		'created_at',
		'updated_at',
	]; // End of nullable fields

    // Use default_values array to specify the default values for each field (if any) indicated by the DB schema, to be used as placeholder on form elements
    protected $default_values = [
		'id' => null,
		'question_id' => null,
		'answer' => null,
		'commentId' => null,
		'chatbot_id' => '1',
		'created_at' => 'current_timestamp()',
		'updated_at' => 'current_timestamp()',
	];  // End of attributes
        
    //everything is fillable by default
    protected $guarded = [];
		
    // These are validation rules used by the DURCModel parent to validate data before storage
    protected static $rules = [
		'question_id' => 'integer|required',
		'answer' => 'required',
		'commentId' => 'required',
		'chatbot_id' => 'integer',
	]; // End of validation rules
		        
		
//DURC HAS_MANY SECTION

			//DURC did not detect any has_many relationships
		
		
//DURC HAS_ONE SECTION

			//DURC did not detect any has_one relationships

		
//DURC BELONGS_TO SECTION

			//DURC did not detect any belongs_to relationships

//Originating SQL Schema
/*
CREATE TABLE `mirrulation`.`llm_reply_per_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `answer` varchar(1000) NOT NULL,
  `commentId` varchar(100) NOT NULL,
  `chatbot_id` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
*/


}//end of llm_reply_per_comment