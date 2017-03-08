<?php
namespace App\Libraries\Walmart;
class WalmartApi {
	function __construct(){
		
	}
	public function jar()
	{
		$walmartkey = env('WALMART_API_KEY');
		$walmartsecretkey = env('WALMART_SECRET_KEY');
		shell_exec("java -jar DigitalSignatureUtil-1.0.0.jar DigitalSignatureUtil https://marketplace.walmartapis.com/v2/feeds $walmartkey $walmartsecretkey GET /var/www/API/API/app/Libraries/Walmart/signature");
	}
	public function test()
	{
		$this->jar();
		$stuff = array( file('/var/www/API/API/app/Libraries/Walmart/signature')[0], file('/var/www/API/API/app/Libraries/Walmart/signature')[1]);
		return $stuff;
	}

            public function get($headers, $assoc = false) {
            	$walmartkey = env('WALMART_API_KEY');
            	$url = 'https://marketplace.walmartapis.com/v2/feeds';
                    $ch = curl_init();
                    $qos = uniqid();
                    $options = array (
                            CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_TIMEOUT => 60,
                            CURLOPT_HEADER => false,
                            CURLOPT_POST => 1,
                            CURLOPT_HTTPHEADER => array(
                                    'WM_SVC.NAME: Walmart Marketplace',
                                    $headers[0],
                                    $headers[1],
                                    'WM_QOS.CORRELATION_ID: '.$qos,
                                    "WM_CONSUMER.ID: $walmartkey",
                                    "Accept: application/xml"
                            ),
                            CURLOPT_HTTPGET => true
                    );
                    curl_setopt_array($ch, $options);

                    $response = curl_exec ($ch);
                    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close ($ch);

                    //if($code == 201 || $code == 200) {
                            return $response;
                    //}
                    //else {
                            //echo "qos:$qos\n";
                            //echo $response;
                         //   return false;
                //    }
                }

}