@extends('admin_layout')
@section('content')
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Unit</h2>
        <form action ="{{URL::to('/save-unit')}}" method = "post" enctype="multipart/form-data">
                {{csrf_field()}}
              <fieldset>
                <div class="form-group">
                  <label class="control-label" for="date01">unit name</label>
                    <input type="text" class="form-control" name="unit_name" required>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Add unit</button>
                  <a href="{{URL::to('/all-units')}}" class="btn btn-default">Cancel</a>
                </div>
              </fieldset>
            </form>   
        </div>
    </div><!--/span-->

</div><!--/row-->
@endsection



