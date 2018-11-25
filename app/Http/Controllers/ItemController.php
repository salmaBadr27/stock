<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use  App\Http\Requests;
use DB;
use Session;
session_start();

class ItemController extends Controller
{
    public function index () {
        return view('admin.add-item');
    }

     public function store (Request $request){
            $data = array();
            $data['item_name'] = $request->item_name;
            $data['code'] = $request->code;
            $data['category_id'] = $request->category_id;
            $data['item_price'] = $request->item_price;
            $data['unit_id']=$request->unit_id;
            $data['to_unit']=$request->to_unit;
            $data['part_unit_id']=$request->part_unit_id;

           //validate if code is unique
            $ifcodeExist = DB::table('items')
            ->select('code')
            ->where('code',$request->code)
            ->get();

            if(count($ifcodeExist)){
                foreach($ifcodeExist as $code){
                   if($code->code == $request->code){
               $code_msg ='item code must be unique';
               return redirect()->back()->with('danger', $code_msg);
                   }
                }
           }

            //upload item image
           $image = $request->file('item_image'); //return true or false
            if($image){
            $image_name = str_random(20); //generate rrandom image name
            $ext = strtolower($image->getClientOriginalExtension()); //get image extension
            $upload_path = 'backend/img/items/'; //distenation tostore image
            $image_full_name =  $image_name.'.'.$ext; //image full name
            $image_url =  $upload_path.$image_full_name ; //image url
            $moved_to_dist = $request->file('item_image')->move($upload_path , $image_full_name); //return true if moved to dis
            if($moved_to_dist){
                 $data['item_image'] =  $image_url; 
                DB::table('items')->insert($data);
                Session::put('message','item added succefully');
                return Redirect::to('/add-item');
            }
            }
            $data['item_image'] = '';
                DB::table('items')->insert($data);
                Session::put('message','item added succefully without image');
                return Redirect::to('/add-item');
        }
        public function all_items (){
            
            $all_items = DB::table('items')
            ->join('categories','items.category_id','=','categories.category_id')
            ->join('units as base','items.unit_id','=','base.id')
            ->join('units as part','items.part_unit_id','=','part.id')
            ->select('items.*','categories.category_name','base.id as Base Unit','part.id as Part Unit')
            ->get(); 
            $manage_items = view('admin.all-item')
            ->with('all_items',$all_items);
            return view ('admin_layout')->with('admin.all-item',$manage_items);
              }

              public function delete_item (Request $request) {
                $item_id = $request->item_id;
                DB::table('items')
                ->where('item_id',$item_id)
                ->delete();
                Session::put('message','item deleted succefully');
                 return Redirect::to('/all-item');
                }
               
                public function delete_item_by_cat_id (Request $request) {
                    $category_id = $request->category_id;
                    DB::table('items')
                    ->where('category_id',$category_id)
                    ->delete();
                    Session::put('message','item deleted succefully');
                     return Redirect::to('/all-item');
                    }

                public function edit_item ($item_id) {
      
                    $single_item= DB::table('items')
                    ->join('categories','items.category_id','=','categories.category_id')
                    ->join('units as base','items.unit_id','=','base.id')
                    ->join('units as part','items.part_unit_id','=','part.id')
                    ->select('items.*','categories.category_name','base.id as Base Unit','part.id as Part Unit')
                    ->where('item_id',$item_id)
                    ->first();
                    $edited_item = view('admin.edit-item')
                    ->with('single_item', $single_item );
                    return view ('admin_layout') 
                    ->with('admin.edit-item',$edited_item);
                    }

                    public function move_item ($category_id) {
                        $single_item = DB::table('items')
                        ->join('categories','items.category_id','=','categories.category_id')
                        ->select('items.*','categories.category_name')
                        ->where('items.category_id',$category_id)
                        ->first();
                        $edited_item = view('admin.move-item')
                        ->with('single_item', $single_item );
                        return view ('admin_layout') 
                        ->with('admin.move-item',$edited_item);
                        }

                    public function update_item(Request $request,$item_id)
                    {
                         $data=array();
                         $data['item_name']=$request->item_name;
                         $data['code'] = $request->code;
                         $data['category_id']=$request->category_id;
                         $data['item_price']=$request->item_price;
                         $data['unit_id']=$request->unit_id;
                         $data['to_unit']=$request->to_unit;
                         $data['part_unit_id']=$request->part_unit_id;

                         $ifcodeExist = DB::table('items')
                         ->select('code')
                         ->where('code',$request->code)
                         ->get();

                         if(count($ifcodeExist)){
                             foreach($ifcodeExist as $code){
                                if($code->code == $request->code){
                            $code_msg ='item code must be unique';
                            return redirect()->back()->with('danger', $code_msg);
                                }
                             }
                        }
                        
                        $image=$request->file('item_image');
                    if ($image) {
                       $image_name=str_random(20);
                       $ext=strtolower($image->getClientOriginalExtension());
                       $image_full_name=$image_name.'.'.$ext;
                       $upload_path='backend/img/items/';
                       $image_url=$upload_path.$image_full_name;
                       $success=$image->move($upload_path,$image_full_name);
                       if ($success) {
                         $data['item_image']=$image_url;
                            DB::table('items')
                            ->where('item_id',$item_id)
                            ->update($data);
                            return Redirect::to('/all-item')->with('msg','item updated successfully!!');
                       }
                    }
                    DB::table('items')
                    ->where('item_id',$item_id)
                    ->update($data);
                    Session::put('message','item updated successfully!!');
                        return Redirect::to('/all-item');
                    }
                    public function update_item_by_cat (Request $request,$category_id)
                    {
                     $data=array();
                     $data['category_id']=$request->category_id;
                    DB::table('items')
                    ->where('category_id',$category_id)
                    ->update($data);
                    Session::put('message','item moved successfully!!');
                        return Redirect::to('/all-item');
                    }
                    public function show_item ($item_id){

                        $single_item= DB::table('items')
                        ->join('categories','items.category_id','=','categories.category_id')
                        ->join('units as base','items.unit_id','=','base.id')
                        ->join('units as part','items.part_unit_id','=','part.id')
                        ->select('items.*','categories.category_name','base.unit_name as BaseUnit','part.unit_name as PartUnit')
                        ->where('item_id',$item_id)
                        ->first();
                        $viewed_item = view('admin.show-item')
                        ->with('single_item', $single_item );
                        return view ('admin_layout') 
                        ->with('admin.show-item',$viewed_item);


                    }
                    public function show_item_by_category ($category_id){

                        $all_items = DB::table('items')
                        ->join('categories','items.category_id','=','categories.category_id')
                        ->select('items.*','categories.category_name')
                        ->where('items.category_id',$category_id)
                        ->get();

                        $viewed_item = view('admin.all-items-by-cat-id')
                        ->with('all_items',  $all_items );
                        return view ('admin_layout') 
                        ->with('admin.all-items-by-cat-id',$viewed_item);


                    }
                    public function search_item(Request $request)
                    {

                        if($request->ajax())
                        {
                            $item_name = $request->get('term',''); 
                             $data = array();
                             
                              $items = DB::table('items')
                              ->where('item_name', 'LIKE',$item_name."%")
                              ->get();
                               if($items){
                                   foreach($items as $item)
                                   {
                                        array_push($data,['item'=>$item->item_name]);
                                       }
                                   }
                               }
                               return json_encode($data);
                           }
              
}
