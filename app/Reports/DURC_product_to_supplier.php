<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=3ae62de577ea2bd62c25349610405435
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_product_to_supplier extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "product_to_supplier Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the product_to_supplier data
			<br>
			<a href='/DURC/product_to_supplier/create'>Add new product_to_supplier</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\product_to_supplier::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$product_field = \App\product::getNameField();	
	$joined_select_field_sql .= "
, A_product.$product_field  AS $product_field
"; 
	$product_img_field = \App\product::getImgField();
	if(!is_null($product_img_field)){
		if($is_debug){echo "product has an image field of: |$product_img_field|
";}
		$joined_select_field_sql .= "
, A_product.$product_img_field  AS $product_img_field
"; 
	}

	$supplier_field = \App\supplier::getNameField();	
	$joined_select_field_sql .= "
, B_supplier.$supplier_field  AS $supplier_field
"; 
	$supplier_img_field = \App\supplier::getImgField();
	if(!is_null($supplier_img_field)){
		if($is_debug){echo "supplier has an image field of: |$supplier_img_field|
";}
		$joined_select_field_sql .= "
, B_supplier.$supplier_img_field  AS $supplier_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
product_to_supplier.id
$joined_select_field_sql 
, product_to_supplier.product_id AS product_id
, product_to_supplier.supplier_id AS supplier_id
, product_to_supplier.created_at AS created_at
, product_to_supplier.updated_at AS updated_at

FROM DURC_northwind_model.product_to_supplier

LEFT JOIN DURC_northwind_model.product AS A_product ON 
	A_product.id =
	product_to_supplier.product_id

LEFT JOIN DURC_northwind_model.supplier AS B_supplier ON 
	B_supplier.id =
	product_to_supplier.supplier_id

";

        }else{

                $sql = "
SELECT
product_to_supplier.id 
$joined_select_field_sql
, product_to_supplier.product_id AS product_id
, product_to_supplier.supplier_id AS supplier_id
, product_to_supplier.created_at AS created_at
, product_to_supplier.updated_at AS updated_at
 
FROM DURC_northwind_model.product_to_supplier 

LEFT JOIN DURC_northwind_model.product AS A_product ON 
	A_product.id =
	product_to_supplier.product_id

LEFT JOIN DURC_northwind_model.supplier AS B_supplier ON 
	B_supplier.id =
	product_to_supplier.supplier_id

WHERE product_to_supplier.id = $index
";

        }

        if($is_debug){
                echo "<pre>$sql";
                exit();
        }

        return $sql;
    }

    //decorate the results of the query with useful results
    public function MapRow(array $row, int $row_number) :array
    {

	$is_debug = false;
	
	//we think it is safe to extract here because we are getting this from the DB and not a user directly..
        extract($row);


	//get the local image field for this report... null if not found..
	$img_field_name = \App\product_to_supplier::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$product_field = \App\product::getNameField();	
	$joined_select_field_sql .= "
, A_product.$product_field  AS $product_field
"; 
	$product_img_field = \App\product::getImgField();
	if(!is_null($product_img_field)){
		if($is_debug){echo "product has an image field of: |$product_img_field|
";}
		$joined_select_field_sql .= "
, A_product.$product_img_field  AS $product_img_field
"; 
	}

	$supplier_field = \App\supplier::getNameField();	
	$joined_select_field_sql .= "
, B_supplier.$supplier_field  AS $supplier_field
"; 
	$supplier_img_field = \App\supplier::getImgField();
	if(!is_null($supplier_img_field)){
		if($is_debug){echo "supplier has an image field of: |$supplier_img_field|
";}
		$joined_select_field_sql .= "
, B_supplier.$supplier_img_field  AS $supplier_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/product_to_supplier/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$product_tmp = ''.$product_field;
if(isset($row[$product_tmp])){
	$product_data = $row[$product_tmp];
	$row[$product_tmp] = "<a target='_blank' href='/Zermelo/DURC_product/$product_id'>$product_data</a>";
}

$product_img_tmp = ''.$product_img_field;
if(isset($row[$product_img_tmp]) && strlen($product_img_tmp) > 0){
	$product_img_data = $row[$product_img_tmp];
	$row[$product_img_tmp] = "<img width='200px' src='$product_img_data'>";
}

$supplier_tmp = ''.$supplier_field;
if(isset($row[$supplier_tmp])){
	$supplier_data = $row[$supplier_tmp];
	$row[$supplier_tmp] = "<a target='_blank' href='/Zermelo/DURC_supplier/$supplier_id'>$supplier_data</a>";
}

$supplier_img_tmp = ''.$supplier_img_field;
if(isset($row[$supplier_img_tmp]) && strlen($supplier_img_tmp) > 0){
	$supplier_img_data = $row[$supplier_img_tmp];
	$row[$supplier_img_tmp] = "<img width='200px' src='$supplier_img_data'>";
}



        return $row;
    }

    //see Zermelo documentation to understand following functions:
    //https://github.com/CareSet/Zermelo

    public $NUMBER     = ['ROWS','AVG','LENGTH','DATA_FREE'];
    public $CURRENCY = [];
    public $SUGGEST_NO_SUMMARY = ['ID'];
    public $REPORT_VIEW = null;

    public function OverrideHeader(array &$format, array &$tags): void
    {
    }

    public function GetIndexSQL(): ?array {
                return(null);
    }

        //turns on the cache, should be off for development and small databases or simple queries
   public function isCacheEnabled(){
        return(false);
   }

        //only matters if the cache is on
   public function howLongToCacheInSeconds(){
        return(1200); //twenty minutes by default
   }

}

/*

//fields:
array (
  0 => 
  array (
    'column_name' => 'product_id',
    'data_type' => 'int',
    'is_primary_key' => true,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'DURC_northwind_model',
    'foreign_table' => 'product',
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  1 => 
  array (
    'column_name' => 'supplier_id',
    'data_type' => 'int',
    'is_primary_key' => true,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'DURC_northwind_model',
    'foreign_table' => 'supplier',
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  2 => 
  array (
    'column_name' => 'created_at',
    'data_type' => 'datetime',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
    'is_nullable' => false,
    'default_value' => 'current_timestamp()',
    'is_auto_increment' => false,
  ),
  3 => 
  array (
    'column_name' => 'updated_at',
    'data_type' => 'datetime',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
    'is_nullable' => false,
    'default_value' => 'current_timestamp()',
    'is_auto_increment' => false,
  ),
)
//has_many
NULL
//has_one
NULL
//belongs_to
array (
  'product' => 
  array (
    'prefix' => NULL,
    'type' => 'product',
    'to_table' => 'product',
    'to_db' => 'DURC_northwind_model',
    'local_key' => 'product_id',
    'other_columns' => 
    array (
      0 => 
      array (
        'column_name' => 'id',
        'data_type' => 'int',
        'is_primary_key' => true,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => false,
        'default_value' => NULL,
        'is_auto_increment' => true,
      ),
      1 => 
      array (
        'column_name' => 'productCode',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      2 => 
      array (
        'column_name' => 'productName',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      3 => 
      array (
        'column_name' => 'description',
        'data_type' => 'longtext',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      4 => 
      array (
        'column_name' => 'standardCost',
        'data_type' => 'decimal',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => '0.0000',
        'is_auto_increment' => false,
      ),
      5 => 
      array (
        'column_name' => 'listPrice',
        'data_type' => 'decimal',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => false,
        'default_value' => '0.0000',
        'is_auto_increment' => false,
      ),
      6 => 
      array (
        'column_name' => 'reorderLevel',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      7 => 
      array (
        'column_name' => 'targetLevel',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      8 => 
      array (
        'column_name' => 'quantityPerUnit',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      9 => 
      array (
        'column_name' => 'discontinued',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => false,
        'default_value' => '0',
        'is_auto_increment' => false,
      ),
      10 => 
      array (
        'column_name' => 'minimumReorderQuantity',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      11 => 
      array (
        'column_name' => 'category',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      12 => 
      array (
        'column_name' => 'attachments',
        'data_type' => 'longblob',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
    ),
  ),
  'supplier' => 
  array (
    'prefix' => NULL,
    'type' => 'supplier',
    'to_table' => 'supplier',
    'to_db' => 'DURC_northwind_model',
    'local_key' => 'supplier_id',
    'other_columns' => 
    array (
      0 => 
      array (
        'column_name' => 'id',
        'data_type' => 'int',
        'is_primary_key' => true,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => false,
        'default_value' => NULL,
        'is_auto_increment' => true,
      ),
      1 => 
      array (
        'column_name' => 'company',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      2 => 
      array (
        'column_name' => 'lastName',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      3 => 
      array (
        'column_name' => 'firstName',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      4 => 
      array (
        'column_name' => 'emailAddress',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      5 => 
      array (
        'column_name' => 'jobTitle',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      6 => 
      array (
        'column_name' => 'businessPhone',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      7 => 
      array (
        'column_name' => 'homePhone',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      8 => 
      array (
        'column_name' => 'mobilePhone',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      9 => 
      array (
        'column_name' => 'faxNumber',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      10 => 
      array (
        'column_name' => 'address',
        'data_type' => 'longtext',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      11 => 
      array (
        'column_name' => 'city',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      12 => 
      array (
        'column_name' => 'stateProvince',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      13 => 
      array (
        'column_name' => 'zipPostalCode',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      14 => 
      array (
        'column_name' => 'countryRegion',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      15 => 
      array (
        'column_name' => 'webPage',
        'data_type' => 'longtext',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      16 => 
      array (
        'column_name' => 'notes',
        'data_type' => 'longtext',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      17 => 
      array (
        'column_name' => 'attachments',
        'data_type' => 'longblob',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
    ),
  ),
)
//many_many
NULL
//many_through
NULL*/


?>