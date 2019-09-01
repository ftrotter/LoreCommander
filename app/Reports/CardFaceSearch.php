<?php

namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class CardFaceSearch extends AbstractTabularReport
{

    /*
    * Get the Report Name
    */
    public function GetReportName(): string {
	return("Simple Card Search");
    }

    /*
    * Get the Report Description, bootstrap styled html is OK
    */
    public function GetReportDescription(): ?string {
	$desc = '
<form method="GET">
  <div class="form-group row">
    <label for="search_term" class="col-4 col-form-label">Term Search</label> 
    <div class="col-8">
      <input id="search_term" name="search_term" placeholder="enter search term here" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
'; 
	return($desc);
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
	$where_array = [];

	$search_term = $this->getInput('search_term');
	

	$is_include_token = false;
	
	if($is_include_token){
		//they are in the database so doing nothing will make them show up
	}else{
		//we must exclude it using the type
		$where_array[] = " type_line NOT LIKE '%token%' ";
	}
	
	

	//so that we can add more fields to search easily...
	$general_search_fields = [
		'name',
		'oracle_text',
		'flavor_text',
		'artist',
		'type_line',
		
		];


	


	//the old way makes a series of static LIKE WHERE statemeents that we "or" together to support  search across fields
/*
	if(!is_null($search_term)){
		$general_search_where = '';
		$or = '';
		foreach($general_search_fields as $this_field){
			$general_search_where .= "\t $or \t$this_field LIKE '%$search_term%'\n";
			$or = ' OR ';
		}
		$where_array[] = $general_search_where;
	}


	if(count($where_array) > 0){
		$where_sql = "\nWHERE ";
		$and = '';
		foreach($where_array as $this_where){
			$where_sql .= "\t $and (\t$this_where)\n";	
			$and = ' AND ';
		}
	}else{
		$where_sql = '';
	}
*/



       $sql = 
"
SELECT
GROUP_CONCAT(cardface.id) AS cardface_ids, 
REGEXP_REPLACE(name,'[^a-zA-Z0-9]',' ') AS name
,REGEXP_REPLACE(artist,'[^a-zA-Z0-9]',' ') AS artist
,`mana_cost`
,REGEXP_REPLACE(type_line,'[^a-zA-Z0-9]',' ') AS type_line

, power
, GROUP_CONCAT(DISTINCT(REGEXP_REPLACE(set_name,'[^a-zA-Z0-9]',' '))) AS set_names
, GROUP_CONCAT(DISTINCT(REGEXP_REPLACE(oracle_text,'[^a-zA-Z0-9]',' '))) AS oracle_texts
, GROUP_CONCAT(DISTINCT(REGEXP_REPLACE(flavor_text,'[^a-zA-Z0-9]',' '))) AS flavor_texts
,`color`, rarity , `color_identity`
,scryfall_web_uri
, rulings_uri  
,`image_uri_small`,
image_uri_art_crop
FROM lore.cardface
JOIN lore.card ON 
	card.id =
    	cardface.card_id
$where_sql
GROUP BY illustration_id

";

	$is_debug = false;
	if($is_debug){
		echo "<pre>$sql";
		exit();
	}

    	return $sql;
    }

    /**
    * Each row content will be passed to MapRow.
    * Values and header names can be changed.
    * Columns cannot be added or removed
    * You can decorate fields with html, with bootstrap css styling
    *
    */
    public function MapRow(array $row, int $row_number) :array
    {

	extract($row);

	if(isset($scryfall_web_uri)){		
		$row['name'] = "<h3>$name</h3><a target='_blank' href='$scryfall_web_uri'><img width='250px' src='$image_uri_art_crop'></a>";
	}
        return $row;
    }


    /**
    * If a column needs to be forced to a certain format (i.e. auto-detection gets it wrong), it can be changed here
    * Tags can also be applied to each header column
    */
    public function OverrideHeader(array &$format, array &$tags): void
    {
    	//$tags['field_to_bold_in_report_display'] = 	['BOLD'];
        //$tags['field_to_hide_by_default'] = 		['HIDDEN'];
        //$tags['field_to_italic_in_report_display'] = 	['ITALIC'];
        //$tags['field_to_right_align_in_report'] = 	['RIGHT'];

        //How to set the format of the display
        //$format['numeric_field'] = 			'NUMBER'; // Formats number in table using commas, and right-aligns
        //$format['decimal_field'] = 			'DECIMAL'; // Formats decimal to 4 places, and right-aligns
        //$format['currency_field'] = 	    'CURRENCY'; // adds $ or Eurosign and right align
        //$format['percent_field'] = 			'PERCENT'; // adds % in the right place and right align
        //$format['url_field'] = 			    'URL'; // auto-link using <a href='$url_field'>$url_field</a>
        //$format['date_field'] = 			'DATE'; // future date display
        //$format['datetime_field'] = 		'DATETIME'; //future date time display
        //$format['time_field'] = 			'TIME'; // future time display
    }

 	/**
    * Header Format 'auto-detection' can be changed per report.
    * it is based on seeing the strings below in a field name... it will then assume it should be styled accordinly
    * By default, these are the column formats -
    * 	public $DETAIL     = ['Sentence'];
	* 	public $URL        = ['URL'];
	* 	public $CURRENCY   = ['Amt','Amount','Paid','Cost'];
	* 	public $NUMBER     = ['id','#','Num','Sum','Total','Cnt','Count'];
	* 	public $DECIMAL    = ['Avg','Average'];
	* 	public $PERCENT    = ['Percent','Ratio','Perentage'];
	*
	*	It detects the column by using 'word' matching, separated white spaces or _.
	*	Example: TABLE_ROWS - ['TABLE','ROWS']
	*	It will also check the full column name
    */
    public $NUMBER     = ['ROWS','AVG','LENGTH','DATA_FREE'];
    public $CURRENCY = [];


    /*
    * By Default, any numeric field will have statistical information will be passed on. AVG/STD/MIN/MAX/SUM
    * Any Text column will have distinct count information passed on.
    * Any Date will have MIN/MAX/AVG
    * This field will add a "NO_SUMMARY" field to the column header to suggest the data not be displayed
    */
    public $SUGGEST_NO_SUMMARY = ['ID'];


	/**
    * Want to use your own blade file for the report front-end?
    * You can customize the report view based on the report
    * When this is set to null, the report will use the view defined in the configuration file.
    *
    */
	public $REPORT_VIEW = null;

    /*
    * Get Indexes for cache table
    * Because results are saved to a cache table, and then exported from there later searching, using the front end... can be very slow
    * This returns an array of Index commands that will be run against the cache table
    * because we do not know the name of the cache table in advance, these index commands must use the string '{{_CACHE_TABLE_}}' instead of
    * the name of a specific table...
    */
    public function GetIndexSQL(): ?array {

                $index_sql = [
"ALTER TABLE {{_CACHE_TABLE_}}  ADD INDEX(`COLUMN_NAME`);",
"ALTER TABLE {{_CACHE_TABLE_}}  ADD INDEX(`TABLE_NAME`);",
"ALTER TABLE {{_CACHE_TABLE_}}  ADD INDEX(`database_name`);",
"ALTER TABLE {{_CACHE_TABLE_}}  ADD PRIMARY KEY( `database_name`, `TABLE_NAME`, `COLUMN_NAME`); "
                        ];
// you can uncomment this line to enable the default report to automatically index the resulting cached table
//                return($index_sql);

		//returning null here results in no indexing happening on the cached results table
		return(null);

    }

    /**
    * If the cache is not enabled, then every time the page is reloaded the entire report is re-processed and put into the cache table
    * So if you want to just run the report one time, and then load subsequent data from the cache, set this to return 'true';
    */
   public function isCacheEnabled(){
        return(false);
   }

    /**
    * This function does nothing if isCacheEnabled is returning false
    * But if the cache is enabled, then this will detail how long the report will be reloaded from the cache before the cache is regenerated by re-running the report SQL
    */
   public function howLongToCacheInSeconds(){
        return(1200); //twenty minutes by default
   }


}
