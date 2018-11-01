@extends('admin_layout')
@section('content')
<body>  
         <div class="form-group">  
              <form name="add_order" id="add_order" method="post" action="{{URL::to('/save-order')}}"> 
                {{csrf_field()}} 
                   <div class="table-responsive"> 
                    <button type="button" name="removeall" id="RemoveAll"class="btn btn-danger" style="float:right"> Remove All <i class="fa fa-remove"></i></button>  
                    <button type="button" name="add" id="addMore"class="btn btn-info" style="float:right"> Add More <i class="fa fa-plus"></i></button>
                    <br><br>
                    <div class="table-responsive"> 
                                <table class="table table-bordered">
                                       <thead>
                                            <h3 class="form-group"> New Order To ... </h3> 
                                       </thead>
                                     <tr> 
                                            <td>Client<input type="search" name="client_name" id="client_name"  class="form-control" required/>
                                                <div id="clientList">
                                                </div>
                                            </td>  
                                            <td>Date<input type="text" id="date" name="order_date" class="form-control"/></td>  
                                            <td>Order number<input type="number" name="order_no" class="form-control"/></td>  
                                     </tr>  
                                </table>  
                           </div>  
                        <table class="table table-bordered" id="dynamic_field">
                             <tr>  
                                    <td>item<input type="text" name="item[]" id="it1" placeholder="Enter  item" class="form-control" required/>
                                        <div id="itemList">
                                        </div>
                                    </td>  
                                    <td>Quantity<input type="text" name="quantity[]" placeholder="Enter quantity" class="form-control" required/></td>  
                                    <td> Unit 
                                        <select name="unit[]" class = "form-control" required>
                                            <option></option>
                                            <option>kg</option>
                                            <option>كرتونه</option>
                                         </select>
                                    </td>  
                                   <td><button type="button" name="add" id="add" class="btn btn-info" ><i class="fa fa-plus"></i></button></td>   
                             </tr>  
                        </table>  
                        <div class="form-actions">
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
              var i=1; 
              var increment = true;


            // date 
             $('#date').val(today);

            //add new row
             $('#add').click(function(){  
                  i++;  
                  $('#dynamic_field').append('<tr id="row'+i+'"><td>Item<input  id="it'+i+'" type="text" name="item[]" placeholder="enter item" class="form-control" /><div id="clientList"></div></td><td>Quantity<input type="textate" name="quantity[]" placeholder="enter quantity" class="form-control" /></td><td>Unit <select name="unit[]" class = "form-control"><option></option><option>kg</option><option>كرتونه</option></select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-remove"></i></button></td></tr>');  
             });   
            

            //remove single
             $(document).on('click', '.btn_remove', function(){  
                  var button_id = $(this).attr("id");   
                  $('#row'+button_id+'').remove();  
             });

            //add new row
              $('#addMore').click(function(){  
             i++;  
             $('#dynamic_field').append('<tr id="row'+i+'"><td>Item<input type="text" name="item[]" id="it'+i+'" placeholder="enter item" class="form-control" required /></td><td>Quantity<input type="textate" name="quantity[]" placeholder="enter quantity" class="form-control" required/></td><td>Unit <select name="unit[]" class = "form-control" required><option></option><option>kg</option><option>كرتونه</option></select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-remove"></i></button></td></tr>');  
             });  
            

             //remove all  
           $('#RemoveAll').click(function() {
           $('#dynamic_field').empty(); 
        });
   
       
       //search clients
       $('#client_name').on('keyup',function(){
           $value=$(this).val();
           if($value != '')
       {

           $.ajax({
               type : 'get',
               url : '{{URL::to('/search')}}',
               data:{'search':$value},
               success:function(data){
                $('#clientList').fadeIn();  
                $('#clientList').html(data);
                }
                     });
                }
        });
              $(document).on('click', '.clients', function(){  
                  $('#client_name').val($(this).text());  
                   $('#clientList').fadeOut();  
                   }); 

                   $('#clientList').hover(
                       function(){
                        $('#clientList').show();
                         },
                         function(){
                            $('#clientList').hide();
                             });

  
     });
        </script>
@endsection