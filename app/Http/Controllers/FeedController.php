<?php

namespace App\Http\Controllers;
//use Auth;
use DB;
use App\Product;
use Illuminate\Http\Request;

class FeedController extends Controller
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

    

    public function GetFeedSubmissionList(Request $request){
       
        $feed = new \AmazonFeedList("PROLINE"); //store name matches the array key in the config file
      //  echo "<pre>"; print_r($request->input()); echo "</pre>";
        $MaxCount                   = $request['MaxCount'];
        $FeedSubmissionIdList       = array_values($request['FeedSubmissionIdList']);
        $FeedTypeList               = array_values($request['FeedTypeList']);
        $FeedProcessingStatusList   = array_values($request['FeedProcessingStatusList']);
        $SubmittedFromDate          = $request['SubmittedFromDate'];
        $SubmittedToDate            = $request['SubmittedToDate'];
        //echo "<pre>"; print_r($ReportRequestIdList);
        $FeedSubmissionIdList       = array_filter($FeedSubmissionIdList);
        $FeedTypeList               = array_filter($FeedTypeList);
        $FeedProcessingStatusList   = array_filter($FeedProcessingStatusList);
        if (!empty($MaxCount)){
             $feed->setMaxCount($MaxCount);
        }
        if (!empty($FeedSubmissionIdList)){ 
            $feed->setFeedIds($FeedSubmissionIdList);
        }
        // Not necessary, scratchpad doesn't require, I changed it to only add if it's not null
        if (!empty($FeedTypeList)){
            $feed->setFeedTypes($FeedTypeList);
        }
        if (!empty($SubmittedFromDate) && !empty($SubmittedToDate)){
            $feed->setTimeLimits($SubmittedFromDate,$SubmittedToDate );
        }
        if (!empty($FeedProcessingStatusList)){
            $feed->setFeedStatuses($FeedProcessingStatusList);
        }
        $feed->fetchFeedSubmissions();
        $feed_list = $feed->getFeedList();
      //  echo "<pre>"; print_r($feed_list); echo "</pre>"; die();
        $message ="";
        if(!empty($feed_list)){
            $message = "Feed details are";
        }
        else{
            $message = "No details Found Matching to your request";
        }
        $feed_list = $feed_list;
         return view('feed.feed-list', ['message'=>$message,'feed_list'=>$feed_list]); 
    }

    public function GetFeedSubmissionResult(Request $request){
       
        $feed = new \AmazonFeedResult("PROLINE"); //store name matches the array key in the config file
      //  echo "<pre>"; print_r($request->input()); echo "</pre>";
        $feed->setFeedId('50540017296');
        $feed->fetchFeedResult();
        $feed_list = $feed->getRawFeed();
       // echo "<pre>"; print_r($feed_list); echo "</pre>"; //die();
        $message ="";
        if(!empty($feed_list)){
            $message = "Feed Result";
        }
        else{
            $message = "No details Found Matching to your request";
        }
        $feed_list = $feed_list;
         return view('feed.feed-result', ['message'=>$message,'feed_list'=>$feed_list]); 
    }

    public function SubmitFeed(Request $request){
        $feed = new \AmazonFeed("PROLINE"); //store name matches the array key in the config file
      //  echo "<pre>"; print_r($request->input()); echo "</pre>";
        $feed->setFeedType('_POST_FLAT_FILE_PRICEANDQUANTITYONLY_UPDATE_DATA_');
        $feed->submitFeed();
        $feed_list = $feed->getResponse();
        echo "<pre>"; print_r($feed_list); echo "</pre>"; //die();
        $message ="";
        if(!empty($feed_list)){
            $message = "Feed Result";
        }
        else{
            $message = "No details Found Matching to your request";
        }
        $feed_list = $feed_list;
         return view('feed.feed-result', ['message'=>$message,'feed_list'=>$feed_list]); 
    }

    public function UpdateAmazonInventory(Request $request)
    {
        $inventory = new \AmazonFeed("PROLINE");
        $inventory->setFeedContent('- 60 min');
        $inventory->loadFeedFile();
        $inventory->setFeedType('_POST_INVENTORY_AVAILABILITY_DATA_');
        $inventory->submitFeed();
        $data = $inventory->getResponse();
        echo "<pre>"; print_r($data);
    }
    

}
