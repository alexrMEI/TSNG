@extends('layouts.app')

@section('content')
<div class="container">
    <a class="btn btn-secondary float-right" href="{{ route('home') }}">Voltar</a>
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
						<label for="raca" class="col-md-12 col-form-label control-label">Raça: <strong>{{ $animalClass->raca }}</strong></label>
					</div>
					<div class="form-group row">
						<label for="idade" class="col-md-12 col-form-label control-label">Idade: <strong>{{ $animalClass->idade }}</strong></label>
					</div>
					<div class="form-group row">
						<label for="peso" class="col-md-12 col-form-label control-label">Peso: <strong>{{ $animalClass->peso }}</strong></label>
					</div>
					<div class="form-group row">
						<label for="tipoAnimal" class="col-md-12 col-form-label control-label">Tipo Animal: <strong>{{ $animalClass->tipo_animal }}</strong></label>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-6">
					<div class="card h-100">
						<div class="card-header">
							<div class="d-inline lead">
		                        Água
		                    </div>
		                    <div class="d-inline float-right">
		                        <button class=" btn btn-primary" data-toggle="modal" data-target="#aguaModal">Adicionar</button>
		                    </div>
						</div>
						<div class="card-body">
							<div class="form-group row col-form-label control-label">
								<div>
									@if($doseadorAguaAnimal)
										@if($doseadorAguaAnimal->vazio)
											<label class="col-md-12 text-danger font-weight-bold">Não tem àgua!</label>
										@else
											<label class="col-md-12 texts-success font-weight-bold">Abastecido</label>
										@endif

										<label class="col-md-12">Temperatura: {{ $doseadorAguaAnimal->temperatura }}</label>

										<label class="col-md-12">Quantidade: </label>
									@else
										<label class="col-md-12">Não tem doseador...</label>
									@endif
								</div>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card h-100">
						<div class="card-header">
							<div class="d-inline lead">
		                        Comida
		                    </div>
		                    <div class="d-inline float-right">
		                        <button class=" btn btn-primary" data-toggle="modal" data-target="#comidaModal">Adicionar</button>
		                    </div>
						</div>
						<div class="card-body">
							<div class="form-group row col-form-label control-label">
								<div >
									@if($doseadorComidaAnimal)
										@if($doseadorComidaAnimal->vazio)
											<label class="col-md-12 text-danger font-weight-bold">Não tem comida!</label>
										@else
											<label class="col-md-12 texts-success font-weight-bold">Abastecido</label>
										@endif

										<label class="col-md-12">Quantidade: </label>
									@else
										<label class="col-md-12">Não tem doseador...</label>
									@endif
								</div>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- AGUA Modal -->
<div class="modal fade" id="aguaModal" tabindex="-1" role="dialog" aria-labelledby="aguaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aguaModalLabel">Adicionar Doseador de Água</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row">
        @forelse($doseadoresAgua as $animal)
	      	<a href="{{ route('updateDoseadorAgua', [$animalClass->id, $animal->doseador_agua_id]) }}" class="btn btn-primary align-middle m-1" style="width: 100px; height: 85px;">
	            O mesmo que
	            <br/>
	            {{ $animal->nome }}
	        </a>
	        @empty
	      	@endforelse
	      	<a href="{{ route('addDoseadorAgua', $animalClass->id) }}" class="btn btn-primary align-middle m-1 pt-4" style=" width: 100px; height: 85px;">
	            NOVO
	        </a>
      	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- COMIDA Modal -->
<div class="modal fade" id="comidaModal" tabindex="-1" role="dialog" aria-labelledby="comidaModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
	      	<div class="modal-header">
		        <h5 class="modal-title" id="comidaModalLabel">Adicionar Doseador de Comida</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<div class="modal-body row">
		      	@forelse($doseadoresComida as $animal)
		      	<a href="#" class="btn btn-primary align-middle m-1" style="width: 100px; height: 85px;">
		            O mesmo que
		            <br/>
		            {{ $animal->nome }}
		        </a>
		        @empty
		      	@endforelse
		      	<a href="{{ route('addDoseadorComida', $animalClass->id) }}" class="btn btn-primary align-middle m-1 pt-4" style="width: 100px; height: 85px;">
		            NOVO
		        </a>
	  		</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      	</div>
	    </div>
	</div>
</div>
@endsection