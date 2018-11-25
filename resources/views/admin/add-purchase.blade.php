@extends('admin_layout')
@section('content')
<body>  
         <div class="form-group"> 
                @if(Session::has('success'))
                <div class="alert alert-success">
                        {{ session('success') }}
                        {{session::put('success',null)}}
                    </div>
                    @endif 
                   
                    
              <form name="add_order" id="add_order" method="post" action="{{URL::to('/save-purchase')}}"> 
                {{csrf_field()}} 
                   <div class="table-responsive"> 
                    <button type="button" name="add" id="addrow" class="btn btn-info" > Add More <i class="fa fa-plus"></i></button>
                    <button type="button" name="removeall" id="RemoveAll"class="btn btn-danger" style="float:right"> Remove All <i class="fa fa-remove"></i></button>  
                    <br><br>
                    <table class="table table-bordered">
                            <thead>
                                 <h3 class="form-group"> New Purchase To ... </h3> 
                            </thead>
                            <tr>
                                <th>supplier</th>
                                <th>supplier Code </th>
                                <th>Date</th>
                                <th>purchase number</th>
                            </tr>
                          <tr> 
                                 <td><input type="search" name="supplier_name" id="supplier" data-type="suppliername"  class="form-control autocomplete_supplier" required/></td>  
                                 <td><input type="search" name="supplier_code" id="supplierscode" data-type="suppliercode"  class="form-control autocomplete_supplier" required/></td>  
                                 <td><input type="text" id="date" name="purchase_date" class="form-control"/></td>  
                                 <td><input type="number" name="purchase_no" class="form-control"/></td>  
                          </tr>  
                     </table> 
                    <div class="table-responsive"> 
                        <table class="table table-bordered" id="autocomplete_table">
                                <thead>
                                        <th>#</th>
                                        <th>code</th>
                                        <th>item</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                    </thead>
                            <tbody>
                             <tr id="row_1">  
                                    <input type="hidden" name ="id[]" id="itemid_1" value="" />
                                    <th id="delete_1" class="delete_row"><img src="../../../minus.png" style="width:25px;height:25px"/></th>
                                    <td><input type="text" name="code[]" id="code_1" data-type="code" class="form-control autocomplete_txt" value="" required/></td>  
                                    <td><input type="text" name="item[]" id="it_1" data-type="itemname" class="form-control autocomplete_txt"   value="" required/></td>  
                                    <td><input type="number" name="quantity[]" id="qty_1" data-type="qty" class="form-control" required/></td>  
                                    <td>  
                                        <select name="unit[]"  id="unit_1" class ="form-control" data-type="unitname" required>
                                            <option></option>
                                            <option>kg</option>
                                            <option>كرتونه</option>
                                         </select>
                                    </td>  
                             </tr>  
                            </tbody>
                        </table> 
                    </div>   
                        <div class="form-actions" style="float:right">
                                <button type="submit" class="btn btn-info">Add Purchase</button>
                                <a type="reset" class="btn btn-default" href="{{URL::to('/all-purchase')}}">Cancel</a>
                            </div>
                   </div>  
              </form>  
         </div>  
</body>  
<script>  
        $(document).ready(function(){  
            //get current date
              var date = new Date(); 
              var day = date.getDate();
              var month = date.getMonth();
              var year = date.getFullYear();
              var today = year+'-'+month+'-'+day;
            
            // default values
             $('#date').val(today);
             $('#supplier').val('cash');
             $('#supplierscode').val('500');


             //remove all rows 
           $('#RemoveAll').click(function() {
           $('#autocomplete_table').empty(); 
        });
         

       //smart autocomplete
       var smartAuto = (function(){
       var addBtn,hrml,rowCount,tableBody,rowitemNo;

       addBtn= $('#addrow');
    // rowCount = $('#autocomplete_table tbody tr').length+1;
       rowCount = 2;
       tableBody = $('#autocomplete_table');
       function formHtml(){
        html ='<tr id="row_'+rowCount+'">';
        html +='<input type="hidden" name ="id[]" id="itemid_'+rowCount+'" value=""/>';
        html +='<th id="delete_'+rowCount+'" class="delete_row"><img src="../../../minus.png" style="width:25px;height:25px"/></th>';  
        html +='<td><input type="text" name="code[]" id="code_'+rowCount+'" data-type="code" class="form-control autocomplete_txt"   required/></td>';
        html +='<td><input type="text" name="item[]" id="it_'+rowCount+'" data-type="itemname" class="form-control autocomplete_txt"   required/></td>';

        html += '<td><input type="number" name="quantity[]" id="qty_'+rowCount+'" data-type="qty" class="form-control autocomplete_txt" required/></td>';  
        html += '<td>'; 
        html +=  '<select name="unit[]"  id="unit_'+rowCount+'" class ="form-control autocomplete_txt" data-type="unitname" required>';
        html +=  '<option></option>';
        html +=  '<option>kg</option>';
        html +=  '<option>كرتونه</option>';
        html +=   '</select>';
        html +=   '</td>';  
        html +=   '</tr>'; 

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
    $(document).on('focus','.autocomplete_supplier',function(){
        var type = $(this).data('type');
  
  if(type =='suppliername' )autoType='supplier_name'; 
  if(type =='suppliercode' )autoType='supplier_code';
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ URL::to('/searchajaxSupplier') }}",
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
           $('#supplierscode').val(data.supplier_code);
       }
   });  

    });
});
        </script>
@endsection