@extends('admin_layout')
@section('content')
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
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
					<input type="text" name="supplier_name" value="{{$single_supplier->supplier_name}}" >
				  </div>
				</div>
               
				<div class="form-group">
				  <label class="form-label" for="date01">description</label>
				  <div class="forms">
					<input type="text" name="supplier_description" value="{{$single_supplier->supplier_description}}">
				  </div>
				</div>
                
				
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">Update supplier </button>
				  <button type="reset" class="btn">Cancel</button>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->
@endsection