@extends('admin_layout')
@section('content')
	<section id="cart_purchases">
		<div class="container col-sm-12">
			<div class="table-responsive cart_info">
					<table class="table table-condensed" style="border-bottom">
							<thead>
								<tr class="cart_menu">
							@foreach($purchases_info as $info)
							   Date &colon; <label class="name">{{$info->purchase_date }}</label>
                               <br>
							   Supplier &colon; <label class="name">{{$info->supplier_name}}</label>
                             <br>
							   Purchase Number &colon; <label class="name">{{$info->purchase_no}}</label>
							   @endforeach
								</tr>
							</thead>
					<a href="{{URL::to('/all-purchase')}}" class="btn btn-success" style="float:right">Back</a>
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
							@foreach($single_purchase as $purchase)
						<tr>
							<td class="cart_product">
                                <h4>{{$purchase->item_name}}</h4>
							</td>
							<td class="cart_description">
								<h4>{{$purchase->item_price}}</h4>
							</td>
							<td class="cart_total">
								<p class="cart_total">{{$purchase->quantity}}</p>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$purchase->item_unit}}</p>
							</td>
							<td class="cart_total">
							<p class="cart_total_price">{{ $totalrow[] = $purchase->item_price * $purchase->quantity}} L.E</p>
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