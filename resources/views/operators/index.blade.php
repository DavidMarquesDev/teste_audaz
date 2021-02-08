@extends('main')

@section('title', 'Operadoras')

@section('content')
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Operadoras</h2>
                </div>
                <div class="col-sm-6">
                    <a href="{{route('operator.create')}}" class="btn btn-success"><i
                            class="material-icons">&#xE147;</i> <span>Adicionar Operadora</span></a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Operadora</th>
                    <th>Tarifas</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($operators as $operator)
                <tr>
                    <td>{{ $operator->id }}</td>
                    <td><a href="{{route('operator.edit', ['operator' =>$operator->id])}}">{{ $operator->name }}</a></td>
                    <td>{{ $operator->fares->count() }}</td>
                    <td>
                        <a href="{{route('operator.edit', ['operator' =>$operator->id])}}" class="edit"><i
                                class="material-icons" title="Edit">&#xE254;</i></a>
                        <form action="{{route('operator.destroy',['operator' =>$operator->id])}}" method="post"
                            style="display: inline">
                            @csrf
                            @method('delete')
                            <a href="#" onclick="this.closest('form').submit();return false;" class="delete"><i
                                    class="material-icons">&#xE872;</i></a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
