<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=51b2d0a6b4b44f0ac29c6036640304f8
*/
namespace App\Reports;
use ftrotter\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_uniquecomment_to_comment extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "uniquecomment_to_comment Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the uniquecomment_to_comment data
			<br>
			<a href='/DURC/uniquecomment_to_comment/create'>Add new uniquecomment_to_comment</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\uniquecomment_to_comment::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$comment_field = \App\comment::getNameField();	
	$joined_select_field_sql .= "
, A_comment.$comment_field  AS $comment_field
"; 
	$comment_img_field = \App\comment::getImgField();
	if(!is_null($comment_img_field)){
		if($is_debug){echo "comment has an image field of: |$comment_img_field|
";}
		$joined_select_field_sql .= "
, A_comment.$comment_img_field  AS $comment_img_field
"; 
	}

	$uniquecomment_field = \App\uniquecomment::getNameField();	
	$joined_select_field_sql .= "
, B_uniquecomment.$uniquecomment_field  AS $uniquecomment_field
"; 
	$uniquecomment_img_field = \App\uniquecomment::getImgField();
	if(!is_null($uniquecomment_img_field)){
		if($is_debug){echo "uniquecomment has an image field of: |$uniquecomment_img_field|
";}
		$joined_select_field_sql .= "
, B_uniquecomment.$uniquecomment_img_field  AS $uniquecomment_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
uniquecomment_to_comment.id
$joined_select_field_sql 
, uniquecomment_to_comment.comment_id AS comment_id
, uniquecomment_to_comment.uniquecomment_id AS uniquecomment_id

FROM mirrulation.uniquecomment_to_comment

LEFT JOIN mirrulation.comment AS A_comment ON 
	A_comment.id =
	uniquecomment_to_comment.comment_id

LEFT JOIN mirrulation.uniquecomment AS B_uniquecomment ON 
	B_uniquecomment.id =
	uniquecomment_to_comment.uniquecomment_id

";

        }else{

                $sql = "
SELECT
uniquecomment_to_comment.id 
$joined_select_field_sql
, uniquecomment_to_comment.comment_id AS comment_id
, uniquecomment_to_comment.uniquecomment_id AS uniquecomment_id
 
FROM mirrulation.uniquecomment_to_comment 

LEFT JOIN mirrulation.comment AS A_comment ON 
	A_comment.id =
	uniquecomment_to_comment.comment_id

LEFT JOIN mirrulation.uniquecomment AS B_uniquecomment ON 
	B_uniquecomment.id =
	uniquecomment_to_comment.uniquecomment_id

WHERE uniquecomment_to_comment.id = $index
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
	$img_field_name = \App\uniquecomment_to_comment::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$comment_field = \App\comment::getNameField();	
	$joined_select_field_sql .= "
, A_comment.$comment_field  AS $comment_field
"; 
	$comment_img_field = \App\comment::getImgField();
	if(!is_null($comment_img_field)){
		if($is_debug){echo "comment has an image field of: |$comment_img_field|
";}
		$joined_select_field_sql .= "
, A_comment.$comment_img_field  AS $comment_img_field
"; 
	}

	$uniquecomment_field = \App\uniquecomment::getNameField();	
	$joined_select_field_sql .= "
, B_uniquecomment.$uniquecomment_field  AS $uniquecomment_field
"; 
	$uniquecomment_img_field = \App\uniquecomment::getImgField();
	if(!is_null($uniquecomment_img_field)){
		if($is_debug){echo "uniquecomment has an image field of: |$uniquecomment_img_field|
";}
		$joined_select_field_sql .= "
, B_uniquecomment.$uniquecomment_img_field  AS $uniquecomment_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/uniquecomment_to_comment/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$comment_tmp = ''.$comment_field;
if(isset($row[$comment_tmp])){
	$comment_data = $row[$comment_tmp];
	$row[$comment_tmp] = "<a target='_blank' href='/Zermelo/DURC_comment/$comment_id'>$comment_data</a>";
}

$comment_img_tmp = ''.$comment_img_field;
if(isset($row[$comment_img_tmp]) && strlen($comment_img_tmp) > 0){
	$comment_img_data = $row[$comment_img_tmp];
	$row[$comment_img_tmp] = "<img width='200px' src='$comment_img_data'>";
}

$uniquecomment_tmp = ''.$uniquecomment_field;
if(isset($row[$uniquecomment_tmp])){
	$uniquecomment_data = $row[$uniquecomment_tmp];
	$row[$uniquecomment_tmp] = "<a target='_blank' href='/Zermelo/DURC_uniquecomment/$uniquecomment_id'>$uniquecomment_data</a>";
}

$uniquecomment_img_tmp = ''.$uniquecomment_img_field;
if(isset($row[$uniquecomment_img_tmp]) && strlen($uniquecomment_img_tmp) > 0){
	$uniquecomment_img_data = $row[$uniquecomment_img_tmp];
	$row[$uniquecomment_img_tmp] = "<img width='200px' src='$uniquecomment_img_data'>";
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
    'column_name' => 'comment_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => true,
    'foreign_db' => 'mirrulation',
    'foreign_table' => 'comment',
    'is_nullable' => false,
    'default_value' => '0',
    'is_auto_increment' => false,
  ),
  1 => 
  array (
    'column_name' => 'uniquecomment_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => true,
    'foreign_db' => 'mirrulation',
    'foreign_table' => 'uniquecomment',
    'is_nullable' => false,
    'default_value' => '0',
    'is_auto_increment' => false,
  ),
)
//has_many
NULL
//has_one
NULL
//belongs_to
array (
  'comment' => 
  array (
    'prefix' => NULL,
    'type' => 'comment',
    'to_table' => 'comment',
    'to_db' => 'mirrulation',
    'local_key' => 'comment_id',
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
      7 => 
      array (
        'column_name' => 'simplified_comment_text_md5',
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
    ),
  ),
  'uniquecomment' => 
  array (
    'prefix' => NULL,
    'type' => 'uniquecomment',
    'to_table' => 'uniquecomment',
    'to_db' => 'mirrulation',
    'local_key' => 'uniquecomment_id',
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
        'column_name' => 'simplified_comment_text_md5',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => 'NULL',
        'is_auto_increment' => false,
      ),
      2 => 
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
      3 => 
      array (
        'column_name' => 'comment_count',
        'data_type' => 'bigint',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => false,
        'default_value' => NULL,
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