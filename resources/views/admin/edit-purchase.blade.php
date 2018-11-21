@extends('admin_layout')
@section('content')
	<section id="cart_purchases">
		<div class="container col-sm-12">
			<div class="table-responsive cart_info">
				@if(count($single_purchase))
				@foreach( $single_purchase as $purchase)
				<p hidden> {{$id = $purchase->purchase_id}}</p>
				@endforeach
					<a href="{{URL::to('/all-purchase')}}" class="btn btn-success" style="float:right">Back</a>
					<form method="post" action = {{URL::to('/update-purchase/'.$id)}} name="update_purchase" id="update_purchase">
						{{csrf_field()}} 
					<table class="table table-condensed">
							<thead>
								<tr>
									
							<th>Supplier</th>
							<th>Supplier Code </th>
							<th>Date</th>
								</tr>
								</thead>
								<tbody>
							<td><input id ="supplier" name ="supplier_name" type=" text" data-type="suppliername" class= "form-control autocomplete_supplier" value="{{$single_purchase[0]->supplier_name}}"/></td>
							<td><input id ="supplier_code" name ="supplier_code" type="number" data-type="suppliercode"  class= "form-control autocomplete_supplier" value="{{$single_purchase[0]->supplier_code}}"/></td>
							<td><input type="date"  name ="purchase_date" class= "form-control" value="{{$single_purchase[0]->purchase_date}}"/></td>
								</tbody>
						</table>
					<hr>
				<table  class="table table-bpurchaseed" id="autocomplete_table">
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
							@foreach($single_purchase as $key=>$purchase)
						<tr id ="row_{{$key}}">
						<input type="hidden" name ="purchase_id"  value="{{$purchase->purchase_id}}" />	
						<input type="hidden" name ="id[]" id="itemid_{{$key}}" value="{{$purchase->item_id}}" />
						   <th id="delete_{{$key}}" class="delete_row"><img src="../../../minus.png" style="width:25px;height:25px"/></th>
						   <td class="cart_description">
						   <input class="form-control"  name="code[]" id="code_{{$key}}" data-type="code"  class="form-control autocomplete_txt" value="{{$purchase->code}}"/>
							</td>
							<td class="cart_product">
                                <input class="form-control" name="item[]" id="it_{{$key}}" data-type="itemname"  class="form-control autocomplete_txt" value="{{$purchase->item_name}}"/>
							</td>
							<td class="cart_total">
								<input class="form-control" name="quantity[]" id="qty_{{$key}}" data-type="qty"  value="{{$purchase->quantity}}"/>
							</td>
							<td>  
									<select name="unit[]"  id="unit_{{$key}}}" class ="form-control" data-type="unitname"  value="{{$purchase->item_unit}}">required>
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
						<button type="submit" class="btn btn-primary">Update purchase </button>
				<a type="reset" class="btn btn-default" href="{{URL::to('/all-purchase')}}">Cancel</a>
					  </div>
					</form>
			</div>
		</div>
	</section>
	<script>
	$(document).ready(function(){

		//autocomplete suppliers fields
		$(document).on('focus','.autocomplete_supplier',function(){
        var type = $(this).data('type');
  
  if(type =='suppliername' )autoType='supplier_name'; 
  if(type =='suppliercode' )autoType='supplier_code';
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ URL::to('/searchajaxsupplier') }}",
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
           $('#supplier').val(data.supplier_name);
           $('#supplier_code').val(data.supplier_code);
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