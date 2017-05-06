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
			                <th>Report Id</th>
			                <th>Report Type</th>
			                <th class="hidden-480">Report Request Id</th>
			                <th>Available Date </th>
			                <th class="hidden-480">Acknowledged</th>
			            </tr>
			        </thead>
			        <tbody>

			        <?php $i = 1; ?>
						
						@foreach ($list as $listValue)
							<tr class='clickable-row' data-href="{{ route('amazon-get-report-info',['id' => $listValue['ReportId']] )}}">
								<td>{{ $i }}</td>
								<td>{{ $listValue['ReportId'] }}</td>
								<td>{{ $listValue['ReportType'] }}</td>
								<td>{{ $listValue['ReportRequestId'] }}</td>
								<td>{{ $listValue['AvailableDate'] }}</td>
								<td>{{ $listValue['Acknowledged'] }}</td>
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
	jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).attr('data-href');
    });
});
</script>
@endsection