<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use  App\Http\Requests;
use DB;
use Session;
 session_start();

class ClientController extends Controller
{
    public function index () {
        return view('admin.add-client');
    }
    public function store (Request $request) {
       
            $data = array();
            $data['client_name'] = $request->client_name;
            $data['client_description'] = $request->client_description;
 
                DB::table('client')->insert($data);
                Session::put('message','client added succefully ');
                return Redirect::to('/add-client');
        
    }
    public function all_clients (){
            
        $all_clients = DB::table('client')
        ->get(); 
        $manage_clients = view('admin.all-client')
        ->with('all_clients',$all_clients);
        return view ('admin_layout')->with('admin.all-client',$manage_clients);
          }
          public function edit_client ($client_id) {
      
            $single_client= DB::table('client')
            ->where('client_id',$client_id)
            ->first();
            $edited_client = view('admin.edit-client')
            ->with('single_client', $single_client );
            return view ('admin_layout') 
            ->with('admin.edit-client',$edited_client);
           
  
            }

            public function update_client(Request $request,$client_id)
            {
                 $data=array();
                 $data['client_name']=$request->client_name;
                 $data['client_id']=$request->client_id;
                 $data['client_description'] = $request->client_description;
            DB::table('client')
            ->where('client_id',$client_id)
            ->update($data);
            Session::put('message','client updated successfully!!');
                return Redirect::to('/all-client');
            }
            public function show_client ($client_id){

                $single_client= DB::table('client')
                ->where('client_id',$client_id)
                ->first();
                $viewed_client = view('admin.show-client')
                ->with('single_client', $single_client );
                return view ('admin_layout') 
                ->with('admin.show-client',$viewed_client);


            }

            public function delete_client (Request $request) {
                $client_id = $request->client_id;
                DB::table('client')
                ->where('client_id',$client_id)
                ->delete();
                Session::put('message','client deleted succefully');
                 return Redirect::to('/all-client');
                }
                 public function search_client(Request $request)
                 {
                     if($request->ajax())
                     {
                          $data = array();
                           $clients = DB::table('client')
                           ->where('client_name', 'LIKE', $request->client_name."%")
                           ->get();
                            if($clients){
                                foreach($clients as $client)
                                {
                                     array_push($data,$client->client_name);
                                    }
                                }
                            }
                            return json_encode($data);
                        }
                    }