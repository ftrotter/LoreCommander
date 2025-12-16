<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=13c1af732059fc3949bb3c8e179f00e7
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_classofc_classofc_vspack extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "classofc_classofc_vspack Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the classofc_classofc_vspack data
			<br>
			<a href='/DURC/classofc_classofc_vspack/create'>Add new classofc_classofc_vspack</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\classofc_classofc_vspack::getImgField();
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

	$classofc_field = \App\classofc::getNameField();	
	$joined_select_field_sql .= "
, B_classofc.$classofc_field  AS second_$classofc_field
"; 
	$classofc_img_field = \App\classofc::getImgField();
	if(!is_null($classofc_img_field)){
		if($is_debug){echo "classofc has an image field of: |$classofc_img_field|
";}
		$joined_select_field_sql .= "
, B_classofc.$classofc_img_field  AS second_$classofc_img_field
"; 
	}

	$vspack_field = \App\vspack::getNameField();	
	$joined_select_field_sql .= "
, C_vspack.$vspack_field  AS $vspack_field
"; 
	$vspack_img_field = \App\vspack::getImgField();
	if(!is_null($vspack_img_field)){
		if($is_debug){echo "vspack has an image field of: |$vspack_img_field|
";}
		$joined_select_field_sql .= "
, C_vspack.$vspack_img_field  AS $vspack_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
classofc_classofc_vspack.id
$joined_select_field_sql 
, classofc_classofc_vspack.classofc_id AS classofc_id
, classofc_classofc_vspack.second_classofc_id AS second_classofc_id
, classofc_classofc_vspack.vspack_id AS vspack_id
, classofc_classofc_vspack.is_bulk_linker AS is_bulk_linker
, classofc_classofc_vspack.link_note AS link_note
, classofc_classofc_vspack.created_at AS created_at
, classofc_classofc_vspack.updated_at AS updated_at

FROM lore.classofc_classofc_vspack

LEFT JOIN lore.classofc AS A_classofc ON 
	A_classofc.id =
	classofc_classofc_vspack.classofc_id

LEFT JOIN lore.classofc AS B_classofc ON 
	B_classofc.id =
	classofc_classofc_vspack.second_classofc_id

LEFT JOIN lore.vspack AS C_vspack ON 
	C_vspack.id =
	classofc_classofc_vspack.vspack_id

";

        }else{

                $sql = "
SELECT
classofc_classofc_vspack.id 
$joined_select_field_sql
, classofc_classofc_vspack.classofc_id AS classofc_id
, classofc_classofc_vspack.second_classofc_id AS second_classofc_id
, classofc_classofc_vspack.vspack_id AS vspack_id
, classofc_classofc_vspack.is_bulk_linker AS is_bulk_linker
, classofc_classofc_vspack.link_note AS link_note
, classofc_classofc_vspack.created_at AS created_at
, classofc_classofc_vspack.updated_at AS updated_at
 
FROM lore.classofc_classofc_vspack 

LEFT JOIN lore.classofc AS A_classofc ON 
	A_classofc.id =
	classofc_classofc_vspack.classofc_id

LEFT JOIN lore.classofc AS B_classofc ON 
	B_classofc.id =
	classofc_classofc_vspack.second_classofc_id

LEFT JOIN lore.vspack AS C_vspack ON 
	C_vspack.id =
	classofc_classofc_vspack.vspack_id

WHERE classofc_classofc_vspack.id = $index
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
	$img_field_name = \App\classofc_classofc_vspack::getImgField();
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

	$classofc_field = \App\classofc::getNameField();	
	$joined_select_field_sql .= "
, B_classofc.$classofc_field  AS second_$classofc_field
"; 
	$classofc_img_field = \App\classofc::getImgField();
	if(!is_null($classofc_img_field)){
		if($is_debug){echo "classofc has an image field of: |$classofc_img_field|
";}
		$joined_select_field_sql .= "
, B_classofc.$classofc_img_field  AS second_$classofc_img_field
"; 
	}

	$vspack_field = \App\vspack::getNameField();	
	$joined_select_field_sql .= "
, C_vspack.$vspack_field  AS $vspack_field
"; 
	$vspack_img_field = \App\vspack::getImgField();
	if(!is_null($vspack_img_field)){
		if($is_debug){echo "vspack has an image field of: |$vspack_img_field|
";}
		$joined_select_field_sql .= "
, C_vspack.$vspack_img_field  AS $vspack_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/classofc_classofc_vspack/$id'>$id</a>";



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

$second_classofc_tmp = 'second_'.$classofc_field;
if(isset($row[$second_classofc_tmp])){
	$second_classofc_data = $row[$second_classofc_tmp];
	$row[$second_classofc_tmp] = "<a target='_blank' href='/Zermelo/DURC_classofc/$second_classofc_id'>$second_classofc_data</a>";
}

$second_classofc_img_tmp = 'second_'.$classofc_img_field;
if(isset($row[$second_classofc_img_tmp]) && strlen($second_classofc_img_tmp) > 0){
	$second_classofc_img_data = $row[$second_classofc_img_tmp];
	$row[$second_classofc_img_tmp] = "<img width='200px' src='$second_classofc_img_data'>";
}

$vspack_tmp = ''.$vspack_field;
if(isset($row[$vspack_tmp])){
	$vspack_data = $row[$vspack_tmp];
	$row[$vspack_tmp] = "<a target='_blank' href='/Zermelo/DURC_vspack/$vspack_id'>$vspack_data</a>";
}

$vspack_img_tmp = ''.$vspack_img_field;
if(isset($row[$vspack_img_tmp]) && strlen($vspack_img_tmp) > 0){
	$vspack_img_data = $row[$vspack_img_tmp];
	$row[$vspack_img_tmp] = "<img width='200px' src='$vspack_img_data'>";
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
    'column_name' => 'second_classofc_id',
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
  3 => 
  array (
    'column_name' => 'vspack_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'lore',
    'foreign_table' => 'vspack',
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  4 => 
  array (
    'column_name' => 'is_bulk_linker',
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
    'column_name' => 'link_note',
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
    'is_nullable' => false,
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
  'second_classofc' => 
  array (
    'prefix' => 'second',
    'type' => 'classofc',
    'to_table' => 'classofc',
    'to_db' => 'lore',
    'local_key' => 'second_classofc_id',
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
  'vspack' => 
  array (
    'prefix' => NULL,
    'type' => 'vspack',
    'to_table' => 'vspack',
    'to_db' => 'lore',
    'local_key' => 'vspack_id',
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
        'column_name' => 'vspack_name',
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
      2 => 
      array (
        'column_name' => 'vspack_wizards_url',
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
        'column_name' => 'vspack_wiki_url',
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
      4 => 
      array (
        'column_name' => 'vspack_img_url',
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
)
//many_many
NULL
//many_through
NULL*/


?>