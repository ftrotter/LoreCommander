<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=b42fd8a0cede3fc9724766efcf5c2227
*/
namespace App;
/*
	order_2017: controls DURC_northwind_data.order_2017

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class order_2017 extends \App\DURC\Models\order_2017
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
			'employee', //from belongs to
			'customer', //from belongs to
			'shipper', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'employee_id', //int
			//'customer_id', //int
			//'orderDate', //datetime
			//'shippedDate', //datetime
			//'shipper_id', //int
			//'shipName', //varchar
			//'shipAddress', //longtext
			//'shipCity', //varchar
			//'shipStateProvince', //varchar
			//'shipZipPostalCode', //varchar
			//'shipCountryRegion', //varchar
			//'shippingFee', //decimal
			//'taxes', //decimal
			//'paymentType', //varchar
			//'paidDate', //datetime
			//'notes', //longtext
			//'taxRate', //double
			//'taxStatus_id', //tinyint
			//'status_id', //tinyint
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the employee for this order_2017 in order_2017
*       but you can extend or override the defaults by editing this function...
*/
	public function employee(){
		return parent::employee();
	}


/**
*	DURC is handling the customer for this order_2017 in order_2017
*       but you can extend or override the defaults by editing this function...
*/
	public function customer(){
		return parent::customer();
	}


/**
*	DURC is handling the shipper for this order_2017 in order_2017
*       but you can extend or override the defaults by editing this function...
*/
	public function shipper(){
		return parent::shipper();
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
	

}//end order_2017