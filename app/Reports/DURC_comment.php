<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=d0287cd844c7361b5385ea03c2522481
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_comment extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "comment Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the comment data
			<br>
			<a href='/DURC/comment/create'>Add new comment</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\comment::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';




        if(is_null($index)){

                $sql = "
SELECT
comment.id
$joined_select_field_sql 
, comment.commentId AS commentId
, comment.comment_on_documentId AS comment_on_documentId
, comment.comment_date_text AS comment_date_text
, comment.comment_date AS comment_date
, comment.comment_text AS comment_text
, comment.simplified_comment_text AS simplified_comment_text

FROM mirrulation.comment

";

        }else{

                $sql = "
SELECT
comment.id 
$joined_select_field_sql
, comment.commentId AS commentId
, comment.comment_on_documentId AS comment_on_documentId
, comment.comment_date_text AS comment_date_text
, comment.comment_date AS comment_date
, comment.comment_text AS comment_text
, comment.simplified_comment_text AS simplified_comment_text
 
FROM mirrulation.comment 

WHERE comment.id = $index
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
	$img_field_name = \App\comment::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';





        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/comment/$id'>$id</a>";



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
    'column_name' => 'commentId',
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
    'column_name' => 'comment_on_documentId',
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
    'column_name' => 'comment_date_text',
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
    'column_name' => 'comment_date',
    'data_type' => 'datetime',
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
    'column_name' => 'comment_text',
    'data_type' => 'longtext',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  6 => 
  array (
    'column_name' => 'simplified_comment_text',
    'data_type' => 'longtext',
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
array (
  'unique_comment_cluster' => 
  array (
    'prefix' => 'unique',
    'type' => 'comment_cluster',
    'from_table' => 'comment_cluster',
    'from_db' => 'mirrulation',
    'from_column' => 'unique_comment_id',
    'other_columns' => 
    array (
      0 => 
      array (
        'column_name' => 'unique_comment_id',
        'data_type' => 'int',
        'is_primary_key' => true,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'mirrulation',
        'foreign_table' => 'comment',
        'is_nullable' => false,
        'default_value' => NULL,
        'is_auto_increment' => false,
      ),
      1 => 
      array (
        'column_name' => 'other_unique_comment_id',
        'data_type' => 'int',
        'is_primary_key' => true,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'mirrulation',
        'foreign_table' => 'comment',
        'is_nullable' => false,
        'default_value' => NULL,
        'is_auto_increment' => false,
      ),
      2 => 
      array (
        'column_name' => 'score',
        'data_type' => 'decimal',
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
        'column_name' => 'diff_text',
        'data_type' => 'text',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
    ),
  ),
  'other_unique_comment_cluster' => 
  array (
    'prefix' => 'other_unique',
    'type' => 'comment_cluster',
    'from_table' => 'comment_cluster',
    'from_db' => 'mirrulation',
    'from_column' => 'other_unique_comment_id',
    'other_columns' => 
    array (
      0 => 
      array (
        'column_name' => 'unique_comment_id',
        'data_type' => 'int',
        'is_primary_key' => true,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'mirrulation',
        'foreign_table' => 'comment',
        'is_nullable' => false,
        'default_value' => NULL,
        'is_auto_increment' => false,
      ),
      1 => 
      array (
        'column_name' => 'other_unique_comment_id',
        'data_type' => 'int',
        'is_primary_key' => true,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'mirrulation',
        'foreign_table' => 'comment',
        'is_nullable' => false,
        'default_value' => NULL,
        'is_auto_increment' => false,
      ),
      2 => 
      array (
        'column_name' => 'score',
        'data_type' => 'decimal',
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
        'column_name' => 'diff_text',
        'data_type' => 'text',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
    ),
  ),
)
//belongs_to
NULL
//many_many
NULL
//many_through
NULL*/


?>