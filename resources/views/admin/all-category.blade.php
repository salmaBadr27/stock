@extends('admin_layout')
@section('content')
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>category</h2>
            <hr>
            <a class="btn btn-info" href="{{URL::to('/add-category')}}" style="float:right;">
                <i class="fa fa-plus"></i> 
                Add Category
            </a>
            <br>
        </div>
        
        @if(Session::has('alert'))
        <div class="alert alert-danger">
                {{ session('alert') }}
            </div>
            @endif
            @if(Session::has('danger'))
            <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
                @endif
            @if(Session::has('success'))
            <div class="alert alert-success">
                    {{ session('success') }}
                </div>
    @endif
        <div class="box-content">
                        @if(count($all_categories)>0) 
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                  <tr>
                     <th> Category</th>
                      <th> Parent Category</th>
                      <th> image</th>
                      <th> Actions</th>
                  </tr>
              </thead>  
             
              <!-- loop through allcategories fetched from database and put them in table-->
              <tbody>
                   
                    @foreach($all_categories as $category)
                <tr>
                    <td class="center">{{$category->category_name}}</td>
                    @if($category->parent_category != null)
                    <?php
                    $all_parent_category=DB::table('categories')
                                         ->where('category_id',$category->parent_category)
                                          ->get();
                                          ?>
                 @foreach ($all_parent_category as $parent)
                  <td class="center">{{$parent->category_name}}</td>
                 @endforeach	
                   @else
                   <td class="center">No Parent</td>
                    @endif
                    
                    <td><img src= "{{URL::to($category->category_image)}}" style ="height:80px;width:80px"></td>
                    <td class="center">
                         <a class="btn btn-primary" href="{{URL::to('/edit-category/'.$category->category_id)}}">
                            <i class="fa fa-edit"></i> 
                        </a>
                        <a class="btn btn-warning" href="{{URL::to('/view-category/'.$category->category_id)}}">
                            <i class="fa fa-eye"></i> 
                        </a>
                        <button class="btn btn-danger" data-categoryid={{$category->category_id}} data-toggle="modal" data-target="#delete"> <i class="fa fa-remove"></i></button>             
                        <div class="modal modal-fade" id="delete" role="dialog" tabindex="-1"  aria-labelledby="myModalLabel" >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Delete category</h4>
                                        </div>
                                      
                                    <form action="{{URL::to('/delete-category')}}">
                                      {{method_field('delete')}}
                                      {{csrf_field()}}
                                     
                                      <div class="modal-body">
                                            are you sure you want to delete this?
                                            <input type="hidden" name="category_id" id="cat_id" value="">
                                    </div>
                                  
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">No,Close</button>
                                        <button type="submit" class="btn btn-danger"> yes, Delete</button>
                                        </div>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div> 
                        @if(Session::has('alert'))
                        <a class="btn btn-success" href="{{URL::to('/view-sub-category/'.$category->category_id)}}">
                         Show 
                         </a>
                        @endif
                         @if(Session::has('danger'))
                        <a class="btn btn-success" href="{{URL::to('/view-item-by-cat/'.$category->category_id)}}">
                         Show 
                        </a>
                        @endif
                        @endforeach
                       
                    </td>
                </tr>
              </tbody>
          </table>   
          @else 
          <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon edit"></i><span class="break"></span>There is no  Categories found  </h2>
                </div>         
        </div>
        @endif
    </div><!--/span-->
    </div>
</div>
<script>
        $(document).ready(function(){  
             $('#delete').on('show.bs.modal', function (event) {
             var button = $(event.relatedTarget) 
             var category_id = button.data('categoryid') 
             var modal = $(this)
             modal.find('.modal-body #cat_id').val(category_id);
       })
       });
            </script>

@endsection
