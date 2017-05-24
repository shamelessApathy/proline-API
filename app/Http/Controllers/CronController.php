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

    	
    	/*echo "<pre>";
    	print_r($list);
    	echo "</pre>";*/

    	// Define the most recent ReportID
    	$latest = $list[0];
    	$reportId = $latest['ReportId'];

    	// Instantiate AmazonReport Class

    	$report = new \AmazonReport();
    	$report->setReportId($reportId);
    	$report->fetchReport();
    	$time = time();
    	$reportName = "/var/www/proline-API/public/cronlogs/report-log.$time.xml";
    	try {
                $report->saveReport($reportName);
                //If the exception is thrown, this text will not be shown
                echo 'If you see this, it worked';
            }

            //catch exception
            catch(Exception $e) {
              echo 'Message: ' .$e->getMessage();
            }

    	//$this->handle_data($reportName);

    }

    /**
    *
    * @param none
    * @return Data that is usable to be sent to either a display, or to an inventory_update function
    */
    public function handle_data($reportName)
    {
    	 $xml = simplexml_load_file($reportName);
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
	public function cron_test()
	{
		file_put_contents("crontestbae.txt",'IT should be woooorking');
	}
}
