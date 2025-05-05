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

                    @session('success')
                        <div class="alert alert-success">{{ $value }}</div>
                    @endsession

                    <div class="row">
                        
                    @foreach ($products as $key => $product)
                        <div class="col-md-3">
                            <div class="card">
                                <img src="/storage/usbmouse1.jpeg" alt="mousse.jpg" class="card-img-top p-2">
                                <div class="card-body">
                                    <h4>{{ $product->name }}</h4>
                                    <p>Sobre: {{ $product->description }}</p>
                                    <p>Qtd.: {{ $product->stock }}</p>
                                    <p>R$ {{ $product->price }}</p>
                                    <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
