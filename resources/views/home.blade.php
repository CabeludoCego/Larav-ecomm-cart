@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        {{ __('Dashboard') }}
                    </div>
                    @auth
                        <div class="row mt-2 flex">
                                <div class="col-6 d-flex justify-content-center align-items-center">
                                    <a class="btn btn-outline-primary" role="button" href="{{ route('produto.index') }}" >
                                        Ver Produtos
                                    </a>
                                </div>
                                <div class="col-6 d-flex align-items-center justify-content-center">
                                    <a class="btn btn-outline-primary" role="button" href="{{ route('produto.create') }}" >
                                        Novo Produto
                                    </a>
                                </div>
                        </div>
                    @endauth
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
