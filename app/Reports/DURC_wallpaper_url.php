<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=683ad181e84cc6dfc8283009478e79f1
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_wallpaper_url extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "wallpaper_url Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the wallpaper_url data
			<br>
			<a href='/DURC/wallpaper_url/create'>Add new wallpaper_url</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\wallpaper_url::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$wallpaper_field = \App\wallpaper::getNameField();	
	$joined_select_field_sql .= "
, A_wallpaper.$wallpaper_field  AS $wallpaper_field
"; 
	$wallpaper_img_field = \App\wallpaper::getImgField();
	if(!is_null($wallpaper_img_field)){
		if($is_debug){echo "wallpaper has an image field of: |$wallpaper_img_field|
";}
		$joined_select_field_sql .= "
, A_wallpaper.$wallpaper_img_field  AS $wallpaper_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
wallpaper_url.id
$joined_select_field_sql 
, wallpaper_url.wallpaper_id AS wallpaper_id
, wallpaper_url.wallpaper_url_name AS wallpaper_url_name
, wallpaper_url.wallpaper_url AS wallpaper_url
, wallpaper_url.created_at AS created_at
, wallpaper_url.updated_at AS updated_at

FROM lore.wallpaper_url

LEFT JOIN lore.wallpaper AS A_wallpaper ON 
	A_wallpaper.id =
	wallpaper_url.wallpaper_id

";

        }else{

                $sql = "
SELECT
wallpaper_url.id 
$joined_select_field_sql
, wallpaper_url.wallpaper_id AS wallpaper_id
, wallpaper_url.wallpaper_url_name AS wallpaper_url_name
, wallpaper_url.wallpaper_url AS wallpaper_url
, wallpaper_url.created_at AS created_at
, wallpaper_url.updated_at AS updated_at
 
FROM lore.wallpaper_url 

LEFT JOIN lore.wallpaper AS A_wallpaper ON 
	A_wallpaper.id =
	wallpaper_url.wallpaper_id

WHERE wallpaper_url.id = $index
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
	$img_field_name = \App\wallpaper_url::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$wallpaper_field = \App\wallpaper::getNameField();	
	$joined_select_field_sql .= "
, A_wallpaper.$wallpaper_field  AS $wallpaper_field
"; 
	$wallpaper_img_field = \App\wallpaper::getImgField();
	if(!is_null($wallpaper_img_field)){
		if($is_debug){echo "wallpaper has an image field of: |$wallpaper_img_field|
";}
		$joined_select_field_sql .= "
, A_wallpaper.$wallpaper_img_field  AS $wallpaper_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/wallpaper_url/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$wallpaper_tmp = ''.$wallpaper_field;
if(isset($row[$wallpaper_tmp])){
	$wallpaper_data = $row[$wallpaper_tmp];
	$row[$wallpaper_tmp] = "<a target='_blank' href='/Zermelo/DURC_wallpaper/$wallpaper_id'>$wallpaper_data</a>";
}

$wallpaper_img_tmp = ''.$wallpaper_img_field;
if(isset($row[$wallpaper_img_tmp]) && strlen($wallpaper_img_tmp) > 0){
	$wallpaper_img_data = $row[$wallpaper_img_tmp];
	$row[$wallpaper_img_tmp] = "<img width='200px' src='$wallpaper_img_data'>";
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
    'column_name' => 'wallpaper_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => true,
    'foreign_db' => 'lore',
    'foreign_table' => 'wallpaper',
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  2 => 
  array (
    'column_name' => 'wallpaper_url_name',
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
  3 => 
  array (
    'column_name' => 'wallpaper_url',
    'data_type' => 'varchar',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  4 => 
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
  5 => 
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
  'wallpaper' => 
  array (
    'prefix' => NULL,
    'type' => 'wallpaper',
    'to_table' => 'wallpaper',
    'to_db' => 'lore',
    'local_key' => 'wallpaper_id',
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
        'column_name' => 'art_name',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      2 => 
      array (
        'column_name' => 'set_name',
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
      3 => 
      array (
        'column_name' => 'art_release_date',
        'data_type' => 'datetime',
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
        'column_name' => 'author_name',
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
      5 => 
      array (
        'column_name' => 'illustration_id',
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
        'column_name' => 'created_at',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'current_timestamp()',
        'is_auto_increment' => false,
      ),
      7 => 
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
    ),
  ),
)
//many_many
NULL
//many_through
NULL*/


?>