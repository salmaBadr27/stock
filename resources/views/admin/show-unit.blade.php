@extends('admin_layout')
@section('content')
	<section id="cart_clients">
		<div class="container col-sm-12">
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
                        <a href="{{'/all-units'}}" class="btn btn-success" style="float:right">Back</a>
					<thead>
						<tr class="cart_menu">
							<td>Unit ID</td>
                            
							<td>Unit Name</td>
                        </tr>
                    </thead>
					<tbody>
						<tr>
                             <td>
                                        <h4>{{$singleUnit->id}}</h4>
                                    </td>
							<td>
								<h4>{{$singleUnit->unit_name}}</h4>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>
@endsection