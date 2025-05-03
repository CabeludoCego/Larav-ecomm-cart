@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card mt-4">
                <div class="card-header">{{ __('Editar Produto') }}</div>
                <div class="card-body">
                    
                    <form method="POST" action="{{ route('produto.update', ['produto' => $produto->id] )}}">
                        @csrf
						            @method('PUT')
                        <div class="mb-3">
                          <label class="form-label">Tarefa</label>
                          <input type="text" class="form-control" name="name" value="{{ $produto->name }}">
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Estoque</label>
                          <input type="number" min="0" step="1" class="form-control" name="stock" value="{{ $produto->stock }}">
                        </div>
						

                        <div class="mb-3">
                          <label class="form-label">Preço</label>
                          <input type="number" min="0" step="0.01" class="form-control" name="price" value="{{ $produto->price }}">
                        </div>

                          <div class="mb-3">
                          <label class="form-label">Descrição</label>
                          <input type="text" class="form-control" name="description" value="{{ $produto->description }}">
                        </div>

                        <button type="submit" class="btn btn-primary btn-success">Atualizar</button>
                      </form>


                </div>
            </div>

        </div>


    </div>
</div>
@endsection