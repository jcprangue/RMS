<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use PDF;
use \App\incoming;
use \App\outgoing;

use \App\category;
use \App\departments;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function debug()
    {
        $data = outgoing::where('control_num','LIKE','%CHKIN%')->get();
        
        foreach ($data as $key => $value) {
            $rewrite = outgoing::find($value->id);
            list($code,$num)=explode("-",$value->control_num);
            $rewrite->control_num = 'CHKOUT-'.$num;
            $rewrite->save();    
        }



    }


    public function index()
    {
        
        return view('home');
    }

    public function getnumdoc(){
        $allincoming = incoming::count();
        $alloutgoing = outgoing::count();
        $all = $allincoming + $alloutgoing;

       
        $arr = array('all'=>number_format($all),
                     'incoming'=>number_format($allincoming),
                     'outgoing'=>number_format($alloutgoing),

                );

        return $arr;
    }

    public function getdata(){
        
        $month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        $month_date = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        foreach ($month_date as $key => $value) {

            $str_date = date('Y-'.$value);
            $incoming_doc = incoming::where('date_receive','LIKE',$str_date.'%')->whereNull('deleted_at')->count();
            $incoming_arr[] = $incoming_doc;
        
        }

        
        $gen_arr = array('label'=>$month,
                         'values'=>$incoming_arr,
                         'title'=>'Number of Incoming per Month '
                    );


        return $gen_arr;

    }


   public function getdataout(){
        
        $month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        $month_date = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        foreach ($month_date as $key => $value) {

            $str_date = date('Y-'.$value);
            $outgoing_doc = outgoing::where('date_receive','LIKE',$str_date.'%')->whereNull('deleted_at')->count();
            $outgoint_arr[] = $outgoing_doc;
        
        }

        
        $gen_arr = array('label'=>$month,
                         'values'=>$outgoint_arr,
                         'title'=>'Number of Outgoing per Month '
                    );


        return $gen_arr;

    }

    public function accessdenied(){
        return view('denied');
    }


}
