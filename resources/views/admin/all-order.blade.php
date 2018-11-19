@extends('admin_layout')
@section('content')
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Orders</h2>
            <hr>
            <a class="btn btn-info" href="{{URL::to('/add-order')}}" style="float:right;">
                <i class="fa fa-plus"></i> 
                Add Order
            </a>
            <br>
        </div>
                        @if(count($all_orders)>0)
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                  <tr>
                      <th> Order Id</th>
                      <th>Client Name</th>
                      <th> order date</th>
                      <th>Actions</th>
                  </tr>
              </thead>   
              @foreach($all_orders as $order) <!-- loop through allcategories d=fetched from database and put them in table-->
              <tbody>
                <tr>
                    <td>{{$order->order_id}}</td>
                    <td class="center">{{$order->client_name}}</td>
                    <td class="center">{{$order->order_date}}</td>
                
                    <td class="center">
                         <a class="btn btn-primary" href="{{URL::to('/edit-order/'.$order->order_id)}}">
                            <i class="fa fa-edit"></i> 
                        </a>
                        <a class="btn btn-warning" href="{{URL::to('/view-order/'.$order->order_id)}}">
                            <i class="fa fa-eye"></i> 
                        </a>
                        <button class="btn btn-danger" data-orderid={{$order->order_id}} data-toggle="modal" data-target="#delete"> <i class="fa fa-remove"></i></button>             
                        <div class="modal modal-fade" id="delete" role="dialog" tabindex="-1"  aria-labelledby="myModalLabel" >
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Delete order</h4>
                                    </div>
                                  
                                <form action="{{URL::to('/delete-order')}}">
                                  {{method_field('delete')}}
                                  {{csrf_field()}}
                                 
                                  <div class="modal-body">
                                        are you sure you want to delete this?
                                        <input type="hidden" name="order_id" id="ord_id" value="">
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
                    <h2><i class="halflings-icon edit"></i><span class="break"></span>There is no  Orders found  </h2>
                </div> 
                @endif                
        </div>
    </div><!--/span-->
    <script>
        $(document).ready(function(){  
             $('#delete').on('show.bs.modal', function (event) {
             var button = $(event.relatedTarget) 
             var order_id = button.data('orderid') 
             var modal = $(this)
             modal.find('.modal-body #ord_id').val(order_id);
       })
       });
            </script>
@endsection