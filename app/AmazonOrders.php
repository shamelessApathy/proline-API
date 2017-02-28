<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmazonOrders extends Model
{

    protected $table = 'amazon_orders';

    protected $fillable = [
        'amazonOrderId', 'buyerName', 'email','purchaseDate','orderStatus','totalAmount','paymentMethod','shippingAddress','marketID','orderType','itemSku','productTitle','ASIN','QuantityOrdered','QuantityShipped'
    ];

    
}
