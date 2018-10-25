@extends('admin_layout')
@section('content')
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>update item</h2>
		</div>
		<p class="alert-success">
			<?php
			$message=Session::get('message');
			if($message)
			{
				echo $message;
				Session::put('message',null);
			}
           ?>
		</p>
			<form class="form-horizontal" action="{{ url('/update-item',$single_item->item_id)}}" method="post" 
			enctype="multipart/form-data">
				{{ csrf_field() }}
			  <fieldset>
				<div class="form-group">
				  <label class="form-label" for="date01">item Name</label>
				  <div class="forms">
					<input type="text" class="input-xlarge" name="item_name" value="{{$single_item->item_name}}" >
				  </div>
				</div>
                <div class="form-group">
					<label class="form-label" for="selectError3">item category</label>
					<div class="forms">
					  <select id="selectError3" name="category_id"> 
                       <?php
                           $all_published_category=DB::table('categories')
                                                  ->get();
                       ?>
                   @foreach($all_published_category as $category){?>  

					<option value="{{ $category->category_id}}">
					 {{$category->category_name}} 				
					</option>	

					@endforeach			
					  </select>
					</div>
				  </div>
				<div class="form-group">
				  <label class="form-label" for="date01">item Price</label>
				  <div class="forms">
					<input type="text" class="input-xlarge" name="item_price" value="{{$single_item->item_price}}">
				  </div>
				</div>
				<div class="form-group">
				  <label class="form-label" for="date01">item quantity</label>
				  <div class="forms">
					<input type="text" class="input-xlarge" name="item_quantity" value="{{$single_item->item_initial_qty}}">
				  </div>
				</div>
				<div class="form-group">
				  <label class="form-label" for="date01">item unit</label>
				  <div class="forms">
					<input type="text" class="input-xlarge" name="item_unit" value="{{$single_item->item_unit}}">
				  </div>
				</div>
                <div class="form-group">
				  <label class="form-label" for="fileInput">Image </label>
				   <img style="height: 80px; width: 80px;" src="{{URL::to($single_item->item_image)}}" ><hr>
				  <div class="forms">
					<input class="input-file uniform_on" name="item_image" id="fileInput" type="file" 
					value="{{$single_item->item_image}}">
				  </div>
				
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">update item </button>
				  <button type="reset" class="btn">Cancel</button>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->
@endsection