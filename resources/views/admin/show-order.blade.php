@extends('admin_layout')
@section('content')
	<section id="cart_orders">
		<div class="container col-sm-12">
			<div class="table-responsive cart_info">
					<table class="table table-condensed" style="border-bottom">
							<thead>
								<tr class="cart_menu">
							@foreach($orders_info as $info)
							   Date &colon; <label class="name">{{$info->order_date }}</label>
                               <br>
							   Client &colon; <label class="name">{{$info->client_name}}</label>
                             <br>
							   Order Number &colon; <label class="name">{{$info->order_no}}</label>
							   @endforeach
								</tr>
							</thead>
						</table>
					<hr>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="name"><b>Item Name</b></td>
							<td class="price"><b>Price</b></td>
							<td class="price"><b>Quantity<b></td>
							<td class="price"><b>Unit<b></td>
							<td class="price"><b>Total<b></td>
						</tr>
					</thead>
					<tbody>
							@foreach($single_order as $order)
						<tr>
							<td class="cart_product">
                                <h4>{{$order->item_name}}</h4>
							</td>
							<td class="cart_description">
								<h4>{{$order->item_price}}</h4>
							</td>
							<td class="cart_total">
								<p class="cart_total">{{$order->quantity}}</p>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$order->item_unit}}</p>
							</td>
							<td class="cart_total">
							<p class="cart_total_price">{{ $totalrow[] = $order->item_price * $order->quantity}} L.E</p>
								</td>
						</tr>

					</tbody>
					@endforeach
				</table>
			</div>
			<hr><?php
			$size = count($totalrow);
			$total = 0;
            for($i=0;$i<$size;$i++){
				$total = $total+$totalrow[$i];
			}
			?>
			 <b style="float:right">Total Price &colon; {{$total}} L.E</b>
		</div>
	</section>
@endsection