@extends('layouts.app')
@section('content')

<div class='container'>
@include('partials.alerts')
<h1>Product Index</h1>
<div class='product-search-container'>
<form name='search' action="/products/search" method='POST'>
{{ csrf_field() }}
<label>Search Proucts</label><br>
<input type='text' name='query'>
<select name='type'>
<option>Search by...</option>
<option name='sku' value='sku'>SKU</option>
</select><br>
<label>Factory<sub>optional</sub></label><br>
<input type='radio' name='factory' value='feishida'>FEISHIDA</option>
<input type='radio' name='factory' value='jilu'>JILU</option>
<br>
<button type='submit'>Search</button>
</form>
</div>
<div class='row'>
	<ul>
		<li><a href='/products/create'>Add Products</a></li>
		<li>Request Info from Vendors</li>
	</ul>
</div>
<div class='row'>
	<table class='product_table'>
	<tr>
		<th>SKU</th>
		<th style='text-align:right;'>Inventory</th>
	</tr>

<?php // echo "<pre>"; print_r($products); ?>
@if ($products->count())
   @foreach ($products as $product)
       <tr>

           <td style='width:130px;' id="sku"><a href="{{ route('product-list', ['id' => $product->asin]) }}"> LIST </a><a href="{{ route('product-info', ['id' => $product->asin]) }}">
           <i class='fa fa-amazon'></i></a> @if($product->walmartID)<div style='display:inline' class="wallmt"><a href="{{ route('walmart-product-info',['id'=> $product->walmartID]) }}"><img width='15px' src="{{asset('images/wallmart.jpg')}}"/> </a></div>@endif <a href="{{ route('product-data', ['id' => $product->id]) }}">{{ $product->sku }}</a></td>

           <td>
               <a class="inventory" href="#">{{ $product->inventory }}</a>
           </td>

           <td class="inventory_change_cell">
               <form action="/products/update" method="POST">
                   {{ csrf_field() }}

                   <input type="hidden" value="{{ $product->sku }}" name="sku">

                   <input type="number" class="inventory_change" name="inventory">

                   <button class="submit_change" type="submit">Change</button>
               </form>

               <div class="clear"></div>
           </td>
       </tr>
   @endforeach
@else
   <p>There are no products matching your criteria.</p>
@endif


@endsection