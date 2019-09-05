<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=55237579ea6c1d62e97a60d4044772a2
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_classofcreature_creature extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "classofcreature_creature Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the classofcreature_creature data
			<br>
			<a href='/DURC/classofcreature_creature/create'>Add new classofcreature_creature</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\classofcreature_creature::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$classofcreature_field = \App\classofcreature::getNameField();	
	$joined_select_field_sql .= "
, A_classofcreature.$classofcreature_field  AS $classofcreature_field
"; 
	$classofcreature_img_field = \App\classofcreature::getImgField();
	if(!is_null($classofcreature_img_field)){
		if($is_debug){echo "classofcreature has an image field of: |$classofcreature_img_field|
";}
		$joined_select_field_sql .= "
, A_classofcreature.$classofcreature_img_field  AS $classofcreature_img_field
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
classofcreature_creature.id
$joined_select_field_sql 
, classofcreature_creature.classofcreature_id AS classofcreature_id
, classofcreature_creature.creature_id AS creature_id
, classofcreature_creature.created_at AS created_at
, classofcreature_creature.updated_at AS updated_at

FROM lore.classofcreature_creature

LEFT JOIN lore.classofcreature AS A_classofcreature ON 
	A_classofcreature.id =
	classofcreature_creature.classofcreature_id

LEFT JOIN lore.creature AS B_creature ON 
	B_creature.id =
	classofcreature_creature.creature_id

";

        }else{

                $sql = "
SELECT
classofcreature_creature.id 
$joined_select_field_sql
, classofcreature_creature.classofcreature_id AS classofcreature_id
, classofcreature_creature.creature_id AS creature_id
, classofcreature_creature.created_at AS created_at
, classofcreature_creature.updated_at AS updated_at
 
FROM lore.classofcreature_creature 

LEFT JOIN lore.classofcreature AS A_classofcreature ON 
	A_classofcreature.id =
	classofcreature_creature.classofcreature_id

LEFT JOIN lore.creature AS B_creature ON 
	B_creature.id =
	classofcreature_creature.creature_id

WHERE classofcreature_creature.id = $index
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
	$img_field_name = \App\classofcreature_creature::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$classofcreature_field = \App\classofcreature::getNameField();	
	$joined_select_field_sql .= "
, A_classofcreature.$classofcreature_field  AS $classofcreature_field
"; 
	$classofcreature_img_field = \App\classofcreature::getImgField();
	if(!is_null($classofcreature_img_field)){
		if($is_debug){echo "classofcreature has an image field of: |$classofcreature_img_field|
";}
		$joined_select_field_sql .= "
, A_classofcreature.$classofcreature_img_field  AS $classofcreature_img_field
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
        $row['id'] = "<a href='/DURC/classofcreature_creature/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
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

$creature_tmp = ''.$creature_field;
if(isset($creature_tmp)){
	$creature_data = $row[$creature_tmp];
	$row[$creature_tmp] = "<a target='_blank' href='/Zermelo/DURC_creature/$creature_id'>$creature_data</a>";
}

$creature_img_tmp = ''.$creature_img_field;
if(isset($creature_img_tmp) && strlen($creature_img_tmp) > 0){
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
  ),
  1 => 
  array (
    'column_name' => 'classofcreature_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'lore',
    'foreign_table' => 'classofcreature',
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
    ),
  ),
)
//many_many
NULL
//many_through
NULL*/


?>