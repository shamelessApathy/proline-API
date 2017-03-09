@extends('layouts.app')
@section('content')
<div class='container'>
<h1>This is the Walmart page</h1>


Click here to view orders <a href="{{ route('walmart-orders') }}"><button>Orders</button></a>

<textarea name='console-input' class='console-input'></textarea></div>
</div>

@endsection