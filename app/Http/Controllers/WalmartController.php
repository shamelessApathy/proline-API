<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Walmart\Item;
<<<<<<< HEAD
use Walmart\Order;
use GuzzleHttp\Command\Exception\CommandClientException;
use Sil\PhpEnv\Env;
=======
use Walmart\Order; 
>>>>>>> 644c0d3d3e007a94f6c707170d2ef5450995e918

class WalmartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $lib = new WalmartApi;
       // make signature file and then parse results to array
       

        $stuff = $lib->test();
        // make curl call
        $results = $lib->get($stuff);
        //var_dump($results);
        //echo "<pre>"; print_r($results);

        die();


       $item = new Item(
            [
                'consumerId' => getenv('b5898955-275c-4511-9d79-e3860b4637e8'),
                'privateKey' => getenv('MIICeAIBADANBgkqhkiG9w0BAQEFAASCAmIwggJeAgEAAoGBAKuGK4a3/Kpz2HCxPpM+cptFg5AhyiVELyByXbJKyTs2WGPgoa2pkZIRZt+u8S/x+c7tNOSHAKibn5H2o3mM0Si+1ZyQZ9Gvtyfy/3VJGcd4tW7HCr1JD40yr8rx62Vlea1O1v8JFTeZahyhDxcusUSZD/Gi8V5Pv7zMzpul3i+RAgMBAAECgYEAotXAMqgupX9PBkUuW8kYMlI/ATEi4FgnyUzpqJ6ZBa6lIUSbGOv3N81vdYF2lYbKGmlVInML7AW56m9UaMuHr/F+i8aqQykcXUWLkFgHksqM8yCe6m4EUr5OHq+YpDeWyiPkj8RLStEFql+UlTx0cxtVgJTQwbUQ94dLYGReifECQQDclO03zDOG2zTDcbq1mtdIb7zVPzDnKLKq63D1HuE7ejicbfy4GGAkyOoZhNIzuiontsi7okLnZDU3+R91ojxdAkEAxxC3KLBQq9zdrc/PbCwztH0e2STo40mQiuYXbi4pTcdXdJ4uAZAM4f2PnR4PPS3e7woeOYrqSbRyzjeKy+DsxQJBAJz9NVO39pgtHQFYyQyFNmEsfVW8Ep8CXR6+UHd0UdLV6sKSmQGg/5ROliYxXLVJ8sSvF3BLTJiIvkOm/1fmblUCQBFtBCuaq6Uv03QIsgatI+WT4mRt17k10mJmW/y4K8N0RNKfmjVmz8nksXK2k+zuHAre3uB4qaPEGRy2Pf809GUCQQCin9/N6bzzMFbzBYRt4csbrQrBtkUdhRW0syRrNPIaW1LIjrvVlZEZmVLqjBwK+xhRbwRzAX4p999JoXC8oPI4'),
            ],
            Item::ENV_MOCK  
        );
        // $items = $item->list();
        $items = $item->list();
        echo "<pre>"; print_r($items);
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

    public function GetProductInfo(){

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
                'privateKey' => getenv('WALMART_SECRET_KEY'),
            ]//,
        //Item::ENV_MOCK 
        );
        $items = $client->list(['limit'=>5]);
        var_dump($items);
    }
    public function order_list()
    {
        $client = new Order([
            'consumerId' => getenv('WALMART_API_KEY'),
            'privateKey' => getenv('WALMART_SECRET_KEY'),
            'wmConsumerChannelType' => getenv('WM_CONSUMER_CHANNEL_TYPE')
        ]);

        $orders = $client->list([]);
        var_dump($orders);
    } 
}
