<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=5217019f5e9ee9500ffb0a0279fd9cf8
*/
namespace App\Reports;
use ftrotter\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_person_strategy_strategytag extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "person_strategy_strategytag Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the person_strategy_strategytag data
			<br>
			<a href='/DURC/person_strategy_strategytag/create'>Add new person_strategy_strategytag</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\person_strategy_strategytag::getImgField();
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

	$strategy_field = \App\strategy::getNameField();	
	$joined_select_field_sql .= "
, B_strategy.$strategy_field  AS $strategy_field
"; 
	$strategy_img_field = \App\strategy::getImgField();
	if(!is_null($strategy_img_field)){
		if($is_debug){echo "strategy has an image field of: |$strategy_img_field|
";}
		$joined_select_field_sql .= "
, B_strategy.$strategy_img_field  AS $strategy_img_field
"; 
	}

	$strategytag_field = \App\strategytag::getNameField();	
	$joined_select_field_sql .= "
, C_strategytag.$strategytag_field  AS $strategytag_field
"; 
	$strategytag_img_field = \App\strategytag::getImgField();
	if(!is_null($strategytag_img_field)){
		if($is_debug){echo "strategytag has an image field of: |$strategytag_img_field|
";}
		$joined_select_field_sql .= "
, C_strategytag.$strategytag_img_field  AS $strategytag_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
person_strategy_strategytag.id
$joined_select_field_sql 
, person_strategy_strategytag.person_id AS person_id
, person_strategy_strategytag.strategy_id AS strategy_id
, person_strategy_strategytag.strategytag_id AS strategytag_id
, person_strategy_strategytag.is_bulk_linker AS is_bulk_linker
, person_strategy_strategytag.link_note AS link_note
, person_strategy_strategytag.created_at AS created_at
, person_strategy_strategytag.updated_at AS updated_at

FROM lore.person_strategy_strategytag

LEFT JOIN lore.person AS A_person ON 
	A_person.id =
	person_strategy_strategytag.person_id

LEFT JOIN lore.strategy AS B_strategy ON 
	B_strategy.id =
	person_strategy_strategytag.strategy_id

LEFT JOIN lore.strategytag AS C_strategytag ON 
	C_strategytag.id =
	person_strategy_strategytag.strategytag_id

";

        }else{

                $sql = "
SELECT
person_strategy_strategytag.id 
$joined_select_field_sql
, person_strategy_strategytag.person_id AS person_id
, person_strategy_strategytag.strategy_id AS strategy_id
, person_strategy_strategytag.strategytag_id AS strategytag_id
, person_strategy_strategytag.is_bulk_linker AS is_bulk_linker
, person_strategy_strategytag.link_note AS link_note
, person_strategy_strategytag.created_at AS created_at
, person_strategy_strategytag.updated_at AS updated_at
 
FROM lore.person_strategy_strategytag 

LEFT JOIN lore.person AS A_person ON 
	A_person.id =
	person_strategy_strategytag.person_id

LEFT JOIN lore.strategy AS B_strategy ON 
	B_strategy.id =
	person_strategy_strategytag.strategy_id

LEFT JOIN lore.strategytag AS C_strategytag ON 
	C_strategytag.id =
	person_strategy_strategytag.strategytag_id

WHERE person_strategy_strategytag.id = $index
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
	$img_field_name = \App\person_strategy_strategytag::getImgField();
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

	$strategy_field = \App\strategy::getNameField();	
	$joined_select_field_sql .= "
, B_strategy.$strategy_field  AS $strategy_field
"; 
	$strategy_img_field = \App\strategy::getImgField();
	if(!is_null($strategy_img_field)){
		if($is_debug){echo "strategy has an image field of: |$strategy_img_field|
";}
		$joined_select_field_sql .= "
, B_strategy.$strategy_img_field  AS $strategy_img_field
"; 
	}

	$strategytag_field = \App\strategytag::getNameField();	
	$joined_select_field_sql .= "
, C_strategytag.$strategytag_field  AS $strategytag_field
"; 
	$strategytag_img_field = \App\strategytag::getImgField();
	if(!is_null($strategytag_img_field)){
		if($is_debug){echo "strategytag has an image field of: |$strategytag_img_field|
";}
		$joined_select_field_sql .= "
, C_strategytag.$strategytag_img_field  AS $strategytag_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/person_strategy_strategytag/$id'>$id</a>";



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

$strategy_tmp = ''.$strategy_field;
if(isset($row[$strategy_tmp])){
	$strategy_data = $row[$strategy_tmp];
	$row[$strategy_tmp] = "<a target='_blank' href='/Zermelo/DURC_strategy/$strategy_id'>$strategy_data</a>";
}

$strategy_img_tmp = ''.$strategy_img_field;
if(isset($row[$strategy_img_tmp]) && strlen($strategy_img_tmp) > 0){
	$strategy_img_data = $row[$strategy_img_tmp];
	$row[$strategy_img_tmp] = "<img width='200px' src='$strategy_img_data'>";
}

$strategytag_tmp = ''.$strategytag_field;
if(isset($row[$strategytag_tmp])){
	$strategytag_data = $row[$strategytag_tmp];
	$row[$strategytag_tmp] = "<a target='_blank' href='/Zermelo/DURC_strategytag/$strategytag_id'>$strategytag_data</a>";
}

$strategytag_img_tmp = ''.$strategytag_img_field;
if(isset($row[$strategytag_img_tmp]) && strlen($strategytag_img_tmp) > 0){
	$strategytag_img_data = $row[$strategytag_img_tmp];
	$row[$strategytag_img_tmp] = "<img width='200px' src='$strategytag_img_data'>";
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
    'column_name' => 'strategy_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'lore',
    'foreign_table' => 'strategy',
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  3 => 
  array (
    'column_name' => 'strategytag_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'lore',
    'foreign_table' => 'strategytag',
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
  'strategy' => 
  array (
    'prefix' => NULL,
    'type' => 'strategy',
    'to_table' => 'strategy',
    'to_db' => 'lore',
    'local_key' => 'strategy_id',
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
        'column_name' => 'strategy_name',
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
        'column_name' => 'strategy_description',
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
        'column_name' => 'strategy_url',
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
        'column_name' => 'wincon_cardface_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => true,
        'foreign_db' => 'lore',
        'foreign_table' => 'cardface',
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      5 => 
      array (
        'column_name' => 'WOTC_rule_reference',
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
    ),
  ),
  'strategytag' => 
  array (
    'prefix' => NULL,
    'type' => 'strategytag',
    'to_table' => 'strategytag',
    'to_db' => 'lore',
    'local_key' => 'strategytag_id',
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
        'column_name' => 'strategytag_name',
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
      3 => 
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