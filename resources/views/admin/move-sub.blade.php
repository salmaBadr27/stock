@extends('admin_layout')
@section('content')
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Move Sub Category to To</h2>
        </div>
        <br></br>
			<form class="form-horizontal" action="{{ url('/update-sub-by-cat/'.$single_category->category_id)}}" method="post">
				{{ csrf_field() }}
                <div class="form-group">
					<label class="form-label" for="selectError3">Parent Category</label>
					<div class="forms">
					  <select id="selectError3" name="parent_id" class="form-control"> 
								<option></option>
                       <?php
                           $all_published_category=DB::table('categories')
                                                  ->get();
                       ?>
                       
                   @foreach($all_published_category as $category){?>  
					<option value="{{$category->category_id}}">
					 {{$category->category_name}} 				
					</option>	
					@endforeach			
					  </select>
					</div>
				  </div>
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">update Category </button>
                <a type="reset" class="btn btn-default" href="{{URL::to('/all-item')}}">Cancel</a>
				</div>
		
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->
@endsection