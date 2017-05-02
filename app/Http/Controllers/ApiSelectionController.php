<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AmazonOrders;
use App\Product;
use Illuminate\Support\Facades\DB;
class ApiSelectionController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }
    /******************* Amazon Selection **************/
    public function ApiSelection(Request $request){
        //echo "string"; die();
        $value  = $request['value'];
        $result = "";
        if($value=='Orders'){
            $result  = "<option value=''>Pick an operation...</option>";
            $result .= '<optgroup label="Order Retrieval"></optgroup>';
            $result .= '<option value="GetOrderServiceStatus">GetServiceStatus</option>';
            $result .= '<option value="ListOrders">ListOrders</option>';
          //  $result .= '<option value="ListOrdersByNextToken">ListOrdersByNextToken</option>';
            $result .= '<option value="GetOrder">GetOrder</option>';
            $result .= '<option value="ListOrderItems">ListOrderItems</option>';
           // $result .= '<option value="ListOrderItemsByNextToken">ListOrderItemsByNextToken</option>';
        }
        if($value=='Products'){
            
            $result  = '<option value="">Pick an operation...</option>';
            $result .= '<optgroup label="Products"></optgroup>';
            $result .= '<option value="GetProductServiceStatus">GetServiceStatus</option>';
            $result .= '<option value="ListMatchingProducts">ListMatchingProducts</option>';
            $result .= '<option value="GetMatchingProduct">GetMatchingProduct</option>';
            $result .= '<option value="GetMatchingProductForId">GetMatchingProductForId</option>';
            $result .= '<option value="GetCompetitivePricingForSKU">GetCompetitivePricingForSKU</option>';
            $result .= '<option value="GetCompetitivePricingForASIN">GetCompetitivePricingForASIN</option>';
            $result .= '<option value="GetLowestPricedOffersForSKU">GetLowestPricedOffersForSKU</option>';
            $result .= '<option value="GetLowestPricedOffersForASIN">GetLowestPricedOffersForASIN</option>';
            $result .= '<option value="GetLowestOfferListingsForSKU">GetLowestOfferListingsForSKU</option>';
            $result .= '<option value="GetLowestOfferListingsForASIN">GetLowestOfferListingsForASIN</option>';
            $result .= '<option value="GetMyFeesEstimate">GetMyFeesEstimate</option>';
            $result .= '<option value="GetMyPriceForSKU">GetMyPriceForSKU</option>';
            $result .= '<option value="GetMyPriceForASIN">GetMyPriceForASIN</option>';
            $result .= '<option value="GetProductCategoriesForSKU">GetProductCategoriesForSKU</option>';
            $result .= '<option value="GetProductCategoriesForASIN">GetProductCategoriesForASIN</option>';
        }

        return $result;
    }

    public function ApiOperation(Request $request){
        $value  = $request['value'];
        if($value=="ListOrders"){
            $result='<div class="row top-buffer">
                    <div class="text_field clearfix">
                        <span class="col-md-6 col-sm-12 lt_col">CreatedAfter</span>
                        <span class="col-md-6 col-sm-12 lt_col">
                            <input name="CreatedAfter" type="text" id="CreatedAfter">
                        </span>
                    </div>
                     <div class="text_field clearfix top-buffer">
                        <span class="col-md-6 col-sm-12 lt_col">CreatedBefore</span>
                        <span class="col-md-6 col-sm-12 lt_col">
                            <input name="CreatedBefore" type="text" id="CreatedBefore">
                        </span>
                    </div>
                     <div class="text_field clearfix top-buffer">
                        <span class="col-md-6 col-sm-12 lt_col">LastUpdatedAfter</span>
                        <span class="col-md-6 col-sm-12 lt_col">
                            <input name="LastUpdatedAfter" type="text" id="LastUpdatedAfter">
                        </span>
                    </div>
                     <div class="text_field clearfix top-buffer">
                        <span class="col-md-6 col-sm-12 lt_col">LastUpdatedBefore</span>
                        <span class="col-md-6 col-sm-12 lt_col">
                            <input name="LastUpdatedBefore" type="text" id="LastUpdatedBefore">
                        </span>
                    </div>
                     <div class="text_field clearfix top-buffer">
                        <span class="col-md-6 col-sm-12 lt_col">FulfillmentChannel.Channel.1</span>
                        <span class="col-md-6 col-sm-12 lt_col">
                            <select id="channel" name="channel" class="form-control" required>
                                <option value="">Select Channel...</option>
                                <option value="MFN">MFN</option>
                                <option value="AFN">AFN</option>
                            </select>
                        </span>
                    </div>  
                     <div class="text_field clearfix top-buffer">
                        <span class="col-md-6 col-sm-12 lt_col">OrderStatus</span>
                        <span class="col-md-6 col-sm-12 lt_col">
                            <select id="shipping" name="shipping" class="form-control" required>
                                <option value="">Select Shipping Status...</option>
                                <option value="Shipped">Shipped</option>
                                <option value="Unshipped">Unshipped</option>
                                <option value="PartiallyShipped">PartiallyShipped</option>
                                <option value="Canceled">Canceled</option>
                                <option value="Unfulfillable">Unfulfillable</option>
                            </select>
                        </span>
                    </div>  
                </div>';
        }
        if($value=="GetOrderServiceStatus"){
            $result ='<div class="row text-center">
                    <div class="text_field clearfix"><h2>No required parameters</h2></div></div>';
        }
        if($value=="GetOrder"){
            $result='<div class="row top-buffer">
                        <div class="text_field clearfix">
                            <span class="col-md-6 col-sm-12 lt_col">AmazonOrderId</span>
                            <span class="col-md-6 col-sm-12 lt_col">
                                <input name="AmazonOrderId" type="text" id="AmazonOrderId" required>
                            </span>
                        </div>
                    </div>';
        }
        if($value=="ListOrderItems"){
            $result='<div class="row top-buffer">
                        <div class="text_field clearfix">
                            <span class="col-md-6 col-sm-12 lt_col">AmazonOrderId</span>
                            <span class="col-md-6 col-sm-12 lt_col">
                                <input name="AmazonOrderId" type="text" id="AmazonOrderId" required>
                            </span>
                        </div>
                    </div>';
        }
        /**** Products API operations *****/
        if($value=="GetProductServiceStatus"){
            $result ='<div class="row text-center">
                    <div class="text_field clearfix"><h2>No required parameters</h2></div></div>';
        }


        return $result;
    }

}