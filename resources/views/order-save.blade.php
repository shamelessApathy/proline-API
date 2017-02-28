@extends('layouts.app')
@section('content')
	<h1>This is the orders page</h1>
	{{$message}}
	<h2>Click here to <a href="{{ URL::to('/amazon/export_order_list')}}">Export Data </a></h2> 
	
@endsection