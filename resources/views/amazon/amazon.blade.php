@extends('layouts.app')
@section('content')
<div class='container'>
<h1>This is the amazon page</h1>

<form class="form-horizontal order-list col-md-8" role="form" method="POST" action="{{ route('order-list') }}">
	{{ csrf_field() }}
	<h3>Get Order List</h3>
	<div class="form-group">
        <label for="time" class="col-md-2 control-label">Set Limit in (hrs)</label>

        <div class="col-md-9">
            <input id="time" type="number" placeholder="100" class="form-control" name="time" required min="1">
        </div>
    </div>
      
    <div class="form-group">
            <label for="shipping" class="col-md-2 control-label">Shipping Status</label>

            <div class="col-md-9">
                <select id="shipping" name="shipping" class="form-control" required>
                	<option value="">Select Shipping Status...</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Unshipped">Unshipped</option>
                    <option value="PartiallyShipped">PartiallyShipped</option>
                    <option value="Canceled">Canceled</option>
                    <option value="Unfulfillable">Unfulfillable</option>
            	</select>
            </div>
        </div>
		<div class="col-md-11">
    	<button type="submit" class="btn btn-primary">Orders</button>                        
    	</div>
</form>                   
<div class="col-md-12">
<a href="{{ URL::to('/amazon/get_report_list')}}"><button>Reports</button></a>


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
</div>
@endsection