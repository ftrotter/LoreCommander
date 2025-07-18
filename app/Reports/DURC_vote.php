<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=636778abd6e12b76fe8cfbf9cc688bec
*/
namespace App\Reports;
use ftrotter\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_vote extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "vote Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the vote data
			<br>
			<a href='/DURC/vote/create'>Add new vote</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\vote::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$post_field = \App\post::getNameField();	
	$joined_select_field_sql .= "
, A_post.$post_field  AS $post_field
"; 
	$post_img_field = \App\post::getImgField();
	if(!is_null($post_img_field)){
		if($is_debug){echo "post has an image field of: |$post_img_field|
";}
		$joined_select_field_sql .= "
, A_post.$post_img_field  AS $post_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
vote.id
$joined_select_field_sql 
, vote.post_id AS post_id
, vote.votenum AS votenum
, vote.updated_at AS updated_at
, vote.created_at AS created_at

FROM DURC_aaa.vote

LEFT JOIN DURC_aaa.post AS A_post ON 
	A_post.id =
	vote.post_id

";

        }else{

                $sql = "
SELECT
vote.id 
$joined_select_field_sql
, vote.post_id AS post_id
, vote.votenum AS votenum
, vote.updated_at AS updated_at
, vote.created_at AS created_at
 
FROM DURC_aaa.vote 

LEFT JOIN DURC_aaa.post AS A_post ON 
	A_post.id =
	vote.post_id

WHERE vote.id = $index
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
	$img_field_name = \App\vote::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$post_field = \App\post::getNameField();	
	$joined_select_field_sql .= "
, A_post.$post_field  AS $post_field
"; 
	$post_img_field = \App\post::getImgField();
	if(!is_null($post_img_field)){
		if($is_debug){echo "post has an image field of: |$post_img_field|
";}
		$joined_select_field_sql .= "
, A_post.$post_img_field  AS $post_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/vote/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$post_tmp = ''.$post_field;
if(isset($row[$post_tmp])){
	$post_data = $row[$post_tmp];
	$row[$post_tmp] = "<a target='_blank' href='/Zermelo/DURC_post/$post_id'>$post_data</a>";
}

$post_img_tmp = ''.$post_img_field;
if(isset($row[$post_img_tmp]) && strlen($post_img_tmp) > 0){
	$post_img_data = $row[$post_img_tmp];
	$row[$post_img_tmp] = "<img width='200px' src='$post_img_data'>";
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
    'column_name' => 'post_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => true,
    'foreign_db' => 'DURC_aaa',
    'foreign_table' => 'post',
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  2 => 
  array (
    'column_name' => 'votenum',
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
    'column_name' => 'updated_at',
    'data_type' => 'datetime',
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
    'column_name' => 'created_at',
    'data_type' => 'datetime',
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
array (
  'post' => 
  array (
    'prefix' => NULL,
    'type' => 'post',
    'to_table' => 'post',
    'to_db' => 'DURC_aaa',
    'local_key' => 'post_id',
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
        'column_name' => 'title',
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
        'column_name' => 'content',
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
        'column_name' => 'created_at',
        'data_type' => 'datetime',
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
        'column_name' => 'updated_at',
        'data_type' => 'datetime',
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