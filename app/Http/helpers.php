<?php
namespace App\Http;

class Helper{
    
     public static function full_name($first_name,$last_name) {
        return $first_name . ', '. $last_name;   
    }
}