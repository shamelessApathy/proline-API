<?php
namespace App\Libraries\Walmart;

class WalmartApi {

	function __construct(){
		
	}

    public $consumerId = 'b5898955-275c-4511-9d79-e3860b4637e8';
    public $privateKey = 'MIICeAIBADANBgkqhkiG9w0BAQEFAASCAmIwggJeAgEAAoGBAKuGK4a3/Kpz2HCxPpM+cptFg5AhyiVELyByXbJKyTs2WGPgoa2pkZIRZt+u8S/x+c7tNOSHAKibn5H2o3mM0Si+1ZyQZ9Gvtyfy/3VJGcd4tW7HCr1JD40yr8rx62Vlea1O1v8JFTeZahyhDxcusUSZD/Gi8V5Pv7zMzpul3i+RAgMBAAECgYEAotXAMqgupX9PBkUuW8kYMlI/ATEi4FgnyUzpqJ6ZBa6lIUSbGOv3N81vdYF2lYbKGmlVInML7AW56m9UaMuHr/F+i8aqQykcXUWLkFgHksqM8yCe6m4EUr5OHq+YpDeWyiPkj8RLStEFql+UlTx0cxtVgJTQwbUQ94dLYGReifECQQDclO03zDOG2zTDcbq1mtdIb7zVPzDnKLKq63D1HuE7ejicbfy4GGAkyOoZhNIzuiontsi7okLnZDU3+R91ojxdAkEAxxC3KLBQq9zdrc/PbCwztH0e2STo40mQiuYXbi4pTcdXdJ4uAZAM4f2PnR4PPS3e7woeOYrqSbRyzjeKy+DsxQJBAJz9NVO39pgtHQFYyQyFNmEsfVW8Ep8CXR6+UHd0UdLV6sKSmQGg/5ROliYxXLVJ8sSvF3BLTJiIvkOm/1fmblUCQBFtBCuaq6Uv03QIsgatI+WT4mRt17k10mJmW/y4K8N0RNKfmjVmz8nksXK2k+zuHAre3uB4qaPEGRy2Pf809GUCQQCin9/N6bzzMFbzBYRt4csbrQrBtkUdhRW0syRrNPIaW1LIjrvVlZEZmVLqjBwK+xhRbwRzAX4p999JoXC8oPI4';
        

	public function jar()
	{
		$consumerId = env('b5898955-275c-4511-9d79-e3860b4637e8');
		$privateKey = env('MIICeAIBADANBgkqhkiG9w0BAQEFAASCAmIwggJeAgEAAoGBAKuGK4a3/Kpz2HCxPpM+cptFg5AhyiVELyByXbJKyTs2WGPgoa2pkZIRZt+u8S/x+c7tNOSHAKibn5H2o3mM0Si+1ZyQZ9Gvtyfy/3VJGcd4tW7HCr1JD40yr8rx62Vlea1O1v8JFTeZahyhDxcusUSZD/Gi8V5Pv7zMzpul3i+RAgMBAAECgYEAotXAMqgupX9PBkUuW8kYMlI/ATEi4FgnyUzpqJ6ZBa6lIUSbGOv3N81vdYF2lYbKGmlVInML7AW56m9UaMuHr/F+i8aqQykcXUWLkFgHksqM8yCe6m4EUr5OHq+YpDeWyiPkj8RLStEFql+UlTx0cxtVgJTQwbUQ94dLYGReifECQQDclO03zDOG2zTDcbq1mtdIb7zVPzDnKLKq63D1HuE7ejicbfy4GGAkyOoZhNIzuiontsi7okLnZDU3+R91ojxdAkEAxxC3KLBQq9zdrc/PbCwztH0e2STo40mQiuYXbi4pTcdXdJ4uAZAM4f2PnR4PPS3e7woeOYrqSbRyzjeKy+DsxQJBAJz9NVO39pgtHQFYyQyFNmEsfVW8Ep8CXR6+UHd0UdLV6sKSmQGg/5ROliYxXLVJ8sSvF3BLTJiIvkOm/1fmblUCQBFtBCuaq6Uv03QIsgatI+WT4mRt17k10mJmW/y4K8N0RNKfmjVmz8nksXK2k+zuHAre3uB4qaPEGRy2Pf809GUCQQCin9/N6bzzMFbzBYRt4csbrQrBtkUdhRW0syRrNPIaW1LIjrvVlZEZmVLqjBwK+xhRbwRzAX4p999JoXC8oPI4');
		
        $result = shell_exec("java -jar DigitalSignatureUtil-1.0.0.jar DigitalSignatureUtil https://marketplace.walmartapis.com/v2/feeds".$consumerId." ".$privateKey." GET (".app_path()."/Libraries/Walmart/signature");

	}
	public function test()
	{
		$this->jar();
		$stuff = array( file(app_path().'/Libraries/Walmart/signature')[0], file(app_path().'/Libraries/Walmart/signature')[1]);

		return $stuff;
	}

    public function get($headers, $assoc = false) {
    	$consumerId = env('b5898955-275c-4511-9d79-e3860b4637e8');
    	$url = 'https://marketplace.walmartapis.com/v2/items?limit=10';
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
                            "WM_CONSUMER.ID:".$consumerId,
                            "Accept: application/xml"
                    ),
                    CURLOPT_HTTPGET => true
            );
            curl_setopt_array($ch, $options);

            $response = curl_exec ($ch);
            echo "Response :::".$response;
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