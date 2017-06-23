<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

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
    /**
    *
    * outgoing() subtracts inventory for each SKU by the $input['quantity']
    * @param $input array with Type, SKU, and Quantity
    * @return BOOL on success or fail
    */
    public function outgoing($input)
    {
        $sku = $input->sku;
        $quantity = $input->quantity;
        $product = Product::where('sku', $sku)->first();
        print_r($product);

    }
    public function zencart_handler($input)
    {
        $input = $input;
        $type = $input->type;
        switch($type)
        {
            case 'outgoing': $this->outgoing($input);
                            break;
            case 'incoming' : $this->incoming($input);
                            break;
            default : break;
        }
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
                            $this->zencart_handler($decoded);
                            //echo "in switch statement";
                            break;
            case "magento":
                            $input = file_get_contents("php://input");
                            $decoded = json_decode($input);
                            $this->magento_handler($decoded);
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
 