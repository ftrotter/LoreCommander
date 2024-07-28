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

        $sql = "

SELECT
    `unique_comment_id` AS source_id,
    left_comment.commentId AS source_name,
    500 AS source_size,
    'Comment'  AS source_type,
    'Comment' AS source_group,
    0 AS source_latitude,
    0 AS source_longitude,
    CONCAT('/DURC/json/comment/',unique_comment_id) AS source_json_url,
    '' AS source_img,
    `other_unique_comment_id` AS target_id,
    right_comment.commentId AS target_name,
    500 AS target_size,
    'Comment' AS target_type,
    'Comment' AS target_group,
    0 AS target_latitude,
    0 AS target_longitude,
    CONCAT('/DURC/json/comment/',other_unique_comment_id) AS target_json_url,
    '' AS target_img,
    Round(50 * `score`,0) AS weight,
    '' AS link_type,
    1 AS query_num
FROM $db.comment_cluster
JOIN $db.comment AS left_comment ON 
	left_comment.id = 
	comment_cluster.unique_comment_id 
JOIN $db.comment AS right_comment ON 
	right_comment.id = 
	comment_cluster.other_unique_comment_id 
WHERE unique_comment_id = 1 OR other_unique_comment_id = 1
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

}
