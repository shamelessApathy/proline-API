@extends('layouts.app')
@section('content')
<h3>getting here!</h3>
<theexample></theexample>
<passport-clients id='client'></passport-clients>
<passport-authorized-clients id='client'></passport-authorized-clients>
<passport-personal-access-tokens id='client'></passport-personal-access-tokens>
@endsection 
<script src='/js/jquery.js'></script>
<script src='/js/token.js'></script> 