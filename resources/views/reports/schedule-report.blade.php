@extends('layouts.app')
@section('content')
<div class="container">
	<div class="col-md-12">
		<a href="{{ route('amazon-data') }}" class="btn btn-primary">Back</a>       
		<div class="row">
			<h1>This is the orders page</h1>
			{{$message}}
			@if($list)
			<!-- <h2>Click here to <a href="{{ route('amazon-export-orders')}}">Export Data </a></h2>  -->
				<table id="table" class="table table-striped table-bordered table-hover">
			        <thead>
			            <tr>
			            	<th>Id</th>
			                <th>Report Type</th>
			                <th class="hidden-480">Schedule</th>
			                <th>ScheduledDate</th>
			            </tr>
			        </thead>
			        <tbody>

			        <?php $i = 1; ?>
						
						@foreach ($list as $listValue)
							<tr class='clickable-row'>
								<td>{{ $i }}</td>
								<td>{{ $listValue['ReportType'] }}</td>
								<td>{{ $listValue['Schedule'] }}</td>
								<td>{{ $listValue['ScheduledDate'] }}</td>
							</tr>
						<?php $i++; ?>  
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
	</div>
</div>
<script type="text/javascript">
// 	jQuery(document).ready(function($) {
//     $(".clickable-row").click(function() {
//         window.location = $(this).attr('data-href');
//     });
// });
</script>
@endsection