<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Walmart\Item;
use Walmart\Order;
use GuzzleHttp\Command\Exception\CommandClientException;
use Sil\PhpEnv\Env;
use App\Product;

class WalmartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function Index()
    {
        return view('walmart.walmart');
    }

    public function OrderList(){
        $client = new Order([
            'consumerId'            => getenv('WALMART_API_KEY'),
            'privateKey'            => getenv('WALMART_SECRETE_KEY'),
            'wmConsumerChannelType' => getenv('WM_CONSUMER_CHANNEL_TYPE'),
        ],
        Order::ENV_MOCK 
        );

        $orders = $client->list([
            'createdStartDate' => '2016-06-01', // required
            'limit' => 10, // optional, default 10);
        ]);
         echo "<pre>"; print_r($orders); die();

        foreach ($orders as $item) {
            echo $item->getElements();
            // $shipping   = $item->getShippingInfo();
            // echo $item->getPurchaseOrderId();
            // echo $shipping;
            exit();
            $orderlines =$item->orderLines();
            $list_data['purchaseOrderId']      = $item->purchaseOrderId();
            $list_data['customerOrderId']      = $item->customerOrderId();
            $list_data['customerEmailId']      = $item->customerEmailId();
            // $list_data['shippingInfo']         = $shipping['postalAddress']['address1']." ".$shipping['postalAddress']['address1']." ".$shipping['postalAddress']['address2']." "$shipping['postalAddress']['city']." "$shipping['postalAddress']['state']." "$shipping['postalAddress']['postalCode']." "$shipping['postalAddress']['country'];
            // $list_data['productName']           = $orderlines['orderLine']['item']['productName'];
            // $list_data['orderLineQuantity']       = $orderlines['orderLine']['orderLineQuantity']['amount'];
            // $list_data['OrderTotal']         = $orderlines['orderLine']['charges']['charge']['chargeAmount']['amount'];
            // $list_data['currency']         = $orderlines['orderLine']['charges']['charge']['chargeAmount']['currency'];
            // $list_data['BuyerName']          = $shipping['postalAddress']['name'];
            $list[] = $list_data;
        }
        echo "<pre>"; print_r($list); die();
        return view('walmart.order-list', ['ordersList'=>$ordersList]);
        //var_dump($orders);
    }

    public function GetProductInfo($id){
        $product = Product::where('walmartID', $id)->first();
        echo $sku = $product->sku;
        $client = new Item(
            [
                'consumerId' => getenv('WALMART_API_KEY'),
                'privateKey' => getenv('WALMART_SECRETE_KEY'),
            ]//,
        //Item::ENV_MOCK 
        );
        $items = $client->get(['sku'=>$sku]);

        echo $item;
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

    /**
    *
    * Public test function to see if WalmartAPI library is accessible
    *
    */
    public function test()
    {

        $client = new Item(
            [
                'consumerId' => getenv('WALMART_API_KEY'),
                'privateKey' => getenv('WALMART_SECRETE_KEY'),
            ]//,
        //Item::ENV_MOCK 
        );
        $items = $client->list(['limit'=>5]);
        echo "<pre>"; print_r($items);
    }
    public function order_list()
    {
        $client = new Order([
            'consumerId' => getenv('WALMART_API_KEY'),
            'privateKey' => getenv('WALMART_SECRETE_KEY'),
            'wmConsumerChannelType' => getenv('WM_CONSUMER_CHANNEL_TYPE')
        ]);

        $orders = $client->list([]);
        var_dump($orders);
    } 
}
