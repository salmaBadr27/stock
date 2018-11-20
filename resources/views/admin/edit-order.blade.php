@extends('admin_layout')
@section('content')
	<section id="cart_orders">
		<div class="container col-sm-12">
			<div class="table-responsive cart_info">
				@if(count($single_order))
				@foreach( $single_order as $order)
				<p hidden> {{$id = $order->order_id}}</p>
				@endforeach
					<a href="{{URL::to('/all-orders')}}" class="btn btn-success" style="float:right">Back</a>
					<form method="post" action = {{URL::to('/update-order/'.$id)}} name="update_order" id="update_order">
						{{csrf_field()}} 
					<table class="table table-condensed">
							<thead>
								<tr>
									
							<th>Client</th>
							<th>Client Code </th>
							<th>Date</th>
								</tr>
								</thead>
								<tbody>
							<td><input id ="client" name ="client_name" type=" text" data-type="clientname" class= "form-control autocomplete_client" value="{{$single_order[0]->client_name}}"/></td>
							<td><input id ="client_code" type="number" data-type="clientcode"  class= "form-control autocomplete_client" value="{{$single_order[0]->client_code}}"/></td>
							<td><input type="date" class= "form-control" value="{{$single_order[0]->order_date}}"/></td>
								</tbody>
						</table>
					<hr>
				<table  class="table table-bordered" id="autocomplete_table">
					<thead>
						<tr>
						   <td class="name"><b>#</b></td>
						   <td class="price"><b>code</b></td>
							<td class="name"><b>Item Name</b></td>
							<td class="price"><b>Quantity<b></td> 
							<td class="price"><b>Unit<b></td>
						</tr>
					</thead>
					<tbody>
							@foreach($single_order as $key=>$order)
						<tr id ="row_{{$key}}">
						<input type="hidden" name ="id[]" id="itemid_{{$key}}" value="{{$order->item_id}}" />
						   <th id="delete_{{$key}}" class="delete_row"><img src="../../../minus.png" style="width:25px;height:25px"/></th>
						   <td class="cart_description">
						   <input class="form-control"  name="code[]" id="code_{{$key}}" data-type="code"  class="form-control autocomplete_txt" value="{{$order->code}}"/>
							</td>
							<td class="cart_product">
                                <input class="form-control" name="item[]" id="it_{{$key}}" data-type="itemname"  class="form-control autocomplete_txt" value="{{$order->item_name}}"/>
							</td>
							<td class="cart_total">
								<input class="form-control" name="quantity[]" id="qty_{{$key}}" data-type="qty"  value="{{$order->quantity}}"/>
							</td>
							<td>  
									<select name="unit[]"  id="unit_{{$key}}}" class ="form-control" data-type="unitname"  value="{{$order->item_unit}}">required>
										<option>kg</option>
										<option>كرتونه</option>
									 </select>
								</td>
						</tr>
						@endforeach
					</tbody>
					<div class="btn btn-container" style="float:right">
							<button type="button" name="add" id="addrow" class="btn btn-info" > Add More <i class="fa fa-plus"></i></button>
							 </div> 
				</table>
				@endif
				<div class="form-actions" style="float:right">
						<button type="submit" class="btn btn-primary">Update order </button>
				<a type="reset" class="btn btn-default" href="{{URL::to('/view-order/'.$id)}}">Cancel</a>
					  </div>
					</form>
			</div>
		</div>
	</section>
	<script>
	$(document).ready(function(){
		
		//autocomplete clients fields
		$(document).on('focus','.autocomplete_client',function(){
        var type = $(this).data('type');
  
  if(type =='clientname' )autoType='client_name'; 
  if(type =='clientcode' )autoType='client_code';
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ URL::to('/searchajaxClient') }}",
                dataType: "json",
                data: {
                    term : request.term,
                    type : type,
                },
                success: function(data) {
                    console.log(data);
                    var array;
                    array = [{
                        label : 'no results',
                        value : ''
                    }];
                    
                    if (data.length){
                     array = $.map(data, function (item) {
                       return {
                           label: item[autoType],
                           value: item[autoType],
                           data : item
                       }
                   });
                }
                    response(array);
                }
            });
       },select: function( event, ui ) {
           var data = ui.item.data;           
           $('#client').val(data.client_name);
           $('#client_code').val(data.client_code);
       }
   });  

    });
       //add more logic
       var smartAuto = (function(){
       var addBtn,hrml,rowCount,tableBody,rowitemNo;
		
       addBtn= $('#addrow');
       rowCount = $('#autocomplete_table tbody tr').length;
	   console.log(rowCount);
       tableBody = $('#autocomplete_table');
       function formHtml(){
        html ='<tr id="row_'+rowCount+'">';
        html +='<input type="hidden" name ="id[]" id="itemid_'+rowCount+'" value=""/>';
        html +='<th id="delete_'+rowCount+'" class="delete_row"><img src="../../../minus.png" style="width:25px;height:25px"/></th>';  
        html +='<td><input type="text" name="code[]" id="code_'+rowCount+'" data-type="code" class="form-control autocomplete_txt"   required/></td>';
        html +='<td><input type="text" name="item[]" id="it_'+rowCount+'" data-type="itemname" class="form-control autocomplete_txt"   required/></td>';

        html += '<td><input type="number" name="quantity[]" id="qty_'+rowCount+'" data-type="qty" class="form-control" required/></td>';  
        html += '<td>'; 
        html +=  '<select name="unit[]"  id="unit_'+rowCount+'" class ="form-control" data-type="unitname" required>';
        html +=  '<option></option>';
        html +=  '<option>kg</option>';
        html +=  '<option>كرتونه</option>';
        html +=   '</select>';
        html +=   '</td>';  
        html +='</tr>'; 
		

        rowCount++;
        return html;
       }
       function getId(element) {
        var id,idArr;
        id = element.attr('id');
        idArr = id.split('_');
        return idArr[idArr.length - 1];

       }
       function addNewRow(){
        tableBody.append(formHtml());
       }
      function deleteRow(){
          var currentEle,rowNo;
          currentEle = $(this);
          rowNo = getId(currentEle);
          $('#row_'+rowNo).remove();

      }
       function registerEvent() {
        addBtn.on('click',addNewRow);
        $(document).on('click','.delete_row',deleteRow);
       }
       
       function init(){
           registerEvent();
       }
           return{
               init:init
           };
       })();

	    smartAuto.init();

    //autocomplete items and code
	$(document).on('keyup','.autocomplete_txt',function(){
        var type = $(this).data('type');
  
            if(type =='itemname' )autoType='item_name'; 
            if(type =='code' )autoType='code'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ URL::to('/searchajax') }}",
                dataType: "json",
                data: {
                    term : request.term,
                    type : type,
                },
                success: function(data) {
                    var array;
                    array = [{
                        label : 'no results',
                        value : ''
                    }];
                    
                    if (data.length){
                     array = $.map(data, function (item) {
                       return {
                           label: item[autoType],
                           value: item[autoType],
                           data : item
                       }
                   });
                }
                    response(array);
                }
            });
       },
       select: function( event, ui ) {
           var data = ui.item.data;           
           id_arr = $(this).attr('id');
           id = id_arr.split("_");
           elementId = id[id.length-1];
           $('#it_'+elementId).val(data.item_name);
           $('#code_'+elementId).val(data.code);
           $('#itemid_'+elementId).val(data.id);
       }
   });  

    });
});


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	</script>
@endsection