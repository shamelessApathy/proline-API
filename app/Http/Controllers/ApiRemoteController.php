<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiRemoteController extends Controller
{
	/**
	*
	* @param $_POST['key']?? Think it'll be coming through HTTP POST method
	* @return BOOLEAN true/false if it is verified or not
	*/
    private function verify()
    {

    }
    public function test()
    {
    	echo 'getting here!';
    }
    public function zencart_handler($input)
    {
        echo "getting to the zencart handler!!!";
    }
    public function magento_handler($input)
    {
        echo "getting to the magento handler!";
    }
    public function incoming($framework)
    {
        //echo $framework;
        switch($framework)
        {
            case "zencart": 
                            $input = file_get_contents("php://input");
                            $decoded = json_decode($input);
                            $this->zencart_handler($input);
                            break;
            case "magento":
                            $input = file_get_contents("php://input");
                            $decoded = json_decode($input);
                            $this->magento_handler($input);
                            break;
            default:
                    echo "please specify the framework!";
                    break;
        }
    }
    public function token_gen()
    {
        return view('tokengen');
    }
}
 