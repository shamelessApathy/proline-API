@extends('layouts.app')
@section('content')
<?php


/*foreach ($response['Request'] as $key => $value)
{
	echo $key . ' = ' . $value . '<br>';
}*/
var_dump($response);


?>
<table class='product-info'>
<col style='width:100px'>
<col style='width:75px'>
	<tr>
		<td>Brand</td>
		<td><?php echo $response['Brand'];?></td>
	</tr>
</table>
<?php //var_dump($response[0]->Request); ?>

@endsection