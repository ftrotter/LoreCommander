<?php

namespace App\Reports;
use ftrotter\Zermelo\Reports\Graph\AbstractGraphReport;

class GraphArtisanTest extends AbstractGraphReport
{

    // define the report name
    public function GetReportName(): string { return("GraphArtisanTest"); }

    // define the report description
    public function getReportDescription(): string {  return("GraphArtisanTest REPORT DESCRIPTION"); }



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

//you must have the following fields defined...
/*
	source_id = the identifier to use for this node when linking in this graph
	source_name = the name to display on the graph UX for this node
	source_size = the size of the node on the graph
	source_longitude = the longitude of this node (usually is 0)
	source_latitude = the latitude of this node (usually is 0)
	source_img = the img that should be used intead of a shape for this node
	source_json_url =  the url to get more info about this node

	target_id = the identifier to use for this node when linking in this graph
	target_name = the name to display on the graph UX for this node
	target_size = the size of the node on the graph
	target_longitude = the longitude of this node (usually is 0)
	target_latitude = the latitude of this node (usually is 0)
	target_img = the img that should be used intead of a shape for this node
	target_json_url = the url to get more info about this node

	weight = the score of the link between the source and target nodes
	link_type = the type of link between the soure and target nodes
	query_num = what order should we do the query? values from nodes are shoudl reset by content from later queries
	
*/

	$sql = [];

//databases to table connections... databases will be our largest nodes
        $sql[] = "
SELECT
	CONCAT('database:',TABLE_SCHEMA) AS source_id, 
	TABLE_SCHEMA AS source_name, 
	100 AS source_size, 
	'Schema         ' AS source_type, 
	'Database       ' AS source_group, 
	0 AS source_longitude, 
	0 AS source_latitude, 
	'' AS source_json_url,
	'' AS source_img, 
	CONCAT('table:',TABLE_NAME) AS target_id, 
	TABLE_NAME AS target_name, 
	80 AS target_size, 
	'Schema         ' AS target_type, 
	'Table                       ' AS target_group, 
	0 AS target_longitude, 
	0 AS target_latitude, 
	'' AS target_json_url,
	'' target_img, 
	10 AS weight, 
	'Database has this table                                            ' AS link_type, 
	1 AS query_num
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA != 'information_schema' AND TABLE_SCHEMA != 'mysql'
GROUP BY TABLE_SCHEMA, TABLE_NAME
";


//columns to table... will reveal column names that are the same across tables...
        $sql[] = "
SELECT
	CONCAT('column:',COLUMN_NAME) AS source_id, 
	COLUMN_NAME AS source_name, 
	50 AS source_size, 
	'Schema' AS source_type, 
	'Column' AS source_group, 
	0 AS source_longitude, 
	0 AS source_latitude, 
	'' AS source_json_url,
	'' AS source_img, 
	CONCAT('table:',TABLE_NAME) AS target_id, 
	TABLE_NAME AS target_name, 
	80 AS target_size, 
	'Schema' AS target_type, 
	'Table' AS target_group, 
	0 AS target_longitude, 
	0 AS target_latitude, 
	'' AS target_json_url,
	'' target_img, 
	10 AS weight, 
	'Table has this column' AS link_type, 
	1 AS query_num
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA != 'information_schema' AND TABLE_SCHEMA != 'mysql'
";



//columns to column types... should create the nexus of the graph, since there are only so many.. 
        $sql[] = "
SELECT
	CONCAT('column:',COLUMN_NAME) AS source_id, 
	COLUMN_NAME AS source_name, 
	50 AS source_size, 
	'Schema' AS source_type, 
	'Column' AS source_group, 
	0 AS source_longitude, 
	0 AS source_latitude, 
	'' AS source_json_url,
	'' AS source_img, 
	CONCAT('datatype:',DATA_TYPE) AS target_id, 
	DATA_TYPE AS target_name, 
	150 AS target_size, 
	'Schema' AS target_type, 
	'Data Type' AS target_group, 
	0 AS target_longitude, 
	0 AS target_latitude, 
	'' AS target_json_url,
	'' target_img, 
	10 AS weight, 
	'Column sometimes has this data type' AS link_type, 
	1 AS query_num
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA != 'information_schema' AND TABLE_SCHEMA != 'mysql'
";


        return $sql;
    }

    /**
     * Each row content will be passed to MapRow.
     * Values and header names can be changed.
     * Columns cannot be added or removed
     *
     */
    public function MapRow(array $row, int $row_number) :array
    {

        /*
        //this logic would ensure that every cell in the TABLE_NAME column, was converted to a link to
        //a table drilldown report
        $table_name = $row['TABLE_NAME'];
        $row[''] = "<a href='/Zermelo/TableDrillDownReport/$table_name/'>$table_name</a>";

    */

        return $row;
    }

    /**
     * Can customize the report view based on the report
     * By default, use the view defined in the configuration file.
     *
     */
    public $REPORT_VIEW = null;


    //Should this report use the report caching functions (usefuly for very slow reports)
   public function isCacheEnabled(){ return(false); }

   //If we are using the cache... how long before it refreshes itself?
   public function howLongToCacheInSeconds(){
        return(1200); //twenty minutes by default
   }



}
