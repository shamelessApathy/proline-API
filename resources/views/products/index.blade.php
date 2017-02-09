@extends('layouts.app')
@section('content')
<div class='container'>
@include('partials.alerts')
<h1>Product Index</h1>
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


@if ($products->count())
   @foreach ($products as $product)
       <tr>
           <td id="sku"><a href="/products/<?php echo $product->id;?>">{{ $product->sku }}</a></td>

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