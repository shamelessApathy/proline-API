@extends('layouts.app')
@section('content')
<div class="container">
	<div class="col-md-12">   
		<div class="row">
			<h1>This is the Feed Result page</h1>
			<b>{{$message}}</b>
			@if($feed_list)
				<div class="container">
					<?php echo $feed_list; ?>
				</div>
			@endif
		</div>
	</div>
</div>
@endsection