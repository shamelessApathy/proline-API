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
      
        $report = new \AmazonReport("PROLINE"); //store name matches the array key in the config file
        $report->setReportId('5005639771017289');
        $report->fetchReport();
        $list_report = $report->getRawReport();
         echo "<pre>"; print_r($list_report); echo "</pre>"; 
    }
    public function GetReportList(Request $request){
        //echo "<pre>"; print_r($request->input()); echo "</pre>";
        $message ="";
        $MaxCount               = $request['MaxCount'];
        $ReportTypeList         = $request['ReportTypeList'];
        $Acknowledged           = $request['Acknowledged'];
        $AvailableFromDate      = $request['AvailableFromDate'];
        $AvailableToDate        = $request['AvailableToDate'];
        $ReportRequestIdList    = $request['ReportRequestIdList'];
        $ReportRequestIdList    = array_values($ReportRequestIdList);
        //echo "<pre>"; print_r($ReportRequestIdList);
        $amz = new \AmazonReportList("PROLINE"); //store name matches the array key in the config file
        $amz->setMaxCount($MaxCount);
        $amz->setReportTypes($ReportTypeList);
        $amz->setAcknowledgedFilter($Acknowledged);
        $amz->setTimeLimits($AvailableFromDate,$AvailableToDate );
        $amz->setRequestIds($ReportRequestIdList);
        $amz->fetchReportList();
        $list = $amz->getList();
        if(!empty($list)){
            $message ="Report list is below :";
        }
        else{
            $message ="No Record Found Matching to your request";
        }
        //echo "<pre>"; print_r($list_amz); echo "</pre>"; 
        //die();
        return view('reports.reports-list', ['message'=>$message,'list'=>$list]); 
    }
     public function GetReportInfo(Request $request,$id){
        $ReportId   = $id; //die();
        $report = new \AmazonReport("PROLINE"); //store name matches the array key in the config file
        $report->setReportId($ReportId);
        $report->fetchReport();
        $list_report = $report->getRawReport();
        $message ="";
        if(!empty($list_report)){
            $message = "Report details associated with order Id : ".$ReportId;
        }
        else{
            $message = "No details Found Matching to your request";
        }
        $list_report = $list_report;
        //die();
         return view('reports.report-info', ['message'=>$message,'list_report'=>$list_report]); 
    }
}
