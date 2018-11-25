@extends('admin_layout')
@section('content')
	<section id="cart_clients">
		<div class="container col-sm-12">
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Supplier Name</td>
							<td class="image">Supplier Code</td>
							<td class="price">Description</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="cart_description">
								<h4>{{$single_supplier->supplier_name}}</h4>
							</td>
							<td class="cart_description">
									<h4>{{$single_supplier->code}}</h4>
								</td>
							<td class="cart_price">
								<p>{{$single_supplier->supplier_description}}</p>
							</td>
						</tr>
            
					</tbody>
				</table>
			</div>
		</div>
	</section>
@endsection