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
            <br>
            <div class="card">
                <div class="card-header">
                    IP do Sistema
                </div> 
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="{{ route('saveAnimal') }}">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="nome" type="text" name="nome" class="form-control" required autofocus>
                            </div>
                        </div>
                        <div class="float-right">
                            <div class="row form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Criar
                                    </button>
                                </div>
                                <a class="btn btn-secondary" href="{{url()->previous()}}">Voltar</a>
                            </div>
                        </div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection
