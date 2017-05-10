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
			                <th>Report Request Id</th>
			                <th>Report Type</th>
			                <th class="hidden-480">Start Date</th>
			                <th>EndDate</th>
			                <th class="hidden-480">Scheduled</th>
			                <th>Submitted Date</th>
			                <th>Report Processing Status</th>
			                <th>Generated ReportId</th>
			                <th>Started Processing Date</th>
			                <th>Completed Date</th>
			            </tr>
			        </thead>
			        <tbody>

			        <?php $i = 1; ?>
						
						@foreach ($list as $listValue)
							<tr class='clickable-row' data-href="{{ route('amazon-get-report-info',['id' => $listValue['ReportRequestId']] )}}">
								<td>{{ $i }}</td>
								<td>{{ $listValue['ReportRequestId'] }}</td>
								<td>{{ $listValue['ReportType'] }}</td>
								<td>{{ $listValue['StartDate'] }}</td>
								<td>{{ $listValue['EndDate'] }}</td>
								<td>{{ $listValue['Scheduled'] }}</td>
								<td>{{ $listValue['SubmittedDate'] }}</td>
								<td>{{ $listValue['ReportProcessingStatus'] }}</td>
								<td>{{ $listValue['GeneratedReportId'] }}</td>
								<td>{{ $listValue['StartedProcessingDate'] }}</td>
								<td>{{ $listValue['CompletedDate'] }}</td>
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
	// jQuery(document).ready(function($) {
 //    $(".clickable-row").click(function() {
 //        window.location = $(this).attr('data-href');
 //    });
//});
</script>
@endsection