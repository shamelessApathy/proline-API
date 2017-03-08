<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Walmart\Item;
use Walmart\Order; 

class WalmartController extends Controller
{
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
