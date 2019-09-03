<?php

namespace App\Reports;
use CareSet\Zermelo\Reports\Graph\AbstractGraphReport;

class PCGraphPics extends AbstractGraphReport
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

// a good url for target...

        $sql = "
SELECT 
    CONCAT('person_',person_id) AS source_id,
    CONCAT(first_name, ' ', last_name) AS source_name,
    2000 AS source_size,
    'MTG Person'  AS source_type,
    'MTG Person' AS source_group,
    0 AS source_latitude,
    0 AS source_longitude,
    CONCAT('/DURC/json/person/',person.id) AS source_json_url,
    person.image_uri AS source_img,
    CONCAT('classofcreature_',classofcreature_id) AS target_id,
    classofcreature_name AS target_name,
    1500 AS target_size,
    'Class of Creature' AS target_type,
    'Class of Creature' AS target_group,
    0 AS target_latitude,
    0 AS target_longitude,
    CONCAT('/DURC/json/classofcreature/',classofcreature.id) AS target_json_url,
    classofcreature_img_uri AS target_img,
    50 AS weight,
    'any' AS link_type,
    1 AS query_num
FROM lore.person_classofcreature_tag
LEFT JOIN lore.person ON 
	person.id =
    	person_id
LEFT JOIN lore.classofcreature ON 
	classofcreature.id =
    	classofcreature_id
GROUP BY classofcreature_id, person_id
";

        return $sql;
    }

    /**
     * Can customize the report view based on the report
     * By default, use the view defined in the configuration file.
     *
     */
    public $REPORT_VIEW = null;

}
