<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use  App\Http\Requests;
use DB;
use Session;
 session_start();

class AdminController extends Controller
{
    public function index(){
         $this->AdminAuthCheck();  
        return view('admin.dashboard');
       }
       public function loginAction (Request $request){
   
        $user_name = $request->user_name;
        $password = md5($request->password);
        $result = DB::table('admin')
                ->where('admin_email',$user_name)
                ->where('admin_password',$password)
                ->first();
              
                if($result){
                    Session::put('admin_email',$result->admin_email);
                    Session::put('admin_id',$result->admin_id);
                  return  Redirect::to('/dashboard');
                }
                else {
                    Session::put('message','email or password not valid');
                    return Redirect::to('/login-form');
                    
                }
            
       }
       public function loginForm() {
        return view('admin.login-form');
        }
        public function AdminAuthCheck() {
            $admin = Session::get('admin_id');
            if($admin){
              return;
            }     else{
              return Redirect::to('/login-form')->send();
            }
        }
            public function logout() {
 
                Session::flush(); //destroy session of user {delete user name and id from session}
         
              return Redirect::to('/login-form');
              }
            
}
