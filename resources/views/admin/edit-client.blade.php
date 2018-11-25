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
			<h2><i class="halflings-icon edit"></i><span class="break"></span>update Client</h2>
        </div>
        <hr>
			<form class="form-horizontal" action="{{ url('/update-client',$single_client->client_id)}}" method="post" 
			enctype="multipart/form-data">
				{{ csrf_field() }}
			  <fieldset>
				<div class="form-group">
				  <label class="form-label" for="date01">client Name</label>
				  <div class="forms">
					<input type="text" name="client_name" class="form-control" value="{{$single_client->client_name}}" >
				  </div>
				</div>
				<div class="form-group">
						<label class="form-label" for="date01">client Code</label>
						<div class="forms">
						<input type="number" name="code" class="form-control" value="{{$single_client->code}}" >
						</div>
					</div>   
				<div class="form-group">
				  <label class="form-label" for="date01">description</label>
				  <div class="forms">
					<input type="text" name="client_description" class="form-control" value="{{$single_client->client_description}}">
				  </div>
				</div>
                
				
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">Update client </button>
				  <a href="{{URL::to('/all-client')}}" class="btn btn-default" class="btn">Cancel</a>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->
@endsection