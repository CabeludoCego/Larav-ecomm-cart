@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"> 		
					
					<a class="btn btn-outline-secondary" role="button" href="{{ route('produto.create') }}" >
						Novo Produto...
					</a>
					<a class="btn btn-outline-secondary" role="button" href="{{ route('produto.create') }}" >
						Add to Cart
					</a>
					<a class="btn btn-outline-secondary" role="button" href="{{ route('produto.create') }}" >
						View Cart
					</a>
				</div>

                <div class="card-body">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th scope="col">ID</th>
											<th scope="col">Produto</th>
											<th scope="col">Estoque</th>
											<th scope="col">Preço</th>
											<th scope="col">Descrição</th>
											<th scope="col">Editar</th>
											<th scope="col">Remover</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($produtos as $produto)
											<tr>
												<th scope="row">{{ $produto['id'] }}</th>
												<td>{{ $produto['name'] }}</td>
												<td>{{ $produto['stock'] }}</td>
												<td>{{ number_format($produto['price'], 2, '.', ',') }}</td>
												<td>{{ $produto['description'] }}</td>
												<td>
													<a href="{{ route('produto.edit', $produto['id']) }}" >
														<img src="{{ asset('storage/icons/editIcon_000.svg') }}">
													</a>
												</td>
												<td>
													<form id="form_{{ $produto['id'] }}" method="post"
														action="{{ route('produto.destroy', ['produto' => $produto->id]) }}" 
														>
														@method('DELETE')
														@csrf
													</form>
													<a href="#" onclick="document.getElementById('form_{{ $produto['id'] }}').submit()">
														<img src="{{ asset('storage/icons/deleteIcon.svg') }}">
													</a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>

								<nav>
									<ul class="pagination">
											<li class="page-item"><a class="page-link" href="{{ $produtos->previousPageUrl() }}">Voltar</a></li>

											@for($i = 1; $i <= $produtos->lastPage(); $i++)
													<li class="page-item {{ $produtos->currentPage() == $i ? 'active' : '' }}">
															<a class="page-link" href="{{ $produtos->url($i) }}">{{ $i }}</a>
													</li>
											@endfor
											
											<li class="page-item"><a class="page-link" href="{{ $produtos->nextPageUrl() }}">Avançar</a></li>
									</ul>
							</nav>
						</div>
            </div>
        </div>
    </div>
</div>

@endsection