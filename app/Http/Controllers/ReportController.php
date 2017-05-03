<?php

namespace App\Http\Controllers;
//use Auth;
use DB;
use App\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
    *
    * Construct Function
    * Passes all requests for this controller through Auth middleware to make sure user is logged in
    */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
    * Search Products Function
    * @param search query and type of search
    * @return list of products matching query
    */
    public function GetReport(){
      echo "strincg";
        $amz = new \AmazonReportList("PROLINE"); //store name matches the array key in the config file
        $amz->setTimeLimits('2017-04-26',' - 1 second');
        $list_amz = $amz->fetchReportList(false);
         echo "<pre>"; print_r($list_amz); echo "</pre>"; die();
    }
    public function GetReportList(){
        echo "lol";
        $amz = new \AmazonReportList("PROLINE"); //store name matches the array key in the config file
        $amz->setMaxCount('10');
        $amz->setReportTypes(array("_GET_ORDERS_DATA_"));
        $amz->setAcknowledgedFilter(true);
        $amz->setTimeLimits('2017-02-26','2017-05-04');
        $amz->setRequestIds(array('50474017289','50475017289'));
        $amz->fetchReportList();
        $list_amz = $amz->getList();
         echo "<pre>"; print_r($list_amz); echo "</pre>"; 

         die();
    }
}
