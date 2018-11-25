@extends('admin_layout')
@section('content')
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			  @if(Session::has('danger'))
            <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
								@endif
							
			<h2><i class="halflings-icon edit"></i><span class="break"></span>update item</h2>
		</div>
			<form class="form-horizontal" action="{{ url('/update-item',$single_item->item_id)}}" method="post" 
			enctype="multipart/form-data">
				{{ csrf_field() }}
			  <fieldset>
				<div class="form-group">
				  <label class="form-label" for="date01">item Name</label>
				  <div class="forms">
					<input type="text" class="form-control" name="item_name" value="{{$single_item->item_name}}" >
				  </div>
				</div>
				<div class="form-group">
						<label class="form-label" for="date01">item Code</label>
						<div class="forms">
						<input type="number" class="form-control" name="code" value="{{$single_item->code}}" >
						</div>
					</div>
                <div class="form-group">
					<label class="form-label" for="selectError3">item category</label>
					<div class="forms">
					  <select id="selectError3" name="category_id" class="form-control"> 
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
					<input type="text" class="form-control" name="item_price" value="{{$single_item->item_price}}">
				  </div>
				</div>
				<div class="form-group">
						<label class="control-label" for="date01">Base Unit </label>
				<select id="selectError3" name="unit_id" class="form-control"> 
						<?php
								$all_published_unit=DB::table('units')
																			 ->get();
						?>
				@foreach($all_published_unit as $unit){?>  
<option value="{{ $unit->id}}">
{{$unit->unit_name}} 				
</option>	
@endforeach			
 </select>
				</div>
				<div class="form-group">
						<label class="control-label" for="date01">Equal To</label>
						<div class="controls">
							<input type="number" class="form-control" name="to_unit" value="{{$single_item->to_unit}}"required>
						</div>
					</div>
					<div class="form-group">
							<label class="control-label" for="date01">Part Unit </label>
					<select id="selectError3" name="part_unit_id" class="form-control"> 
							<?php
									$all_published_unit=DB::table('units')
																				 ->get();
							?>
					@foreach($all_published_unit as $unit){?>  
 <option value="{{ $unit->id}}">
	{{$unit->unit_name}} 				
 </option>	
 @endforeach			
	 </select>
					</div>
                <div class="form-group">
				  <label class="form-label" for="fileInput">Image </label>
				   <img style="height: 80px; width: 80px;" src="{{URL::to($single_item->item_image)}}" ><hr>
				  <div class="forms">
					<input class="form-control" name="item_image" id="fileInput" type="file" 
					value="{{$single_item->item_image}}">
				  </div>
				
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">update item </button>
				  <a href="{{URL::to('/all-item')}}" class="btn btn-default">Cancel</a>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->
@endsection