@extends('admin_layout')
@section('content')
	<section id="cart_items">
		<div class="container col-sm-12">
			<div class="table-responsive cart_info">
					@if(count( $all_items)>0) 
				<table class="table table-condensed">
						<a class="btn btn-warning" href={{URL::to('move-item-by-cat/'.$all_items[0]->category_id)}}>Move All</a> 
						<button class="btn btn-danger" data-categoryid ={{$all_items[0]->category_id}} data-toggle="modal" data-target="#deleteAll" style="float:right">Delete All</button> 
						<div class="modal modal-fade" id="deleteAll" role="dialog" tabindex="-1"  aria-labelledby="myModalLabel" >
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel">Delete item</h4>
										</div>
									<form action="{{URL::to('/delete-item-by-cat')}}">
									  {{method_field('delete')}}
									  {{csrf_field()}}
									  <div class="modal-body">
											are you sure you want to delete All items?
											<input type="hidden" name="category_id" id="cats_id" value="">
									</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">No,Close</button>
										<button type="submit" class="btn btn-danger"> yes, Delete</button>
										</div>
										</form>
									</div>
								</div>
							</div>
						<br><br>
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="price">Quantity</td>
							<td class="price">Unit</td>
							<td class="quantity"> Parent category</td>
							<td class="quantity"> Action</td> 
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
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$item->item_unit}}</p>
							</td>
							<td class="cart_total">
									<p class="cart_total_price">{{$item->category_name}}</p>
								</td>
							<td class="center">
							<a class="btn btn-primary" href="{{URL::to('/edit-item/'.$item->item_id)}}">
								Move
							</a>
							<button class="btn btn-danger" data-itemid={{$item->item_id}} data-toggle="modal" data-target="#delete">Delete</button>             
							<div class="modal modal-fade" id="delete" role="dialog" tabindex="-1"  aria-labelledby="myModalLabel" >
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title" id="myModalLabel">Delete item</h4>
											</div>
										  
										<form action="{{URL::to('/delete-item')}}">
										  {{method_field('delete')}}
										  {{csrf_field()}}
										 
										  <div class="modal-body">
												are you sure you want to delete this?
												<input type="hidden" name="item_id" id="itm_id" value="">
										</div>
									  
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">No,Close</button>
											<button type="submit" class="btn btn-danger"> yes, Delete</button>
											</div>
											</form>
											
										</div>
									</div>
								</div>
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
	<script>
            $(document).ready(function(){  
                 $('#delete').on('show.bs.modal', function (event) {
                 var button = $(event.relatedTarget) 
                 var item_id = button.data('itemid') 
                 var modal = $(this)
                 modal.find('.modal-body #itm_id').val(item_id);
           })
		   $('#deleteAll').on('show.bs.modal', function (event) {
                 var button = $(event.relatedTarget) 
                 var category_id = button.data('categoryid') 
                 var modal = $(this)
                 modal.find('.modal-body #cats_id').val(category_id);
           })
           });
                </script>
@endsection