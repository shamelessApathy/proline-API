<table>
	<thead>
		<tr>
			<th>Id</th>
			<th>Sku</th>
			<th>ASIN</th>
			<th>Name</th>
			<th>Inventory</th>
			<th>Created At</th>
			<th>Last Updated</th>		
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>{{ $product->id }}</td>
			<td>{{ $product->sku }}</td>
			<td>{{ $product->asin }}</td>
			<td>{{ $product->name }}</td>
			<td>{{ $product->inventory }}</td>
			<td>{{ $product->created_at }}</td>
			<td>{{ $product->updated_at }}</td>
		</tr>
	</tbody>
	
</table>