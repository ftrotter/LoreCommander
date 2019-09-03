<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=5e6448d2400a56cb32e60faaa9b1dc47
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_classofcreature_cardface extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "classofcreature_cardface Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the classofcreature_cardface data
			<br>
			<a href='/DURC/classofcreature_cardface/create'>Add new classofcreature_cardface</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\classofcreature_cardface::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$cardface_field = \App\cardface::getNameField();	
	$joined_select_field_sql .= "
, A_cardface.$cardface_field  AS $cardface_field
"; 
	$cardface_img_field = \App\cardface::getImgField();
	if(!is_null($cardface_img_field)){
		if($is_debug){echo "cardface has an image field of: |$cardface_img_field|
";}
		$joined_select_field_sql .= "
, A_cardface.$cardface_img_field  AS $cardface_img_field
"; 
	}

	$classofcreature_field = \App\classofcreature::getNameField();	
	$joined_select_field_sql .= "
, B_classofcreature.$classofcreature_field  AS $classofcreature_field
"; 
	$classofcreature_img_field = \App\classofcreature::getImgField();
	if(!is_null($classofcreature_img_field)){
		if($is_debug){echo "classofcreature has an image field of: |$classofcreature_img_field|
";}
		$joined_select_field_sql .= "
, B_classofcreature.$classofcreature_img_field  AS $classofcreature_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
classofcreature_cardface.id
$joined_select_field_sql 
, classofcreature_cardface.cardface_id AS cardface_id
, classofcreature_cardface.classofcreature_id AS classofcreature_id
, classofcreature_cardface.created_at AS created_at
, classofcreature_cardface.updated_at AS updated_at

FROM lore.classofcreature_cardface

LEFT JOIN lore.cardface AS A_cardface ON 
	A_cardface.id =
	classofcreature_cardface.cardface_id

LEFT JOIN lore.classofcreature AS B_classofcreature ON 
	B_classofcreature.id =
	classofcreature_cardface.classofcreature_id

";

        }else{

                $sql = "
SELECT
classofcreature_cardface.id 
$joined_select_field_sql
, classofcreature_cardface.cardface_id AS cardface_id
, classofcreature_cardface.classofcreature_id AS classofcreature_id
, classofcreature_cardface.created_at AS created_at
, classofcreature_cardface.updated_at AS updated_at
 
FROM lore.classofcreature_cardface 

LEFT JOIN lore.cardface AS A_cardface ON 
	A_cardface.id =
	classofcreature_cardface.cardface_id

LEFT JOIN lore.classofcreature AS B_classofcreature ON 
	B_classofcreature.id =
	classofcreature_cardface.classofcreature_id

WHERE classofcreature_cardface.id = $index
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
	$img_field_name = \App\classofcreature_cardface::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$cardface_field = \App\cardface::getNameField();	
	$joined_select_field_sql .= "
, A_cardface.$cardface_field  AS $cardface_field
"; 
	$cardface_img_field = \App\cardface::getImgField();
	if(!is_null($cardface_img_field)){
		if($is_debug){echo "cardface has an image field of: |$cardface_img_field|
";}
		$joined_select_field_sql .= "
, A_cardface.$cardface_img_field  AS $cardface_img_field
"; 
	}

	$classofcreature_field = \App\classofcreature::getNameField();	
	$joined_select_field_sql .= "
, B_classofcreature.$classofcreature_field  AS $classofcreature_field
"; 
	$classofcreature_img_field = \App\classofcreature::getImgField();
	if(!is_null($classofcreature_img_field)){
		if($is_debug){echo "classofcreature has an image field of: |$classofcreature_img_field|
";}
		$joined_select_field_sql .= "
, B_classofcreature.$classofcreature_img_field  AS $classofcreature_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/classofcreature_cardface/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$cardface_tmp = ''.$cardface_field;
if(isset($cardface_tmp)){
	$cardface_data = $row[$cardface_tmp];
	$row[$cardface_tmp] = "<a target='_blank' href='/Zermelo/DURC_cardface/$cardface_id'>$cardface_data</a>";
}

$cardface_img_tmp = ''.$cardface_img_field;
if(isset($cardface_img_tmp) && strlen($cardface_img_tmp) > 0){
	$cardface_img_data = $row[$cardface_img_tmp];
	$row[$cardface_img_tmp] = "<img width='200px' src='$cardface_img_data'>";
}

$classofcreature_tmp = ''.$classofcreature_field;
if(isset($classofcreature_tmp)){
	$classofcreature_data = $row[$classofcreature_tmp];
	$row[$classofcreature_tmp] = "<a target='_blank' href='/Zermelo/DURC_classofcreature/$classofcreature_id'>$classofcreature_data</a>";
}

$classofcreature_img_tmp = ''.$classofcreature_img_field;
if(isset($classofcreature_img_tmp) && strlen($classofcreature_img_tmp) > 0){
	$classofcreature_img_data = $row[$classofcreature_img_tmp];
	$row[$classofcreature_img_tmp] = "<img width='200px' src='$classofcreature_img_data'>";
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
  ),
  1 => 
  array (
    'column_name' => 'cardface_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'lore',
    'foreign_table' => 'cardface',
  ),
  2 => 
  array (
    'column_name' => 'classofcreature_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'lore',
    'foreign_table' => 'classofcreature',
  ),
  3 => 
  array (
    'column_name' => 'created_at',
    'data_type' => 'datetime',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  4 => 
  array (
    'column_name' => 'updated_at',
    'data_type' => 'datetime',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
)
//has_many
NULL
//has_one
NULL
//belongs_to
array (
  'cardface' => 
  array (
    'prefix' => NULL,
    'type' => 'cardface',
    'to_table' => 'cardface',
    'to_db' => 'lore',
    'local_key' => 'cardface_id',
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
      ),
      1 => 
      array (
        'column_name' => 'card_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'lore',
        'foreign_table' => 'card',
      ),
      2 => 
      array (
        'column_name' => 'cardface_index',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      3 => 
      array (
        'column_name' => 'illustration_id',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      4 => 
      array (
        'column_name' => 'artist',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      5 => 
      array (
        'column_name' => 'color',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      6 => 
      array (
        'column_name' => 'color_identity',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      7 => 
      array (
        'column_name' => 'flavor_text',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      8 => 
      array (
        'column_name' => 'image_uri',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      9 => 
      array (
        'column_name' => 'mana_cost',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      10 => 
      array (
        'column_name' => 'name',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      11 => 
      array (
        'column_name' => 'oracle_text',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      12 => 
      array (
        'column_name' => 'power',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      13 => 
      array (
        'column_name' => 'toughness',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      14 => 
      array (
        'column_name' => 'type_line',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      15 => 
      array (
        'column_name' => 'border_color',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      16 => 
      array (
        'column_name' => 'image_uri_art_crop',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      17 => 
      array (
        'column_name' => 'image_hash_art_crop',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      18 => 
      array (
        'column_name' => 'image_uri_small',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      19 => 
      array (
        'column_name' => 'image_hash_small',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      20 => 
      array (
        'column_name' => 'image_uri_normal',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      21 => 
      array (
        'column_name' => 'image_hash_normal',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      22 => 
      array (
        'column_name' => 'image_uri_large',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      23 => 
      array (
        'column_name' => 'image_hash_large',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      24 => 
      array (
        'column_name' => 'image_uri_png',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      25 => 
      array (
        'column_name' => 'image_hash_png',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      26 => 
      array (
        'column_name' => 'image_uri_border_crop',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      27 => 
      array (
        'column_name' => 'image_hash_border_crop',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      28 => 
      array (
        'column_name' => 'is_foil',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      29 => 
      array (
        'column_name' => 'is_nonfoil',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      30 => 
      array (
        'column_name' => 'is_oversized',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      31 => 
      array (
        'column_name' => 'is_color_green',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      32 => 
      array (
        'column_name' => 'is_color_red',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      33 => 
      array (
        'column_name' => 'is_color_blue',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      34 => 
      array (
        'column_name' => 'is_color_black',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      35 => 
      array (
        'column_name' => 'is_color_white',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      36 => 
      array (
        'column_name' => 'is_colorless',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      37 => 
      array (
        'column_name' => 'color_count',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      38 => 
      array (
        'column_name' => 'is_snow',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      39 => 
      array (
        'column_name' => 'has_phyrexian_mana',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      40 => 
      array (
        'column_name' => 'for_fulltext_search',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      41 => 
      array (
        'column_name' => 'created_at',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      42 => 
      array (
        'column_name' => 'updated_at',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
    ),
  ),
  'classofcreature' => 
  array (
    'prefix' => NULL,
    'type' => 'classofcreature',
    'to_table' => 'classofcreature',
    'to_db' => 'lore',
    'local_key' => 'classofcreature_id',
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
      ),
      1 => 
      array (
        'column_name' => 'classofcreature_name',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      2 => 
      array (
        'column_name' => 'classofcreature_img_uri',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      3 => 
      array (
        'column_name' => 'classofcreature_wiki_url',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      4 => 
      array (
        'column_name' => 'is_mega_class',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      5 => 
      array (
        'column_name' => 'created_at',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      6 => 
      array (
        'column_name' => 'updated_at',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
    ),
  ),
)
//many_many
NULL
//many_through
NULL*\


?>