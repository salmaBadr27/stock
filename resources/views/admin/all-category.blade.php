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
                     <th> Category Id</th>
                      <th> Category</th>
                      <th>  image</th>
                      <th>  Actions</th>
                  </tr>
              </thead>  
             
              <!-- loop through allcategories fetched from database and put them in table-->
              <tbody>
                   
                    @foreach($all_categories as $category)
                <tr>
                    <td class="center">{{$category->category_id}}</td>
                    <td class="center">{{$category->category_name}}</td>
                    <td><img src= "{{URL::to($category->category_image)}}" style ="height:80px;width:80px"></td>
                    <td class="center">
                         <a class="btn btn-primary" href="{{URL::to('/edit-category/'.$category->category_id)}}">
                            <i class="fa fa-edit"></i> 
                        </a>
                        <a class="btn btn-warning" href="{{URL::to('/view-category/'.$category->category_id)}}">
                            <i class="fa fa-eye"></i> 
                        </a>
                        <a class="btn btn-danger" href="{{URL::to('/delete-category/'.$category->category_id)}}">
                            <i class="fa fa-remove"></i>
                        </a>
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
    </script>

@endsection