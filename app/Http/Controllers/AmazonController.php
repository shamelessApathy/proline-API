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
       // $amz = new \AmazonOrderList();
       // $amz->fetchOrders();
       // $list = $amz->getList();
       // $response = $amz->getLastResponse();
        // Arun Code to fetch the past 24 hrs orders. 
        $amz = new \AmazonOrderList("PROLINE"); //store name matches the array key in the config file
        $amz->setLimits('Modified', "- 24 hours");
        $amz->setFulfillmentChannelFilter("MFN"); //no Amazon-fulfilled orders
       // $amz->setOrderStatusFilter(
          //  array("Unshipped", "PartiallyShipped", "Canceled", "Unfulfillable")
          //  ); //no shipped or pending
        $amz->setUseToken(); //Amazon sends orders 100 at a time, but we want them all
        $amz->fetchOrders();
        $list = $amz->getList();
        $response = $amz->getLastResponse();
        //return $amz->getList();

       // echo "<pre>"; print_r($amz->getList());
      // die();
        return view('orders', ['response' => $response, 'list'=>$list]);
    }

    public function ExportOrdersData(){

        header("Content-type: text/csv");  
        header("Cache-Control: no-store, no-cache");  
        header('Content-Disposition: attachment; filename="AmazonOrders.csv"');  
        $outstream = fopen("php://output",'w');
        
        $amz = new \AmazonOrderList("PROLINE"); 
        $amz->setLimits('Modified', "- 24 hours");
        $amz->setFulfillmentChannelFilter("MFN");
        $amz->setUseToken();
        $amz->fetchOrders();
        $list = $amz->getList();
        $response = $amz->getLastResponse();
        $order_data[] = array('Amazon OrderID','Purchase Date','Order Status','Shipping Address','Order Total','Payment Method','Marketplace Id','Buyer Name','Email','Order Type' );
        foreach ($list as $order) {
            $address            = $order->getShippingAddress();
            $amount             = $order->getOrderTotal();
            $amazon_id          = $order->getAmazonOrderId();
            $purchase_data      = $order->getPurchaseDate();
            $order_status       = $order->getOrderStatus();
            $shipping_address   = $address['Name']." ".$address['AddressLine1']." ".$address['City']." ".$address['StateOrRegion']." ".$address['PostalCode']." ".$address['CountryCode']." ".$address['Phone'];
            $total              = $amount['Amount']." ".$amount['CurrencyCode'];
            $payment_method     = $order->getPaymentMethod();
            $market_id          = $order->getMarketplaceId();
            $buyer_name         = $order->getBuyerName();
            $email              = $order->getBuyerEmail();
            $order_type         = $order->getOrderType();
            $order_data[] = array($amazon_id,$purchase_data,$order_status,$shipping_address,$total,$payment_method,$market_id,$buyer_name,$email,$order_type);
        }

        foreach( $order_data as $row )  
        {  
            fputcsv($outstream, $row, ',', '"');  
        }  
          
        fclose($outstream);

        // return view('orders', ['response' => $response, 'list'=>$list]);
    }
    public function render_view()
    {
        $response = array( "Binding"=> "Tools & Home Improvement", "Brand" => "ProLine Range Hoods", "Color" => "Stainless Steel", "Feature" => array( "Under Cabinet Range Hood","CFM: 2000",'Dimensions: 60" Width, 18" Height, 24" Depth' ), "ItemDimensions"=>array( "Height"=> "18.00", "Length"=> "24.00", "Width"=> "60.00", "Weight"=> "135.00" ), "Label"=> "Proline Range Hoods", "ListPrice"=> array( "Amount"=> "2649.95", "CurrencyCode"=>"USD" ), "Manufacturer"=> "Proline Range Hoods", "Model"=> "PLJW 101.60", "NumberOfItems"=> "1", "PackageDimensions"=> array( "Height"=>"24.00", "Length"=> "64.00", "Width"=> "28.00", "Weight"=> "146.00"), "PackageQuantity" => "1", "PartNumber"=>  "PLJW101.60", "ProductGroup"=> "Home Improvement", "ProductTypeName"=>"MAJOR_HOME_APPLIANCES", "Publisher"=> "Proline Range Hoods", "ReleaseDate"=> "2017-01-27", "Size"=> '60"', "SmallImage"=> array( "URL"=>  "http://ecx.images-amazon.com/images/I/41u1Yjiu5qL._SL75_.jpg", "Height"=> "75", "Width"=>"75"), "Studio"=> "Proline Range Hoods", "Title"=> "Proline Wall / Undercabinet Range Hood PLJW 101.60 2000 CFM, 60");

        return view('product_info', ['response' =>$response]);
    }
    /**
    * 
    * Creates a product_info request for MWS
    * @param ASIN # included in GET url var
    * @return View of product info results from MWS
    */

    public function product_info($asin)
    {
        $amz = new \AmazonProductList();
        $amz->setIdType("ASIN");
        $amz->setProductIds($asin); 
        $amz->fetchProductList();   
        //$product = $amz->getProduct();
        //$response = $amz->getLastResponse();
        $response = $amz->getProduct();
        $response = $response[0]->getAttributeSets();
        return view('product_info', ['response' => $response]);
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
