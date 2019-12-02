@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Adicionar Animal Estimação
				</div>
				<div class="card-body">
					<form class="form-horizontal" method="post" action="{{ route('saveAnimal') }}">
						{{ method_field('POST') }}
	                    {{ csrf_field() }}
						<div class="form-group row">
							<label for="nome" class="col-md-4 col-form-label control-label text-right">Nome</label>
							<div class="col-md-6">
								<input id="nome" type="text" name="nome" class="form-control" required autofocus>
							</div>
						</div>
						<div class="form-group row">
							<label for="raca" class="col-md-4 col-form-label control-label text-right">Raça</label>
							<div class="col-md-6">
								<input id="raca" type="text" name="raca" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<label for="idade" class="col-md-4 col-form-label control-label text-right">Idade</label>
							<div class="col-md-6">
								<input id="idade" type="text" name="idade" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<label for="peso" class="col-md-4 col-form-label control-label text-right">Peso</label>
							<div class="col-md-6">
								<input id="peso" type="text" name="peso" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<label for="tipoAnimal" class="col-md-4 col-form-label control-label text-right">Tipo Animal</label>
							<select id="tipoAnimal" name="tipoAnimal" class="form-control col-md-6">
								<option value="">Selecione uma opção</option>
								<option value="cao">Cão</option>
								<option value="gato">Gato</option>
								<option value="outro">Outro</option>
							</select>
						</div>
						<div class="row float-right">
							<div class="form-group">
	                            <div class="col-md-6 col-md-offset-4">
	                                <button type="submit" class="btn btn-primary">
	                                    Criar
	                                </button>
	                            </div>
	                        </div>
	                        <a class="btn btn-default" href="{{url()->previous()}}">Voltar</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection