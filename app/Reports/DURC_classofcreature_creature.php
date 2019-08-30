<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=d9daf03ab457d86bf6db6f7906f8cc26
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_classofcreature_creature extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "classofcreature_creature Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the classofcreature_creature data
			<br>
			<a href='/DURC/classofcreature_creature/create'>Add new classofcreature_creature</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $index = $this->getCode();

        if(is_null($index)){

                $sql = "
SELECT * FROM lore.classofcreature_creature
";

        }else{

                $sql = "
SELECT * FROM lore.classofcreature_creature WHERE id = $index
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
        $row['id'] = "<a href='/DURC/classofcreature_creature/$id'>$id</a>";

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