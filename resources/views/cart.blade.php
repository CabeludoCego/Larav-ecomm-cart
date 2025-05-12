@extends('layouts.app')

@section('content')
<div class="container">

	<form action="{{ route('order.post') }}" method="POST">
		@csrf

		<div class="row" id="cart-products">
			@include('cartProducts')
		</div>

		<div class="text-end">
			<a href="{{ url('/home') }}" class="btn btn-warning">Continue Shopping</a>
			<button class="btn btn-success">Checkout</button>
		</div>

	</form>
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
					type:"update",
					product_id: elem.parents("tr").attr("data-id"),
					quantity: elem.val(),
				},
				success: function (response) {
					$("#cart-products").html(response.success);
					console.log(response);
				}
			})
		});

		$("body").on("click", ".remove-from-cart", function(e) {
			var elem = $(this);

			$.ajax({
				url: "{{ route('cart.update') }}",
				method: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					type:"delete",
					product_id: elem.parents("tr").attr("data-id"),
				},
				success: function (response) {
					$("#cart-products").html(response.success);
					console.log(response);
				}
			})
		})
	</script>
@endsection