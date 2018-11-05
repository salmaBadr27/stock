@extends('admin_layout')
@section('content')
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Items</h2>
            <hr>
            <a class="btn btn-info" href="{{URL::to('/add-item')}}" style="float:right;">
                <i class="fa fa-plus"></i> 
                Add Item
            </a>
            <br>
        </div>
        <div class="box-content">
            @if(count($all_items)>0)
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                  <tr>
                      <th> Name</th>
                      <th>  image</th>
                      <th>Actions</th>
                  </tr>
              </thead>   
              @foreach($all_items as $item) <!-- loop through allcategories d=fetched from database and put them in table-->
              <tbody>
                <tr>
                    <td class="center">{{$item->item_name}}</td>
                    <td><img src= "{{URL::to($item->item_image)}}" style ="height:80px;width:80px"></td>
                    <td class="center">
                         <a class="btn btn-primary" href="{{URL::to('/edit-item/'.$item->item_id)}}">
                            <i class="fa fa-edit"></i> 
                        </a>
                        <a class="btn btn-warning" href="{{URL::to('/view-item/'.$item->item_id)}}">
                            <i class="fa fa-eye"></i> 
                        </a>
                        <button class="btn btn-danger" data-itemid={{$item->item_id}} data-toggle="modal" data-target="#delete"> <i class="fa fa-remove"></i></button>             
                        <div class="modal modal-fade" id="delete" role="dialog" tabindex="-1"  aria-labelledby="myModalLabel" >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Delete item</h4>
                                        </div>
                                      
                                    <form action="{{URL::to('/delete-item')}}">
                                      {{method_field('delete')}}
                                      {{csrf_field()}}
                                     
                                      <div class="modal-body">
                                            are you sure you want to delete this?
                                            <input type="hidden" name="item_id" id="itm_id" value="">
                                    </div>
                                  
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">No,Close</button>
                                        <button type="submit" class="btn btn-danger"> yes, Delete</button>
                                        </div>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div> 
                    </td>
                </tr>
               
              </tbody>
              @endforeach
          </table>  
          @else 
          <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon edit"></i><span class="break"></span>There is no  Items found  </h2>
                </div> 
                @endif                  
        </div>
    </div><!--/span-->
</div>
    <script>
            $(document).ready(function(){  
                 $('#delete').on('show.bs.modal', function (event) {
                 var button = $(event.relatedTarget) 
                 var item_id = button.data('itemid') 
                 var modal = $(this)
                 modal.find('.modal-body #itm_id').val(item_id);
           })
           });
                </script>

@endsection

