<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=d9d9809c2589440b12c6af8f5c1eeb90
*/
namespace App\Reports;
use ftrotter\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_powertoughsource extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "powertoughsource Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the powertoughsource data
			<br>
			<a href='/DURC/powertoughsource/create'>Add new powertoughsource</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\powertoughsource::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';




        if(is_null($index)){

                $sql = "
SELECT
powertoughsource.id
$joined_select_field_sql 
, powertoughsource.scryfall_web_uri AS scryfall_web_uri
, powertoughsource.name AS name
, powertoughsource.cmc AS cmc
, powertoughsource.power AS power
, powertoughsource.toughness AS toughness
, powertoughsource.power_plus_toughness AS power_plus_toughness
, powertoughsource.is_color_identity_green AS is_color_identity_green
, powertoughsource.is_color_identity_red AS is_color_identity_red
, powertoughsource.is_color_identity_blue AS is_color_identity_blue
, powertoughsource.is_color_identity_black AS is_color_identity_black
, powertoughsource.is_color_identity_white AS is_color_identity_white

FROM lore.powertoughsource

";

        }else{

                $sql = "
SELECT
powertoughsource.id 
$joined_select_field_sql
, powertoughsource.scryfall_web_uri AS scryfall_web_uri
, powertoughsource.name AS name
, powertoughsource.cmc AS cmc
, powertoughsource.power AS power
, powertoughsource.toughness AS toughness
, powertoughsource.power_plus_toughness AS power_plus_toughness
, powertoughsource.is_color_identity_green AS is_color_identity_green
, powertoughsource.is_color_identity_red AS is_color_identity_red
, powertoughsource.is_color_identity_blue AS is_color_identity_blue
, powertoughsource.is_color_identity_black AS is_color_identity_black
, powertoughsource.is_color_identity_white AS is_color_identity_white
 
FROM lore.powertoughsource 

WHERE powertoughsource.id = $index
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
	$img_field_name = \App\powertoughsource::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';





        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/powertoughsource/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
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
    'column_name' => 'scryfall_web_uri',
    'data_type' => 'varchar',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  1 => 
  array (
    'column_name' => 'name',
    'data_type' => 'varchar',
    'is_primary_key' => true,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  2 => 
  array (
    'column_name' => 'cmc',
    'data_type' => 'decimal',
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
    'column_name' => 'power',
    'data_type' => 'decimal',
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
    'column_name' => 'toughness',
    'data_type' => 'decimal',
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
    'column_name' => 'power_plus_toughness',
    'data_type' => 'decimal',
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
    'column_name' => 'is_color_identity_green',
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
  7 => 
  array (
    'column_name' => 'is_color_identity_red',
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
  8 => 
  array (
    'column_name' => 'is_color_identity_blue',
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
  9 => 
  array (
    'column_name' => 'is_color_identity_black',
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
    'column_name' => 'is_color_identity_white',
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
)
//has_many
NULL
//has_one
NULL
//belongs_to
NULL
//many_many
NULL
//many_through
NULL*/


?>