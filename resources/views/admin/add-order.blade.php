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
                   
                    
              <form name="add_order" id="add_order" method="post" action="{{URL::to('/save-order')}}"> 
                {{csrf_field()}} 
                   <div class="table-responsive"> 
                    <button type="button" name="removeall" id="RemoveAll"class="btn btn-danger" style="float:right"> Remove All <i class="fa fa-remove"></i></button>  
                    <br><br>
                    <table class="table table-bordered">
                            <thead>
                                 <h3 class="form-group"> New Order To ... </h3> 
                            </thead>
                            <tr>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Order number</th>
                            </tr>
                          <tr> 
                                 <td><input type="search" name="client_name" id="client_name"  class="form-control" required/></td>  
                                 <td><input type="text" id="date" name="order_date" class="form-control"/></td>  
                                 <td><input type="number" name="order_no" class="form-control"/></td>  
                          </tr>  
                     </table> 
                    <div class="table-responsive"> 
                        <table class="table table-bordered" id="autocomplete_table">
                                <thead>
                                        <th>#</th>
                                        <th>item</th>
                                        <th>code</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                    </thead>
                            <tbody>
                             <tr id="row_1">  
                                    <input type="hidden"  id="itemid_1" value="" />
                                    <th id="delete_1" class="delete_row"><img src="../../../minus.png" style="width:25px;height:25px"/></th>
                                    <td><input type="text" name="item[]" id="it_1" data-type="itemname" class="form-control autocomplete_txt" valu required/></td>  
                                    <td><input type="text" name="code[]" id="code_1" data-type="code" class="form-control autocomplete_txt" required/></td>  
                                    <td><input type="number" name="quantity[]" id="qty_1" data-type="qty" class="form-control autocomplete_txt" required/></td>  
                                    <td>  
                                        <select name="unit[]"  id="unit_1" class ="form-control autocomplete_txt" data-type="unitname" required>
                                            <option></option>
                                            <option>kg</option>
                                            <option>كرتونه</option>
                                         </select>
                                    </td>  
                             </tr>  
                            </tbody>
                        </table> 
                    </div>   
                        <div class="btn btn-container">
                                <button type="button" name="add" id="addrow" class="btn btn-info" > Add More <i class="fa fa-plus"></i></button>
                                 </div> 
                        <div class="form-actions" style="float:right">
                                <button type="submit" class="btn btn-info">Add Order</button>
                                <button type="reset" class="btn">Cancel</button>
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
            
            // date 
             $('#date').val(today);

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
        html +='<input type="hidden"  id="itemid_'+rowCount+'" value=""/>';
        html +='<th id="delete_'+rowCount+'" class="delete_row"><img src="../../../minus.png" style="width:25px;height:25px"/></th>';  
        html +='<td><input type="text" name="item[]" id="it_'+rowCount+'" data-type="itemname" class="form-control autocomplete_txt"   required/></td>';
        html +='<td><input type="text" name="code[]" id="code_'+rowCount+'" data-type="code" class="form-control autocomplete_txt"   required/></td>';
        
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

       function getFieldNo(type){
        var fieldNo;
        switch(type) {
            case 'itemname':
            fieldNo = 0;
            break;
            case 'code':
            fieldNo = 1;
            break;
            case 'qty' :
            fieldNo = 2;
            break;
            case 'unitname' :
            fieldNo = 3;
            break;
            default:
            break;
        }
       return fieldNo;
       }


       function handleAutoComplete() {
       var fieldNo,type,currentEle;
       type = $(this).data('type');
       fieldNo = getFieldNo(type);
     
       currentEle = $(this);
      currentEle.autocomplete({
       source :function(request,response){
            $.ajax({  
                       url : '{{URL::to('/search-item')}}',
                       method:"GET",  
                       dataType:'json',
                       data:{
                           name:request.term,
                           fieldNo:fieldNo
                       },
                       success:function(res)  
                       {  
                          var itemsList;

                          itemsList = [{
                          label:"there is no matching results founds for" +request.term,
                          value:''
                          }];

                           if(res.length) {
                            itemsList = $.map(res,function(name){
                            //   console.log('name',name);
                                //  var arr = name[0].split("|");
                                //  console.log('arr',name[1]);
                                
                                            //   for( var i=1;i<rowCount;i++){
                                            //     var id = $('#it_'+i).val(res);
                                            //     console.log(id);
                                            //     // $('#itemid_'+i).val(2);
                                            //         }

                            return {
                                label: name.item,
                                value:name.id,
                                 data:name
                                }
                  
                            });
                           }
                        console.log('data',res);
                          
                       
                           response($.ui.autocomplete.filter(itemsList, request.term));
                        
                
                       }
                  }); 
                 
           }
      });


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
        $(document).on('focus','.autocomplete_txt',handleAutoComplete);
      
       }
       
       function init(){
           registerEvent();
       }
           return{
               init:init
           };
       })();
   
       smartAuto.init()

            
       



         
        //search client
       $('#client_name').autocomplete({
            source :function(request,response){
            $.ajax({  
                       url : '{{URL::to('/search-client')}}',
                       method:"GET",  
                       dataType:'json',
                       data:{
                           name:request.term
                       },
                       success:function(res)  
                       {  
                        //   var clientList;
                        //  notfound = [
                        //     {
                        //         label: 'There is no result found for '+request.term,
                        //         value: ''
                        //     }
                        //   ];
                           if(res.length) {
                            clientList = $.map(res,function(name){
                            return {
                                label: name,
                                value: name
                                }
                            });
                           }
                           response($.ui.autocomplete.filter(clientList, request.term));
                       }  
                       
                  }); 
                 
           }
       });

     });
        </script>
@endsection