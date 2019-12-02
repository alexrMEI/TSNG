@extends('layouts.app')

@section('content')
<div class="container">
    <a class="btn btn-secondary float-right" href="{{url()->previous()}}">Voltar</a>
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">
					<div class="lead">
                        {{ $animalClass->nome }}
                    </div>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<label for="raca" class="col-md-12 col-form-label control-label">Raça <strong>{{ $animalClass->raca }}</strong></label>
					</div>
					<div class="form-group row">
						<label for="idade" class="col-md-12 col-form-label control-label">Idade <strong>{{ $animalClass->idade }}</strong></label>
					</div>
					<div class="form-group row">
						<label for="peso" class="col-md-12 col-form-label control-label">Peso <strong>{{ $animalClass->peso }}</strong></label>
					</div>
					<div class="form-group row">
						<label for="tipoAnimal" class="col-md-12 col-form-label control-label">Tipo Animal <strong>{{ $animalClass->tipo_animal }}</strong></label>
					</div>
				</div>
			</div>
			<br>
			<div class="card">
				<div class="card-header">
					<div class="d-inline lead">
                        Doseadores
                    </div>
                    <div class="d-inline float-right">
                        <a class=" btn btn-primary" href="{{ route('addAnimalForm') }}">Adicionar Doseador</a>
                    </div>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<label for="raca" class="col-md-12 col-form-label control-label">Agua</label>
					</div>
					<div class="form-group row">
						<label for="idade" class="col-md-12 col-form-label control-label">Comida</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection