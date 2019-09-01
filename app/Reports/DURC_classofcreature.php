<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=dfb8756e0ee1e2d558bc3ecf658d71d2
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_classofcreature extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "classofcreature Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the classofcreature data
			<br>
			<a href='/DURC/classofcreature/create'>Add new classofcreature</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $index = $this->getCode();




        if(is_null($index)){

                $sql = "
SELECT 
 classofcreature.id AS id
, classofcreature.classofcreature_name AS classofcreature_name
, classofcreature.is_mega_class AS is_mega_class
, classofcreature.created_at AS created_at
, classofcreature.updated_at AS updated_at

FROM lore.classofcreature

";

        }else{

                $sql = "
SELECT 
 classofcreature.id AS id
, classofcreature.classofcreature_name AS classofcreature_name
, classofcreature.is_mega_class AS is_mega_class
, classofcreature.created_at AS created_at
, classofcreature.updated_at AS updated_at
 
FROM lore.classofcreature 

WHERE classofcreature.id = $index
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



        extract($row);

        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/classofcreature/$id'>$id</a>";




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
    'column_name' => 'is_mega_class',
    'data_type' => 'tinyint',
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
)
//has_many
array (
  'cardface_classofcreature_atag' => 
  array (
    'prefix' => NULL,
    'type' => 'cardface_classofcreature_atag',
    'from_table' => 'cardface_classofcreature_atag',
    'from_db' => 'lore',
    'from_column' => 'classofcreature_id',
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
        'column_name' => 'atag_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'lore',
        'foreign_table' => 'atag',
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
  'classofcreature_cardface' => 
  array (
    'prefix' => NULL,
    'type' => 'classofcreature_cardface',
    'from_table' => 'classofcreature_cardface',
    'from_db' => 'lore',
    'from_column' => 'classofcreature_id',
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
    ),
  ),
  'classofcreature_creature' => 
  array (
    'prefix' => NULL,
    'type' => 'classofcreature_creature',
    'from_table' => 'classofcreature_creature',
    'from_db' => 'lore',
    'from_column' => 'classofcreature_id',
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
    ),
  ),
  'person_classofcreature_tag' => 
  array (
    'prefix' => NULL,
    'type' => 'person_classofcreature_tag',
    'from_table' => 'person_classofcreature_tag',
    'from_db' => 'lore',
    'from_column' => 'classofcreature_id',
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
)
//has_one
NULL
//belongs_to
NULL
//many_many
NULL
//many_through
NULL*\


?>