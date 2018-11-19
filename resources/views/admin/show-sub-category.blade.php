@extends('admin_layout')
@section('content')
	<section id="cart_categorys">
		<div class="container col-sm-12">
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
			<div class="table-responsive cart_info">
                    @if(count($single_category) > 0)
				<table class="table table-condensed">
                        <a class="btn btn-warning" href={{URL::to('move-sub-by-cat/'.$single_category[0]->category_id)}}>Move All</a>         
					<thead>
						<tr class="cart_menu">
                            <td class="description">Name</td>
                            <td class="image">Image</td>
                            <td class="image">Description</td>
                            <td class="quantity"> Action</td> 
						</tr>
					</thead>
					<tbody>
                            @foreach($single_category as $subCat)                
						<tr>
							<td class="cart_description">
								<h4>{{$subCat->sub_category}}</h4>
                        </td>
                            <td class="cart_product">
                                    <a href=""><img src="{{URL::to($subCat->image)}}" height="200px" width="200px" alt=""></a>
                            </td>
                            <td class="cart_product">
                                    <h4>{{$subCat->category_description}}</h4>
                            </td>
                            <td>
                            <a class="btn btn-primary" href="{{URL::to('/move-sub-by-cat/'.$subCat->parent)}}">
								Move
                            </a>
                            @foreach($sub_id as $sub)
                            <button class="btn btn-danger" data-subid={{$sub->category_id}} data-toggle="modal" data-target="#delete">Delete</button>             
                            @endforeach
							<div class="modal modal-fade" id="delete" role="dialog" tabindex="-1"  aria-labelledby="myModalLabel" >
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title" id="myModalLabel">Delete Sub</h4>
											</div>
										  
										<form action="{{URL::to('/delete-sub-category')}}">
										  {{method_field('delete')}}
										  {{csrf_field()}}
										 
										  <div class="modal-body">
												are you sure you want to delete this?
												<input type="hidden" name="subcat_id" id="sub_id" value="">
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
                                <a class="btn btn-success" href="{{URL::to('/view-sub-category/'.$sub->category_id)}}">
                                 Show 
                                 </a>
                                @endif
                                 @if(Session::has('danger'))
                                <a class="btn btn-success" href="{{URL::to('/view-item-by-cat/'.$sub->category_id)}}">
                                 Show 
                                </a>
                                @endif
                               
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="box span12">
                        <div class="box-header" data-original-title>
                            <h2><i class="halflings-icon edit"></i><span class="break"></span>There is no sub Category in this Category</h2>
                           
                        </div>
                  @endif
			</div>
		</div>
    </section>
    <script>
           $(document).ready(function(){  
             $('#delete').on('show.bs.modal', function (event) {
             var button = $(event.relatedTarget) 
             var sub_id = button.data('subid') 
             var modal = $(this)
             modal.find('.modal-body #sub_id').val(sub_id);
       });
 
		   $('#deleteAll').on('show.bs.modal', function (event) {
                 var button = $(event.relatedTarget) 
                 var category_id = button.data('parentid') 
                 var modal = $(this)
                 modal.find('.modal-body #prt_id').val(category_id);
           });
         
        });
                </script>
@endsection