<?php

namespace App\Reports;

class TEST_NorthwindOrderYearReport extends ParentTabularReport
{

    /*
    * Get the Report Name
    */
    public function GetReportName(): string {
	return('Zermelo Demo: Northwind Order Report');
    }

    /*
    * Get the Report Description, can be html
    */
    public function GetReportDescription(): ?string {

	//here is a good place to make bootstrap forms https://bootstrapformbuilder.com/
	$bootstrap_html_form = "
<p>
This report demonstrates how you can add bootstrap HTML forms to your reports, and how to work with the form data inside the report. <br>
Using this report, you can specify a start and end date and limit the orders to those dates.
<br>
Use this report to test for: Ensuring that the order of the sockets and wrenches is sensible.. and for using different databases to simulate 
different years worth of data.
<br>
When you click data options, the options should be alphabetically sorted and the latest year should be chosen by default..
</p>
";

	return($bootstrap_html_form);

    }

	/**
    * This is what builds the report. It will accept a SQL statement or an Array of sql statements.
    * Can be used in conjunction with Inputs to determine different output based on URI parameters
    * Additional URI parameters are passed as
    *	$this->getCode() - which will give the first url segment after the report name
    *   $this->getParameters() - which will give an array of every later url segment after the getCode value
    *   $this->getInput() - which will give _GET parameters (etc?)
    **/
    public function GetSQL()
    {

	$order_year_db_table = $this->getSocket('MyWind_order_year_db_table');

        	$sql = "
SELECT 
	employee.lastName AS employee_last_name,
	employee.firstName AS employee_first_name, 
	customer.companyName AS customer_company,
	orderDate,
    	COUNT(DISTINCT(orderDetail.id)) AS distinct_products_ordered,
    	GROUP_CONCAT(DISTINCT productName) AS product_list
FROM $order_year_db_table AS order_table 
JOIN MyWind_northwind_model.employee ON 
	employee.id =
    	employee_id
JOIN MyWind_northwind_model.customer ON 
	customer.id =
    	customer_id
JOIN MyWind_northwind_data.orderDetail ON 
	orderDetail.order_id =
    	order_table.id
JOIN MyWind_northwind_model.product ON 	
	orderDetail.product_id =
    	product.id 
GROUP BY order_table.id
";
    	return $sql;
    }

    /**
    * Each row content will be passed to MapRow.
    * Values and header names can be changed.
    * Columns cannot be added or removed
    *
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

	//look in ParentTabularReport.php for further typical report settings

}
