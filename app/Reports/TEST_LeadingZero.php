<?php


namespace App\Reports;


use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class TEST_LeadingZero extends AbstractTabularReport
{
    /*
* Get the Report Name
*/
    public function GetReportName(): string {
        return("Leading Zero Report");
    }

    /*
* Get the Report Description, bootstrap styled html is OK
*/
    public function GetReportDescription(): ?string {
        $desc = "<p>
Values with leading zeros
</p>
";
        return($desc);
    }

    public function GetSQL()
    {
        //replace with your own SQL
        $sql = "
        SELECT * 
        FROM DURC_aaa.leading_zero
        ";
        return $sql;
    }
}
