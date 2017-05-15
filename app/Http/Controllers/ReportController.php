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
        // $simple = "<para><note>simple note</note></para>";
        // $p = xml_parser_create();
        // xml_parse_into_struct($p, $simple, $vals, $index);
        // xml_parser_free($p);
        // echo "Index array\n"; echo "</br>";
        // echo "<pre>"; print_r($index);
        // echo "\nVals array\n";
        // echo "<br> lkvjl;sk";
        // echo "<pre>"; print_r($vals); echo "</pre>";

        $ReportId   = $request['ReportId'];
        $report = new \AmazonReport("PROLINE"); //store name matches the array key in the config file
        $report->setReportId($ReportId);
        $report->fetchReport();
        $list_report = $report->getRawReport();
        
        // echo "<pre>"; print_r($report);
        // die();
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
       // echo "<pre>"; print_r($request->input()); echo "</pre>";
        $MaxCount               = $request['MaxCount'];
        $ReportTypeList         = array_values($request['ReportTypeList']);
        $Acknowledged           = $request['Acknowledged'] ;
        $AvailableFromDate      = $request['AvailableFromDate'];
        $AvailableToDate        = $request['AvailableToDate'];
        $ReportRequestIdList    = array_values($request['ReportRequestIdList']);
        //echo "<pre>"; print_r($ReportRequestIdList);
        $ReportTypeList  = array_filter($ReportTypeList);
        $ReportRequestIdList =array_filter($ReportRequestIdList);
        $amz = new \AmazonReportList("PROLINE"); 
        if (!empty($MaxCount)){
            $amz->setMaxCount($MaxCount);
        }
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
        if(!empty($list)){
            $message ="Report list is below :";
        }
        else{
            $message ="No Record Found Matching to your request";
        }
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
         return view('reports.report-info', ['message'=>$message,'list_report'=>$list_report]); 
    }

    /**** 9th may Working in Eport Request ***/
    public function GetReportRequest(Request $request){
        $ReportType        = $request['ReportType'];
        $StartDate         = $request['StartDate'];
        $EndDate           = $request['EndDate'] ;
        
        $report = new \AmazonReportRequest("PROLINE"); //store name matches the array key in the config file
        $report->setReportType($ReportType);
        $report->requestReport();
        if ( (!empty($StartDate)) && (!empty($EndDate)) ) {
            $report->setTimeLimits($StartDate,$EndDate);
        }
        $report->getStatus();
        $list_report =  $report->getResponse();

        if(!empty($list_report)){
            $message = "Requested Reports Details : ";
        }
        else{
            $message = "No details Found Matching to your request";
        }
        // /  echo "<pre>"; print_r($list_report); echo "</pre>"; 
       return view('reports.requested-report-info', ['message'=>$message,'list'=>$list_report]);       
    }
    
    public function AmazonReportRequestList(Request $request){
        $report = new \AmazonReportRequestList("PROLINE"); //store name matches the array key in the config file
        $MaxCount                   = $request['MaxCount'];
        $RequestedFromDate          = $request['RequestedFromDate'];
        $RequestedToDate            = $request['RequestedToDate'] ;
        $ReportRequestIdList        = array_values($request['ReportRequestIdList']);
        $ReportTypeList             = array_values($request['ReportTypeList']);
        $ReportProcessingStatusList = array_values($request['ReportProcessingStatusList']) ;
      // echo "<pre>"; print_r($request->input()); echo "</pre>";
        $ReportRequestIdList  = array_filter($ReportRequestIdList);
        $ReportTypeList =array_filter($ReportTypeList);
        $ReportProcessingStatusList =array_filter($ReportProcessingStatusList);
        if (!empty($MaxCount)) {
            $report->setMaxCount($MaxCount);
        }
        if ( (!empty($RequestedFromDate)) && (!empty($RequestedToDate)) ) {
            $report->setTimeLimits($RequestedFromDate,$RequestedToDate);
        }
        if (!empty($ReportRequestIdList)) {
            $report->setRequestIds($ReportRequestIdList);
        }
        if (!empty($ReportTypeList)) {
            $report->setReportTypes($ReportTypeList );
        }
        if (!empty($ReportProcessingStatusList)) {
            $report->setReportStatuses($ReportProcessingStatusList);
        }
        
        $report->fetchRequestList();
        $list_report =  $report->getList();
        if(!empty($list_report)){
            $message = "Requested Reports list : ";
        }
        else{
            $message = "No details Found Matching to your request";
        }
      // /  echo "<pre>"; print_r($list_report); echo "</pre>"; 
       return view('reports.requested-reports-list', ['message'=>$message,'list'=>$list_report]);
    }

    public function ManageReportSchedule(Request $request){
        $ReportType                 = $request['ReportType'];
        $Schedule                   = $request['Schedule'];
        $ScheduleDate               = $request['ScheduleDate'] ;
      //  echo "<pre>"; print_r($request->input()); echo "</pre>";
        $report = new \AmazonReportScheduleManager("PROLINE"); 
        $report->setReportType($ReportType);
        $report->setSchedule($Schedule);
        if (!empty($ScheduleDate )) {
            $report->setScheduledDate('2017-05-01');
        }
        $report->manageReportSchedule();
        $list_report =  $report->getList();
        if(!empty($list_report)){
            $message = "Scheduled Reports list : ";
        }
        else{
            $message = "No details Found Matching to your request";
        }
        return view('reports.schedule-report', ['message'=>$message,'list'=>$list_report]);

    }
    public function GetReportScheduleList(Request $request){
         //  echo "<pre>"; print_r($request->input()); echo "</pre>";
        $ReportTypeList     = array_values($request['ReportTypeList']);
        $report = new \AmazonReportScheduleList("PROLINE"); 
        if(!empty($ReportTypeList)){
            $report->setReportTypes('_GET_ORDERS_DATA_');
        }
        $report->fetchReportList();
        $list_report =  $report->getList();
        if(!empty($list_report)){
            $message = "Requested Reports Details : ";
        }
        else{
            $message = "No details Found Matching to your request";
        }
     //     echo "<pre>"; print_r($list_report); echo "</pre>"; 
       return view('reports.schedule-report', ['message'=>$message,'list'=>$list_report]); 
    }

}
