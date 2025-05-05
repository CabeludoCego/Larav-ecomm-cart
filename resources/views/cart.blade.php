@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        {{ __('View Cart') }}
                    </div>
                </div>

                <div class="card-body">
					@if (session('cart'))
						<table class="table-striped table-bordered table">
							<thead>
								<tr>
									<th>Product</th>
									<th width="100px">Quantity</th>
									<th>Unit Price</th>
									<th>Total Price</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@php	$total=0;	@endphp
								@foreach (session('cart') as $key => $item)
									@php	
										$total=$total + $item['price']*$item['quantity'];	
									@endphp
								<tr data-id="{{ $key }}">
									<td>
										<div class="row">
											<div class="col-md-2">
												<img src="/storage/usbmouse1.jpeg" alt="mousse.jpg"
												class="img-responsive" width="80px">
											</div>
											<div class="col-md-10">
												<h4 style="margin-left: 1.4em;">{{ $item['name'] }}</h4>
											</div>
										</div>
									</td>
									<td>
										<input type="number" name="quantity" min="1"
										 class="form-control quantity" value={{ $item['quantity'] }}>
										{{-- {{ $item['quantity'] }} --}}
									</td>
									<td>R${{ $item['price'] }}</td>
									<td>R${{ $item['price'] * $item['quantity'] }}</td>
									<td>
										<button class="btn btn-danger">
											<i class="fa fa-trash"></i>
										</button>
									</td>
									
								</tr>
								@endforeach
								<tr>
									<td colspan="6" class="text-end">
										<h3>Total: R$ {{ $total }}</h3>
									</td>
								</tr>
							</tbody>
						</table>

					@endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		$("body").on("change", ".quantity", function(e) {
			// alert();
			var elem = $(this);

			$.ajax({
				url: "{{ route('cart.update') }}",
				method: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					product_id: elem.parents("tr").attr("data-id"),
					quantity: elem.val(),
				},
				success: function (response) {
					console.log(response);
				}
			})
		})
	</script>
@endsection