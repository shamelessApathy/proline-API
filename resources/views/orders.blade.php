@extends('layouts.app')
@section('content')
	<h1>This is the orders page</h1>
	<h2>Click here to <a href="{{ URL::to('/amazon/export_order_list')}}">Export Data </a></h2> 
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
			@foreach ($list as $list_data)
				<?php $address=$list_data->getShippingAddress(); ?>
				<?php $amount=$list_data->getOrderTotal(); ?>
				<tr>
					<td>{{ $i }}</td>
					<td>{{ $list_data->getAmazonOrderId() }}</td>
					<td>{{ $list_data->getPurchaseDate() }}</td>
					<td>{{ $list_data->getOrderStatus() }}</td>
					<td> {{ $address['Name'] }}</br>
						{{ $address['AddressLine1'] }},{{ $address['City'] }},{{ $address['StateOrRegion'] }} </br>
						{{ $address['PostalCode'] }} {{ $address['CountryCode'] }} </br>
						{{ $address['Phone'] }} </td>
					<td>{{ $amount['Amount'] }} {{ $amount['CurrencyCode'] }} </td>
					<td>{{ $list_data->getPaymentMethod() }}</td>
					<td>{{ $list_data->getMarketplaceId() }}</td>
					<td>{{ $list_data->getBuyerName() }}</td>
					<td>{{ $list_data->getBuyerEmail() }}</td>
					<td>{{ $list_data->getOrderType() }}</td>
				</tr>
			<?php $i++; ?>  
			@endforeach
		</tbody>
	</table>
@endsection