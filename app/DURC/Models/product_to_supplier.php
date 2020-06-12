<?php

namespace App\DURC\Models;

use CareSet\DURC\DURCModel;
use CareSet\DURC\DURC;
/*
	Note this class was auto-generated from 

DURC_northwind_model.product_to_supplier by DURC.

	This class will be overwritten during future auto-generation runs..
	Itjust reflects whatever is in the database..
	DO NOT EDIT THIS FILE BY HAND!!
	Your changes go in product_to_supplier.php 

*/

class product_to_supplier extends DURCModel{

    protected $primaryKey = 'supplier_id';

    
        // the datbase for this model
        protected $table = 'DURC_northwind_model.product_to_supplier';

	//DURC will dymanically copy these into the $with variable... which prevents recursion problem: https://laracasts.com/discuss/channels/eloquent/eager-load-deep-recursion-problem?page=1
		protected $DURC_selfish_with = [ 
			'product', //from belongs to
			'supplier', //from belongs to
		];


	//DURC did not detect any date fields

	public $timestamps = true;
	const UPDATED_AT = 'updated_at';
	const CREATED_AT = 'created_at';
	
	

	//for many functions to work, we need to be able to do a lookup on the field_type and get back the MariaDB/MySQL column type.
	static $field_type_map = [
		'product_id' => 'int',
		'supplier_id' => 'int',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	]; //end field_type_map
		
    // Indicate which fields are nullable for the UI to be able to validate required/present form elements
    protected $non_nullable_fields = [
		'product_id',
		'supplier_id',
		'created_at',
		'updated_at',
	]; // End of nullable fields

    // Use default_values array to specify the default values for each field (if any) indicated by the DB schema, to be used as placeholder on form elements
    protected $default_values = [
		'product_id' => null,
		'supplier_id' => null,
		'created_at' => 'current_timestamp()',
		'updated_at' => 'current_timestamp()',
	];  // End of attributes
        
    //everything is fillable by default
    protected $guarded = [];
		
    // These are validation rules used by the DURCModel parent to validate data before storage
    protected static $rules = [
		'product_id' => 'integer|required',
		'supplier_id' => 'integer|required',
	]; // End of validation rules
		        
		
//DURC HAS_MANY SECTION

			//DURC did not detect any has_many relationships
		
		
//DURC HAS_ONE SECTION

			//DURC did not detect any has_one relationships

		
//DURC BELONGS_TO SECTION

/**
*	get the single product for this product_to_supplier
*/
	public function product(){
		return $this->belongsTo('App\product','product_id','id');
	}


/**
*	get the single supplier for this product_to_supplier
*/
	public function supplier(){
		return $this->belongsTo('App\supplier','supplier_id','id');
	}



//Originating SQL Schema
/*
CREATE TABLE `DURC_northwind_model`.`product_to_supplier` (
  `product_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`product_id`,`supplier_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1
*/


}//end of product_to_supplier