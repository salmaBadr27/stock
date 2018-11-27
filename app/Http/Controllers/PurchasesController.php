<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use  App\Http\Requests;
use DB;
use Session;
session_start();

class PurchasesController extends Controller
{
    public function index () {
        return view('admin.add-purchase');
    }
    public function search_supplier (Request $request){
        {
               $query = $request->get('term','');
                $suppliers=DB::table('supplier');
                if($request->type =='suppliername'){
                    $suppliers->where('supplier_name','LIKE','%'.$query.'%');
                }
                if($request->type =='suppliercode'){
                    $suppliers->where('code','LIKE','%'.$query.'%');
                }
                $suppliers=$suppliers->get();  
                $data=array(); 
                foreach ($suppliers as $supplier) {
                    $data[]=array('supplier_name'=>$supplier->supplier_name,'supplier_code'=>$supplier->code);
            }  
                        if(count($data))
                        return $data;
                else
                    return ['supplier_name'=>'','supplier_code'=>''];
                    
                }
            }
                    public function store (Request $request){

                        //insert supplier info and date and purchase number
                        $supplier_id = DB::table('supplier')
                        ->where('supplier_name', $request->supplier_name)
                         ->get();
                        foreach ($supplier_id as $id) {
                        $current_supplier = $id->supplier_id;
                        }
                        $data = array();
                        $data['supplier_id'] =  $current_supplier;
                        $data['code'] = $request->supplier_code;
                        $data['purchase_date'] = $request->purchase_date;
                        $data['purchase_no'] = $request->purchase_no;
                        $lastId = DB::table('purchases')->insertGetId(['purchase_date'=>$request->purchase_date,'supplier_id'=>$current_supplier,'purchase_no'=>$request->purchase_no]);
                       
                        $itemsid = $request->id;
                        $itemscode = $request->code;
                        $quantities = $request->quantity;
                        $units = $request->unit;

                        foreach($itemsid as $index => $id){
                            $result = DB::table('items')
                            ->where('item_id',$id)
                            ->first();
                        }

                        $baseUnit = array();
                        foreach($units as $index => $unit_id ){
                            if( $unit_id == $result->unit_id){
                                $baseUnit[$index] = $quantities[$index];
                            }
                            else{
                            $baseUnit[$index] = $quantities[$index]/$result->to_unit;
                                
                            }
                        }

                        $numbers = count( $quantities);
                               if($lastId){
                                if($numbers>0){
                                for($i=0; $i<$numbers; $i++){
                                $purchasesData = array(
                                array('id' => $lastId,
                                'item_id' =>  $itemsid[$i],
                                'code'=>$itemscode[$i],
                                'quantity' => $quantities[$i],
                                'unit' =>  $units[$i])
                                );
                                DB::table('purchases_item')->insert( $purchasesData );
                                }
                            }
                        }
                        Session::put('success','purchase added succefully');
                        return Redirect::to('/add-purchase');
                    }
                    public function searchResponse(Request $request){
                        $query = $request->get('term','');
                        $items=DB::table('items')
                        ->join('units as base','items.unit_id','=','base.id')
                        ->join('units as part','items.part_unit_id','=','part.id')
                        ->select('items.*','base.unit_name as Base','part.unit_name as Part');

                        if($request->type =='itemname'){
                            $items->where('item_name','LIKE','%'.$query.'%');
                        }
                        if($request->type =='code'){
                            $items->where('code','LIKE','%'.$query.'%');
                        }
                           $items=$items->get();        
                        $data=array();
                        foreach ($items as $item) {
                            $data[]=array('item_name'=>$item->item_name,'code'=>$item->code,'id'=>$item->item_id,'units'=>['base'=>$item->Base,'part'=>$item->Part,'baseId'=>$item->unit_id,'partId'=>$item->part_unit_id]);
                        }
                        if(count($data))
                             return $data;
                        else
                                return ['item_name'=>'','code'=>'','id'=>'','units'=>''];
                    }

