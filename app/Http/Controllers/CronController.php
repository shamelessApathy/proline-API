<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CronController extends Controller
{
	/**
	*
	* @param none
	* @return Returns an XML list from amazon on all the days orders
	*
	*/
    public function get_amazon_orders()
    {
    	// Get Initial ReportList, specifying only _GET_ORDERS_DATA_
    	$reportList = new \AmazonReportList();
    	$reportList->setReportTypes('_GET_ORDERS_DATA_');
    	$reportList->setMaxCount('5');
    	$reportList->fetchReportList();
    	$list = $reportList->getList();

    	
    	echo "<pre>";
    	print_r($list);
    	echo "</pre>";

    	// Define the most recent ReportID
    	$latest = $list[1];
    	$reportId = $latest['ReportId'];

    	// Instantiate AmazonReport Class

    	$report = new \AmazonReport();
    	$report->setReportId($reportId);
    	$report->fetchReport();
    	$report->saveReport("report-test-log.txt");

    }

    /**
    *
    * @param none
    * @return Data that is usable to be sent to either a display, or to an inventory_update function
    */
    public function handle_data()
    {
    	 $xml = simplexml_load_file('report-test-log.txt');
 		echo "<pre>";
 		print_r($xml);
 		echo "</pre>";
// Currently able to grab the SKU of every item thats been orders on the current sheet
 		$data = array();
 		foreach($xml->Message as $order)
 		{
 			var_dump($order->OrderReport->Item->SKU);
 			echo "<br>";
 			array_push($data, ['sku'=>(string)$order->OrderReport->Item->SKU, 'quantity'=>(int)$order->OrderReport->Item->Quantity]);
 		}
 		$this->update_inventory($data);

	}
	public function update_inventory($data)
	{
		foreach ($data as $order)
		{
			$product = Product::where('sku', $order['sku'])->first();
			$product->inventory = $product->inventory - $order['quantity'];
			$product->save();
		}
	}
}