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
			<h2><i class="halflings-icon edit"></i><span class="break"></span>update supplier</h2>
        </div>
        <hr>
			<form class="form-horizontal" action="{{ url('/update-supplier',$single_supplier->supplier_id)}}" method="post" 
			enctype="multipart/form-data">
				{{ csrf_field() }}
			  <fieldset>
				<div class="form-group">
				  <label class="form-label" for="date01">supplier Name</label>
				  <div class="forms">
					<input type="text" name="supplier_name" class="form-control"  value="{{$single_supplier->supplier_name}}" >
				  </div>
				</div>
				<div class="form-group">
						<label class="form-label" for="date01">supplier Code</label>
						<div class="forms">
						<input type="number" name="code" class="form-control" value="{{$single_supplier->code}}" >
						</div>
					</div>   
				<div class="form-group">
				  <label class="form-label" for="date01">description</label>
				  <div class="forms">
					<input type="text" name="supplier_description" class="form-control" value="{{$single_supplier->supplier_description}}">
				  </div>
				</div>
                
				
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">Update supplier </button>
				  <a href="{{URL::to('/all-supplier')}}" class="btn btn-default">Cancel</a>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->
@endsection