@extends('admin_layout')
@section('content')
	<section id="cart_orders">
		<div class="container col-sm-12">
			<div class="table-responsive cart_info">
					<table class="table table-condensed" style="border-bottom">
							<thead>
								<tr class="cart_menu">
							@foreach($orders_info as $info)
							   Date &colon; <input  calss= "form-control" value="{{$info->order_date}}"/>
                               <br>
							   Client &colon; <input calss= "form-control" value="{{$info->client_name}}"/>
                             <br>
							   Order Number &colon; <input calss= "form-control" value="{{$info->order_no}}"/>
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
						</tr>
					</thead>
					<tbody>
							@foreach($single_order as $order)
						<tr>
							<td class="cart_product">
                                <input class="form-control" value="{{$order->item_name}}"/>
							</td>
							<td class="cart_description">
								<input class="form-control" value="{{$order->item_price}}"/>
							</td>
							<td class="cart_total">
								<input class="form-control" value="{{$order->quantity}}"/>
							</td>
							<td class="cart_total">
								<input class="form-control" value="{{$order->item_unit}}"/>
							</td>
							<td class="cart_total">
							<input type="hidden" value"{{ $totalrow[] = $order->item_price * $order->quantity}}"/>
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