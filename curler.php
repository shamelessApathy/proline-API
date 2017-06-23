<?php
//
// A very simple PHP example that sends a HTTP POST to a remote site
//
$data = array(
	'sku'=>'PLJW185.30', 
	'quantity' => '1');
$data_string = json_encode($data);
$ch = curl_init();
$header = array();
$auth_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjI1MjUxOGRiNzliZWUyNjg1YzU5NzNmZjExNTg3ZGJiZmI0MjY3YzZmNjRiMWM2MjUyMGM3NDhkMmQ1NmQyMjM2MGExMjJmN2U1YTNkYzMxIn0.eyJhdWQiOiIxIiwianRpIjoiMjUyNTE4ZGI3OWJlZTI2ODVjNTk3M2ZmMTE1ODdkYmJmYjQyNjdjNmY2NGIxYzYyNTIwYzc0OGQyZDU2ZDIyMzYwYTEyMmY3ZTVhM2RjMzEiLCJpYXQiOjE0OTgxNTk1NzUsIm5iZiI6MTQ5ODE1OTU3NSwiZXhwIjoxNTI5Njk1NTc1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.ixJ3sn0vzzrpB_wiL11QU2CMC-A1LT0Nr5rWmiqFY0cJmWSLf3XtEsSFQ-EMbF9dyTMYCTqInxAUInLFHu-fndRoTYSb7hrnOSkPpwHKdG-7fmu5DtyhwZ106zlGnt7LRLjSw6oWbD65YyHGB0CEEZ8M04lW9gSaAz2f-Gt-9mbzDpkv_Qv-S2H5MUz_geq7ap7jkvnvo9co5HcLQAh53WfTSf7D9THQGW64dlvMj1zwILH0nicy7WJc41GstL4fMoX9__uLmW_gKF3kP-fisxjhOY5Zh1RJxZ6WXi3ZahRiA8E4vXzGpO79rlUA-oA8YMDUNQsL7ZQjJ4MisLgtsBeWmrp2bEy3-jpewgb-0BBg1wEHazZY1w7ZmosXEMNaO8l83fn1aPSEKxwCSiMJhWG3gLoB5HVHwGqTmDEOrgBMCftkMrIcRBt0JIqe9Mj6-Vi69D8g4mFmMfIpQh9M5LlgjXC1DiLiPRucfmhYDLK1q5MTMZP3hZ6tQtOFGfP4yeAh9OoT08wj7UtP3E2-cR1GgaSwN7vPWI4HVxf-ap4Vts5dwQ-A4_VOzreAI48_IEPKWwTA0oHu2-PFHKc_bV8_SbcJMd5KTo38TX1NjBSi9KDQfmcIXVGei9Z04BlSVMIpiZ40QOM8xw87X3UafiMUt_5oxfYchARh4-bPSVc';

$stringLength = strlen($data_string);
$header[] = "Content-length: $stringLength";
$header[] = 'Content-type: application/json';
$header[] = "Authorization: Bearer $auth_token";
// In PHP 7.0 you must set the array in CURLOPT_HTTPHEADER with seperate elements.
curl_setopt($ch, CURLOPT_HTTPHEADER,array($header[0],$header[1],$header[2]));
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_URL,"http://api.dev/api/remote/incoming/magento");
curl_setopt($ch, CURLOPT_POST, 1);


// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$server_output = curl_exec ($ch);

curl_close ($ch);

var_dump($server_output);
// further processing ....
//if ($server_output == "OK") { ... } else { ... }

?>
