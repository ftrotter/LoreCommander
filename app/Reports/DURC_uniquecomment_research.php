<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=b0bf8edf0c278b16a225d7af0ef2cac7
*/
namespace App\Reports;
use ftrotter\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_uniquecomment_research extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "uniquecomment_research Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the uniquecomment_research data
			<br>
			<a href='/DURC/uniquecomment_research/create'>Add new uniquecomment_research</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\uniquecomment_research::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';




        if(is_null($index)){

                $sql = "
SELECT
uniquecomment_research.id
$joined_select_field_sql 
, uniquecomment_research.simplified_comment_text_md5 AS simplified_comment_text_md5
, uniquecomment_research.uniquecomment_name AS uniquecomment_name
, uniquecomment_research.uniquecomment_org_url AS uniquecomment_org_url
, uniquecomment_research.uniquecomment_wayback_machine_url AS uniquecomment_wayback_machine_url

FROM mirrulation.uniquecomment_research

";

        }else{

                $sql = "
SELECT
uniquecomment_research.id 
$joined_select_field_sql
, uniquecomment_research.simplified_comment_text_md5 AS simplified_comment_text_md5
, uniquecomment_research.uniquecomment_name AS uniquecomment_name
, uniquecomment_research.uniquecomment_org_url AS uniquecomment_org_url
, uniquecomment_research.uniquecomment_wayback_machine_url AS uniquecomment_wayback_machine_url
 
FROM mirrulation.uniquecomment_research 

WHERE uniquecomment_research.id = $index
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
	$img_field_name = \App\uniquecomment_research::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';





        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/uniquecomment_research/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
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
    'column_name' => 'simplified_comment_text_md5',
    'data_type' => 'varchar',
    'is_primary_key' => true,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  1 => 
  array (
    'column_name' => 'uniquecomment_name',
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
    'column_name' => 'uniquecomment_org_url',
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
    'column_name' => 'uniquecomment_wayback_machine_url',
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
)
//has_many
NULL
//has_one
NULL
//belongs_to
NULL
//many_many
NULL
//many_through
NULL*/


?>