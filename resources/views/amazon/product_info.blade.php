@extends('layouts.app')
@section('content')
<?php


var_dump($response);


?>
<table class='product-info'>
<col style='width:120px'>
<col style='width:75px'>
	<tr>
		<td>Brand</td>
		<td><?php echo $response['Brand'];?></td>
	</tr>
</table>
<?php //var_dump($response[0]->Request); ?>

@endsection