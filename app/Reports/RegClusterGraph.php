<?php

namespace App\Reports;
use CareSet\Zermelo\Reports\Graph\AbstractGraphReport;

class RegClusterGraph extends AbstractGraphReport
{

    /*
    * Get the Report Name, by default it will fetch the const REPORT_NAME.
    * This can be overridden to custom return different Name based on Input
    */
    public function GetReportName(): string
    {
	return("Regulation Cluster Graph");
    }

    /*
    * Get the Report Description, by default it will fetch the const DESCRIPTION.
    * This can be overridden to custom return different description based on Input
    */
    public function getReportDescription(): string
    {
        return("Shows cluster of regulations");
    }

    /**
     * This is what builds the report. It will accept a SQL statement or an Array of sql statements.
     * Can be used in conjunction with Inputs to determine different output based on URI parameters
     * Additional URI parameters are passed as
     *	$this->getCode() - which will give the first url segment after the report name
     *   $this->getParameters() - which will give an array of every later url segment after the getCode value
     *   $this->getInputs() - which will give _GET parameters (etc?)
     **/
    public function GetSQL()
    {

// a good url for target...

	$db = 'mirrulation';

	$count_factor = 300;
	$weight_factor = 10;
	$biggest_bubble = 10000;

	#TODO investigate why weight is coming out as a string?
	#the thickness of the lines should be doing something for us.

        $sql = "

SELECT
    left_comment.id AS source_id,
    CONCAT(left_comment.commentId,' ',unique_comment_id) AS source_name,
    IF(left_uniquecomment.comment_count * $count_factor > $biggest_bubble,
		$biggest_bubble, 
		left_uniquecomment.comment_count * $count_factor) AS source_size,
    'Comment'  AS source_type,
    'Comment' AS source_group,
    0 AS source_latitude,
    0 AS source_longitude,
    CONCAT('/DURC/json/comment/',left_comment.id) AS source_json_url,
    '' AS source_img,
    right_comment.id AS target_id,
    CONCAT(right_comment.commentId,' ',other_unique_comment_id) AS target_name,
    IF(right_uniquecomment.comment_count * $count_factor > $biggest_bubble,
		$biggest_bubble, 
		right_uniquecomment.comment_count * $count_factor) AS target_size,
    'Comment' AS target_type,
    'Comment' AS target_group,
    0 AS target_latitude,
    0 AS target_longitude,
    CONCAT('/DURC/json/comment/',right_comment.id) AS target_json_url,
    '' AS target_img,
    ROUND($weight_factor * `score`,-1) AS weight,
    '' AS link_type,
    1 AS query_num
FROM $db.uniquecomment_cluster
JOIN $db.uniquecomment AS left_uniquecomment ON 
	left_uniquecomment.id = 
	uniquecomment_cluster.unique_comment_id 
JOIN $db.uniquecomment_to_comment AS u_to_c_left ON 
	u_to_c_left.uniquecomment_id =
	left_uniquecomment.id
JOIN $db.comment AS left_comment ON 
	left_comment.id =
	u_to_c_left.comment_id
JOIN $db.uniquecomment AS right_uniquecomment ON 
	right_uniquecomment.id = 
	uniquecomment_cluster.other_unique_comment_id 
JOIN $db.uniquecomment_to_comment AS u_to_c_right ON
        u_to_c_right.uniquecomment_id =
        right_uniquecomment.id
JOIN $db.comment AS right_comment ON
        right_comment.id =
        u_to_c_right.comment_id
WHERE unique_comment_id = 1 OR other_unique_comment_id = 1
GROUP BY `unique_comment_id`, `other_unique_comment_id`
";

        return $sql;
    }

    /**
     * Can customize the report view based on the report
     * By default, use the view defined in the configuration file.
     *
     */
    public $REPORT_VIEW = null;

    /**
    * This function will determine if replacing /ZermeloCard/ with /ZeremeloSQL/ will show the SQL of the report
    * for security reasons it should be off by default.
    */
   public function isSQLPrintEnabled(): bool{
         return(true); //protect the sql by default
   }

   public function isCacheEnabled(){
        return(false);
   }

}
