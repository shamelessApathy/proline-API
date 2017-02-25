@extends('layouts.app')
@section('content')
	<h1>This is the orders page</h1>
	<h2>Click here to <a href="{{ URL::to('/amazon/export_order_list')}}">Export Data </a></h2> 
	<table id="table" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
            	<th>Id</th>
                <th>Amazon OrderID</th>
                <th>Item Sku</th>
                <th>Product Name</th>
                <th>Quantity Ordered</th>
                <th>Quantity Shipped</th>
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
				<tr>
					<td>{{ $i }}</td>
					<td>{{ $listValue['AmazonOrderID'] }}</td>
					<td>{{ $listValue['ItemSku'] }}</td>
					<td>{{ $listValue['ProductName'] }}</td>
					<td>{{ $listValue['QuantityOrdered'] }}</td>
					<td>{{ $listValue['QuantityShipped'] }}</td>
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
@endsection