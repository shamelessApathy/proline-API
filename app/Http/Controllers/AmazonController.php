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

    /*** Get Orders List ****/
    public function get_order_list()
    {
        $amz = new \AmazonOrderList("PROLINE"); //store name matches the array key in the config file
        $amz->setLimits('Modified', "- 24 hours");
        $amz->setFulfillmentChannelFilter("MFN"); //no Amazon-fulfilled orders
        $amz->setOrderStatusFilter(
           array("Shipped")
           ); //no shipped or pending
        $amz->setUseToken(); //Amazon sends orders 100 at a time, but we want them all
        $amz->fetchOrders();
        $list_amz = $amz->getList();
        // Extracting Orders item sku  //
        // echo "<pre>"; print_r($list_amz); echo "</pre>"; die();
        foreach ($list_amz as $order) {
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
            
            /*** Extracting Item sku **/
            $amz_item = new \AmazonOrderItemList("PROLINE"); //store name matches the array key in the config file
            $amz_item->setOrderId($amazon_id);
     
            $amz_item->setUseToken(); //Amazon sends orders 100 at a time, but we want them all
            $amz_item->fetchItems();
            $amz_item = $amz_item->getItems();
            // $response = $amz_item->getLastResponse();
            // echo "<pre>"; print_r($amz_item); echo "</pre>"; die();


            foreach ($amz_item as $item) {
               
                $list_data['AmazonOrderID']      = $amazon_id;
                $list_data['ItemSku']            = $item['SellerSKU'];
                $list_data['ProductName']        = $item['Title'];
                $list_data['QuantityOrdered']    = $item['QuantityOrdered'];
                $list_data['QuantityShipped']    = $item['QuantityShipped'];
                $list_data['PurchaseDate']       = $purchase_data;
                $list_data['OrderStatus']        = $order_status;
                $list_data['ShippingAddress']    = $shipping_address;
                $list_data['OrderTotal']         = $total;
                $list_data['PaymentMethod']      = $payment_method;
                $list_data['MarketplaceId']      = $market_id;
                $list_data['BuyerName']          = $buyer_name;
                $list_data['Email']              = $email;
                $list_data['OrderType']          = $order_type;
                $list[] = $list_data;
            }

        }       
        
        $response = $amz->getLastResponse();
        //return $amz->getList();
        // echo "<pre>"; print_r($list);
        // die();
        return view('orders', ['response' => $response, 'list'=>$list]);
    }

    /**** Order Details Export Funtion ****/
    public function ExportOrdersData(){

        header("Content-type: text/csv");  
        header("Cache-Control: no-store, no-cache");  
        header('Content-Disposition: attachment; filename="AmazonOrders.csv"');  
        $outstream = fopen("php://output",'w');
        
        $amz = new \AmazonOrderList("PROLINE"); 
        $amz->setLimits('Modified', "- 24 hours");
        $amz->setFulfillmentChannelFilter("MFN");
        $amz->setOrderStatusFilter(
           array("Shipped")
           ); //no shipped or pending
        $amz->setUseToken();
        $amz->fetchOrders();
        $list = $amz->getList();
        $response = $amz->getLastResponse();
        $order_data[] = array('Amazon OrderID','Item Sku','Product Name','Quantity Ordered','Quantity Shipped','Purchase Date','Order Status','Shipping Address','Order Total','Payment Method','Marketplace Id','Buyer Name','Email','Order Type' );
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

            /*** Extracting Item sku **/
            $amz_item = new \AmazonOrderItemList("PROLINE"); //store name matches the array key in the config file
            $amz_item->setOrderId($amazon_id);
     
            $amz_item->setUseToken(); //Amazon sends orders 100 at a time, but we want them all
            $amz_item->fetchItems();
            $amz_item = $amz_item->getItems();
            // $response = $amz_item->getLastResponse();
            // echo "<pre>"; print_r($amz_item); echo "</pre>"; die();
            foreach ($amz_item as $item) {
                $Sku                = $item['SellerSKU'];
                $proNmae            = $item['Title'];
                $QuantityOrdered    = $item['QuantityOrdered'];
                $QuantityShipped    = $item['QuantityShipped'];
                $order_data[] = array($amazon_id,$Sku,$proNmae,$QuantityOrdered,$QuantityShipped,$purchase_data,$order_status,$shipping_address,$total,$payment_method,$market_id,$buyer_name,$email,$order_type);
            }
        }

        foreach( $order_data as $row )  
        {  
            fputcsv($outstream, $row, ',', '"');  
        }  
          
        fclose($outstream);

        // return view('orders', ['response' => $response, 'list'=>$list]);
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
