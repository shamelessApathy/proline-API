<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmazonController extends Controller
{ 

    public function test()
    {
        echo "testing";
    }
    public function get_report()
    {
        $path = "/var/www/API/API/reports.txt";
        $id = $_POST['report-id'];
        $amz = new \AmazonReport();
        $amz->setReportId($id);
        $amz->fetchReport();
        $raw = $amz->getRawReport();
       /* try
        {
            $amz->saveReport($path);
        } catch (Exception $e) {
             echo 'Caught exception: ',  $e->getMessage(), "\n";
        }*/
        return view('amazon', ['status'=>$raw]);

    }
    public function get_report_list()
    {
        $amz = new \AmazonReportList();
        $amz->fetchReportList();
        $list = $amz->getList();
        return view('orders', ['list'=>$list]);
    }
    public function get_order_list()
    {
        //6c9fb023-71d4-42cc-b3f6-9a9d9639c60d
       $amz = new \AmazonOrderList();
       $amz->fetchOrders();
       $list = $amz->getList();
       $response = $amz->getLastResponse();
        return view('orders', ['response' => $response, 'list'=>$list]);
    }
    public function get_status()
    {
        $reportRequestId = '50351017214';
        $amz = new \AmazonReportList();
        //$amz->setRequestIds();
        $list = $amz->fetchReportList();
        //$status = $amz->getStatus();
        $reportId = $amz->getList();
        //echo "<h3>Status of: $reportRequestId</h3><p>$status</p>";
        //echo "<h3>Report Id:</h3><p>$reportId</p>";
        var_dump($reportId);
    }
    public function helper_request() 
    {
        try {
            $amz = new \AmazonReportRequest(); // Instantiates ReportRequest class
            $amz->setReportType('_GET_FLAT_FILE_ACTIONABLE_ORDER_DATA_');
            $amz->requestReport(); // Run function that makes the report request
            $data = $amz->getResponse(); //
            //return $amz->getList();
            return $data;
        } catch (Exception $ex) {
            echo 'There was a problem with the Amazon library. Error: '.$ex->getMessage();
    }
}

    /**
    * Invokes the the library for MWS
    *
    *
    */
    public function request_report()
    {
        $list= $this->helper_request();
        var_dump($list);
        /*if ($list) {
    echo 'My Store Orders<hr>';
    foreach ($list as $order) {
        //these are AmazonOrder objects
        echo '<b>Order Number:</b> '.$order->getAmazonOrderId();
        echo '<br><b>Purchase Date:</b> '.$order->getPurchaseDate();
        echo '<br><b>Status:</b> '.$order->getOrderStatus();
        echo '<br><b>Customer:</b> '.$order->getBuyerName();
        $address=$order->getShippingAddress(); //address is an array
        echo '<br><b>City:</b> '.$address['City'];
        echo '<br><br>';
    }
    }*/
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
