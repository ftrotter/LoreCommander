<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=af12e9baff2ad382a572b86a5cec987f
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_person_classofc_tag extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "person_classofc_tag Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the person_classofc_tag data
			<br>
			<a href='/DURC/person_classofc_tag/create'>Add new person_classofc_tag</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\person_classofc_tag::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$person_field = \App\person::getNameField();	
	$joined_select_field_sql .= "
, A_person.$person_field  AS $person_field
"; 
	$person_img_field = \App\person::getImgField();
	if(!is_null($person_img_field)){
		if($is_debug){echo "person has an image field of: |$person_img_field|
";}
		$joined_select_field_sql .= "
, A_person.$person_img_field  AS $person_img_field
"; 
	}

	$classofc_field = \App\classofc::getNameField();	
	$joined_select_field_sql .= "
, B_classofc.$classofc_field  AS $classofc_field
"; 
	$classofc_img_field = \App\classofc::getImgField();
	if(!is_null($classofc_img_field)){
		if($is_debug){echo "classofc has an image field of: |$classofc_img_field|
";}
		$joined_select_field_sql .= "
, B_classofc.$classofc_img_field  AS $classofc_img_field
"; 
	}

	$tag_field = \App\tag::getNameField();	
	$joined_select_field_sql .= "
, C_tag.$tag_field  AS $tag_field
"; 
	$tag_img_field = \App\tag::getImgField();
	if(!is_null($tag_img_field)){
		if($is_debug){echo "tag has an image field of: |$tag_img_field|
";}
		$joined_select_field_sql .= "
, C_tag.$tag_img_field  AS $tag_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
person_classofc_tag.id
$joined_select_field_sql 
, person_classofc_tag.person_id AS person_id
, person_classofc_tag.classofc_id AS classofc_id
, person_classofc_tag.tag_id AS tag_id
, person_classofc_tag.is_bulk_linker AS is_bulk_linker
, person_classofc_tag.link_note AS link_note
, person_classofc_tag.created_at AS created_at
, person_classofc_tag.updated_at AS updated_at

FROM lore.person_classofc_tag

LEFT JOIN lore.person AS A_person ON 
	A_person.id =
	person_classofc_tag.person_id

LEFT JOIN lore.classofc AS B_classofc ON 
	B_classofc.id =
	person_classofc_tag.classofc_id

LEFT JOIN lore.tag AS C_tag ON 
	C_tag.id =
	person_classofc_tag.tag_id

";

        }else{

                $sql = "
SELECT
person_classofc_tag.id 
$joined_select_field_sql
, person_classofc_tag.person_id AS person_id
, person_classofc_tag.classofc_id AS classofc_id
, person_classofc_tag.tag_id AS tag_id
, person_classofc_tag.is_bulk_linker AS is_bulk_linker
, person_classofc_tag.link_note AS link_note
, person_classofc_tag.created_at AS created_at
, person_classofc_tag.updated_at AS updated_at
 
FROM lore.person_classofc_tag 

LEFT JOIN lore.person AS A_person ON 
	A_person.id =
	person_classofc_tag.person_id

LEFT JOIN lore.classofc AS B_classofc ON 
	B_classofc.id =
	person_classofc_tag.classofc_id

LEFT JOIN lore.tag AS C_tag ON 
	C_tag.id =
	person_classofc_tag.tag_id

WHERE person_classofc_tag.id = $index
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
	$img_field_name = \App\person_classofc_tag::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$person_field = \App\person::getNameField();	
	$joined_select_field_sql .= "
, A_person.$person_field  AS $person_field
"; 
	$person_img_field = \App\person::getImgField();
	if(!is_null($person_img_field)){
		if($is_debug){echo "person has an image field of: |$person_img_field|
";}
		$joined_select_field_sql .= "
, A_person.$person_img_field  AS $person_img_field
"; 
	}

	$classofc_field = \App\classofc::getNameField();	
	$joined_select_field_sql .= "
, B_classofc.$classofc_field  AS $classofc_field
"; 
	$classofc_img_field = \App\classofc::getImgField();
	if(!is_null($classofc_img_field)){
		if($is_debug){echo "classofc has an image field of: |$classofc_img_field|
";}
		$joined_select_field_sql .= "
, B_classofc.$classofc_img_field  AS $classofc_img_field
"; 
	}

	$tag_field = \App\tag::getNameField();	
	$joined_select_field_sql .= "
, C_tag.$tag_field  AS $tag_field
"; 
	$tag_img_field = \App\tag::getImgField();
	if(!is_null($tag_img_field)){
		if($is_debug){echo "tag has an image field of: |$tag_img_field|
";}
		$joined_select_field_sql .= "
, C_tag.$tag_img_field  AS $tag_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/person_classofc_tag/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$person_tmp = ''.$person_field;
if(isset($row[$person_tmp])){
	$person_data = $row[$person_tmp];
	$row[$person_tmp] = "<a target='_blank' href='/Zermelo/DURC_person/$person_id'>$person_data</a>";
}

$person_img_tmp = ''.$person_img_field;
if(isset($row[$person_img_tmp]) && strlen($person_img_tmp) > 0){
	$person_img_data = $row[$person_img_tmp];
	$row[$person_img_tmp] = "<img width='200px' src='$person_img_data'>";
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

$tag_tmp = ''.$tag_field;
if(isset($row[$tag_tmp])){
	$tag_data = $row[$tag_tmp];
	$row[$tag_tmp] = "<a target='_blank' href='/Zermelo/DURC_tag/$tag_id'>$tag_data</a>";
}

$tag_img_tmp = ''.$tag_img_field;
if(isset($row[$tag_img_tmp]) && strlen($tag_img_tmp) > 0){
	$tag_img_data = $row[$tag_img_tmp];
	$row[$tag_img_tmp] = "<img width='200px' src='$tag_img_data'>";
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
    'column_name' => 'person_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'lore',
    'foreign_table' => 'person',
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  2 => 
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
  3 => 
  array (
    'column_name' => 'tag_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'lore',
    'foreign_table' => 'tag',
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
  'person' => 
  array (
    'prefix' => NULL,
    'type' => 'person',
    'to_table' => 'person',
    'to_db' => 'lore',
    'local_key' => 'person_id',
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
        'column_name' => 'last_name',
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
        'column_name' => 'first_name',
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
      3 => 
      array (
        'column_name' => 'person_blurb',
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
        'column_name' => 'image_uri',
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
        'column_name' => 'wallpaper_download_url',
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
        'column_name' => 'mtgwiki_url',
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
        'column_name' => 'wizards_story_url',
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
      9 => 
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
  'tag' => 
  array (
    'prefix' => NULL,
    'type' => 'tag',
    'to_table' => 'tag',
    'to_db' => 'lore',
    'local_key' => 'tag_id',
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
        'column_name' => 'tag_name',
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
        'column_name' => 'is_directed',
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
      3 => 
      array (
        'column_name' => 'excludes_tag_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => true,
        'foreign_db' => 'lore',
        'foreign_table' => 'tag',
        'is_nullable' => true,
        'default_value' => 'NULL',
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
    ),
  ),
)
//many_many
NULL
//many_through
NULL*/


?>