@extends('lay.html')

@section('title',config()->APP_NAME)

@section('content')
	@include('inc.menu')
	<div class="container">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">{{config()->APP_NAME}}</h5>
				<h6 class="card-subtitle mb-2 text-muted">Тестовое задание</h6>
				<form action="{{route('submit')}}" method="POST" id="getDistance">
					<p class="card-text">
						<div class="mb-3 row">
							<label for="adr" class="col-sm-2 col-form-label">Ваш адрес</label>
							<div class="col-sm-10">
								<input type="text" class="form-control autocompleteJs" name="adr" id="adr">
								<input type="hidden" id="adr_lat" name="adr_lat" value="0">
								<input type="hidden" id="adr_lon" name="adr_lon" value="0">
							</div>
						</div>
						<div class="mb-3 row">
							<label for="adr" class="col-sm-2 col-form-label">Адрес назначения</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="{{config('ADR')}}" disabled>
								</div>
						</div>
						<button type="submit" class="btn btn-primary">
							<span class="spinner-border spinner-border-sm" id="spinner" style="display: none;" role="status" aria-hidden="true"></span>
							Расчитать
						</button>
					</p>
				</form>
			</div>
		</div>
	</div>
@endsection