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
                                <option value="">Pick an operation...</option>    
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
				                <!-- <option value="">Pick an operation...</option>
				                <optgroup label="Feeds"></optgroup>
				                <option value="CancelFeedSubmissions">CancelFeedSubmissions</option>
				                <option value="GetFeedSubmissionList">GetFeedSubmissionList</option>
				                <option value="GetFeedSubmissionListByNextToken">GetFeedSubmissionListByNextToken</option>
				                <option value="GetFeedSubmissionCount">GetFeedSubmissionCount</option>
				                <option value="GetFeedSubmissionResult">GetFeedSubmissionResult</option>
				                <option value="SubmitFeed">SubmitFeed</option> -->
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

<script type="text/javascript">
    $(document).ready(function(){
        $("#apisectionoption:selected").removeAttr("selected");
    });
	$(function(){
    	$(document).on('click', '.btn-add', function(e){
	        e.preventDefault();
	        var controlForm = $('#ReportTypeList:first'),
	            currentEntry = $(this).parents('.entry:first'),
	            newEntry = $(currentEntry.clone()).appendTo(controlForm);
	        newEntry.find('input').val('');
	        controlForm.find('.entry:not(:last) .btn-add')
	            .removeClass('btn-add').addClass('btn-remove')
	            .removeClass('btn-success').addClass('btn-danger')
	            .html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
    	}).on('click', '.btn-remove', function(e){
	        e.preventDefault();
	        $(this).parents('.entry:first').remove();
	        return false;
    });

	$(document).on('click', '.btn-add-rId', function(e){
        e.preventDefault();
        var controlForm = $('#ReportRequestIdList:first'),
            currentEntry = $(this).parents('.entry-rId:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('input').val('');
        controlForm.find('.entry-rId:not(:last) .btn-add-rId')
            .removeClass('btn-add-rId').addClass('btn-remove-rId')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
	}).on('click', '.btn-remove-rId', function(e){
        e.preventDefault();
        $(this).parents('.entry-rId:first').remove();
        return false;
    });

	$(document).on('click', '.btn-add-rril', function(e){
        e.preventDefault();
        var controlForm = $('#ReportRequestIdList:first'),
            currentEntry = $(this).parents('.entry-rril:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('input').val('');
        controlForm.find('.entry-rril:not(:last) .btn-add-rril')
            .removeClass('btn-add-rril').addClass('btn-remove-rril')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
	}).on('click', '.btn-remove-rril', function(e){
        e.preventDefault();
        $(this).parents('.entry-rril:first').remove();
        return false;
    });
    $(document).on('click', '.btn-add-rtl', function(e){
        e.preventDefault();
        var controlForm = $('#ReportTypeList:first'),
            currentEntry = $(this).parents('.entry-rtl:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('input').val('');
        controlForm.find('.entry-rtl:not(:last) .btn-add-rtl')
            .removeClass('btn-add-rtl').addClass('btn-remove-rtl')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
	}).on('click', '.btn-remove-rtl', function(e){
        e.preventDefault();
        $(this).parents('.entry-rtl:first').remove();
        return false;
    });
    $(document).on('click', '.btn-add-rpsl', function(e){
        e.preventDefault();
        var controlForm = $('#ReportProcessingStatusList:first'),
            currentEntry = $(this).parents('.entry-rpsl:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('select').val('');
        controlForm.find('.entry-rpsl:not(:last) .btn-add-rpsl')
            .removeClass('btn-add-rpsl').addClass('btn-remove-rpsl')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
	}).on('click', '.btn-remove-rpsl', function(e){
        e.preventDefault();
        $(this).parents('.entry-rpsl:first').remove();
        return false;
    });
    $(document).on('click', '.btn-add-rrl', function(e){
        e.preventDefault();
        var controlForm = $('#ReportTypeList:first'),
            currentEntry = $(this).parents('.entry-rrl:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('select').val('');
        controlForm.find('.entry-rrl:not(:last) .btn-add-rrl')
            .removeClass('btn-add-rrl').addClass('btn-remove-rrl')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
    }).on('click', '.btn-remove-rrl', function(e){
        e.preventDefault();
        $(this).parents('.entry-rrl:first').remove();
        return false;
    });
    $(document).on('click', '.btn-add-fsil', function(e){
        e.preventDefault();
        var controlForm = $('#FeedSubmissionIdList:first'),
            currentEntry = $(this).parents('.entry-fsil:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('input').val('');
        controlForm.find('.entry-fsil:not(:last) .btn-add-fsil')
            .removeClass('btn-add-fsil').addClass('btn-remove-fsil')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
    }).on('click', '.btn-remove-fsil', function(e){
        e.preventDefault();
        $(this).parents('.entry-fsil:first').remove();
        return false;
    });
    $(document).on('click', '.btn-add-ftl', function(e){
        e.preventDefault();
        var controlForm = $('#FeedTypeList:first'),
            currentEntry = $(this).parents('.entry-ftl:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('input').val('');
        controlForm.find('.entry-ftl:not(:last) .btn-add-ftl')
            .removeClass('btn-add-ftl').addClass('btn-remove-ftl')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
    }).on('click', '.btn-remove-ftl', function(e){
        e.preventDefault();
        $(this).parents('.entry-ftl:first').remove();
        return false;
    });
    $(document).on('click', '.btn-add-fpsl', function(e){
        e.preventDefault();
        var controlForm = $('#FeedProcessingStatusList:first'),
            currentEntry = $(this).parents('.entry-fpsl:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('select').val('');
        controlForm.find('.entry-fpsl:not(:last) .btn-add-fpsl')
            .removeClass('btn-add-fpsl').addClass('btn-remove-fpsl')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
    }).on('click', '.btn-remove-fpsl', function(e){
        e.preventDefault();
        $(this).parents('.entry-fpsl:first').remove();
        return false;
    });
      $(document).on('click', '.btn-add-aoi', function(e){
        e.preventDefault();
        var controlForm = $('#AmazonOrderId:first'),
            currentEntry = $(this).parents('.entry-aoi:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('input').val('');
        controlForm.find('.entry-aoi:not(:last) .btn-add-aoi')
            .removeClass('btn-add-aoi').addClass('btn-remove-aoi')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
    }).on('click', '.btn-remove-aoi', function(e){
        e.preventDefault();
        $(this).parents('.entry-aoi:first').remove();
        return false;
    });

});
</script>


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
    $(document).on("focus", "#AvailableFromDate", function(){
        $(this).datepicker({
          dateFormat: "yy-mm-dd",
          showAnim : 'fadeIn'
        });
    });
    $(document).on("focus", "#AvailableToDate", function(){
        $(this).datepicker({
          dateFormat: "yy-mm-dd",
          showAnim : 'fadeIn'
        });
    });
    $(document).on("focus", "#StartDate", function(){
        $(this).datepicker({
          dateFormat: "yy-mm-dd",
          showAnim : 'fadeIn'
        });
    });
    $(document).on("focus", "#EndDate", function(){
        $(this).datepicker({
          dateFormat: "yy-mm-dd",
          showAnim : 'fadeIn'
        });
    });
    $(document).on("focus", "#RequestedFromDate", function(){
        $(this).datepicker({
          dateFormat: "yy-mm-dd",
          showAnim : 'fadeIn'
        });
    });
    $(document).on("focus", "#RequestedToDate", function(){
        $(this).datepicker({
          dateFormat: "yy-mm-dd",
          showAnim : 'fadeIn'
        });
    });
    $(document).on("focus", "#ScheduleDate", function(){
        $(this).datepicker({
          dateFormat: "yy-mm-dd",
          showAnim : 'fadeIn'
        });
    });
     $(document).on("focus", "#SubmittedFromDate", function(){
        $(this).datepicker({
          dateFormat: "yy-mm-dd",
          showAnim : 'fadeIn'
        });
    });
  $(document).on("focus", "#SubmittedToDate", function(){
    $(this).datepicker({
      dateFormat: "yy-mm-dd",
      showAnim : 'fadeIn'
    });
});
  } );
  </script>
 
@endsection