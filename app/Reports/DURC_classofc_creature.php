<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=8e17c913ac7f61ec271421cb998590aa
*/
namespace App\Reports;
use ftrotter\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_classofc_creature extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "classofc_creature Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the classofc_creature data
			<br>
			<a href='/DURC/classofc_creature/create'>Add new classofc_creature</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\classofc_creature::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$classofc_field = \App\classofc::getNameField();	
	$joined_select_field_sql .= "
, A_classofc.$classofc_field  AS $classofc_field
"; 
	$classofc_img_field = \App\classofc::getImgField();
	if(!is_null($classofc_img_field)){
		if($is_debug){echo "classofc has an image field of: |$classofc_img_field|
";}
		$joined_select_field_sql .= "
, A_classofc.$classofc_img_field  AS $classofc_img_field
"; 
	}

	$creature_field = \App\creature::getNameField();	
	$joined_select_field_sql .= "
, B_creature.$creature_field  AS $creature_field
"; 
	$creature_img_field = \App\creature::getImgField();
	if(!is_null($creature_img_field)){
		if($is_debug){echo "creature has an image field of: |$creature_img_field|
";}
		$joined_select_field_sql .= "
, B_creature.$creature_img_field  AS $creature_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
classofc_creature.id
$joined_select_field_sql 
, classofc_creature.classofc_id AS classofc_id
, classofc_creature.creature_id AS creature_id
, classofc_creature.created_at AS created_at
, classofc_creature.updated_at AS updated_at

FROM lore.classofc_creature

LEFT JOIN lore.classofc AS A_classofc ON 
	A_classofc.id =
	classofc_creature.classofc_id

LEFT JOIN lore.creature AS B_creature ON 
	B_creature.id =
	classofc_creature.creature_id

";

        }else{

                $sql = "
SELECT
classofc_creature.id 
$joined_select_field_sql
, classofc_creature.classofc_id AS classofc_id
, classofc_creature.creature_id AS creature_id
, classofc_creature.created_at AS created_at
, classofc_creature.updated_at AS updated_at
 
FROM lore.classofc_creature 

LEFT JOIN lore.classofc AS A_classofc ON 
	A_classofc.id =
	classofc_creature.classofc_id

LEFT JOIN lore.creature AS B_creature ON 
	B_creature.id =
	classofc_creature.creature_id

WHERE classofc_creature.id = $index
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
	$img_field_name = \App\classofc_creature::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$classofc_field = \App\classofc::getNameField();	
	$joined_select_field_sql .= "
, A_classofc.$classofc_field  AS $classofc_field
"; 
	$classofc_img_field = \App\classofc::getImgField();
	if(!is_null($classofc_img_field)){
		if($is_debug){echo "classofc has an image field of: |$classofc_img_field|
";}
		$joined_select_field_sql .= "
, A_classofc.$classofc_img_field  AS $classofc_img_field
"; 
	}

	$creature_field = \App\creature::getNameField();	
	$joined_select_field_sql .= "
, B_creature.$creature_field  AS $creature_field
"; 
	$creature_img_field = \App\creature::getImgField();
	if(!is_null($creature_img_field)){
		if($is_debug){echo "creature has an image field of: |$creature_img_field|
";}
		$joined_select_field_sql .= "
, B_creature.$creature_img_field  AS $creature_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/classofc_creature/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$classofc_tmp = ''.$classofc_field;
if(isset($row[$classofc_tmp])){
	$classofc_data = $row[$classofc_tmp];
	$row[$classofc_tmp] = "<a target='_blank' href='/Zermelo/DURC_classofc/$classofc_id'>$classofc_data</a>";
}

$classofc_img_tmp = ''.$classofc_img_field;
if(isset($row[$classofc_img_tmp]) && strlen($classofc_img_tmp) > 0){
	$classofc_img_data = $row[$classofc_img_tmp];
	$row[$classofc_img_tmp] = "<img width='200px' src='$classofc_img_data'>";
}

$creature_tmp = ''.$creature_field;
if(isset($row[$creature_tmp])){
	$creature_data = $row[$creature_tmp];
	$row[$creature_tmp] = "<a target='_blank' href='/Zermelo/DURC_creature/$creature_id'>$creature_data</a>";
}

$creature_img_tmp = ''.$creature_img_field;
if(isset($row[$creature_img_tmp]) && strlen($creature_img_tmp) > 0){
	$creature_img_data = $row[$creature_img_tmp];
	$row[$creature_img_tmp] = "<img width='200px' src='$creature_img_data'>";
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
    'column_name' => 'classofc_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'lore',
    'foreign_table' => 'classofc',
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  2 => 
  array (
    'column_name' => 'creature_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'lore',
    'foreign_table' => 'creature',
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
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
    'is_nullable' => false,
    'default_value' => 'current_timestamp()',
    'is_auto_increment' => false,
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
  'classofc' => 
  array (
    'prefix' => NULL,
    'type' => 'classofc',
    'to_table' => 'classofc',
    'to_db' => 'lore',
    'local_key' => 'classofc_id',
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
        'column_name' => 'classofc_name',
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
      2 => 
      array (
        'column_name' => 'classofc_img_uri',
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
        'column_name' => 'classofc_wiki_url',
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
        'column_name' => 'is_mega_class',
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
      5 => 
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
      6 => 
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
  'creature' => 
  array (
    'prefix' => NULL,
    'type' => 'creature',
    'to_table' => 'creature',
    'to_db' => 'lore',
    'local_key' => 'creature_id',
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
        'column_name' => 'creature_name',
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
      2 => 
      array (
        'column_name' => 'creature_image_uri',
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
      4 => 
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