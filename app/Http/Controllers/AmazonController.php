<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AmazonOrders;
use App\AmazonProductList;
use Illuminate\Support\Facades\DB;
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
        $amz->setLimits('Modified', "- 100 hours");
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
        $message="";
        return view('orders', ['message'=>$message,'response' => $response, 'list'=>$list]);
    }

    /**** Order Details Export Funtion ****/
    public function ExportOrdersData(){

        header("Content-type: text/csv");  
        header("Cache-Control: no-store, no-cache");  
        header('Content-Disposition: attachment; filename="AmazonOrders.csv"');  
        $outstream = fopen("php://output",'w');
        
        $amz = new \AmazonOrderList("PROLINE"); 
        $amz->setLimits('Modified', "- 100 hours");
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

    /**** Funtion to Update the Inventory ****/
    public function SaveOrders(){
        $amz = new \AmazonOrderList("PROLINE"); //store name matches the array key in the config file
        $amz->setLimits('Modified', "- 18 hours");
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
                    }
                }else{
                    $message ="Duplicate entry";
                }

            }       
        }
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
}
