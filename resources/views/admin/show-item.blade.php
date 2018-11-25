@extends('admin_layout')
@section('content')
	<section id="cart_items">
		<div class="container col-sm-12">
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Name</td>
							<td class="description">Code</td>
							<td class="price">Price</td>
							<td class="price">Unit</td>
							<td class="price">Equal To</td>
							<td class="price">Part Unit</td>
						    <td class="quantity">category</td> 
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to($single_item->item_image)}}" height="200px" width="200px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4>{{$single_item->item_name}}</h4>
								
							</td>
							<td class="cart_description">
									<h4>{{$single_item->code}}</h4>
									
								</td>
							<td class="cart_price">
								<p>{{$single_item->item_price}}</p>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$single_item->BaseUnit}}</p>
							</td>
							<td class="cart_total">
									<p class="cart_total_price">{{$single_item->to_unit}}</p>
								</td>
								<td class="cart_total">
										<p class="cart_total_price">{{$single_item->PartUnit}}</p>
									</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$single_item->category_name}}</p>
							</td> 
						
						</tr>
            
					</tbody>
				</table>
			</div>
		</div>
	</section>
@endsection