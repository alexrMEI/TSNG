@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-inline lead">
                        Animais de Estimação
                    </div>
                    <div class="d-inline float-right">
                        <a class=" btn btn-primary" href="{{ route('addAnimalForm') }}">Adicionar Animal Estimação</a>
                    </div>
                </div>

                <div class="card-body row d-flex justify-content-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @forelse($animaisArray as $animal)
                        <div class="card col-md-3 mr-1 mb-1">
                            <div class="card-body">
                                <h4 class="font-weight-bold"><a href="{{ route('viewAnimal', $animal->id) }}">{{ $animal->nome }}</a></h4>
                                <p>Raça: {{ $animal->raca }}</p>
                                <p>Idade: {{ $animal->idade }} anos</p>
                                <p>Peso: {{ $animal->peso }} Kg</p>
                            </div>
                        </div>
                    @empty
                        <h4>Sem dados</h4>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
