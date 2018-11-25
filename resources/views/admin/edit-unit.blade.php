@extends('admin_layout')
@section('content')
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>update Unit</h2>
        </div>
        <hr>
			<form class="form-horizontal" action="{{ url('/update-unit',$singleUnit->id)}}" method="post" 
			enctype="multipart/form-data">
				{{ csrf_field() }}
			  <fieldset>
				<div class="form-group">
				  <label class="form-label" for="date01">unit Name</label>
				  <div class="forms">
					<input type="text" name="unit_name"  class="form-control" value="{{$singleUnit->unit_name}}" >
				  </div>
				</div>
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">Update unit </button>
				  <a href="{{URL::to('/all-units')}}" class="btn btn-default">Cancel</a>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div>

</div>
@endsection