<?php
namespace App\Reports;
use ftrotter\Zermelo\Reports\Cards\AbstractCardsReport;

class AlmasFavoriteCards extends AbstractCardsReport
{

    public function GetReportName(): string { return('Almas Favorite Cards'); }
    public function GetReportDescription(): ?string { return(
'these are MTG cards that Alma likes'
); }

    //should this card view use a fluid boostrap container
    public function is_fluid() { return true; }

    //how wide should each card be?
    public function cardWidth() { return "250px"; }

    /**
     * This is what builds the report. It will accept a SQL statement or an Array of sql statements.
     * Can be used in conjunction with Inputs to determine different output based on URI parameters
     * Additional URI parameters are passed as
    *   $this->getCode() - which will give the first url segment after the report name
    *   $this->getParameters() - which will give an array of every later url segment after the getCode value
    *   $this->getInput() - which will give _GET parameters (etc?)
    *   $this->quote($something_you_got_from_the_user) - This wrapper to the PDO quote function is good for preventing SQL injection
    * 	$this->setInput($key,$new_value) - a way to override _GET parameters (i.e. for initializing a sort for instance)
    * 		For instance $this->setInput('order',[0 => ['order_by_me' => 'asc']]); will order the report, to start by the order_by_me column ASC. 
    *		This replicates what is being passed from the front end data tables to the backend to make sorting work.. 
    **/
    public function GetSQL()
    {
        //Card Layout Columns
        //this is based on the cards element from bootstrap https://getbootstrap.com/docs/4.3/components/card/ in the standard view
        //card_header is text at the top card.
        //card_title will be the title of the card, inside the card content
        //card_text is beneath the title in the card content
        //card_img_top is the image url for an image placed at the top of the card
        //card_img_bottom is the image url for the bottom
        //card_img_top_alttext sets the alttext of the image at the top
        //card_img_bottom_alttext sets the alttext of the image at the bottom
        //card_footer is the text inside the footer of the card


        //Card Block Layout Columns
        //card_layout_block_id this is any identifier you would like to use to label a sequential group of cards... by changing this for a sequential group
        //      The cards will move to a new row (if they have not already) and they will switch between black text/white background to
        //      white text on a grey background.. this is basically the same as the 'zebra' effect that is often used on. If this is not set, the cards
        //      simply all use the black text/white background for all the cards...
        //card_layout_block_label this will be used as the heading before a new grouping of cards, if it is set.
        //card_layout_block_url if you have a block label, you can turn it into a link by setting this field..

        $sql = "
SELECT 
	card.oracle_id,
	CONCAT(cardface.name,cardface.artist) AS card_layout_block_id,
	CONCAT(cardface.artist,' - ',cardface.name) AS card_layout_block_label,
    	cardface.image_uri_art_crop AS card_img_top
FROM lore.card
JOIN lore.cardface ON 
	cardface.card_id =
	card.id
WHERE 
	cardface.name LIKE '%Beast in show%'
	 OR cardface.name LIKE '%Jerboa%'
	 OR cardface.name LIKE '% Moth'
ORDER BY card_layout_block_id
	
";
        return $sql;
    }

    /**
     * Each row content will be passed to MapRow.
     * Values and header names can be changed.
     * Columns cannot be added or removed
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
        return(false);
   }

    /**
    * This function does nothing if isCacheEnabled is returning false
    * But if the cache is enabled, then this will detail how long the report will be reloaded from the cache 
    * before the cache is regenerated by re-running the report SQL
    */
   public function howLongToCacheInSeconds(){
        return(1200); //twenty minutes by default
   }

    /**
    * This function will determine if replacing /ZermeloCard/ with /ZeremeloSQL/ will show the SQL of the report
    * for security reasons it should be off by default.
    */
   public function isSQLPrintEnabled(): bool{
         return(true); //protect the sql by default
   }


}
