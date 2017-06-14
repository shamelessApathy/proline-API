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
    	$reportName = base_path()."/public/cronlogs/report-log.$time.xml";
    	try {
                $report->saveReport($reportName);
                //If the exception is thrown, this text will not be shown
                echo 'If you see this, it worked';
            }

            //catch exception
            catch(Exception $e) {
              echo 'Message: ' .$e->getMessage();
            }

    	$this->handle_data($reportName);

    }

    /**
    *
    * @param none
    * @return Data that is usable to be sent to either a display, or to an inventory_update function
    */
    public function handle_data($reportName = null)
    {
        $reportName = $reportName;
    	$xml = simplexml_load_file($reportName);
// Currently able to grab the SKU of every item thats been orders on the current sheet
 		$data = array();
 		foreach($xml->Message as $order)
 		{
 			array_push($data, ['sku'=>(string)$order->OrderReport->Item->SKU, 'quantity'=>(int)$order->OrderReport->Item->Quantity]);
 		}
 		$this->update_inventory_local($data);
        $time = time();
        $today = date("F j, Y, g:i a");
        // Everytime this function runs (due to the cronjob running it, it will make a notation with the date and time in a new file)
        $newFileName = '/var/www/proline-API/public/cronlogs/inventory-records/'.$time.'.txt';
        $data = "Inventory Records updated [time]: ". $today;
        file_put_contents($newFileName, $data);
	}
    /**
    *
    * @return Path to newly formed inventory feed file
    * @param Nothing, called from update_inventory
    */
    public function form_feed()
    {
        $feed_string = "sku quantity\n";
        $name = "inv_feed_" . time() . '.csv';
        $path = "cronlogs/inventory-records/" . $name;
        file_put_contents($path, $feed_string);
        $products = Product::all();
        foreach ($products as $product)
        {
            $string = "$product->sku $product->inventory\n";
            file_put_contents($path, $string, FILE_APPEND);
        }

    }
    public function update_inventory(){
        try{
            $inventory = new \AmazonFeed("PROLINE");
            $inventory->setFeedContent('csv');
            $inventory->loadFeedFile(base_path().'/stock.csv');
            $inventory->setFeedType('_POST_FLAT_FILE_INVLOADER_DATA_');
            $inventory->submitFeed();
            $data = $inventory->getResponse();
            if($data){
                echo "Inventory Updated succesfully!! Here is Feed Submission Id : ".$data['FeedSubmissionId']."  ";
            }
        }
        catch(Exception $e) {
          echo 'Message: ' .$e->getMessage();
        }
    }
	/**
	*   Calling function is handle_data()
	* @param $data is all the info that has been digested from the amazon _GET_ORDERS_REPORT_ 
	* @return
	*/
	public function update_inventory_local($data)
	{
		foreach ($data as $order)
		{
			$product = Product::where('sku', $order['sku'])->first();
			$newInventory = $product->inventory - $order['quantity'];
			$product->inventory = $newInventory;
			$product->save();
		}
	}

	public function cron_test()
	{
		file_put_contents("crontestbae.txt",'IT should be woooorking');
	}
}
