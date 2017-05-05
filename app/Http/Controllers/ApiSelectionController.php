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
        if($value=='Reports'){
            
            $result  = '<option value="">Pick an operation...</option>';
            $result .= '<optgroup label="Reports"></optgroup>';
            $result .= '<option value="GetReport">GetReport</option>';
            $result .= '<option value="GetReportCount">GetReportCount</option>';
            $result .= '<option value="GetReportList">GetReportList</option>';
            $result .= '<option value="GetReportListByNextToken">GetReportListByNextToken</option>';
            $result .= '<option value="GetReportRequestCount">GetReportRequestCount</option>';
            $result .= '<option value="GetReportRequestList">GetReportRequestList</option>';
            $result .= '<option value="GetReportRequestListByNextToken">GetReportRequestListByNextToken</option>';
            $result .= '<option value="CancelReportRequests">CancelReportRequests</option>';
            $result .= '<option value="RequestReport">RequestReport</option>';
            $result .= '<optgroup label="ReportSchedule"></optgroup>';
            $result .= '<option value="ManageReportSchedule">ManageReportSchedule</option>';
            $result .= '<option value="GetReportScheduleList">GetReportScheduleList</option>';
            $result .= '<option value="GetReportScheduleListByNextToken">GetReportScheduleListByNextToken</option>';
            $result .= '<option value="GetReportScheduleCount">GetReportScheduleCount</option>';
            $result .= '<option value="UpdateReportAcknowledgements">UpdateReportAcknowledgements</option>';
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
                            <input name="CreatedAfter" type="text" class="form-control" id="CreatedAfter">
                        </span>
                    </div>
                     <div class="text_field clearfix top-buffer">
                        <span class="col-md-6 col-sm-12 lt_col">CreatedBefore</span>
                        <span class="col-md-6 col-sm-12 lt_col">
                            <input name="CreatedBefore" type="text" class="form-control" id="CreatedBefore">
                        </span>
                    </div>
                     <div class="text_field clearfix top-buffer">
                        <span class="col-md-6 col-sm-12 lt_col">LastUpdatedAfter</span>
                        <span class="col-md-6 col-sm-12 lt_col">
                            <input name="LastUpdatedAfter" type="text" class="form-control" id="LastUpdatedAfter">
                        </span>
                    </div>
                     <div class="text_field clearfix top-buffer">
                        <span class="col-md-6 col-sm-12 lt_col">LastUpdatedBefore</span>
                        <span class="col-md-6 col-sm-12 lt_col">
                            <input name="LastUpdatedBefore" type="text" class="form-control" id="LastUpdatedBefore">
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
                                <input name="AmazonOrderId" class="form-control" type="text" id="AmazonOrderId" required>
                            </span>
                        </div>
                    </div>';
        }
        if($value=="ListOrderItems"){
            $result='<div class="row top-buffer">
                        <div class="text_field clearfix">
                            <span class="col-md-6 col-sm-12 lt_col">AmazonOrderId</span>
                            <span class="col-md-6 col-sm-12 lt_col">
                                <input name="AmazonOrderId" type="text" class="form-control" id="AmazonOrderId" required>
                            </span>
                        </div>
                    </div>';
        }
        /**** Products API operations *****/
        if($value=="GetProductServiceStatus"){
            $result ='<div class="row text-center">
                    <div class="text_field clearfix"><h2>No required parameters</h2></div></div>';
        }

        /**** Reports API operations *****/
        if($value=="GetReport"){
             $result='<div class="row top-buffer">
                        <div class="text_field clearfix">
                            <span class="col-md-6 col-sm-12 lt_col">ReportId</span>
                            <span class="col-md-6 col-sm-12 lt_col">
                                <input name="ReportId" type="text" class="form-control" id="ReportId" required>
                            </span>
                        </div>
                    </div>';
        }
        if($value=="GetReportList"){
             $result='<div class="row top-buffer">
                    <div class="text_field clearfix">
                        <span class="col-md-6 col-sm-12 lt_col">MaxCount</span>
                        <span class="col-md-6 col-sm-12 lt_col">
                            <input name="MaxCount" type="text" class="form-control" id="MaxCount">
                        </span>
                    </div>
                    <div class="text_field clearfix repeat-in" id="ReportTypeList">
                        <div class="entry top-buffer text_field clearfix">
                            <span class="col-md-6 col-sm-12 lt_col_text">ReportTypeList.Type.1</span>
                            <span class="col-md-6 col-sm-12 lt_col">
                                <input name="ReportTypeList[]" class="form-control" type="text" id="ReportTypeList">
                                <button type="button" class="btn btn-success btn-lg btn-add">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div> 
                    </div>
                     <div class="text_field clearfix top-buffer">
                        <span class="col-md-6 col-sm-12 lt_col">Acknowledged</span>
                        <span class="col-md-6 col-sm-12 lt_col">
                            <select id="Acknowledged" name="Acknowledged" class="form-control" required>
                                <option value="">Select Option...</option>
                                <option value="True">True</option>
                                <option value="False">False</option>
                            </select>
                        </span>
                    </div>
                     <div class="text_field clearfix top-buffer">
                        <span class="col-md-6 col-sm-12 lt_col">AvailableFromDate</span>
                        <span class="col-md-6 col-sm-12 lt_col">
                            <input name="AvailableFromDate" class="form-control" type="text" id="AvailableFromDate">
                        </span>
                    </div>
                     <div class="text_field clearfix top-buffer">
                        <span class="col-md-6 col-sm-12 lt_col">AvailableToDate</span>
                        <span class="col-md-6 col-sm-12 lt_col">
                           <input name="AvailableToDate" class="form-control" type="text" id="AvailableToDate">
                        </span>
                    </div>  
                     <div class="text_field clearfix repeat-in" id="ReportRequestIdList">
                        <div class="entry-rId top-buffer text_field clearfix">
                            <span class="col-md-6 col-sm-12 lt_col_text">ReportRequestIdList.Id.1</span>
                            <span class="col-md-6 col-sm-12 lt_col">
                                <input name="ReportRequestIdList[]" class="form-control" type="text" id="ReportRequestIdList">
                                <button type="button" class="btn btn-success btn-lg btn-add-rId">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div> 
                    </div>
                </div>';
        }

        return $result;
    }

}