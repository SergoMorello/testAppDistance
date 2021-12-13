@extends('lay.html')

@section('title',config()->APP_NAME)

@section('content')
	@include('inc.menu')
	<div class="container">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Расстояние до</h5>
				<h6 class="card-subtitle mb-2 text-muted">{{config('ADR')}}</h6>
				<p class="card-text">
					{{$distance}} Км
				</p>
			</div>
		</div>
	</div>
@endsection