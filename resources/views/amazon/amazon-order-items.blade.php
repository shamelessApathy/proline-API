@extends('layouts.app')
@section('content')
<div class="container">
	<div class="col-md-12">
	<a href="{{ route('amazon-data') }}" class="btn btn-primary">Back</a>       
		<div class="row">
			<h1>This is the orders page</h1>
			{{$message}}
			@if($list)
			<h2>Click here to <a href="{{ route('amazon-export-orders')}}">Export Data </a></h2> 
				<table id="table" class="table table-striped table-bordered table-hover">
			        <thead>
			            <tr>
			            	<th>Id</th>
			                <th>Amazon OrderID</th>
			                <th>ASIN</th>
			                <th>Item Sku</th>
			                <th>Order Item Id</th>
			                <th>Product Name</th>
			                <th>Quantity Ordered</th>
			                <th>Quantity Shipped</th>
			                <th>Item Condition</th>
			                <th>Item Price</th>
			            </tr>
			        </thead>
			        <tbody>

			        <?php $i = 1; ?>
						
						@foreach ($list as $listValue)
							<tr>
								<td>{{ $i }}</td>
								<td>{{ $listValue['AmazonOrderID'] }}</td>
								<td>{{ $listValue['ASIN'] }}</td>
								<td>{{ $listValue['ItemSku'] }}</td>
								<td>{{ $listValue['OrderItemId'] }}</td>
								<td>{{ $listValue['ProductName'] }}</td>
								<td>{{ $listValue['QuantityOrdered'] }}</td>
								<td>{{ $listValue['QuantityShipped'] }}</td>
								<td>{{ $listValue['ConditionId'] }}</td>
								<td>{{ $listValue['CurrencyCode'] }} {{ $listValue['ItemPrice'] }}</td>
							</tr>
						<?php $i++; ?>  
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
	</div>
</div>
@endsection