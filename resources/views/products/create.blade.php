@extends('layouts.app');
@section('content')
<form action='/products/store' method='POST'>
{{ csrf_field()}}
<add-product></add-product>
</form>
@endsection
<?php $path = base_path(); ?>
