@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card mt-4">
                <div class="card-header">{{ __('Novo Produto') }}</div>
                <div class="card-body">
                    
                    <form method="POST" action="{{ route('produto.store') }}">
                        @csrf
                        <div class="mb-3">
                          <label class="form-label">Nome</label>
                          <input type="text" class="form-control" name="name">
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Estoque</label>
                          <input type="number" min="0" step="1" class="form-control" name="stock">
                        </div>
						

                        <div class="mb-3">
                          <label class="form-label">Preço</label>
                          <input type="number" min="0" step="0.01" class="form-control" name="price">
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Descrição</label>
                          <input type="text" class="form-control" name="description">
                        </div>

                        <button type="submit" class="btn btn-primary btn-success">Cadastrar</button>
                      </form>


                </div>
            </div>

        </div>


    </div>
</div>
@endsection