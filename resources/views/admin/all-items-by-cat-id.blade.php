@extends('admin_layout')
@section('content')
	<section id="cart_items">
		<div class="container col-sm-12">
			<div class="table-responsive cart_info">
					@if(count( $all_items)>0) 
				<table class="table table-condensed">
						<a class="btn btn-warning" href={{URL::to('move-item-by-cat/'.$all_items[0]->category_id)}}>Move All</a> 
						<br><br>
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="price">Quantity</td>
							<td class="price">Unit</td>
						    <td class="quantity"> Parent category</td> 
						</tr>
					</thead>
					<tbody>
							@foreach( $all_items as $item)
						<tr>
							<td class="cart_product">
							<img src="{{URL::to($item->item_image)}}" height="200px" width="200px" alt="">
							</td>
							<td class="cart_description">
								<h4>{{$item->item_name}}</h4>
								
							</td>
							<td class="cart_price">
								<p>{{$item->item_price}}</p>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$item->item_initial_qty}}</p>
							</td><td class="cart_total">
								<p class="cart_total_price">{{$item->item_unit}}</p>
							</td>
							
							<td class="cart_total">
								<p class="cart_total_price">{{$item->category_name}}</p>
							</td> 
						
						</tr>
						@endforeach
					</tbody>
				</table>
				@else 
				<div class="box span12">
					  <div class="box-header" data-original-title>
						  <h2><i class="halflings-icon edit"></i><span class="break"></span>There is no  items found  </h2>
					  </div>         
			  </div>
			  @endif
			</div>
		</div>
	</section>
@endsection