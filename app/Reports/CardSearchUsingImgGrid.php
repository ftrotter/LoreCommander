<?php
namespace App\Reports;
use ftrotter\Zermelo\Reports\Cards\AbstractCardsReport;

class CardSearchUsingImgGrid extends AbstractCardsReport
{

    public function GetReportName(): string
    {
	return('Card Image Grid');
    }

    public function GetReportDescription(): ?string
    {
	$search_term = $this->getInput('search_term');

	$search_term = str_replace("'",'"',$search_term);
	
	if(is_null($search_term)){
		$search_term_default = '';
	}else{
		
		$search_term_default = " value='$search_term'";
	}


	$form = '
<form method="GET">
  <div class="form-group row">
    <label for="search_term" class="col-4 col-form-label">Term Search</label> 
    <div class="col-8">
      <input id="search_term" name="search_term" placeholder="enter search term here" type="text" class="form-control" '.$search_term_default.'>
    </div>
  </div>
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
';

	return($form);

    }


    /**
     * Header Format 'auto-detection' can be changed per report.
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


    /*
    * By Default, any numeric field will have statistical information will be passed on. AVG/STD/MIN/MAX/SUM
    * Any Text column will have distinct count information passed on.
    * Any Date will have MIN/MAX/AVG
    * This field will add a "NO_SUMMARY" field to the column header to suggest the data not be displayed
    */
    public $SUGGEST_NO_SUMMARY = ['ID'];


    /**
     * Can customize the report view based on the report
     * By default, use the view defined in the configuration file.
     *
     */
    public $REPORT_VIEW = null;

    public function is_fluid()
    {
        return true;
    }

    public function cardWidth()
    {
        return "75px";
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

	$search_term = $this->getInput('search_term');
	$search_term = str_replace("'",'"',$search_term);

        //so that we can add more fields to search easily...
        $general_search_fields = [
                'name',
                'oracle_text',
                'flavor_text',
                'artist',
                'type_line',

                ];
	
	$search_tokens = explode(' ',$search_term);

	$and = '';
	$match_sql = '';
	foreach($search_tokens as $this_token){
		//we either want to match the term at the beginning of the string, the end, or in the middle with spaces around it!!
		$match_sql .= "
$and (  
	for_fulltext_search LIKE '$this_token %' 
		OR 
	for_fulltext_search LIKE '% $this_token' 
		OR 
	for_fulltext_search LIKE '% $this_token %' 
)
";

		$and = "\n\t AND \n ";
	}


        $sql = "
SELECT 
	MAX(image_uri) AS card_img_top,
	MAX(image_uri) AS image_uri,
	MAX(image_hash_art_crop) AS image_hash_art_crop,
	MAX(cardface.name) AS card_img_top_alttext,
	MAX(scryfall_web_uri) AS card_img_top_anchor
FROM lore.cardface
JOIN lore.card ON 
	card.id =
	cardface.card_id
WHERE $match_sql
GROUP BY illustration_id
ORDER BY name ASC, illustration_id
";

	//$this->setInput('order',[0 => ['match_rank' => 'desc']]);

	$is_debug = false;
	if($is_debug){
		echo("<pre>$sql");
		exit();
	}

        return $sql;
    }

    /*
    * Get Indexes for cache table
    * Because results are saved to a cache table, and then exported from there later searching, using the front end... can be very slow
    * This returns an array of Index commands that will be run against the cache table
    * because we do not know the name of the cache table in adv)ance, these index commands must use the string '{{_CACHE_TABLE_}}' instead of
    * the name of a specific table...
    */
    public function GetIndexSQL(): ?array {

		//without this our boolean search will not have an index, despite FULLTEXT searches on the original
		//table.. 

                return(null);

    }



    /**
     * Each row content will be passed to MapRow.
     * Values and header names can be changed.
     * Columns cannot be added or removed
     *
     */
    public function MapRow(array $row, int $row_number) :array
    {

	extract($row);

	$ext_to_check = [
		'.png',
		'.jpg',
		'.gif',
		'.svg',
		];

	//use the url as it exists to start..
	$file_to_use = $card_img_top;

	foreach($ext_to_check as $this_ext){
		$web_path = "/imgdata/original/$image_hash_art_crop . $this_ext";
		$file_to_check = base_path(). "/public/$web_path";
		if(file_exists($file_to_check)){
			$file_to_use = $web_path;  //we found the local cache.. lets use it!!!
		}
	}

	$row['card_img_top'] = $file_to_use; //not sure if this is original or not.. but it should work either way..

        return $row;
    }

    /**
     * Column Headers will be auto detected using $DETAIL,$URL,$CURRENCY,$NUMBER,$DECIMAL,$PERCENT
     * If a column needs to be forced to a certain format, it can be changed here
     * Tags can also be applied to each header column
     */
    public function OverrideHeader(array &$format, array &$tags): void
    {
        //$tags['field_to_bold_in_report_display'] = 	['BOLD'];
        //$tags['field_to_hide_by_default'] = 		['HIDDEN'];
        //$tags['field_to_italic_in_report_display'] = 	['ITALIC'];
        //$tags['field_to_right_align_in_report'] = 	['RIGHT'];

        //How to set the format of the display
        //$format['numeric_field'] = 			['NUMBER']; //TODO what does this do?
        //$format['decimal_field'] = 			['DECIMAL']; //TODO what does this do?
        //$format['currency_field'] = 			['CURRENCY']; //adds $ or Eurosign and right align
        //$format['percent_field'] = 			['PERCENT']; //adds % in the right place and right align
        //$format['url_field'] = 			['URL']; //auto-link using <a href='$url_field'>$url_field</a>
        //$format['numeric_field'] = 			['NUMBER']; //TODO what does this do?
        //$format['date_field'] = 			['DATE']; //future date display
        //$format['datetime_field'] = 			['DATETIME']; //future date time display
        //$format['time_field'] = 			['TIME']; //future time display
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
