@extends('layouts.app')
@section('content')
<div class='container'>
<h1>This is the amazon page</h1>


<a href='/amazon/get_order_list'><button>Orders</button></a>
<a href='/amazon/get_report_list'><button>Reports</button></a>


<form action='/amazon/get_report' method="POST">
{{ csrf_field() }}
<input type='text' placeholder='Report ID' name='report-id'>
<button type='submit'>Get Report</button>
</form>
<div class='console'>
<?php 
if (isset($status))
{
	echo $status;
}
?><textarea name='console-input' class='console-input'></textarea></div>
</div>

@endsection