@extends('layouts.app')
@section('content')
<div class='container'>
<img src="images/amazon-logo-preview.png"/>
<h4>This is the amazon page</h4>

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

</div>

@endsection