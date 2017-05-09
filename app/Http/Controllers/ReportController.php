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
    public function GetReport(Request $request){
        //echo "<pre>"; print_r($request->input()); echo "</pre>";
        $ReportId   = $request['ReportId'];
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
    public function GetReportList(Request $request){
        //echo "<pre>"; print_r($request->input()); echo "</pre>";
        $message ="";
        $MaxCount               = $request['MaxCount'];
        $ReportTypeList         = $request['ReportTypeList'];
        $Acknowledged           = $request['Acknowledged'] ;
        $AvailableFromDate      = $request['AvailableFromDate'];
        $AvailableToDate        = $request['AvailableToDate'];
        $ReportRequestIdList    = $request['ReportRequestIdList'];
        $ReportRequestIdList    = array_values($ReportRequestIdList);
        //echo "<pre>"; print_r($ReportRequestIdList);
        $amz = new \AmazonReportList("PROLINE"); //store name matches the array key in the config file
        $amz->setMaxCount($MaxCount);
        if (!empty($ReportTypeList)){
            $amz->setReportTypes($ReportTypeList);
        }
        // Not necessary, scratchpad doesn't require, I changed it to only add if it's not null
        if (!empty($Acknowledged)){
            $amz->setAcknowledgedFilter($Acknowledged);
        }
        if (!empty($AvailableFromDate) && !empty($AvailableToDate)){
            $amz->setTimeLimits($AvailableFromDate,$AvailableToDate );
        }
        if (!empty($ReportRequestIdList)){
            $amz->setRequestIds($ReportRequestIdList);
        }
        $amz->fetchReportList();
        $list = $amz->getList();
        $response = $amz->getLastResponse();
       //  echo "<pre>"; print_r($list); echo "</pre>";
        // echo count($list); 
        if(!empty($list)){
            $message ="Report list is below :";
        }
        else{
            $message ="No Record Found Matching to your request";
        }
        //echo "<pre>"; print_r($list_amz); echo "</pre>"; 
        //die();
        
     //    var_dump($list);
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

    /**** 9th may Working in Eport Request ***/
    public function GetReportRequest(Request $request){
        $report = new \AmazonReportRequest("PROLINE"); //store name matches the array key in the config file
        $report->setReportType('_GET_FLAT_FILE_ORDERS_DATA_');
       
        $list_report =  $report->requestReport();
       
        echo "<pre>"; print_r($list_report); echo "</pre>"; 
        die();
    }
    public function AmazonReportScheduleManager(Request $request){
        $report = new \AmazonReportRequest("PROLINE"); //store name matches the array key in the config file
        $report->setReportType('_GET_FLAT_FILE_ORDERS_DATA_');
       
        $list_report =  $report->manageReportSchedule();
       
        echo "<pre>"; print_r($list_report); echo "</pre>"; 
        die();
    }
}
