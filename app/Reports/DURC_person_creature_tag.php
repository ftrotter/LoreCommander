<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=2737b2217b32e7fae24e175cb5de3f90
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_person_creature_tag extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "person_creature_tag Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the person_creature_tag data
			<br>
			<a href='/DURC/person_creature_tag/create'>Add new person_creature_tag</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\person_creature_tag::getImgField();
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
person_creature_tag.id
$joined_select_field_sql 
, person_creature_tag.person_id AS person_id
, person_creature_tag.creature_id AS creature_id
, person_creature_tag.tag_id AS tag_id
, person_creature_tag.is_bulk_linker AS is_bulk_linker
, person_creature_tag.link_note AS link_note
, person_creature_tag.created_at AS created_at
, person_creature_tag.updated_at AS updated_at

FROM lore.person_creature_tag

LEFT JOIN lore.person AS A_person ON 
	A_person.id =
	person_creature_tag.person_id

LEFT JOIN lore.creature AS B_creature ON 
	B_creature.id =
	person_creature_tag.creature_id

LEFT JOIN lore.tag AS C_tag ON 
	C_tag.id =
	person_creature_tag.tag_id

";

        }else{

                $sql = "
SELECT
person_creature_tag.id 
$joined_select_field_sql
, person_creature_tag.person_id AS person_id
, person_creature_tag.creature_id AS creature_id
, person_creature_tag.tag_id AS tag_id
, person_creature_tag.is_bulk_linker AS is_bulk_linker
, person_creature_tag.link_note AS link_note
, person_creature_tag.created_at AS created_at
, person_creature_tag.updated_at AS updated_at
 
FROM lore.person_creature_tag 

LEFT JOIN lore.person AS A_person ON 
	A_person.id =
	person_creature_tag.person_id

LEFT JOIN lore.creature AS B_creature ON 
	B_creature.id =
	person_creature_tag.creature_id

LEFT JOIN lore.tag AS C_tag ON 
	C_tag.id =
	person_creature_tag.tag_id

WHERE person_creature_tag.id = $index
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
	$img_field_name = \App\person_creature_tag::getImgField();
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
        $row['id'] = "<a href='/DURC/person_creature_tag/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$person_tmp = ''.$person_field;
if(isset($person_tmp)){
	$person_data = $row[$person_tmp];
	$row[$person_tmp] = "<a target='_blank' href='/Zermelo/DURC_person/$person_id'>$person_data</a>";
}

$person_img_tmp = ''.$person_img_field;
if(isset($person_img_tmp) && strlen($person_img_tmp) > 0){
	$person_img_data = $row[$person_img_tmp];
	$row[$person_img_tmp] = "<img width='200px' src='$person_img_data'>";
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

$tag_tmp = ''.$tag_field;
if(isset($tag_tmp)){
	$tag_data = $row[$tag_tmp];
	$row[$tag_tmp] = "<a target='_blank' href='/Zermelo/DURC_tag/$tag_id'>$tag_data</a>";
}

$tag_img_tmp = ''.$tag_img_field;
if(isset($tag_img_tmp) && strlen($tag_img_tmp) > 0){
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
    'column_name' => 'tag_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'lore',
    'foreign_table' => 'tag',
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
      ),
    ),
  ),
)
//many_many
NULL
//many_through
NULL*\


?>