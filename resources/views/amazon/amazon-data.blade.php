@extends('layouts.app')
@section('content')

<div class="container">
	<h1>Amazon MWS</h1>
	<div class="col-md-12">
		<div class="col-md-6 col-sm-6">
			<form class="form-horizontal api-data" role="form" method="POST" action="{{ route('api-form-action') }}">
				{{ csrf_field() }}
				<h3 class="text-center btn btn-primary btn-block">API Selection</h2>
				<div class="row top-buffer">
					<div class="text_field clearfix">
						<span class="col-md-6 col-sm-12 lt_col">API Section:</span>
						<span class="col-md-6 col-sm-12 lt_col">
							<select id="apisection" name="apisection" class="form-control" required>    
                    			<option value="Feeds">Feeds</option>
                    			<option value="Reports">Reports</option>
                    			<option value="FulfillmentByAmazon">Fulfillment</option>
                    			<option value="Orders">Orders</option>
                    			<option value="Sellers">Sellers</option>
                    			<option value="Products">Products</option>
                    			<option value="Recommendations">Recommendations</option>
                    			<option value="Subscriptions">Subscriptions</option>
                    			<option value="OffAmazonPayments-Sandbox">Off-Amazon Payments Sandbox</option>
                    			<option value="OffAmazonPayments">Off-Amazon Payments</option>
                    			<option value="Finances">Finances</option>
                    			<option value="MerchantFulfillment">Merchant Fulfillment</option>
                    		</select>
						</span>
					</div>
				</div>
				<div class="row top-buffer">
					<div class="text_field clearfix">
						<span class="col-md-6 col-sm-12 lt_col">Operation:</span>
						<span class="col-md-6 col-sm-12 lt_col">
							<select id="apicall" name="apicall" class="form-control" required>
				                <option value="">Pick an operation...</option>
				                <optgroup label="Feeds"></optgroup>
				                <option value="CancelFeedSubmissions">CancelFeedSubmissions</option>
				                <option value="GetFeedSubmissionList">GetFeedSubmissionList</option>
				                <option value="GetFeedSubmissionListByNextToken">GetFeedSubmissionListByNextToken</option>
				                <option value="GetFeedSubmissionCount">GetFeedSubmissionCount</option>
				                <option value="GetFeedSubmissionResult">GetFeedSubmissionResult</option>
				                <option value="SubmitFeed">SubmitFeed</option>
				            </select>
						</span>
					</div>
				</div>
				<h3 class="text-center btn btn-primary btn-block">Required API Parameters</h2>
				<div class="clearfix" id="required-parameter"></div>
				<div class="text-center top-buffer">
		    	<button type="submit" class="btn btn-primary">Submit</button>                        
		    	</div>
			</form>
		</div>
	</div>

<?php //var_dump($response[0]->Request); ?>
<script type="text/javascript">
	$('select#apisection').on('change', function() {
	  	var value = this.value;
	  	$.ajax({
	      url: 'amazon-api-selection',
	      type: "get",
	      data: {'value':value},
	      success: function(data){
	        $("#apicall").empty().append(data);
	      }
	    });   
	});
	$('select#apicall').on('change', function() {
	  	var value = this.value;
	  	$.ajax({
	      url: 'amazon-api-operation',
	      type: "get",
	      data: {'value':value},
	      success: function(data){
	        $("#required-parameter").empty().append(data);
	      }
	    });   
	});
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on("focus", "#CreatedAfter", function(){
        $(this).datepicker({
          dateFormat: "yy-mm-dd",
          showAnim : 'fadeIn'
        });
    });
    $(document).on("focus", "#CreatedBefore", function(){
        $(this).datepicker({
          dateFormat: "yy-mm-dd",
          showAnim : 'fadeIn'
        });
    });
    $(document).on("focus", "#LastUpdatedAfter", function(){
        $(this).datepicker({
          dateFormat: "yy-mm-dd",
          showAnim : 'fadeIn'
        });
    });
    $(document).on("focus", "#LastUpdatedBefore", function(){
        $(this).datepicker({
          dateFormat: "yy-mm-dd",
          showAnim : 'fadeIn'
        });
    });
  } );
  </script>
 
@endsection