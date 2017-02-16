<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AmazonController extends Controller
{ 
  public function getAmazonOrders() {
    try {
        $amz = new \AmazonOrderList("PROLINE"); //store name matches the array key in the config file
        $amz->setLimits('Modified', "- 24 hours"); //accepts either specific timestamps or relative times 
        $amz->setFulfillmentChannelFilter("MFN"); //no Amazon-fulfilled orders
        $amz->setOrderStatusFilter(
            array("Unshipped", "PartiallyShipped", "Canceled", "Unfulfillable")
            ); //no shipped or pending orders
        $amz->setUseToken(); //tells the object to automatically use tokens right away
        $amz->fetchOrders(); //this is what actually sends the request
        return $amz->getList();
    } catch (Exception $ex) {
        echo 'There was a problem with the Amazon library. Error: '.$ex->getMessage();
    }
}

    /**
    * Invokes the the library for MWS
    *
    *
    */
    public function service_test()
    {
        $list= $this->getAmazonOrders();
        if ($list) {
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
}
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
