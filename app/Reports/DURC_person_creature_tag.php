<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=081dfd40477cf6ee361d9f96bc387e33
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

        $index = $this->getCode();


$person_field = \App\person::getNameField();
$creature_field = \App\creature::getNameField();
$tag_field = \App\tag::getNameField();


        if(is_null($index)){

                $sql = "
SELECT 
 person_creature_tag.id AS id
, B_person.$person_field AS $person_field
, C_creature.$creature_field AS $creature_field
, D_tag.$tag_field AS $tag_field
, person_creature_tag.is_bulk_linker AS is_bulk_linker
, person_creature_tag.link_note AS link_note
, person_creature_tag.created_at AS created_at
, person_creature_tag.updated_at AS updated_at
, person_creature_tag.person_id AS person_id
, person_creature_tag.creature_id AS creature_id
, person_creature_tag.tag_id AS tag_id

FROM lore.person_creature_tag

LEFT JOIN lore.person AS B_person ON 
	B_person.id =
	person_creature_tag.person_id

LEFT JOIN lore.creature AS C_creature ON 
	C_creature.id =
	person_creature_tag.creature_id

LEFT JOIN lore.tag AS D_tag ON 
	D_tag.id =
	person_creature_tag.tag_id

";

        }else{

                $sql = "
SELECT 
 person_creature_tag.id AS id
, B_person.$person_field AS $person_field
, C_creature.$creature_field AS $creature_field
, D_tag.$tag_field AS $tag_field
, person_creature_tag.is_bulk_linker AS is_bulk_linker
, person_creature_tag.link_note AS link_note
, person_creature_tag.created_at AS created_at
, person_creature_tag.updated_at AS updated_at
, person_creature_tag.person_id AS person_id
, person_creature_tag.creature_id AS creature_id
, person_creature_tag.tag_id AS tag_id
 
FROM lore.person_creature_tag 

LEFT JOIN lore.person AS B_person ON 
	B_person.id =
	person_creature_tag.person_id

LEFT JOIN lore.creature AS C_creature ON 
	C_creature.id =
	person_creature_tag.creature_id

LEFT JOIN lore.tag AS D_tag ON 
	D_tag.id =
	person_creature_tag.tag_id

WHERE person_creature_tag.id = $index
";

        }

        $is_debug = false;
        if($is_debug){
                echo "<pre>$sql";
                exit();
        }

        return $sql;
    }

    //decorate the results of the query with useful results
    public function MapRow(array $row, int $row_number) :array
    {


$person_field = \App\person::getNameField();
$creature_field = \App\creature::getNameField();
$tag_field = \App\tag::getNameField();

        extract($row);

        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/person_creature_tag/$id'>$id</a>";


$person_tmp = ''.$person_field;
$person_label = $row[$person_tmp];
if(isset($person_tmp)){
	$row[$person_tmp] = "<a target='_blank' href='/Zermelo/DURC_person/$person_id'>$person_label</a>";
}

$creature_tmp = ''.$creature_field;
$creature_label = $row[$creature_tmp];
if(isset($creature_tmp)){
	$row[$creature_tmp] = "<a target='_blank' href='/Zermelo/DURC_creature/$creature_id'>$creature_label</a>";
}

$tag_tmp = ''.$tag_field;
$tag_label = $row[$tag_tmp];
if(isset($tag_tmp)){
	$row[$tag_tmp] = "<a target='_blank' href='/Zermelo/DURC_tag/$tag_id'>$tag_label</a>";
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
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      3 => 
      array (
        'column_name' => 'image_uri',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
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
        'column_name' => 'created_at',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
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