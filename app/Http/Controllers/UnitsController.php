<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use  App\Http\Requests;
use DB;
use Session;
session_start();

class UnitsController extends Controller
{
    public function index () {
        return view('admin.add-unit');
    }

    public function store (Request $request) {
     $data = array();
     $data['unit_name'] = $request->unit_name;
     DB::table('units')->insert($data);
    //  Session::put('done','unit added succefully');
     return Redirect::to('/add-unit');
     
    }
    public function allUnits () {
      $allUnits = DB::table('units')
      ->select('id','unit_name')
      ->get();
      $manageUnits = view('admin.all-units')
      ->with('allUnits',$allUnits);
      return view ('admin_layout')->with('admin.all-units',$manageUnits);
    }
    public function delete_unit (Request $request) {
        $unit_id = $request->unit_id; 
        $allUnits = DB::table('units')
        ->where('id',$unit_id)
        ->delete();
        Session::put('success','unit deleted succefully');
        return Redirect::to('/all-units');
      }

      public function show_unit ($unit_id) {
        $singleUnit = DB::table('units')
        ->where('id',$unit_id)
        ->first();
        $viewed_unit = view('admin.show-unit')
        ->with('singleUnit',  $singleUnit );

        return view ('admin_layout') 
        ->with('admin.show-unit',$viewed_unit);
      }
      public function edit_unit ($unit_id) {
        $singleUnit = DB::table('units')
        ->where('id',$unit_id)
        ->first();

        $edited_unit = view('admin.edit-unit')
        ->with('singleUnit',  $singleUnit );

        return view ('admin_layout') 
        ->with('admin.edit-unit',$edited_unit);
      }
      public function update_unit (Request $request,$unit_id) {
       $data = array();
       $data['unit_name'] = $request->unit_name;
       DB::table('units')
       ->where('id',$unit_id)
       ->update($data);
       Session::put('message','unit updated successfully!!');
       return Redirect::to('/all-units');
      }

}
