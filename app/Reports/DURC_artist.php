<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=392f5ac6e9f85054b65b64e4579d5f88
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_artist extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "artist Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the artist data
			<br>
			<a href='/DURC/artist/create'>Add new artist</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $index = $this->getCode();




        if(is_null($index)){

                $sql = "
SELECT 
 artist.id AS id
, artist.artist_name AS artist_name
, artist.created_at AS created_at
, artist.updated_at AS updated_at

FROM lore.artist

";

        }else{

                $sql = "
SELECT 
 artist.id AS id
, artist.artist_name AS artist_name
, artist.created_at AS created_at
, artist.updated_at AS updated_at
 
FROM lore.artist 
WHERE id = $index
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
        $row['id'] = "<a href='/DURC/artist/$id'>$id</a>";




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
  ),
  1 => 
  array (
    'column_name' => 'artist_name',
    'data_type' => 'varchar',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  2 => 
  array (
    'column_name' => 'created_at',
    'data_type' => 'datetime',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
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
  ),
)
//has_many
NULL
//has_one
NULL
//belongs_to
NULL
//many_many
NULL
//many_through
NULL*\


?>