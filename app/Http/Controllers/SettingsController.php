<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use \App\documents;
use \App\category;
use \App\city;
use \App\doc_update;
use \App\doc_add_info;
use \App\contractor;
use \App\outgoing;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
       	$category = category::all();
       	$contractor = contractor::all();

    	return view('settings.index',compact('category','contractor'));
    }

    public function deletecat(Request $r){
    	$data = category::find($r->id)->delete();

    	return json_encode("Success");

    }

	public function deletecontractor(Request $r){
    	$data = contractor::find($r->id)->delete();

    	return json_encode("Success");

    }


}
