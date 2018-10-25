@extends('admin_layout')
@section('content')
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Supplier</h2>
           
        </div>
        <p class="alert-success">
                <?php
                $message=Session::get('message');
                if($message){
                    echo $message;
                    Session::put('message',null);
                }
                ?>
        </p>
        <div>
        <form action ="{{URL::to('/save-supplier')}}" method = "post" enctype="multipart/form-data">
                {{csrf_field()}}
              <fieldset>
                <div class="form-group">
                  <label class="control-label" for="date01">Supplier name</label>
                  <div>
                    <input type="text" class="form-control" name="supplier_name" required>
                  </div>
              <div class="form-group">
                  <label class="control-label" for="date01">Description</label>
                  <div class="controls">
                    <textarea type="text" class="form-control" name="supplier_description"></textarea>
                  </div>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Add supplier</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>   

        </div>
    </div><!--/span-->

</div><!--/row-->
@endsection



