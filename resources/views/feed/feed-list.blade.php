@extends('layouts.app')
@section('content')
<div class="container">
	<div class="col-md-12">
		<a href="{{ route('amazon-data') }}" class="btn btn-primary">Back</a>       
		<div class="row">
			<h1>This is Feed page</h1>
			{{$message}}
			@if($feed_list)
			<!-- <h2>Click here to <a href="{{ route('amazon-export-orders')}}">Export Data </a></h2>  -->
				<table id="table" class="table table-striped table-bordered table-hover">
			        <thead>
			            <tr>
			            	<th>Id</th>
			                <th>Feed Submission Id</th>
			                <th>Feed Type</th>
			                <th class="hidden-480">Submitted Date</th>
			                <th>Feed Processing Status</th>
			                <th class="hidden-480">Started Processing Date</th>
			                <th>Completed Processing Date</th>
			            </tr>
			        </thead>
			        <tbody>

			        <?php $i = 1; ?>
						
						@foreach ($feed_list as $listValue)
							<tr class='clickable-row' data-href="">
								<td>{{ $i }}</td>
								<td>{{ $listValue['FeedSubmissionId'] }}</td>
								<td>{{ $listValue['FeedType'] }}</td>
								<td>{{ $listValue['SubmittedDate'] }}</td>
								<td>{{ $listValue['FeedProcessingStatus'] }}</td>
								<td>{{ $listValue['StartedProcessingDate'] }}</td>
								<td>{{ $listValue['CompletedProcessingDate'] }}</td>
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