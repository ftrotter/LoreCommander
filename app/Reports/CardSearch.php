<?php

namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class CardSearch extends AbstractTabularReport
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
    <label for="card_type" class="col-4 col-form-label">Creature Type</label> 
    <div class="col-8">
      <select id="card_type" name="card_type" class="custom-select" aria-describedby="card_typeHelpBlock">

        <option value="none">No Type Selected</option>
        <option value="zombie">zombie</option>
        <option value="angel">angel</option>
        <option value="soldier">soldier</option>
      </select> 
      <span id="card_typeHelpBlock" class="form-text text-muted">Select a card type</span>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-4">Include</label> 
    <div class="col-8">
      <div class="custom-control custom-checkbox custom-control-inline">
        <input name="include[]" id="include_0" type="checkbox" class="custom-control-input" value="include_token"> 
        <label for="include_0" class="custom-control-label">Tokens</label>
      </div>
      <div class="custom-control custom-checkbox custom-control-inline">
        <input name="include[]" id="include_1" type="checkbox" class="custom-control-input" value="include_green"> 
        <label for="include_1" class="custom-control-label">Green Cards</label>
      </div>
      <div class="custom-control custom-checkbox custom-control-inline">
        <input name="include[]" id="include_2" type="checkbox" class="custom-control-input" value="include_red"> 
        <label for="include_2" class="custom-control-label">Red Cards</label>
      </div>
      <div class="custom-control custom-checkbox custom-control-inline">
        <input name="include[]" id="include_3" type="checkbox" class="custom-control-input" value="include_blue"> 
        <label for="include_3" class="custom-control-label">Blue Cards</label>
      </div>
      <div class="custom-control custom-checkbox custom-control-inline">
        <input name="include[]" id="include_4" type="checkbox" class="custom-control-input" value="include_black"> 
        <label for="include_4" class="custom-control-label">Black Cards</label>
      </div>
      <div class="custom-control custom-checkbox custom-control-inline">
        <input name="include[]" id="include_5" type="checkbox" class="custom-control-input" value="include_white"> 
        <label for="include_5" class="custom-control-label">White Cards</label>
      </div>
      <div class="custom-control custom-checkbox custom-control-inline">
        <input name="include[]" id="include_6" type="checkbox" class="custom-control-input" value="include_multi"> 
        <label for="include_6" class="custom-control-label">Multi-Color Cards</label>
      </div>
      <div class="custom-control custom-checkbox custom-control-inline">
        <input name="include[]" id="include_7" type="checkbox" class="custom-control-input" value="include_colorless"> 
        <label for="include_7" class="custom-control-label">Colorless Cards</label>
      </div>
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
	$card_type = $this->getInput('card_type');
	$include = $this->getInput('include');
	

	$is_include_token = false;
	

	if($card_type == 'none'){
		$card_type = null;
	}


	if(is_null($include)){
		$include = []; //empty does nothing...
	}




	foreach($include as $include_this){
		if($include_this == 'include_green'){
			$where_array[] = " is_color_green = 1 ";
		}
		if($include_this == 'include_red'){
			$where_array[] = " is_color_red = 1 ";
		}
		if($include_this == 'include_blue'){
			$where_array[] = " is_color_blue = 1 ";
		}
		if($include_this == 'include_black'){
			$where_array[] = " is_color_black = 1 ";
		}
		if($include_this == 'include_white'){
			$where_array[] = " is_color_white = 1 ";
		}
		if($include_this == 'include_multi'){
			$where_array[] = " color_count > 1 ";
		}
		if($include_this == 'include_colorless'){
			$where_array[] = " is_colorless = 1 ";
		}
		if($include_this == 'include_black'){
			$where_array[] = " is_color_black = 1 ";
		}

		if($include_this == 'include_token'){
			$is_include_token = true;
		}

	}

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
	


	if(!is_null($search_term)){
		$general_search_where = '';
		$or = '';
		foreach($general_search_fields as $this_field){
			$general_search_where .= "\t $or \t$this_field LIKE '%$search_term%'\n";
			$or = ' OR ';
		}
		$where_array[] = $general_search_where;
	}

	if(!is_null($card_type)){
		$where_array[] = "\ttype_line LIKE '%$card_type%'";
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

       $sql = 
"
SELECT 
`name`
, COUNT(DISTINCT(illustration_id)) AS illustration_count
, COUNT(DISTINCT(scryfall_id)) AS release_count
,`mana_cost`
, type_line
, power
, set_name
, oracle_text
, flavor_text
,`color`, rarity , `color_identity`
,artist
,`is_color_green`, `is_color_red`, `is_color_blue`, `is_color_black`
,`is_color_white`, `is_colorless`
,`color_count` 
,legal_modern, legal_standard
,scryfall_web_uri, rulings_uri  
,`image_uri_small`

FROM lore.cardface
JOIN lore.card ON 
	card.id =
    	cardface.card_id
$where_sql
GROUP BY oracle_id

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
		
	$row['name'] = "<h3>$name</h3><a target='_blank' href='$scryfall_web_uri'><img src='$image_uri_small'></a>";

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
