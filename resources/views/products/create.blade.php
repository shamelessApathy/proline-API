@extends('layouts.app');
@section('content')
<div class='container'>
<h1>add</h1>	
<div class='row'>
<form action='/products/store' method='POST'>
<label>SKU</label><br>
<input type='text' name='sku'><br>

<label>Category</label><br>
<select name='category'>
	<option value='1'>Wall</option>
	<option value='2'>Under Cabinet</option>
	<option value='3'>Outdoor</option>
	<option value='6'>Professional</option>
	<option value='4'>Island</option>
	<option value='7'>Artisan</option>
	<option value='5'>Inserts</option>
	<option value='8'>Accessories</option>
</select>

<label>Amount</label><br>
<input type='number' name='inventory'><br>

<label>Product Name</label><br>
<input type='text' name='name'><br>

<label>Default Image</label><br>
<input type='text' name='image_path'><br>

<label>Spec Sheet</label><br>
<input type='text' name='spec_sheet_path'><br><br>

<label>Optional Attributes</label>&nbsp&nbsp<input type='checkbox' name='optional_attributes'><br>

<button type='submit'>Add Product</button>
{{ csrf_field() }}
</form>
</div>
</div>
@endsection
<?php $path = base_path(); ?>
<script src="/js/add_product.js"></script>