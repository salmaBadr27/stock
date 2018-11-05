@extends('admin_layout')
@section('content')
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>New Order</h2>
           
        </div>
        <form action ="{{URL::to('/save-order')}}" method = "post" enctype="multipart/form-data">
                {{csrf_field()}}
              <fieldset>
                <div class="form-group">
                  <label class="control-label" for="date01">Order date</label>
                  <div>
                    <input class="date form-control" type="date" name="order_date" required>
                  </div>
                  <div class="form-group">
								<label class="control-label" for="selectError3">Order item</label>
								<div class="controls">
                 <select name="item_id">
                 <option>select Item</option>
                       <?php 
                    $all_items = DB::table('items')
								 ->get();
                  foreach ($all_items as $item){?>
                  <option value="{{$item->item_id}}">{{$item->item_name}}</option>
                  <?php }?>
								  </select>
								</div>
                              </div>
                  <div class="form-group">
							  <label class="control-label" for="fileInput">Client Name</label>
							  <div class="controls">
                                <select name="client_id">
                                <option>select Client</option>
                                      <?php 
                                   $all_clients = DB::table('client')
                                                ->get();
                                 foreach ($all_clients as $client){?>
                                 <option value="{{$client->client_id}}">{{$client->client_name}}</option>
                                 <?php }?>
                               </select>
                                               </div>
                            </div>  
                           
              <div class="form-group">
                  <label class="control-label" for="date01">Quantity</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="order_qty" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="fileInput">Item Unit</label>
                    <div class="controls">
                      <select name="item_unit">
                      <option>select Unit</option>
                       <option>Kg</option>
                       <option>g</option>
                </select>
                                     </div>
                  </div>    
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Add order</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>   

        </div>
    </div><!--/span-->

</div><!--/row-->
@endsection



