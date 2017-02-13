<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Test extends Controller
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
    public function send()
    {
        $key = 'AKIAIBSPIEV5NG42J6ZA';
        $seller_id = 'A4MXUMMLKCFTL';
        $Marketplace_ID = 'ATVPDKIKX0DER';
        $dev_num = '9614-6978-4316';
        $dev_key = 'AKIAIBSPIEV5NG42J6ZA';
        $secret = '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';
        $url = 'https://mws.amazonservices.com';
        $hash = hash('hmacsha256',$secret);
        $hash64 = base64_encode($hash);
        $timestamp = date('Y-m-d\TH:i:s.Z\Z', time());
        $data = array('AWSAccessKeyId'=>$dev_key,'Action'=>'RequestReport','ReportType'=>'InventoryReport', 'SellerId'=>$seller_id, 'SignatureMethod'=>'HmacSHA256','SignatureVersion'=>'2','Signature'=>$hash64, 'Timestamp'=>$timestamp);


// what post fields?


// build the urlencoded data
$postvars = http_build_query($data);

// open connection
$ch = curl_init();

// set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, count($data));
curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);

// execute post
$result = curl_exec($ch);

// close connection
curl_close($ch);
var_dump($result);
        /*

        POST /Feeds/2009-01-01 HTTP/1.1
Content-Type: x-www-form-urlencoded
Host: mws.amazonservices.com
User-Agent: <Your User Agent Header>

AWSAccessKeyId=0PExampleR2
&Action=CancelFeedSubmissions
&FeedSubmissionIdList.Id.1=1058369303
&FeedTypeList.Type.1=_POST_PRODUCT_DATA_
&FeedTypeList.Type.2=_POST_PRODUCT_PRICING_DATA_
&MWSAuthToken=amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE
&Marketplace=ATExampleER
&SellerId=A1ExampleE6
&SignatureMethod=HmacSHA256
&SignatureVersion=2
&Timestamp=2009-02-04T17%3A34%3A14.203Z
&Version=2009-01-01
&Signature=0RExample0%3D*/

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
