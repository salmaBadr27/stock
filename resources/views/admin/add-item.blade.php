@extends('admin_layout')
@section('content')
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add item</h2>
           
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
        <form action ="{{URL::to('/save-item')}}" method = "post" enctype="multipart/form-data">
                {{csrf_field()}}
              <fieldset>
                <div class="form-group">
                  <label class="control-label" for="date01">item name</label>
                  <div>
                    <input type="text" class="form-control" name="item_name" required>
                  </div>
                  <div class="form-group">
								<label class="control-label" for="selectError3">item category</label>
								<div class="controls">
                 <select name="category_id" class = "form-control">
                 <option>select category</option>
                       <?php 
                    $all_category = DB::table('categories')
								 ->get();
                  foreach ($all_category as $category){?>
                  <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                  <?php }?>
								  </select>
								</div>
                              </div>
                  <div class="form-group">
							  <label class="control-label" for="fileInput">image</label>
							  <div class="form-control">
								<input class="input-file uniform_on" name="item_image" id ="fileInput" type="file">
							  </div>
							</div>   
              <div class="form-group">
                  <label class="control-label" for="date01">item price</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="item_price" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="date01">item quantity</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="item_quantity" required>
                    </div>
                  </div>
                  <div class="form-group">
                  <select name="item_unit" class = "form-control" required>
                      <option></option>
                      <option>kg</option>
                      <option>كرتونه</option>
                   </select>
                  </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Add item</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>   

        </div>
    </div><!--/span-->

</div><!--/row-->
@endsection



