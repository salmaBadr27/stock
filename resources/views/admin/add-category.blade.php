@extends('admin_layout')
@section('content')
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Category</h2>
           
        </div>
        <div>
        <form action ="{{URL::to('/save-category')}}" method = "post" enctype="multipart/form-data">
                {{csrf_field()}}
              <fieldset>
                <div class="form-group">
                  <label class="control-label" for="date01">category name</label>
                  <div>
                    <input type="text" class="form-control" name="category_name" required>
                  </div>
                  <div class="form-group">
								<label class="control-label" for="selectError3">Parent Category</label>
								<div class="controls">
                 <select class = "form-control" name="parent_id">
                 <option></option>
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
								<input class="input-file uniform_on" name="category_image" id ="fileInput" type="file">
							  </div>
							</div>   
                            <div class="form-group">
                                <label class="control-label" for="date01">Description</label>
                                <div class="controls">
                                  <textarea type="text" class="form-control" name="category_description"></textarea>
                                </div>
                              </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Add Category</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>   

        </div>
    </div><!--/span-->

</div><!--/row-->
@endsection



