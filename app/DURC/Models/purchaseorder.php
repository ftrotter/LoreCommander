<?php

namespace App\DURC\Models;

use CareSet\DURC\DURCModel;
/*
	Note this class was auto-generated from 

DURC_northwind_data.purchaseOrder by DURC.

	This class will be overwritten during future auto-generation runs..
	Itjust reflects whatever is in the database..
	DO NOT EDIT THIS FILE BY HAND!!
	Your changes go in purchaseorder.php 

*/

class purchaseorder extends DURCModel{

    

    
        // the datbase for this model
        protected $table = 'DURC_northwind_data.purchaseOrder';

	//DURC will dymanically copy these into the $with variable... which prevents recursion problem: https://laracasts.com/discuss/channels/eloquent/eager-load-deep-recursion-problem?page=1
		protected $DURC_selfish_with = [ 
			'inventorytransaction', //from from many
			'orderdetail', //from from many
			'purchaseorderdetail', //from from many
			'supplier', //from belongs to
			'createdBy_employee', //from belongs to
			'approvedBy_employee', //from belongs to
			'submittedBy_employee', //from belongs to
		];


	//DURC did not detect any date fields

	public $timestamps = false;
	//DURC NOTE: did not find updated_at and created_at fields for this model

	
	
	

	//for many functions to work, we need to be able to do a lookup on the field_type and get back the MariaDB/MySQL column type.
	static $field_type_map = [
		'id' => 'int',
		'supplier_id' => 'int',
		'createdBy_employee_id' => 'int',
		'submittedDate' => 'datetime',
		'creationDate' => 'datetime',
		'status_id' => 'int',
		'expectedDate' => 'datetime',
		'shippingFee' => 'decimal',
		'taxes' => 'decimal',
		'paymentDate' => 'datetime',
		'paymentAmount' => 'decimal',
		'paymentMethod' => 'varchar',
		'notes' => 'longtext',
		'approvedBy_employee_id' => 'int',
		'approvedDate' => 'datetime',
		'submittedBy_employee_id' => 'int',
			]; //end field_type_map
		
    // Indicate which fields are nullable for the UI to be able to validate required form elements
    protected $non_nullable_fields = [
		'id',
		'creationDate',
		'shippingFee',
		'taxes',
			]; // End of nullable fields

    // Use Eloquent attributes array to specify the default values for each field (if any) indicated by the DB schema, to be used as placeholder on form elements
    protected $attributes = [
		'id' => null,
		'supplier_id' => 'NULL',
		'createdBy_employee_id' => 'NULL',
		'submittedDate' => 'NULL',
		'creationDate' => 'current_timestamp()',
		'status_id' => '0',
		'expectedDate' => 'NULL',
		'shippingFee' => '0.0000',
		'taxes' => '0.0000',
		'paymentDate' => 'NULL',
		'paymentAmount' => '0.0000',
		'paymentMethod' => 'NULL',
		'notes' => 'NULL',
		'approvedBy_employee_id' => 'NULL',
		'approvedDate' => 'NULL',
		'submittedBy_employee_id' => 'NULL',
			]; // End of attributes
        
		//everything is fillable by default
		protected $guarded = [];


		
//DURC HAS_MANY SECTION

/**
*	get all the inventorytransaction for this purchaseorder
*/
	public function inventorytransaction(){
		return $this->hasMany('App\inventorytransaction','purchaseOrder_id','id');
	}


/**
*	get all the orderdetail for this purchaseorder
*/
	public function orderdetail(){
		return $this->hasMany('App\orderdetail','PurchaseOrder_id','id');
	}


/**
*	get all the purchaseorderdetail for this purchaseorder
*/
	public function purchaseorderdetail(){
		return $this->hasMany('App\purchaseorderdetail','purchaseOrder_id','id');
	}


		
		
//DURC HAS_ONE SECTION

			//DURC did not detect any has_one relationships

		
//DURC BELONGS_TO SECTION

/**
*	get the single supplier for this purchaseorder
*/
	public function supplier(){
		return $this->belongsTo('App\supplier','supplier_id','id');
	}


/**
*	get the single createdBy_employee for this purchaseorder
*/
	public function createdBy_employee(){
		return $this->belongsTo('App\employee','createdBy_employee_id','id');
	}


/**
*	get the single approvedBy_employee for this purchaseorder
*/
	public function approvedBy_employee(){
		return $this->belongsTo('App\employee','approvedBy_employee_id','id');
	}


/**
*	get the single submittedBy_employee for this purchaseorder
*/
	public function submittedBy_employee(){
		return $this->belongsTo('App\employee','submittedBy_employee_id','id');
	}



//Originating SQL Schema
/*
CREATE TABLE `DURC_northwind_data`.`purchaseOrder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) DEFAULT NULL,
  `createdBy_employee_id` int(11) DEFAULT NULL,
  `submittedDate` datetime DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT current_timestamp(),
  `status_id` int(11) DEFAULT 0,
  `expectedDate` datetime DEFAULT NULL,
  `shippingFee` decimal(19,4) NOT NULL DEFAULT 0.0000,
  `taxes` decimal(19,4) NOT NULL DEFAULT 0.0000,
  `paymentDate` datetime DEFAULT NULL,
  `paymentAmount` decimal(19,4) DEFAULT 0.0000,
  `paymentMethod` varchar(50) DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `approvedBy_employee_id` int(11) DEFAULT NULL,
  `approvedDate` datetime DEFAULT NULL,
  `submittedBy_employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `createdBy` (`createdBy_employee_id`),
  KEY `status_id` (`status_id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `fkPurchaseOrderEmployees1` FOREIGN KEY (`createdBy_employee_id`) REFERENCES `northwind_model`.`employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkPurchaseOrderPurchaseOrderStatus1` FOREIGN KEY (`status_id`) REFERENCES `northwind_model`.`purchaseOrderStatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkPurchaseOrderSuppliers1` FOREIGN KEY (`supplier_id`) REFERENCES `northwind_model`.`supplier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB  DEFAULT CHARSET=utf8
*/


}//end of purchaseorder