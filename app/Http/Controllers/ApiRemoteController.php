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
}
