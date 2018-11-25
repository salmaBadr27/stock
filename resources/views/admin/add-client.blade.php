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
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Client</h2>
        </div>
        <div>
        <form action ="{{URL::to('/save-client')}}" method = "post" enctype="multipart/form-data">
                {{csrf_field()}}
              <fieldset>
                <div class="form-group">
                  <label class="control-label" for="date01">client name</label>
                  <div>
                    <input type="text" class="form-control" name="client_name" required>
                  </div>
                  <div class="form-group">
                      <label class="control-label" for="date01">client Code</label>
                      <div>
                        <input type="number" class="form-control" name="code" required>
                      </div>
              <div class="form-group">
                  <label class="control-label" for="date01">Description</label>
                  <div class="controls">
                    <textarea type="text" class="form-control" name="client_description"></textarea>
                  </div>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Add client</button>
                  <a href="{{URL::to('/all-client')}}" class="btn btn-default">Cancel</a>
                </div>
              </fieldset>
            </form>   

        </div>
    </div><!--/span-->

</div><!--/row-->
@endsection



