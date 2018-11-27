<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use  App\Http\Requests;
use DB;
use Session;
session_start();

class OrdersController extends Controller
{
    public function index () {
        return view('admin.add-order');
    }

    public function allOrders () {
        $all_orders = DB::table('orders')
        ->join('client','orders.client_id','=','client.client_id')
        ->select('orders.order_id','orders.order_date','client.client_name')
        ->get(); 
        $manage_orders = view('admin.all-order')
        ->with('all_orders',$all_orders);
        return view ('admin_layout')->with('admin.all-order',$manage_orders);

    }

    public function show_order ($order_id){

        $single_order = DB::table('orders_item')
        ->join('orders','orders.order_id','=','orders_item.id')
        ->join('items','orders_item.item_id','=','items.item_id')
        ->select('orders.order_id','items.item_name','items.item_price','items.item_unit','orders_item.quantity','orders.order_no','orders.client_id','orders.order_date')
        ->where('id',$order_id)
        ->get();
        
        $orders_info = DB::table('orders')
        ->join('client','orders.client_id','=','client.client_id')
        ->select('order_date','client.client_name','order_no')
        ->where('order_id',$order_id)
        ->get();

        $viewed_order = view('admin.show-order')
        ->with(['single_order'=> $single_order,
                 'orders_info'=>$orders_info
               ]);
        return view ('admin_layout') 
        ->with('admin.show-order',$viewed_order);


    }
    public function delete_order (Request $request) {
        $order_id = $request->order_id;
        DB::table('orders')
        ->where('order_id',$order_id)
        ->delete();
        Session::put('message','order deleted succefully');
         return Redirect::to('/all-orders');
        }

        public function search_client (Request $request){
            {
                   $query = $request->get('term','');
                    $clients=DB::table('client');
                    if($request->type =='clientname'){
                        $clients->where('client_name','LIKE','%'.$query.'%');
                    }
                    if($request->type =='clientcode'){
                        $clients->where('code','LIKE','%'.$query.'%');
                    }
                    $clients=$clients->get();  
                    $data=array(); 
                    foreach ($clients as $client) {
                        $data[]=array('client_name'=>$client->client_name,'client_code'=>$client->code);
                }  
                            if(count($data))
                            return $data;
                    else
                        return ['client_name'=>'','client_code'=>''];
                        
                    }
                }
                        public function store (Request $request){
                      
                            //insert client info and date and order number
                            $client_id = DB::table('client')
                            ->where('client_name', $request->client_name)
                             ->get();
                            foreach ($client_id as $id) {
                            $current_client = $id->client_id;
                            }
                            $data = array();
                            $data['client_id'] =  $current_client;
                            $data['code'] = $request->client_code;
                            $data['order_date'] = $request->order_date;
                            $data['order_no'] = $request->order_no;
                            $lastId = DB::table('orders')->insertGetId(['order_date'=>$request->order_date,'client_id'=>$current_client,'order_no'=>$request->order_no]);
                           
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
                                    $ordersData = array(
                                    array('id' => $lastId,
                                    'item_id' =>  $itemsid[$i],
                                    'code'=>$itemscode[$i],
                                    'quantity' => $baseUnit[$i],
                                    'unit' => $result->unit_id  )
                                    );
                                    DB::table('orders_item')->insert( $ordersData );
                                    }
                                }
                            }
                            Session::put('success','order added succefully');
                            return Redirect::to('/add-order');
                        }
                        
                        public function edit_order($order_id){

                            $single_order = DB::table('orders_item')
                            ->join('orders','orders.order_id','=','orders_item.id')
                            ->join('items','orders_item.item_id','=','items.item_id')
                            ->join('client','orders.client_id','=','client.client_id')
                            ->select('orders.order_id','items.item_id','items.item_name','items.code','items.item_unit','orders_item.quantity','orders.client_id','orders.order_date','client.client_name','client.code as client_code')
                            ->where('id',$order_id)
                            ->get();
                            
                            $viewed_order = view('admin.edit-order')
                            ->with('single_order', $single_order);
                            return view ('admin_layout') 
                            ->with('admin.edit-order',$viewed_order);
                    
                        }
                        public function update_order (Request $request){

                            //order id
                            $order_id = $request->order_id;
                            //insert client info and date and order number
                            $client_id = DB::table('client')
                            ->where('client_name', $request->client_name)
                             ->get();
                            foreach ($client_id as $id) {
                            $current_client = $id->client_id;
                            }
                            $data = array();
                            $data['client_id'] =  $current_client;
                            $data['order_date'] = $request->order_date;
                            DB::table('orders')
                            ->where('order_id', $order_id)
                            ->update($data);

                           DB::table('orders_item')
                           ->where('id',  $order_id)
                           ->delete();


                            $itemsid = $request->id;
                            $itemscode = $request->code;
                            $quantities = $request->quantity;
                            $units = $request->unit;
                            $numbers = count( $quantities);
                                   
                                    if($numbers>0){
                                    for($i=0; $i<$numbers; $i++){
                                    $ordersData = array(
                                    array(
                                    'id'=>$order_id,
                                    'item_id' =>  $itemsid[$i],
                                    'code' =>  $itemscode[$i],
                                    'quantity' => $quantities[$i],
                                    'unit' => $units[$i]
                                    )
                                    );
                                    DB::table('orders_item')
                                    ->insert( $ordersData );
                                    }
                                  
                                }
                            
                            Session::put('success','order edited succefully');
                            return Redirect::to('/all-order');
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
                                return ['item_name'=>'','code'=>'','id'=>'','unit'=>''];
                        }
                    
         
            }