                    public function allPurchases () {
                        $all_purchases = DB::table('purchases')
                        ->join('supplier','purchases.supplier_id','=','supplier.supplier_id')
                        ->select('purchases.purchase_id','purchases.purchase_date','supplier.supplier_name')
                        ->get(); 
                        $manage_purchases = view('admin.all-purchase')
                        ->with('all_purchases',$all_purchases);
                        return view ('admin_layout')->with('admin.all-purchase',$manage_purchases);
                    }
                    public function delete_purchase (Request $request) {
                        $purchase_id = $request->purchase_id;
                        DB::table('purchases')
                        ->where('purchase_id',$purchase_id)
                        ->delete();
                        Session::put('message','purchase deleted succefully');
                         return Redirect::to('/all-purchase');
                        }
                        public function show_purchase ($purchase_id){

                            $single_purchase = DB::table('purchases_item')
                            ->join('purchases','purchases.purchase_id','=','purchases_item.id')
                            ->join('items','purchases_item.item_id','=','items.item_id')
                            ->select('purchases.purchase_id','items.item_name','items.item_price','items.item_unit','purchases_item.quantity','purchases.purchase_no','purchases.supplier_id','purchases.purchase_date')
                            ->where('id',$purchase_id)
                            ->get();
                            
                            $purchases_info = DB::table('purchases')
                            ->join('supplier','purchases.supplier_id','=','supplier.supplier_id')
                            ->select('purchase_date','supplier.supplier_name','purchase_no')
                            ->where('purchase_id',$purchase_id)
                            ->get();
                    
                            $viewed_purchase = view('admin.show-purchase')
                            ->with(['single_purchase'=> $single_purchase,
                                     'purchases_info'=>$purchases_info
                                   ]);
                            return view ('admin_layout') 
                            ->with('admin.show-purchase',$viewed_purchase);
                        }
                        public function edit_purchase($purchase_id){

                            $single_purchase = DB::table('purchases_item')
                            ->join('purchases','purchases.purchase_id','=','purchases_item.id')
                            ->join('items','purchases_item.item_id','=','items.item_id')
                            ->join('supplier','purchases.supplier_id','=','supplier.supplier_id')
                            ->select('purchases.purchase_id','items.item_id','items.item_name','items.code','items.item_unit','purchases_item.quantity','purchases.supplier_id','purchases.purchase_date','supplier.supplier_name','supplier.code as supplier_code')
                            ->where('id',$purchase_id)
                            ->get();
                            
                            $viewed_purchase = view('admin.edit-purchase')
                            ->with('single_purchase', $single_purchase);
                            return view ('admin_layout') 
                            ->with('admin.edit-purchase',$viewed_purchase);
                    
                        }
                        public function update_purchase (Request $request){

                            //purchase id
                            $purchase_id = $request->purchase_id;
                            //insert supplier info and date and purchase number
                            $supplier_id = DB::table('supplier')
                            ->where('supplier_name', $request->supplier_name)
                             ->get();
                            foreach ($supplier_id as $id) {
                            $current_supplier = $id->supplier_id;
                            }
                            $data = array();
                            $data['supplier_id'] =  $current_supplier;
                            $data['purchase_date'] = $request->purchase_date;
                            DB::table('purchases')
                            ->where('purchase_id', $purchase_id)
                            ->update($data);

                           DB::table('purchases_item')
                           ->where('id',  $purchase_id)
                           ->delete();


                            $itemsid = $request->id;
                            $itemscode = $request->code;
                            $quantities = $request->quantity;
                            $units = $request->unit;
                            $numbers = count( $quantities);
                                   
                                    if($numbers>0){
                                    for($i=0; $i<$numbers; $i++){
                                    $purchasesData = array(
                                    array(
                                    'id'=>$purchase_id,
                                    'item_id' =>  $itemsid[$i],
                                    'code' =>  $itemscode[$i],
                                    'quantity' => $quantities[$i],
                                    'unit' => $units[$i]
                                    )
                                    );
                                    DB::table('purchases_item')
                                    ->insert( $purchasesData );
                                    }
                                  
                                }
                            
                            Session::put('success','purchase updated succefully');
                            return Redirect::to('/all-purchase');
                        }

                    
}
