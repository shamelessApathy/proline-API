@extends('layouts.app')
@section('content')
<div class="container">
	<div class="col-md-12">   
		<div class="row">
			<h1>This is the order Details page</h1>
			<b>{{$message}}</b>
			@if($list)
				<table id="table" class="table table-striped table-bordered table-hover top-buffer">
			        <tbody>
				        @foreach ($list as $key => $listValue) 
				        	<tr>
				        		<th>{{$key}}</th>
				        		<td>{{$listValue}}</td>
				        	</tr>
						@endforeach	
					</tbody>
				</table>
			@endif
		</div>
	</div>
</div>
@endsection