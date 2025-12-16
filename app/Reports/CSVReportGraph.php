<?php

namespace App\Reports;
use ftrotter\ZZermelo\Reports\Graph\AbstractGraphReport;

class CSVReportGraph extends AbstractGraphReport
{

    /*
    * Get the Report Name, by default it will fetch the const REPORT_NAME.
    * This can be overridden to custom return different Name based on Input
    */
    public function GetReportName(): string
    {
	return("Person to Creature Relationships");
    }

    /*
    * Get the Report Description, by default it will fetch the const DESCRIPTION.
    * This can be overridden to custom return different description based on Input
    */
    public function getReportDescription(): string
    {
        return("Shows how a card related to other cards and entities");
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

        $csv_table_name = $this->getCode();

// a good url for target...

        // Use SELECT * to pick up all columns including optional ones like:
        // source_group_order, target_group_order (for controlling Group Gravity left-to-right ordering)
        // source_latitude, source_longitude, target_latitude, target_longitude (for geo positioning)
        // source_img, target_img (for node images)
        // source_json_url, target_json_url (for node click details)
        $sql = "
SELECT *
FROM graph_reports.$csv_table_name
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
