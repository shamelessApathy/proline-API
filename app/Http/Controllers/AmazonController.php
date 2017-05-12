<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AmazonOrders;
use App\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductController;
class AmazonController extends Controller
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
    public function test()
    {
        echo "testing";
    }
    public function home()
    {
        return view('amazon/amazon');
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
        $message="";
        return view('orders', ['list'=>$list,'message'=>$message]);
    }

    /**** Funtion to Update the Inventory ****/
    public function SaveOrders(){
        $amz = new \AmazonOrderList("PROLINE"); //store name matches the array key in the config file
        $amz->setLimits('Modified', "- 48 hours");
        $amz->setFulfillmentChannelFilter("MFN"); //no Amazon-fulfilled orders
        $amz->setOrderStatusFilter(
           array("Shipped")
           ); //no shipped or pending
        $amz->setUseToken(); //Amazon sends orders 100 at a time, but we want them all
        $amz->fetchOrders();
        $list_amz = $amz->getList();
        // Extracting Orders item sku  //
        // $list;
        // echo "<pre>"; print_r($list_amz); echo "</pre>"; die();
        $message = "";

        if($list_amz){
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
                
                $entry = DB::table('amazon_orders')->where('amazonOrderId',$amazon_id)->get();
                $result = $entry->count();
               // echo $result;
                if(empty($result)){
                    /*** Extracting Item sku **/
                    $amz_item = new \AmazonOrderItemList("PROLINE"); //store name matches the array key in the config file
                    $amz_item->setOrderId($amazon_id);
             
                    $amz_item->setUseToken(); //Amazon sends orders 100 at a time, but we want them all
                    $amz_item->fetchItems();
                    $amz_item = $amz_item->getItems();
                    // $response = $amz_item->getLastResponse();
                    // echo "<pre>"; print_r($amz_item); echo "</pre>"; die();


                    foreach ($amz_item as $item) {
                       
                        $ItemSku            = $item['SellerSKU'];
                        $ProductName        = $item['Title'];
                        $QuantityOrdered    = $item['QuantityOrdered'];
                        $QuantityShipped    = $item['QuantityShipped'];
                        $ASIN               = $item['ASIN'];

                        $newOrder = new AmazonOrders;
                        $newOrder->amazonOrderId    = $amazon_id;
                        $newOrder->buyerName        = $buyer_name;
                        $newOrder->email            = $email;
                        $newOrder->purchaseDate     = $purchase_data;
                        $newOrder->orderStatus      = $order_status;
                        $newOrder->totalAmount      = $total;
                        $newOrder->paymentMethod    = $payment_method;
                        $newOrder->shippingAddress  = $shipping_address;
                        $newOrder->marketID         = $market_id;
                        $newOrder->orderType        = $order_type;
                        $newOrder->itemSku          = $ItemSku;
                        $newOrder->productTitle     = $ProductName;
                        $newOrder->ASIN             = $ASIN;
                        $newOrder->QuantityOrdered  = $QuantityOrdered;
                        $newOrder->QuantityShipped  = $QuantityShipped;
                        if($newOrder->save()){
                            $message = "Orders are saved successfully!";
                        }else { 
                            $message = "There is issue with saving orders";
                        }
                        $product = Product::where('asin', $ASIN)->first();
                        if($product){
                            if($product->inventory >= 1){
                                $product->inventory = $product->inventory -$QuantityShipped ;
                                $product->save();
                            }
                           // die();
                        }
                        //die();

                    }
                }else{
                    $message ="Duplicate entry";
                }

            }      
        }

        /**** Generate feed ****/
         $product_feed = Product::all();
         //$products_data[] = array();
         foreach ($product_feed as $data) {
            $sku                    = $data->sku;
            $price                  = "";
            $minimum_seller_price   = "";
            $maximun_seller_price   = "";
            $quantity               = $data->inventory;
            $products_data['sku']                   = $sku;
            $products_data['price']                 = $price;
            $products_data['minimum_seller_price']  = $minimum_seller_price;
            $products_data['maximun_seller_price']  = $maximun_seller_price;
            $products_data['quantity'] = $quantity;
            $feed_data[] = $products_data;
         }
         $feed = "sku,price,minimum-seller-price,maximun-seller-price,Quantity \n";
        // echo "<pre>";print_r($feed_data); 
        foreach ($feed_data as $record){
            $feed.= $record['sku'].','.$record['price'].','.$record['minimum_seller_price'].','.$record['maximun_seller_price'].','.$record['quantity']."\n"; //Append data to csv
        }
        $csv_handler = fopen (public_path().'/csvfile-'.date("Y-m-d").'-'.date("h:i:sa").'.csv','w');            

        fwrite ($csv_handler,$feed);
        fclose ($csv_handler);

        $response = $amz->getLastResponse();
        //return $amz->getList();
        // echo "<pre>"; print_r($list);
        // die();

        return view('order-save', ['message'=>$message,'response' => $response]);
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
       // $amz = new \AmazonProductList();
      //  $amz->setIdType("ASIN");
       // $amz->setProductIds($asin); 
       // $amz->fetchProductList();   
        //$product = $amz->getProduct();
        //$response = $amz->getLastResponse();
       // $response = $amz->getProduct();
        //$response = $response[0]->getAttributeSets();
        return view('product_info');
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

    /******************* Amazon data list **************/
    public function AmazonData()
    {

        return view('amazon.amazon-data');
    }
    
    public function ApiFormAction(Request $request){
       // echo "<pre>"; print_r($request->input()); echo "</pre>";
        $ApiSelection       = $request['apisection'];
        $ApicallOperation   = $request['apicall'];
        
        if( $ApiSelection== 'Orders'){
            if( $ApicallOperation=='GetOrderServiceStatus' ){
                return  $this->GetOrderServiceStatus($request);
            }
            if( $ApicallOperation=='ListOrders' ){
                return  $this->ListOrders($request);
            }
            if( $ApicallOperation=='GetOrder' ){
                return  $this->GetOrder($request);
            }
             if( $ApicallOperation=='ListOrderItems' ){
                return  $this->ListOrderItems($request);
            }
        }

        if( $ApiSelection== 'Products'){
            if( $ApicallOperation=='GetProductServiceStatus' ){
                $product = new ProductController;
                return  $product->GetProductServiceStatus($request);
            }
            // if( $ApicallOperation=='ListOrders' ){
            //     return  $this->ListOrders($request);
            // }
            // if( $ApicallOperation=='GetOrder' ){
            //     return  $this->GetOrder($request);
            // }
            //  if( $ApicallOperation=='ListOrderItems' ){
            //     return  $this->ListOrderItems($request);
            // }
        }
        if( $ApiSelection== 'Reports'){
            if( $ApicallOperation=='GetReportList'){
                $product = new ReportController;
                return  $product->GetReportList($request);
            }
            if ($ApicallOperation =='GetReport'){
                $product = new ReportController;
                return $product->GetReport($request);
            }
             if ($ApicallOperation =='GetReportRequestList'){
                $product = new ReportController;
                return $product->AmazonReportRequestList($request);
            }
             if ($ApicallOperation =='RequestReport'){
                $product = new ReportController;
                return $product->GetReportRequest($request);
            }
             if ($ApicallOperation =='ManageReportSchedule'){
                $product = new ReportController;
                return $product->ManageReportSchedule($request);
            }
             if ($ApicallOperation =='GetReportScheduleList'){
                $product = new ReportController;
                return $product->GetReportScheduleList($request);
            }
        }
    }

    public function GetOrderServiceStatus(Request $request){
        $amz = new \AmazonServiceStatus("PROLINE"); //store name matches the array key in the 
        $amz->setService('Orders');
        $amz->fetchServiceStatus(); 
        $list_amz = $amz->getStatus();  
        // Extracting Orders item sku  //
        // $list;
        $status =  $list_amz;
        $response="";
        $list="";
        $message="";
        $url="";
        if(!empty($status)){
            $message="Status : ".$status;
        }
        return view('orders', ['message'=>$message,'response' => $response, 'list'=>$list]); 
    }

    public function ListOrders(Request $request){
        $amz = new \AmazonOrderList("PROLINE"); //store name matches the array key in the config file
        $CreatedAfter       = $request['CreatedAfter'];
        $CreatedBefore      = $request['CreatedBefore'];
        $LastUpdatedAfter   = $request['LastUpdatedAfter'];
        $LastUpdatedBefore  = $request['LastUpdatedBefore'];
        $Shipping           = $request['shipping'];
        $Channel            = $request['channel'];
        if($CreatedAfter || $CreatedBefore ){
             $amz->setLimits('Created',$CreatedAfter,$CreatedBefore);
        }elseif ($LastUpdatedAfter || $LastUpdatedBefore) {
             $amz->setLimits('Modified', $LastUpdatedAfter,$LastUpdatedBefore);
        }else{
              $amz->setLimits('Modified', "- 100 hours");
        }
       
        $amz->setFulfillmentChannelFilter($Channel); //no Amazon-fulfilled orders
        $amz->setOrderStatusFilter(
           array($Shipping)
           ); //no shipped or pending
        $amz->setUseToken(); //Amazon sends orders 100 at a time, but we want them all
        $amz->fetchOrders();
        $list_amz = $amz->getList();
        // Extracting Orders item sku  //
        // $list;
         //echo "<pre>"; print_r($list_amz); echo "</pre>"; die();
        $message="";
        $url="";
         if($list_amz){
            foreach ($list_amz as $order) {
                $address            = $order->getShippingAddress();
                $amount             = $order->getOrderTotal();                
                $list_data['AmazonOrderID']      = $order->getAmazonOrderId();
                $list_data['PurchaseDate']       = $order->getPurchaseDate();
                $list_data['OrderStatus']        = $order->getOrderStatus();
                $list_data['ShippingAddress']    = $address['Name']." ".$address['AddressLine1']." ".$address['City']." ".$address['StateOrRegion']." ".$address['PostalCode']." ".$address['CountryCode']." ".$address['Phone'];
                $list_data['OrderTotal']         = $amount['Amount']." ".$amount['CurrencyCode'];
                $list_data['PaymentMethod']      = $order->getPaymentMethod();
                $list_data['MarketplaceId']      = $order->getMarketplaceId();
                $list_data['BuyerName']          = $order->getBuyerName();
                $list_data['Email']              = $order->getBuyerEmail();
                $list_data['OrderType']          = $order->getOrderType();
                $list[] = $list_data;

            }
        }else{
            $message="No Order Found Matching to your request";
            $list= "";
        }
        $response = $amz->getLastResponse();
        return view('orders', ['message'=>$message,'response' => $response, 'list'=>$list]); 
    }

    public function GetOrder(Request $request){
        $AmazonOrderId   = $request['AmazonOrderId'];
        $amz = new \AmazonOrder("PROLINE"); //store name matches the array key in the config file
        $amz->setOrderId($AmazonOrderId);
        $amz->fetchOrder();
        $list_amz = $amz->getData();
        // echo "<pre>"; print_r($list_amz); echo "</pre>"; die();
        $message="";
        $url="";
         if($list_amz){
            $order = $list_amz;
            //foreach ($list_amz as $order) {
                // echo $order['ShippingAddress'];
                // die();
                $address            = $order['ShippingAddress'];
                $amount             = $order['OrderTotal'];
                $list_data['AmazonOrderID']      = $order['AmazonOrderId'];
                $list_data['PurchaseDate']       = $order['PurchaseDate'];
                $list_data['OrderStatus']        = $order['OrderStatus'];
                $list_data['ShippingAddress']    = $address['Name']." ".$address['AddressLine1']." ".$address['City']." ".$address['StateOrRegion']." ".$address['PostalCode']." ".$address['CountryCode']." ".$address['Phone'];
                $list_data['OrderTotal']         = $amount['Amount']." ".$amount['CurrencyCode'];
                $list_data['PaymentMethod']      = $order['PaymentMethod'];
                $list_data['MarketplaceId']      = $order['MarketplaceId'];
                $list_data['BuyerName']          = $order['BuyerName'];
                $list_data['Email']              = $order['BuyerEmail'];
                $list_data['OrderType']          = $order['OrderType'];
                $list[] = $list_data;

           // }
        }else{
            $message="No Order Found Matching to your request";
            $list= "";
        }
        $response = $amz->getLastResponse();
        return view('orders', ['message'=>$message,'response' => $response, 'list'=>$list]); 
    }

    public function ListOrderItems(Request $request){
        $AmazonOrderId   = $request['AmazonOrderId'];
                
        /*** Extracting Item sku **/
        $amz_item = new \AmazonOrderItemList("PROLINE"); //store name matches the array key in the config file
        $amz_item->setOrderId($AmazonOrderId); 
        $amz_item->setUseToken(); //Amazon sends orders 100 at a time, but we want them all
        $amz_item->fetchItems();
        $amz_item = $amz_item->getItems();
        $message="";
        $url="";
        if($amz_item){
            $message="Items associated with order Id ".$AmazonOrderId;
            foreach ($amz_item as $item) {
                $price = $item['ItemPrice'];
                $list_data['AmazonOrderID']      = $AmazonOrderId;
                $list_data['ASIN']               = $item['ASIN'];
                $list_data['ItemSku']            = $item['SellerSKU'];
                $list_data['OrderItemId']        = $item['OrderItemId'];
                $list_data['ProductName']        = $item['Title'];
                $list_data['QuantityOrdered']    = $item['QuantityOrdered'];
                $list_data['QuantityShipped']    = $item['QuantityShipped'];
                $list_data['ConditionId']        = $item['ConditionId'];
                $list_data['ItemPrice']          = $price['Amount'];
                $list_data['CurrencyCode']       = $price['CurrencyCode'];
                $list[] = $list_data;
            }

       // }
        }else{
            $message="No Items Found Matching to your request";
            $list= "";
        }
        $response = '';
        return view('amazon.amazon-order-items', ['message'=>$message,'response' => $response, 'list'=>$list]); 
    }


    public function ExportOrders(Request $request){
         //echo "<pre>"; print_r($request->input()); echo "</pre>";

        header("Content-type: text/csv");  
        header("Cache-Control: no-store, no-cache");  
        header('Content-Disposition: attachment; filename="AmazonOrders.csv"');  
        $outstream = fopen("php://output",'w');

        $order_data[] = array('Amazon OrderID','Item Sku','Product Name','Quantity Ordered','Quantity Shipped','Purchase Date','Order Status','Shipping Address','Order Total','Payment Method','Marketplace Id','Buyer Name','Email','Order Type' );

        $amz = new \AmazonOrderList("PROLINE"); 
        $CreatedAfter       = $request['CreatedAfter'];
        $CreatedBefore      = $request['CreatedBefore'];
        $LastUpdatedAfter   = $request['LastUpdatedAfter'];
        $LastUpdatedBefore  = $request['LastUpdatedBefore'];
        $Shipping           = $request['shipping'];
        $Channel            = $request['channel'];
        if($CreatedAfter || $CreatedBefore ){
             $amz->setLimits('Created',$CreatedAfter,$CreatedBefore);
        }elseif ($LastUpdatedAfter || $LastUpdatedBefore) {
             $amz->setLimits('Modified', $LastUpdatedAfter,$LastUpdatedBefore);
        }else{
              $amz->setLimits('Modified', "- 100 hours");
        }
        $amz->setFulfillmentChannelFilter($Channel);
        $amz->setOrderStatusFilter(
           array($Shipping)
           ); //no shipped or pending
        $amz->setUseToken();
        $amz->fetchOrders();
        $list = $amz->getList();
        $response = $amz->getLastResponse();
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
    }

    public function GetOrderDetails(Request $request,$id){
       $AmazonOrderId   = $id;
        $amz = new \AmazonOrder("PROLINE"); //store name matches the array key in the config file
        $amz->setOrderId($AmazonOrderId);
        $amz->fetchOrder();
        $list_amz = $amz->getData();
        // echo "<pre>"; print_r($list_amz); echo "</pre>"; die();
        $message="";
        $url="";
         if($list_amz){
            $message ="Order details associated with order Id : ".$AmazonOrderId;
            $order = $list_amz;
            //foreach ($list_amz as $order) {
                // echo $order['ShippingAddress'];
                // die();
                $address            = $order['ShippingAddress'];
                $amount             = $order['OrderTotal'];
                $amazon_id          = $order['AmazonOrderId'];
                $purchase_data      = $order['PurchaseDate'];
                $order_status       = $order['OrderStatus'];
                $shipping_address   = $address['Name']." ".$address['AddressLine1']." ".$address['City']." ".$address['StateOrRegion']." ".$address['PostalCode']." ".$address['CountryCode']." ".$address['Phone'];
                $total              = $amount['Amount']." ".$amount['CurrencyCode'];
                $payment_method     = $order['PaymentMethod'];
                $market_id          = $order['MarketplaceId'];
                $buyer_name         = $order['BuyerName'];
                $email              = $order['BuyerEmail'];
                $order_type         = $order['OrderType'];                
                /*** Extracting Item sku **/
                $amz_item = new \AmazonOrderItemList("PROLINE"); //store name matches the array key in the config file
                $amz_item->setOrderId($amazon_id);         
                $amz_item->setUseToken(); //Amazon sends orders 100 at a time, but we want them all
                $amz_item->fetchItems();
                $amz_item = $amz_item->getItems();

                foreach ($amz_item as $item) {   
                    $list_data['Amazon OrderID']      = $amazon_id;
                    $list_data['Item Sku']            = $item['SellerSKU'];
                    $list_data['Product Name']        = $item['Title'];
                    $list_data['Quantity Ordered']    = $item['QuantityOrdered'];
                    $list_data['Quantity Shipped']    = $item['QuantityShipped'];
                    $list_data['Purchase Date']       = $purchase_data;
                    $list_data['Order Status']        = $order_status;
                    $list_data['Shipping Address']    = $shipping_address;
                    $list_data['Order Total']         = $total;
                    $list_data['Payment Method']      = $payment_method;
                    $list_data['Marketplace Id']      = $market_id;
                    $list_data['Buyer Name']          = $buyer_name;
                    $list_data['Email']               = $email;
                    $list_data['Order Type']          = $order_type;
                    $list = $list_data;
                }

           // }
        }else{
            $message="No Data Found Matching to your request";
            $list= "";
        }
        $response = $amz->getLastResponse();
        return view('amazon.amazon-order-info', ['message'=>$message,'response' => $response, 'list'=>$list]); 
    }

}
