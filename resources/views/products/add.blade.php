@extends('layouts.app');
@section('content')
<div class='container'>
<h1>add</h1>	
<div class='row'>
<form action='/products/store' method='POST'>
<label>SKU</label><br>
<input type='text' name='sku'><br>
<label>Amount</label><br>
<input type='number' name='inventory'><br>
<button type='submit'>Add Product</button>
{{ csrf_field() }}
</form>
</div>
</div>
@endsection