@extends('main')

@section('title', 'Nova Operadora')

@section('content')
<div class="container">
    <div class="py-5 text-center">
        <h2>Nova Operadora</h2>
    </div>
    <form action="{{ route('operator.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <label>Nome da Operadora</label>
                <input type="text" class="form-control" required name="operator">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <a href="{{route('operator.index')}}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </div>
    </form>
</div>
@stop
