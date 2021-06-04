<?php
namespace App\Reports;
use CareSet\Zermelo\Reports\Cards\AbstractCardsReport;
use DB;

class ArtBinderReport extends AbstractCardsReport
{

    public function GetReportName(): string { 
		return('Art Binder Report');
	}
    public function GetReportDescription(): ?string { 

	//our html is doing alot of work here...
	//we have css that targets the print mode of the Binder Report to ensure that there are nine cards on each page...
	//then we have the form that allows you to choose which set you want to order...

	$desc = 'Shows each MTG artist on a seperate binder page, listing all of their art-only cards';
	return($desc);

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
	$cards_per_page = 8; //not supporting any other value for this...

	$pdo = DB::connection()->getPdo();

	$collectnum_cache_table = "card_pagemap_cache_collectnum_artcards"."_$cards_per_page";
	$WUBRG_cache_table = "card_pagemap_cache_WUBRG_artcards"."_$cards_per_page";

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

	$is_cache_exist = false; //assume this for debugging...

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
  `sort_by_me`  DATE,
  `sortable_collector_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `binder_page_number` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
"; 
		$pdo->exec($create_pagemap_table_sql);

		//now we need to loop over the results, and use the LIMIT function to get identifably pages in groups of nine. 
		//we need to know how long to do that for, so we need to get the total number of rows as a starting point
		$artist_list_sql = "
SELECT artist, COUNT(DISTINCT(card.id)) AS card_count
FROM `card`
JOIN cardface ON 
	card.id =
    	cardface.card_id 
WHERE layout = 'art_series' AND artist != ''
AND ( illustration_id != '0' AND illustration_id IS NOT NULL)
GROUP BY artist
ORDER BY card_count DESC, artist
";

		$stm = $pdo->query($artist_list_sql);
		$rows = $stm->fetchAll(\PDO::FETCH_ASSOC);
		$artist_pages = [];
		foreach($rows as $this_row){
			$card_count = $this_row['card_count'];
			$artist = $this_row['artist'];

			$pages_for_this_artist = ceil( $card_count / $cards_per_page);
			for($i = 1; $i <= $pages_for_this_artist; $i++){
				$total_cards_later = $card_count - ($i * $cards_per_page);
				if($total_cards_later <= 0){
					$cards_on_this_page = $card_count - (($i - 1) * $cards_per_page); 
				}else{
					$cards_on_this_page  = $cards_per_page;
				}
				
				$artist_pages[$artist][$i] = $cards_on_this_page;
			}
		}


		$total_pages = 0;
		$pages = [];
		foreach($artist_pages as $artist => $page_array){
			foreach($page_array as $page_num => $this_page){
				
				$pages[$total_pages] = [
								'artist' => $artist, 
								'page' => $page_num,
							];

				$total_pages++;
			}
		}

		$last_artist = null;
		$from_row_count = 0;
		for($i = 0; $i < $total_pages; $i++){
		
			$current_artist = $pages[$i]['artist'];
			$current_artist_page = $pages[$i]['page'];	

			if(is_null($last_artist)){
				$last_artist = $current_artist;
			}

			if($last_artist == $current_artist){ //then the artist has changed...
				$from_row_count = 0;
			}else{
				$from_row_count = $from_row_count + $cards_per_page;
				
			}


			$insert_sql = "
INSERT INTO _zermelo_cache.$collectnum_cache_table
SELECT 
	illustration_id,
	card.released_at AS sort_by_me,
	card.sortable_collector_number,
	'$i' AS binder_page_number,
	CURRENT_TIME() AS created_at
FROM lore.cardface
JOIN lore.card ON
        card.id =
        cardface.card_id
WHERE artist = '$artist' AND layout = 'art_series'
AND ( illustration_id != '0' AND illustration_id IS NOT NULL)
GROUP BY illustration_id, card.released_at, sortable_collector_number
ORDER BY sortable_collector_number ASC
LIMIT $from_row_count, $cards_per_page 
";
		
			$pdo->exec($insert_sql);
		}
		
	//There is no WUBRG sort...

	} //end cache creation logic, should only run the first time for each set... 

		$divider_page_cache_table = $collectnum_cache_table;


        	$sql = "
SELECT
        CONCAT('(', card.collector_number, ')') AS card_body
	, MAX(name) AS card_name
	, card.collector_number
	, MAX(scryfall_web_uri) AS card_img_top_anchor
        , MAX(image_uri_normal) AS card_img_top
        , binder_page_number + 1 AS card_layout_block_id
	, CONCAT(artist , ' p:' , binder_page_number + 1 ) AS card_layout_block_label
	, sort_by_me
FROM lore.cardface
JOIN lore.card ON
        card.id =
        cardface.card_id
JOIN _zermelo_cache.$divider_page_cache_table AS pagemap_cache 
		pagemap_cache.illustration_id =
		cardface.illustration_id
WHERE layout = 'art_series' AND ( cardface.illustration_id != '0' AND cardface.illustration_id IS NOT NULL)
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
