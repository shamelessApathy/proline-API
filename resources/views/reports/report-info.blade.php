@extends('layouts.app')
@section('content')
<div class="container">
	<div class="col-md-12">   
		<div class="row">
			<h1>This is the order Details page</h1>
			<b>{{$message}}</b>
			@if($list_report)
				<div class="container">
					<?php echo $list_report; ?>
				</div>
			@endif
		</div>
	</div>
</div>
@endsection