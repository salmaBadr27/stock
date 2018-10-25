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
        <div class="box-content">
                <p class="alert-success">
                        <?php
                        $message=Session::get('message');
                        if($message){
                            echo $message;
                            Session::put('message',null);
                        }
                        ?>
                        </p>
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
                        <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-remove"></i>
                          </button>
                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                          <h4 class="modal-title" id="myModalLabel">Delete order</h4>
                                      </div>
                                      <div class="modal-body">
                                          are you shure you want to delete this ?
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          <a class="btn btn-danger" href="{{URL::to('/delete-order/'.$order->order_id)}}">
                                            Delete
                                        </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </td>
                </tr>
               
              </tbody>
              @endforeach
          </table>            
        </div>
    </div><!--/span-->
@endsection