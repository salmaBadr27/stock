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
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add item</h2>
        <form action ="{{URL::to('/save-item')}}" method = "post" enctype="multipart/form-data">
                {{csrf_field()}}
              <fieldset>
                <div class="form-group">
                  <label class="control-label" for="date01">Item name</label>
                  <div>
                    <input type="text" class="form-control" name="item_name" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="date01">Item Code</label>
                    <div>
                      <input type="number" class="form-control" name="code" required>
                    </div>
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
                    <input type="number"  step="0.01" class="form-control" name="item_price" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="date01">Base Unit </label>
                <select id="selectError3" name="unit_id" class="form-control"> 
                    <?php
                        $all_published_unit=DB::table('units')
                                               ->get();
                    ?>
                @foreach($all_published_unit as $unit){?>  
       <option value="{{ $unit->id}}">
        {{$unit->unit_name}} 				
       </option>	
       @endforeach			
         </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="date01">Equal To</label>
                    <div class="controls">
                      <input type="number" class="form-control" name="to_unit" required>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label" for="date01">Part Unit </label>
                  <select id="selectError3" name="part_unit_id" class="form-control"> 
                      <?php
                          $all_published_unit=DB::table('units')
                                                 ->get();
                      ?>
                  @foreach($all_published_unit as $unit){?>  
         <option value="{{ $unit->id}}">
          {{$unit->unit_name}} 				
         </option>	
         @endforeach			
           </select>
                  </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Add item</button>
                  <a href="{{URL::to('/all-item')}}" class=" btn btn-default">Cancel</a>
                </div>
              </fieldset>
            </form>   

        </div>
    </div><!--/span-->

</div><!--/row-->
@endsection



