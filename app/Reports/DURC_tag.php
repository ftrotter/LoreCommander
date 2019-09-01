<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=c93e0b8cdd3a3c86862c87272f3a1d15
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_tag extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "tag Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the tag data
			<br>
			<a href='/DURC/tag/create'>Add new tag</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $index = $this->getCode();


$tag_field = \App\tag::getNameField();


        if(is_null($index)){

                $sql = "
SELECT 
 tag.id AS id
, tag.tag_name AS tag_name
, tag.is_directed AS is_directed
, B_tag.$tag_field AS excludes_$tag_field
, tag.created_at AS created_at
, tag.updated_at AS updated_at
, tag.excludes_tag_id AS excludes_tag_id

FROM lore.tag

LEFT JOIN lore.tag AS B_tag ON 
	B_tag.id =
	tag.excludes_tag_id

";

        }else{

                $sql = "
SELECT 
 tag.id AS id
, tag.tag_name AS tag_name
, tag.is_directed AS is_directed
, B_tag.$tag_field AS excludes_$tag_field
, tag.created_at AS created_at
, tag.updated_at AS updated_at
, tag.excludes_tag_id AS excludes_tag_id
 
FROM lore.tag 

LEFT JOIN lore.tag AS B_tag ON 
	B_tag.id =
	tag.excludes_tag_id

WHERE tag.id = $index
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


$tag_field = \App\tag::getNameField();

        extract($row);

        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/tag/$id'>$id</a>";


$excludes_tag_tmp = 'excludes_'.$tag_field;
$excludes_tag_label = $row[$excludes_tag_tmp];
if(isset($excludes_tag_tmp)){
	$row[$excludes_tag_tmp] = "<a target='_blank' href='/Zermelo/DURC_tag/$excludes_tag_id'>$excludes_tag_label</a>";
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
)
//has_many
array (
  'person_classofcreature_tag' => 
  array (
    'prefix' => NULL,
    'type' => 'person_classofcreature_tag',
    'from_table' => 'person_classofcreature_tag',
    'from_db' => 'lore',
    'from_column' => 'tag_id',
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
    ),
  ),
  'person_creature_tag' => 
  array (
    'prefix' => NULL,
    'type' => 'person_creature_tag',
    'from_table' => 'person_creature_tag',
    'from_db' => 'lore',
    'from_column' => 'tag_id',
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
    ),
  ),
  'person_strategy_tag' => 
  array (
    'prefix' => NULL,
    'type' => 'person_strategy_tag',
    'from_table' => 'person_strategy_tag',
    'from_db' => 'lore',
    'from_column' => 'tag_id',
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
        'column_name' => 'strategy_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'lore',
        'foreign_table' => 'strategy',
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
    ),
  ),
  'excludes_tag' => 
  array (
    'prefix' => 'excludes',
    'type' => 'tag',
    'from_table' => 'tag',
    'from_db' => 'lore',
    'from_column' => 'excludes_tag_id',
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
//has_one
NULL
//belongs_to
array (
  'excludes_tag' => 
  array (
    'prefix' => 'excludes',
    'type' => 'tag',
    'to_table' => 'tag',
    'to_db' => 'lore',
    'local_key' => 'excludes_tag_id',
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