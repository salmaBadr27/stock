@extends('admin_layout')
@section('content')
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>update category</h2>
		</div>
			<form class="form-horizontal" action="{{ url('/update-category',$single_category->category_id)}}" method="post" 
			enctype="multipart/form-data">
				{{ csrf_field() }}
			  <fieldset>
				<div class="form-group">
				  <label class="form-label" for="date01">category Name</label>
				  <div class="forms">
					<input type="text" class="form-control" name="category_name" value="{{$single_category->category_name}}" >
				  </div>
				</div>
                <div class="form-group">
					<label class="form-label" for="selectError3">Parent category</label>
					<div class="forms">
					  <select id="selectError3" name="category_id" class="form-control"> 
								<option></option>
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
				</div>
				<div class="form-group">
                        <label class="control-label" for="date01">Description</label>
                        <div class="controls">
                        <textarea type="text" class="form-control" name="category_description" value="{{$single_category->category_description}}"></textarea>
                        </div>
                      </div>
                <div class="form-group">
				  <label class="form-label" for="fileInput">Image </label>
				   <img style="height: 80px; width: 80px;" src="{{URL::to($single_category->category_image)}}" ><hr>
				  <div class="forms">
					<input class="form-control" name="category_image" id="fileInput" type="file" 
					value="{{$single_category->category_image}}">
				  </div>
				
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">update category </button>
				  <a href="{{URL::to('/all-category')}}" class="btn btn-default">Cancel</a>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->
@endsection