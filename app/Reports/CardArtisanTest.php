<?php
namespace App\Reports;
use ftrotter\Zermelo\Reports\Cards\AbstractCardsReport;

class CardArtisanTest extends AbstractCardsReport
{

    public function GetReportName(): string { return('CardArtisanTest'); }
    public function GetReportDescription(): ?string { return('Enter Your Report Description Here HTML is allowed for forms and such. Example reports on mysql table metadata'); }

    //should this card view use a fluid boostrap container
    public function is_fluid() { return true; }

    //how wide should each card be?
    public function cardWidth() { return "250px"; }

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
	//this is based on the cards element from bootstrap https://getbootstrap.com/docs/4.3/components/card/ in the standard view
	//card_header is text at the top card.
	//card_title will be the title of the card, inside the card content
	//card_text is beneath the title in the card content
	//card_img_top is the image at the top of the card
	//card_img_bottom is the image at the bottom of the card
	//card_img_top_alttext sets the alttext of the image at the top
	//card_img_bottom_alttext sets the alttext of the image at the bottom
	//card_footer is the text inside the footer of the card

        $sql = "
SELECT
        CONCAT('DB: ',`TABLE_SCHEMA`) AS card_header,
        CONCAT('Table: ',`TABLE_NAME`) AS card_title,
        CONCAT('Column: ',`COLUMN_NAME`, ' ', `COLUMN_TYPE`) AS card_text,
        CONCAT('column number: ',`ORDINAL_POSITION`) AS card_footer 
FROM information_schema.COLUMNS
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


}
