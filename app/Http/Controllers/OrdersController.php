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
    public function delete_order ($order_id) {

        DB::table('orders')
        ->where('order_id',$order_id)
        ->delete();
        Session::put('message','order deleted succefully');
         return Redirect::to('/all-orders');
        }

        public function search_client (Request $request){
            {
                $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
                if($request->ajax()){
                    $clients=DB::table('client')
                    ->where('client_name','LIKE','%'.$request->client."%")
                    ->get();
                     if($clients){
                         foreach ($clients as $client) {
                              $output.= '<li class="clients"><a href="#">'.$client->client_name.'</a></li>';
                             }
                            echo $output;
                            }
                            else {
                                $output.='<li><a href="#">no result founds</a></li>';
                                echo $output;
                            }
                        }
                    }
                }
                public function search_item (Request $request){
                    {
                        $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
                        if($request->ajax()){
                            $items=DB::table('items')
                            ->where('item_name','LIKE','%'.$request->item."%")
                            ->get();
                             if($items){
                                 foreach ($items as $item) {
                                      $output.= '<li class="items"><a href="#">'.$item->item_name.'</a></li>';
                                     }
                                    echo $output;
                                    }
                                    else {
                                        $output.='<li><a href="#">no result founds</a></li>';
                                        echo $output;
                                    }
                                }
                            }
                        }

                        public function store (Request $request){


                            //insert client info and date and order number
                            $client_id = DB::table('client')
                            ->where('client_name','=',$request->client_name)
                            ->get();
                            $current_client;
                            foreach ($client_id as $id) {
                               $current_client = $id->client_id;
                            }
                           
                            $data = array();
                            $data['order_date'] = $request->order_date;
                            $data['order_no'] = $request->order_no;
                            $data['client_id'] =  $current_client;
                            DB::table('orders')->insert($data);
                           
                            Session::put('message','order added succefully');
                            return Redirect::to('/add-order');
                        }
         
            }
