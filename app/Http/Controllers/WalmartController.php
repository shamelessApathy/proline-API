<?php

namespace App\Http\Controllers;
use \App\Libraries\Walmart\WalmartApi;
use Illuminate\Http\Request;

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
       $lib = new WalmartApi;
       // make signature file and then parse results to array
        $stuff = $lib->test();
        // make curl call
        $results = $lib->get($stuff);
        var_dump($results);
        // I installed default Java newest version on machine
        // I used the digitalsignature.jar file got from here :https://developer.walmartapis.com/#jar-executable-recommended

        // Keey geting this error : string(402) "UNAUTHORIZED.GMP_GATEWAY_APIUNAUTHORIZEDUnauthorizedUnauthorizedERRORDATA"
    }
}
