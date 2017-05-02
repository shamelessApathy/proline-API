@extends('layouts.app')
@section('content')
<div class="container">
	<div class="col-md-12">
		<a href="{{ route('amazon-data') }}" class="btn btn-primary">Back</a>       
		<div class="row">
			<h1>This is the Amazon Products page</h1>
			{{$message}}
			@if($list)
			<h2>Click here to <a href="{{ route('amazon-export-orders')}}">Export Data </a></h2> 
				<table id="table" class="table table-striped table-bordered table-hover">
			        <thead>
			            <tr>
			            	<th>Id</th>
			                <th>Amazon OrderID</th>
			                <th>Purchase Date</th>
			                <th class="hidden-480">Order Status</th>
			                <th>Shipping Address </th>
			                <th class="hidden-480">Order Total</th>
			                <th>Payment Method</th>
			                <th>Marketplace Id</th>
			                <th>Buyer Name</th>
			                <th>Email</th>
			                <th>Order Type</th>
			            </tr>
			        </thead>
			        <tbody>

			        <?php $i = 1; ?>
						
						@foreach ($list as $listValue)
							<tr class='clickable-row' data-href="{{ route('amazon-order-info',['id' => $listValue['AmazonOrderID']] )}}">
								<td>{{ $i }}</td>
								<td>{{ $listValue['AmazonOrderID'] }}</td>
								<td>{{ $listValue['PurchaseDate'] }}</td>
								<td>{{ $listValue['OrderStatus'] }}</td>
								<td>{{ $listValue['ShippingAddress'] }}</td>
								<td>{{ $listValue['OrderTotal'] }}</td>
								<td>{{ $listValue['PaymentMethod'] }}</td>
								<td>{{ $listValue['MarketplaceId'] }}</td>
								<td>{{ $listValue['BuyerName'] }}</td>
								<td>{{ $listValue['Email'] }}</td>
								<td>{{ $listValue['OrderType'] }}</td>
							</tr>
						<?php $i++; ?>  
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).attr('data-href');
    });
});
</script>
@endsection