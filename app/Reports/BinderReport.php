<?php
namespace App\Reports;
use ftrotter\Zermelo\Reports\Cards\AbstractCardsReport;
use DB;

class BinderReport extends AbstractCardsReport
{

    public function GetReportName(): string { 

        	$current_mtgset_id = $this->getInput('mtgset_id',-1);
		if($current_mtgset_id > 0){
			$mtgsetObj = \App\mtgset::find($current_mtgset_id);
			return($mtgsetObj->name . ' Binder Report'); 
		}else{
			return('Binder Report');
		}
	}
    public function GetReportDescription(): ?string { 

	//our html is doing alot of work here...
	//we have css that targets the print mode of the Binder Report to ensure that there are nine cards on each page...
	//then we have the form that allows you to choose which set you want to order...

        $mtgset_Objs = \App\mtgset::orderBy('released_at','desc')->get();


        $current_mtgset_id = $this->getInput('mtgset_id',-1);
	
	$html = "
<style>
@media print {
	.zermelo-card-group-label {
		break-before: page;
		width: 100%;
	}
}
.p-1 {
    padding: 0rem  !important;;
}
.table {
    margin-bottom: 0rem;
}
</style>
<div class='d-print-none'>
This report will display 'page guides' for a binder of MTG cards, by set.
Choose a set below. <br>

<form>
  <div class='form-group row'>
    <label for='select' class='col-4 col-form-label'>Select Which Set to view</label>
    <div class='col-8'>
      <select id='mtgset_id' name='mtgset_id' class='custom-select'>
";
        foreach($mtgset_Objs as $this_mtgset){

                $code = $this_mtgset->code;

                if($this_mtgset->id == $current_mtgset_id){
                        $selected_html = 'selected';
                }else{
                        $selected_html = '';
                }

                $html .= "
                <option $selected_html value='$this_mtgset->id'> $this_mtgset->name ($this_mtgset->code $this_mtgset->released_at) </option>
                ";

        }

        $html .= "
      </select>
    </div>
  </div>
  <div class='form-group row'>
    <label for='sort_method' class='col-4 col-form-label'>Choose Sort Method</label> 
    <div class='col-8'>
      <select id='sort_method' name='sort_method' class='custom-select'>
        <option value='sort_WUBRG'>Sort Colorless WUBRG Multi Artifact Land Token</option>
        <option value='sort_collector'>Sort By Collector Number</option>
      </select>
    </div>
  </div>
  <div class='form-group row'>
    <label for='cards_per_page' class='col-4 col-form-label'>Cards Per Page</label> 
    <div class='col-8'>
      <select id='cards_per_page' name='cards_per_page' class='custom-select'>
        <option value='8'>8</option>
        <option value='9'>9</option>
        <option value='7'>7</option>
        <option value='6'>6</option>
      </select>
    </div>
  </div>

  <div class='form-group row'>
    <div class='offset-4 col-8'>
      <button name='submit' type='submit' class='btn btn-primary'>Show Set</button>
    </div>
  </div>
</form>
</div>
";
	return($html);

	}

    //should this card view use a fluid boostrap container
    public function is_fluid() { return true; }

    //how wide should each card be?
    public function cardWidth() { return "215px"; }

