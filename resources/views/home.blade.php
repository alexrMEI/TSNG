@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Animais de Estimação</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @forelse($animaisArray as $animal)
                        <div class="card w-25">
                            <div class="card-body">
                                <h4 class="font-weight-bold">{{ $animal->nome }}</h4>
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
