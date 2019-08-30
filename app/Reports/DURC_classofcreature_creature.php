<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=793b5e1eae725ea1a7b272d312133cc2
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

        $index = $this->getCode();


$classofcreature_field = \App\classofcreature::getNameField();
$creature_field = \App\creature::getNameField();


        if(is_null($index)){

                $sql = "
SELECT 
 classofcreature_creature.id AS id
, classofcreature.$classofcreature_field AS $classofcreature_field
, creature.$creature_field AS $creature_field
, classofcreature_creature.created_at AS created_at
, classofcreature_creature.updated_at AS updated_at
, classofcreature_creature.classofcreature_id AS classofcreature_id
, classofcreature_creature.creature_id AS creature_id

FROM lore.classofcreature_creature

LEFT JOIN lore.classofcreature ON 
	classofcreature.id =
	classofcreature_creature.classofcreature_id

LEFT JOIN lore.creature ON 
	creature.id =
	classofcreature_creature.creature_id

";

        }else{

                $sql = "
SELECT 
 classofcreature_creature.id AS id
, classofcreature.$classofcreature_field AS $classofcreature_field
, creature.$creature_field AS $creature_field
, classofcreature_creature.created_at AS created_at
, classofcreature_creature.updated_at AS updated_at
, classofcreature_creature.classofcreature_id AS classofcreature_id
, classofcreature_creature.creature_id AS creature_id
 
FROM lore.classofcreature_creature 
WHERE id = $index
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


$classofcreature_field = \App\classofcreature::getNameField();
$creature_field = \App\creature::getNameField();

        extract($row);

        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/classofcreature_creature/$id'>$id</a>";


$classofcreature_tmp = $$classofcreature_field;
if(isset($classofcreature_tmp)){
	$row[$classofcreature_field] = "<a target='_blank' href='/Zermelo/DURC_classofcreature/$classofcreature_id'>$classofcreature_tmp</a>";
}

$creature_tmp = $$creature_field;
if(isset($creature_tmp)){
	$row[$creature_field] = "<a target='_blank' href='/Zermelo/DURC_creature/$creature_id'>$creature_tmp</a>";
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
)
//many_many
NULL
//many_through
NULL*\


?>