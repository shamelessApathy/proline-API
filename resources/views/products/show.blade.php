<?php //$product = $data['product']; ?>
@extends('layouts.app')
@section('content')
<?php var_dump($product);?>
<?php echo "<br><br>"; ?>
<?php var_dump($data); ?>
<ul>
<?php foreach ($data[0] as $info): ?>
	<li><?php print_r($info);?></li>
<?php endforeach; ?>
@endsection