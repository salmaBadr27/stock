@extends('admin_layout')
@section('content')
	<section id="cart_categorys">
		<div class="container col-sm-12">
			<div class="table-responsive cart_info">
                    @if(count($single_category) > 0)
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
                            <td class="description">Name</td>
                            <td class="image">Image</td>
                            <td class="image">Description</td>
						</tr>
					</thead>
					<tbody>
                            @foreach($single_category as $sub)                
						<tr>
							<td class="cart_description">
								<h4>{{$sub->sub_category}}</h4>
                        </td>
                            <td class="cart_product">
                                    <a href=""><img src="{{URL::to($sub->image)}}" height="200px" width="200px" alt=""></a>
                            </td>
                            <td class="cart_product">
                                    <h4>{{$sub->category_description}}</h4>
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
@endsection