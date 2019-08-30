<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=b56f5e41a76ae28cc59f1cedd0aa1b3a
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_person_creature_tag extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "person_creature_tag Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the person_creature_tag data
			<br>
			<a href='/DURC/person_creature_tag/create'>Add new person_creature_tag</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $index = $this->getCode();

        if(is_null($index)){

                $sql = "
SELECT * FROM lore.person_creature_tag
";

        }else{

                $sql = "
SELECT * FROM lore.person_creature_tag WHERE id = $index
";

        }

        $is_debug = false;
        if($is_debug){
                echo "<pre>$sql";
                exit();
        }

        return $sql;
    }

    //decorate the results of the query with useful results
    public function MapRow(array $row, int $row_number) :array
    {

        extract($row);

        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/person_creature_tag/$id'>$id</a>";

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
?>