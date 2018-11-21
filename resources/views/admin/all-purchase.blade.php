@extends('admin_layout')
@section('content')
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Purchases</h2>
            <hr>
            <a class="btn btn-info" href="{{URL::to('/add-purchase')}}" style="float:right;">
                <i class="fa fa-plus"></i> 
                Add Purchase
            </a>
            <br>
        </div>
                        @if(count($all_purchases)>0)
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                  <tr>
                      <th> purchase Id</th>
                      <th>Client Name</th>
                      <th> purchase date</th>
                      <th>Actions</th>
                  </tr>
              </thead>   
              @foreach($all_purchases as $purchase) <!-- loop through allcategories d=fetched from database and put them in table-->
              <tbody>
                <tr>
                    <td>{{$purchase->purchase_id}}</td>
                    <td class="center">{{$purchase->supplier_name}}</td>
                    <td class="center">{{$purchase->purchase_date}}</td>
                
                    <td class="center">
                         <a class="btn btn-primary" href="{{URL::to('/edit-purchase/'.$purchase->purchase_id)}}">
                            <i class="fa fa-edit"></i> 
                        </a>
                        <a class="btn btn-warning" href="{{URL::to('/view-purchase/'.$purchase->purchase_id)}}">
                            <i class="fa fa-eye"></i> 
                        </a>
                        <button class="btn btn-danger" data-purchaseid={{$purchase->purchase_id}} data-toggle="modal" data-target="#delete"> <i class="fa fa-remove"></i></button>             
                        <div class="modal modal-fade" id="delete" role="dialog" tabindex="-1"  aria-labelledby="myModalLabel" >
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Delete purchase</h4>
                                    </div>
                                  
                                <form action="{{URL::to('/delete-purchase')}}">
                                  {{method_field('delete')}}
                                  {{csrf_field()}}
                                 
                                  <div class="modal-body">
                                        are you sure you want to delete this?
                                        <input type="hidden" name="purchase_id" id="pur_id" value="">
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
                    <h2><i class="halflings-icon edit"></i><span class="break"></span>There is no  purchases found  </h2>
                </div> 
                @endif                
        </div>
    </div><!--/span-->
    <script>
        $(document).ready(function(){  
             $('#delete').on('show.bs.modal', function (event) {
             var button = $(event.relatedTarget) 
             var purchase_id = button.data('purchaseid') 
             var modal = $(this)
             modal.find('.modal-body #pur_id').val(purchase_id);
       })
       });
            </script>
@endsection