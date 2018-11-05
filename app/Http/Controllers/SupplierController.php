<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use  App\Http\Requests;
use DB;
use Session;
session_start();

class SupplierController extends Controller
{
    public function index () {
        return view('admin.add-supplier');
    }
    public function store (Request $request) {
       
        $data = array();
        $data['supplier_name'] = $request->supplier_name;
        $data['supplier_description'] = $request->supplier_description;

            DB::table('supplier')->insert($data);
            Session::put('message','supplier added succefully ');
            return Redirect::to('/add-supplier');
    
}
public function all_suppliers (){
            
    $all_suppliers = DB::table('supplier')
    ->get(); 
    $manage_suppliers = view('admin.all-supplier')
    ->with('all_suppliers',$all_suppliers);
    return view ('admin_layout')->with('admin.all-supplier',$manage_suppliers);
      }

      public function edit_supplier ($supplier_id) {
  
        $single_supplier= DB::table('supplier')
        ->where('supplier_id',$supplier_id)
        ->first();
        $edited_supplier = view('admin.edit-supplier')
        ->with('single_supplier', $single_supplier );
        return view ('admin_layout') 
        ->with('admin.edit-supplier',$edited_supplier);
       

        }
        public function update_supplier(Request $request,$supplier_id)
        {
             $data=array();
             $data['supplier_name']=$request->supplier_name;
             $data['supplier_id']=$request->supplier_id;
             $data['supplier_description'] = $request->supplier_description;
        DB::table('supplier')
        ->where('supplier_id',$supplier_id)
        ->update($data);
        Session::put('message','supplier updated successfully!!');
            return Redirect::to('/all-supplier');
        }
        public function show_supplier ($supplier_id){

            $single_supplier= DB::table('supplier')
            ->where('supplier_id',$supplier_id)
            ->first();
            $viewed_supplier = view('admin.show-supplier')
            ->with('single_supplier', $single_supplier );
            return view ('admin_layout') 
            ->with('admin.show-supplier',$viewed_supplier);


        }

        public function delete_supplier (Request $request) {
            $supplier_id = $request->supplier_id;
            DB::table('supplier')
            ->where('supplier_id',$supplier_id)
            ->delete();
            Session::put('message','supplier deleted succefully');
             return Redirect::to('/all-supplier');
            }


}
