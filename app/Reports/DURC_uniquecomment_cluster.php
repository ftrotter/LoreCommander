<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=bfbb24683402b4f4bbe82742d0f0a8bf
*/
namespace App\Reports;
use ftrotter\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_uniquecomment_cluster extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "uniquecomment_cluster Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the uniquecomment_cluster data
			<br>
			<a href='/DURC/uniquecomment_cluster/create'>Add new uniquecomment_cluster</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\uniquecomment_cluster::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$comment_field = \App\comment::getNameField();	
	$joined_select_field_sql .= "
, A_comment.$comment_field  AS unique_$comment_field
"; 
	$comment_img_field = \App\comment::getImgField();
	if(!is_null($comment_img_field)){
		if($is_debug){echo "comment has an image field of: |$comment_img_field|
";}
		$joined_select_field_sql .= "
, A_comment.$comment_img_field  AS unique_$comment_img_field
"; 
	}

	$comment_field = \App\comment::getNameField();	
	$joined_select_field_sql .= "
, B_comment.$comment_field  AS other_unique_$comment_field
"; 
	$comment_img_field = \App\comment::getImgField();
	if(!is_null($comment_img_field)){
		if($is_debug){echo "comment has an image field of: |$comment_img_field|
";}
		$joined_select_field_sql .= "
, B_comment.$comment_img_field  AS other_unique_$comment_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
uniquecomment_cluster.id
$joined_select_field_sql 
, uniquecomment_cluster.unique_comment_id AS unique_comment_id
, uniquecomment_cluster.other_unique_comment_id AS other_unique_comment_id
, uniquecomment_cluster.score AS score
, uniquecomment_cluster.diff_text AS diff_text

FROM mirrulation.uniquecomment_cluster

LEFT JOIN mirrulation.comment AS A_comment ON 
	A_comment.id =
	uniquecomment_cluster.unique_comment_id

LEFT JOIN mirrulation.comment AS B_comment ON 
	B_comment.id =
	uniquecomment_cluster.other_unique_comment_id

";

        }else{

                $sql = "
SELECT
uniquecomment_cluster.id 
$joined_select_field_sql
, uniquecomment_cluster.unique_comment_id AS unique_comment_id
, uniquecomment_cluster.other_unique_comment_id AS other_unique_comment_id
, uniquecomment_cluster.score AS score
, uniquecomment_cluster.diff_text AS diff_text
 
FROM mirrulation.uniquecomment_cluster 

LEFT JOIN mirrulation.comment AS A_comment ON 
	A_comment.id =
	uniquecomment_cluster.unique_comment_id

LEFT JOIN mirrulation.comment AS B_comment ON 
	B_comment.id =
	uniquecomment_cluster.other_unique_comment_id

WHERE uniquecomment_cluster.id = $index
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
	$img_field_name = \App\uniquecomment_cluster::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$comment_field = \App\comment::getNameField();	
	$joined_select_field_sql .= "
, A_comment.$comment_field  AS unique_$comment_field
"; 
	$comment_img_field = \App\comment::getImgField();
	if(!is_null($comment_img_field)){
		if($is_debug){echo "comment has an image field of: |$comment_img_field|
";}
		$joined_select_field_sql .= "
, A_comment.$comment_img_field  AS unique_$comment_img_field
"; 
	}

	$comment_field = \App\comment::getNameField();	
	$joined_select_field_sql .= "
, B_comment.$comment_field  AS other_unique_$comment_field
"; 
	$comment_img_field = \App\comment::getImgField();
	if(!is_null($comment_img_field)){
		if($is_debug){echo "comment has an image field of: |$comment_img_field|
";}
		$joined_select_field_sql .= "
, B_comment.$comment_img_field  AS other_unique_$comment_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/uniquecomment_cluster/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$unique_comment_tmp = 'unique_'.$comment_field;
if(isset($row[$unique_comment_tmp])){
	$unique_comment_data = $row[$unique_comment_tmp];
	$row[$unique_comment_tmp] = "<a target='_blank' href='/Zermelo/DURC_comment/$unique_comment_id'>$unique_comment_data</a>";
}

$unique_comment_img_tmp = 'unique_'.$comment_img_field;
if(isset($row[$unique_comment_img_tmp]) && strlen($unique_comment_img_tmp) > 0){
	$unique_comment_img_data = $row[$unique_comment_img_tmp];
	$row[$unique_comment_img_tmp] = "<img width='200px' src='$unique_comment_img_data'>";
}

$other_unique_comment_tmp = 'other_unique_'.$comment_field;
if(isset($row[$other_unique_comment_tmp])){
	$other_unique_comment_data = $row[$other_unique_comment_tmp];
	$row[$other_unique_comment_tmp] = "<a target='_blank' href='/Zermelo/DURC_comment/$other_unique_comment_id'>$other_unique_comment_data</a>";
}

$other_unique_comment_img_tmp = 'other_unique_'.$comment_img_field;
if(isset($row[$other_unique_comment_img_tmp]) && strlen($other_unique_comment_img_tmp) > 0){
	$other_unique_comment_img_data = $row[$other_unique_comment_img_tmp];
	$row[$other_unique_comment_img_tmp] = "<img width='200px' src='$other_unique_comment_img_data'>";
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
)
//has_many
NULL
//has_one
NULL
//belongs_to
array (
  'unique_comment' => 
  array (
    'prefix' => 'unique',
    'type' => 'comment',
    'to_table' => 'comment',
    'to_db' => 'mirrulation',
    'local_key' => 'unique_comment_id',
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
  'other_unique_comment' => 
  array (
    'prefix' => 'other_unique',
    'type' => 'comment',
    'to_table' => 'comment',
    'to_db' => 'mirrulation',
    'local_key' => 'other_unique_comment_id',
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
)
//many_many
NULL
//many_through
NULL*/


?>