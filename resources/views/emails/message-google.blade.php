@extends('layout')
@section('title', 'mon email')
@section('content')
<div style="max-width: 320px; margin: 0 auto; padding: 20px; background: #fff;">
	<h3>Message via le SMTP Google :</h3>
	<div>{{ $data['message'] }}</div>
</div>
@endsection