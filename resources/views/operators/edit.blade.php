@extends('main')

@section('title', 'Editar Operadora')

@section('content')
<div class="container">
    <div class="py-5 text-center">
        <h2>{{ $operator->name }}</h2>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <form method="post" action="{{ route('operator.update', ['operator' => $operator->id]) }}" class="form-inline">
            @csrf
            {{ method_field('PUT') }}
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" name="name" value="{{ $operator->name }}">
            </div>
            <button type="submit" class="btn btn-success mb-2">Renomear</button>

        </form>
    </div>
    <div class="row">
        <div class="table-title" style="margin: 1.5rem 0 0 0">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Tarifas</h2>
                </div>
                <div class="col-sm-6">
                    <a href="#addFareModal" class="btn btn-success" data-toggle="modal"><i
                            class="material-icons">&#xE147;</i> <span>Nova Tarifa</span></a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Tarifa</th>
                    <th style="text-align: center">Status</th>
                    <th style="text-align: center">Validade</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($operator->fares as $fare)
                <tr>
                    <td>R$@convert($fare->value)</td>
                    <td align="center">
                        @if($fare->active)
                        <span class="badge badge-success">Ativa</span>
                        @else
                        <span class="badge badge-danger">Inativa</span>
                        @endif
                    </td>
                    <td align="center">{{ $fare->created_at->addMonths(6)->format('d/m/Y') }}</td>
                    <td align="right">
                        <a href={{ route('update-status', ['fare' => $fare->id]) }}">
                            @if($fare->active)
                            <button class="btn btn-danger">Desativar</button>
                            @else
                            <button class="btn btn-success">Ativar</button>
                            @endif
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <a href="{{route('operator.index')}}" class="btn btn-danger">Voltar</a>
        </div>
    </div>
</div>
<!-- Add Operator Modal HTML -->
<div id="addFareModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('fare.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Nova tarifa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Valor</label>
                        <input type="number" step="0.01" name="value" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status" value="true" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Ativa
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status" value="false">
                            <label class="form-check-label" for="exampleRadios2">
                                Inativa
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="operator_id" value="{{ $operator->id }}">
                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Add">
                </div>
            </form>
        </div>
    </div>
</div>
@stop
