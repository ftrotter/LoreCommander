<?php

namespace App\Reports;
use ftrotter\Zermelo\Reports\Graph\AbstractGraphReport;

class RegGraph extends AbstractGraphReport
{

    /*
    * Get the Report Name, by default it will fetch the const REPORT_NAME.
    * This can be overridden to custom return different Name based on Input
    */
    public function GetReportName(): string
    {
	return("DEA Marijuana Regulation Graph");
    }

    /*
    * Get the Report Description, by default it will fetch the const DESCRIPTION.
    * This can be overridden to custom return different description based on Input
    */
    public function getReportDescription(): string
    {
        return("Show connections between comments");
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

        $sql = "
SELECT 
    CONCAT('person_',person_id) AS source_id,
    CONCAT(first_name, ' ', last_name) AS source_name,
    500 AS source_size,
    'MTG Person'  AS source_type,
    'MTG Person' AS source_group,
    0 AS source_latitude,
    0 AS source_longitude,
    CONCAT('/DURC/json/person/',person.id) AS source_json_url,
    '' AS source_img,
    CONCAT('classofc_',classofc_id) AS target_id,
    classofc_name AS target_name,
    500 AS target_size,
    'Class of Creature' AS target_type,
    'Class of Creature' AS target_group,
    0 AS target_latitude,
    0 AS target_longitude,
    CONCAT('/DURC/json/classofc/',classofc.id) AS target_json_url,
    '' AS target_img,
    50 AS weight,
    'any' AS link_type,
    1 AS query_num
FROM lore.person_classofc_tag
LEFT JOIN lore.person ON 
	person.id =
    	person_id
LEFT JOIN lore.classofc ON 
	classofc.id =
    	classofc_id
GROUP BY person_id, first_name, last_name, person.id, classofc_id, classofc_name, classofc.id 
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
