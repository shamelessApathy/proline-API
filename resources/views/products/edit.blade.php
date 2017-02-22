@extends('layouts.add')
<h1> Product Edit Page</h1>
<form action='/products/add'>
	<label>SKU</label><input type='text' name='sku'>
	<label>Amount</label><input type='number' name='amount'>
	<button type='submit'>Add Product</button>

</form>