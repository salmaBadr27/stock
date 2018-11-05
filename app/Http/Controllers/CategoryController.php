<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use  App\Http\Requests;
use DB;
use Session;
session_start();

class CategoryController extends Controller
{
    public function index () {
        return view('admin.add-category');
    }
   
    public function store (Request $request){
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['parent_category'] = $request->parent_id;
        $data['category_description'] = $request->category_description;

        //upload category image
       $image = $request->file('category_image'); //return true or false
        if($image){
        $image_name = str_random(20); //generate rrandom image name
        $ext = strtolower($image->getClientOriginalExtension()); //get image extension
        $upload_path = 'backend/img/category/'; //distenation tostore image
        $image_full_name =  $image_name.'.'.$ext; //image full name
        $image_url =  $upload_path.$image_full_name ; //image url
        $moved_to_dist = $request->file('category_image')->move($upload_path , $image_full_name); //return true if moved to dis
        if($moved_to_dist){
             $data['category_image'] =  $image_url; 
            DB::table('categories')->insert($data);
            Session::put('message','category added succefully');
            return Redirect::to('/add-category');
        }
        }
        $data['category_image'] = '';
            DB::table('categories')->insert($data);
            Session::put('message','category added succefully without image');
            return Redirect::to('/add-category');
    }
    public function all_categories (){
            
        $all_categories = DB::table('categories')
        ->get();
        $manage_categories = view('admin.all-category')
        ->with('all_categories',$all_categories);
        return view ('admin_layout')->with('admin.all-category',$manage_categories);
          }

          public function show_category ($category_id){

            $single_category= DB::table('categories')
             ->join('categories as cat', 'categories.category_id', '=', 'cat.parent_category')
             ->select('cat.category_name as sub_category','cat.category_image as image','categories.category_description')
             ->where('cat.parent_category',$category_id)
             ->get();
            $viewed_category = view('admin.show-category')
            ->with('single_category', $single_category);
            return view ('admin_layout') 
            ->with('admin.show-category',$viewed_category);


        }
        public function delete_category (Request $request) {
           $category_id = $request->category_id;
           $parents = DB::table('categories')
            ->where('parent_category',$category_id)
            ->get();
            if(count($parents)>0){
            $parent_msg = 'there is sub categories in this category move them first';
            return redirect()->back()->with('alert', $parent_msg );
        }
        $items = DB::table('items')
        ->where('category_id',$category_id)
        ->get();

       if(count($items) > 0) {
        $item_msg ='there is items in this category move them first';
        return redirect()->back()->with('danger', $item_msg);
     }
            else{
            DB::table('categories')
            ->where('category_id',$category_id)
            ->delete();
            $success_msg ='category deleted succefully';
            return redirect()->back()->with('success', $success_msg);
            }
        }
          
            public function edit_category ($category_id) {
      
                $single_category= DB::table('categories')
                ->where('category_id',$category_id)
                ->first();
                $edited_category = view('admin.edit-category')
                ->with('single_category', $single_category );
                return view ('admin_layout') 
                ->with('admin.edit-category',$edited_category);
               
      
                }
                public function update_category(Request $request,$category_id)
                {
                     $data=array();
                     $data['category_name']=$request->category_name;
                     $data['parent_category']=$request->category_id;
                     $data['category_description'] = $request->category_description;

                    $image=$request->file('category_image');
                if ($image) {
                   $image_name=str_random(20);
                   $ext=strtolower($image->getClientOriginalExtension());
                   $image_full_name=$image_name.'.'.$ext;
                   $upload_path='backend/img/category/';
                   $image_url=$upload_path.$image_full_name;
                   $success=$image->move($upload_path,$image_full_name);
                   if ($success) {
                     $data['category_image']=$image_url;
                        DB::table('categories')
                        ->where('category_id',$category_id)
                        ->update($data);
                        Session::put('message','category updated successfully!!');
                        return Redirect::to('/all-category');
                   }
                }
                DB::table('categories')
                ->where('category_id',$category_id)
                ->update($data);
                Session::put('message','category updated successfully!!');
                    return Redirect::to('/all-category');
                }

                public function show_sub_category ($category_id){

                    $single_category= DB::table('categories')
                     ->join('categories as cat', 'categories.category_id', '=', 'cat.parent_category')
                     ->select('cat.category_name as sub_category','cat.category_image as image','categories.category_description')
                     ->where('cat.parent_category',$category_id)
                     ->get();
                    $viewed_category = view('admin.show-category')
                    ->with('single_category', $single_category);
                    return view ('admin_layout') 
                    ->with('admin.show-category',$viewed_category);
        
        
                }
}
