@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $produto->name }}</div>

                <div class="card-body">
                    <fieldset disabled>
                        <div class="mb-3">
                            <label class="form-label">Estoque</label>
                            <input type="number" class="form-control" value="{{ $produto->stock }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Preço</label>
                            <input type="number" class="form-control" value="{{ $produto->price }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <input type="text" class="form-control" value="{{ $produto->description }}">
                        </div>
                    </fieldset>
                    <a href="{{ route('produto.index') }}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
