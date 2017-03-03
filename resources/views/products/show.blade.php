<?php //$product = $data['product']; ?>
@extends('layouts.app')
@section('content')
<div class='container'>
<div class='row'>
<h2>Details of <strong>{{ $product->name }}:</strong></h2>
@include('partials.info')
</div>
</div>
@endsection