    /**
     * Builds the report
    **/
    public function GetSQL()
    {
	// This report relies on us knowning where every illustration goes on which binder page. 
	// which means we need to increment a counter every ninth row in the data... but that would require a mysql variable and zermelo does not yet support that
	// so we are going to instead create a table, in advance, which has that mapping between pages and illustrations, and then we are going to join to it.

	$mtgset_id = $this->getInput('mtgset_id');
	$cards_per_page = $this->getInput('cards_per_page');
	$sort_method = $this->getInput('sort_method','sort_WUBRG');


	if(!is_numeric($mtgset_id)){
		return('SELECT "No results, use form to populate results" AS message');
		exit();
	}

	if(!is_numeric($cards_per_page)){
		return('SELECT "No results, use form to populate results" AS message');
		exit();
	}

	$mtgset_id = (int) $mtgset_id;
	$cards_per_page = (int) $cards_per_page;

	$pdo = DB::connection()->getPdo();

	$collectnum_cache_table = "card_pagemap_cache_collectnum_$mtgset_id"."_$cards_per_page";
	$WUBRG_cache_table = "card_pagemap_cache_WUBRG_$mtgset_id"."_$cards_per_page";

	//first, lets see if a cache already exists for this cache_id.. 

	$check_sql = "
SELECT * 
FROM information_schema.tables
WHERE table_schema = '_zermelo_cache' 
    AND table_name = '$collectnum_cache_table'
LIMIT 1;
";

	$is_cache_exist = false; //our starting assumption

	$stm = $pdo->query($check_sql);
	$rows = $stm->fetchAll(\PDO::FETCH_ASSOC);
	foreach($rows as $this_row){
		$is_cache_exist = true; //we know we have one of the cache tables... so we assume we have both...
	}

	//$is_cache_exist = false; //assume this for debugging...

	if(!$is_cache_exist){

		//there are two ways to sort, and therefore there are two cache tables..
		//one for collection number sorting...
		//and one for WUBRG sorting... 		

		// we need an empty cache table for this report.. 
		$drop_pagemap_table_sql = "DROP TABLE IF EXISTS _zermelo_cache.$collectnum_cache_table";
		$pdo->exec($drop_pagemap_table_sql);

		//now re-create it from scratch
		$create_pagemap_table_sql = "
CREATE TABLE _zermelo_cache.$collectnum_cache_table (
  `illustration_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_by_me` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sortable_collector_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `binder_page_number` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
"; 
		$pdo->exec($create_pagemap_table_sql);

		//now we need to loop over the results, and use the LIMIT function to get identifably pages in groups of nine. 
		//we need to know how long to do that for, so we need to get the total number of rows as a starting point
		$count_total_rows_sql = "
SELECT
	COUNT(DISTINCT(CONCAT(illustration_id, collector_number))) AS total_result_rows
FROM lore.cardface
JOIN lore.card ON
        card.id =
        cardface.card_id
WHERE mtgset_id = $mtgset_id
AND ( illustration_id != '0' AND illustration_id IS NOT NULL)
";

		$stm = $pdo->query($count_total_rows_sql);
		$rows = $stm->fetchAll(\PDO::FETCH_ASSOC);
		foreach($rows as $this_row){
			$total_result_rows = $this_row['total_result_rows'];
		}

		$total_pages = ($total_result_rows / $cards_per_page) +1; //not a big deal to do the loop one too many times...



		for($i = 0; $i <= $total_pages; $i++){
			$from_row_count = $i * $cards_per_page;		
	
			$insert_sql = "
INSERT INTO _zermelo_cache.$collectnum_cache_table
SELECT 
	illustration_id,
	card.sortable_collector_number AS sort_by_me,
	card.sortable_collector_number,
	'$i' AS binder_page_number,
	CURRENT_TIME() AS created_at
FROM lore.cardface
JOIN lore.card ON
        card.id =
        cardface.card_id
WHERE mtgset_id = $mtgset_id
AND ( illustration_id != '0' AND illustration_id IS NOT NULL)
GROUP BY illustration_id, sortable_collector_number
ORDER BY sortable_collector_number ASC
LIMIT $from_row_count, $cards_per_page 
";
		
			$pdo->exec($insert_sql);
		}
		

		//now we do the same thing.. but for our WUBRG sort...

		// we need an empty cache table for this report.. 
		$drop_pagemap_table_sql = "DROP TABLE IF EXISTS _zermelo_cache.$WUBRG_cache_table";
		$pdo->exec($drop_pagemap_table_sql);

		//now re-create it from scratch
		$create_pagemap_table_sql = "
CREATE TABLE _zermelo_cache.$WUBRG_cache_table (
  `illustration_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_by_me` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sortable_collector_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `binder_page_number` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
"; 
		$pdo->exec($create_pagemap_table_sql);

		//total pages will be the same for both caches...
		//so we do not need to recalculate $total_pages

		for($i = 0; $i <= $total_pages; $i++){
			$from_row_count = $i * $cards_per_page;		
	
			$insert_sql = "
INSERT INTO _zermelo_cache.$WUBRG_cache_table
SELECT 
	illustration_id,
	CONCAT(card.binder_group_number,cardface.name,sortable_collector_number) AS sort_by_me,
	card.sortable_collector_number,
	'$i' AS binder_page_number,
	CURRENT_TIME() AS created_at
FROM lore.cardface
JOIN lore.card ON
        card.id =
        cardface.card_id
WHERE mtgset_id = $mtgset_id
AND ( illustration_id != '0' AND illustration_id IS NOT NULL)
GROUP BY card.binder_group_number, illustration_id, sortable_collector_number, cardface.name
ORDER BY card.binder_group_number ASC, sort_by_me ASC
LIMIT $from_row_count, $cards_per_page 
";
	
			$pdo->exec($insert_sql);

		}


	} //end cache creation logic, should only run the first time for each set... 

		$divider_page_cache_table = $collectnum_cache_table;
		if($sort_method == 'sort_WUBRG'){
			//the other sort table takes precedence here...
			$divider_page_cache_table = $WUBRG_cache_table;
		}


        	$sql = "
SELECT
        CONCAT('(', card.collector_number, ')') AS card_body
	, MAX(name) AS card_name
	, card.collector_number
	, MAX(scryfall_web_uri) AS card_img_top_anchor
        , MAX(image_uri_normal) AS card_img_top
        , binder_page_number + 1 AS card_layout_block_id
	, CONCAT('Page Number ', binder_page_number + 1 ) AS card_layout_block_label
	, sort_by_me
FROM lore.cardface
JOIN lore.card ON
        card.id =
        cardface.card_id
JOIN _zermelo_cache.$divider_page_cache_table AS pagemap_cache ON ( 
		pagemap_cache.illustration_id =
		cardface.illustration_id
	AND
		pagemap_cache.sortable_collector_number =
		card.sortable_collector_number
	)
WHERE mtgset_id = $mtgset_id
AND ( cardface.illustration_id != '0' AND cardface.illustration_id IS NOT NULL)
GROUP BY cardface.illustration_id, card.collector_number
ORDER BY binder_page_number ASC, sort_by_me ASC
";

	$this->setInput('order',[0 => ['card_layout_block_id' => 'asc', 'sort_by_me' => 'asc']]);


        return $sql;
    }

    /**
     * Each row content will be passed to MapRow.
     * Values and header names can be changed.
     * Columns cannot be added or removed
     */
    public function MapRow(array $row, int $row_number) :array
    {

	extract($row);


	if(isset($row['card_body'])){

		if(strlen($card_name) > 25){ //Narset of the Ancient Way Token causes a line break... most card names are short.. some are not... just in case..
			$card_name = substr($card_name,0,25) . '...' ;
		}

		$row['card_body'] = "
<table class='table table-bordered table-sm small' style='background-color: white'>
<tr>
	<td colspan=6> <small> $card_name</small> <b>($collector_number)</b> </td>
</tr>
<tr><td>foil:</td>
	<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr><tr><td>reg:</td>
	<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr></table>
";
	}

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
     * Can customize the report view based on the report
     * By default, use the view defined in the configuration file.
     *
     */
    public $REPORT_VIEW = null;

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
    * If the cache is not enabled, then every time the page is reloaded the entire report is re-processed and put into the cache table
    * So if you want to just run the report one time, and then load subsequent data from the cache, set this to return 'true';
    */
   public function isCacheEnabled(){
        return(true);
   }

    /**
    * This function does nothing if isCacheEnabled is returning false
    * But if the cache is enabled, then this will detail how long the report will be reloaded from the cache 
    * before the cache is regenerated by re-running the report SQL
    */
   public function howLongToCacheInSeconds(){
        return(12000); //200 minutes
   }

    /**
    * This function will determine if replacing /ZermeloCard/ with /ZeremeloSQL/ will show the SQL of the report
    * for security reasons it should be off by default.
    */
   public function isSQLPrintEnabled(): bool{
         return(true); //protect the sql by default
   }

}
