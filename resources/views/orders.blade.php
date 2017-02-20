@extends('layouts.app')
@section('content')
<h1>This is the orders page</h1>
<?php if (isset($response))
{
	var_dump($response);
}
if (isset($list))
{
	var_dump($list);
}
?>
@endsection