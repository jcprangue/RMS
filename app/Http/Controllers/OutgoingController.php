<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use PDF;
use \App\outgoing;
use \App\incoming;
use \App\category;
use \App\departments;
use \App\facategory;


class OutgoingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $arr_cat = explode(",",Auth::user()->category);
        $category = category::whereIN('id',$arr_cat)->orderby('category','ASC')->get();
        $departments = departments::orderby('dept_nick','ASC')->get();
        $incoming = incoming::whereIN('category',$arr_cat)->get();
        $facategory = facategory::all();



    	return view('outgoing.index',compact('category','departments','incoming','facategory'));
    }

    ####!important
    public function editdata(Request $r){
        $datas = outgoing::where('id',$r->id)->first();
        return $datas;
    }

     public function normalizeDate($data)
    {
        if ($data != null){
            $lstdate = explode(',',$data);
            $arr = [];
            foreach ($lstdate as  $value) {
                $date = explode("/",$value);
                $arr[date('Y',strtotime($value))][date('M',strtotime($value))][] = $date[1];
            }

             
            $arrdata = [];
            $strdate = '';
            foreach ($arr as $yearKey => $yearValue) {
                $name = "";
                
                foreach ($yearValue as $monthKey => $monthValue) {
                    $name = $monthKey;
                    

                    foreach ($monthValue as $dateKey => $dateValue) {
                        $name .= " " . $dateValue . ",";
                    }
                    
                        $arrdata[] = rtrim($name,",") . " " . $yearKey;
                    
                }
                
            }
            $strdate = implode(" | ",$arrdata);

        }else{
            $strdate = '';
        }

        return $strdate;
    }


    ####!important
    public function save(Request $r){


        if ($r->txtid == '' || $r->txtid == null){
            $docu = New outgoing;
        }else{
            $docu = outgoing::find($r->txtid);
        }
       
        $ext = category::find($r->txtcategory);
        $count_outgoing = outgoing::where('category',$r->txtcategory)->count();

        if ($count_outgoing){
            $control_num = $count_outgoing + 1;
        }else{
            $control_num = 1;
        }
        
        $docu->control_num = $ext->nick.'OUT-'.$control_num;


        // $docu->control_num = $control_num;
        // $docu->date_receive = $r->txtdate;
        $docu->office = $r->txtoffice;
        $docu->particulars = $r->txtparticulars;
        $docu->amount = $r->txtamount;
        $docu->check_no = $r->txtcheckno;
        $docu->payee = $r->txtpayee;
        $docu->supplier = $r->txtsupplier;
        $docu->date_leave = $r->txtdateleave;
        $docu->type_leave = $r->txttypeleave;
        $docu->category = $r->txtcategory;
        $docu->remarks = $r->txtremarks;
        $docu->fa_category = $r->txtfacategory;
        $docu->save();


        return json_encode('success');
    }


     ####!important
    public function saveadd(Request $r){
        // list($control,$part) = explode(" - ",$r->arrincoming);

        $idarr = explode(",",$r->arrincoming);
        
        foreach ($idarr as  $value) {

            $data = incoming::find($value);

            $docu = New outgoing;

            $ext = category::find($data->category);
            $count_outgoing = outgoing::where('category',$data->category)->count();

            if ($count_outgoing){
                $control_num = $count_outgoing + 1;
            }else{
                $control_num = 1;
            }
            
            $docu->control_num = $ext->nick.'OUT-'.$control_num;

            // $docu->control_num = $data->control_num;
            // $docu->date_receive = $r->txtoutdate;
            $docu->office = $data->office;
            $docu->particulars = $data->particulars;
            $docu->amount = $data->amount;
            $docu->category = $data->category;
            $docu->remarks = $r->txtremarks;
            $docu->check_no = $data->check_no;
            $docu->type_leave = $data->type_leave;
            $docu->date_leave = $data->date_leave;
            $docu->payee = $data->payee;
            $docu->supplier = $data->supplier;
            $docu->fa_category = $data->fa_category;
            $docu->save();

            $changestat = incoming::find($data->id);
            $changestat->status = 1;
            $changestat->save();

        }
        


        return json_encode('success');
    }

    ####!important
    public function delete(Request $r){
        $data = outgoing::find($r->id);
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->save();

        return json_encode('Success');
    }


     ####!important
    public function records(){
        $arr_cat = explode(",",Auth::user()->category);
        

        $data = outgoing::SELECT(DB::RAW('outgoings.*,category.category as category_name,departments.dept_nick'))
                         ->JOIN('category','outgoings.category','category.id')
                         ->JOIN('departments','outgoings.office','departments.id')
                         ->whereNull('deleted_at')
                         ->ORDERBY('created_at','DESC')
                         ->get();

        
        $arr = [];
        $x = 0;
        foreach ($data as $key => $value) {
            $x++;

            $btn = '';
            $btnfunc = '';
            if (Auth::user()->acl != 4){
                $btnfunc = '<button type="button" data-toggle="tooltip" data-placement="bottom" title="Edit Record" class="btn btn-primary btn-sm" onclick="editmode('.$value->id.')">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>
                                      
                                        <button type="button" data-toggle="tooltip" data-placement="bottom" title="Delete Record" class="btn btn-primary btn-sm" onclick="deletemode('.$value->id.')">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>';
            }

            $arr[] = array("number" => $x,
                           "id" => $value->id,
                           "control_num" => $value->control_num,
                           "date_receive" => date('M d, Y | h:i A',strtotime($value->created_at)),
                           "office" => $value->office,
                           "office_name" => $value->dept_nick,
                           "particulars" => '<a href="#" onclick="viewmode('.$value->id.')">'.$value->particulars.'</a>',
                           "category" => $value->category,
                           "category_name" => $value->category_name,
                           "amount" => $value->amount,
                           "amount_format" => number_format($value->amount,2),
                           "remarks" => $value->remarks,
                           "supplier" => $value->supplier,
                           "check_no" => $value->check_no,
                           "payee" => $value->payee,
                           "type_leave" => $value->type_leave,
                           "date_leave" => $this->normalizeDate($value->date_leave), 
                           "action" =>'<div class="btn-group" role="group" aria-label="Basic example">'.$btnfunc.$btn.'</div>',

                    );
        }

        return $arr;
    }

    
    public function filter(Request $r){
        $category = $r->cat_id;
        if ($r->cat_date == null){
            $datez = null;
        }else{
            $datez = $r->cat_date;
        }

        $office = $r->cat_lgu;
        $arr_cat = explode(",",Auth::user()->category);

        $data = outgoing::SELECT(DB::RAW('outgoings.*,category.category as category_name,departments.dept_nick,fa_category.type_fa'))
                         ->JOIN('category','outgoings.category','category.id')
                         ->LEFTJOIN('departments','outgoings.office','departments.id')
                         ->LEFTJOIN('fa_category','outgoings.fa_category','fa_category.id')
                         ->whereNull('deleted_at')
                         ->where(function ($query) use ($category,$arr_cat){
                            if ($category != 0){
                                $query->where('outgoings.category',$category);
                            }else{
                                $query->whereIN('outgoings.category',$arr_cat);
                         
                            }
                         }) 
                         ->where(function ($query) use ($office){
                            if ($office != 0){
                                $query->where('outgoings.office',$office);
                            }
                         }) 
                         ->where(function ($query) use ($datez){
                            if ($datez != null){
                                $query->whereDate('outgoings.created_at',$datez);
                            }
                         })
                        
                         // ->ORDERBY('created_at','DESC')
                         ->get();

        // dd($category);
     

        $arr = [];
        $x = 0;
        foreach ($data as $key => $value) {
            $x++;
            $btn = '';
            $btnfunc = '<button type="button" data-toggle="tooltip" data-placement="bottom" title="Edit Record" class="btn btn-primary btn-sm" onclick="editmode('.$value->id.')">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>
                                      
                                        <button type="button" data-toggle="tooltip" data-placement="bottom" title="Delete Record" class="btn btn-primary btn-sm" onclick="deletemode('.$value->id.')">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>';
            

            $arr[] = array("number" => $x,
                           "id" => $value->id,
                           "control_num" => $value->control_num,
                           "date_receive" => date('M d, Y | h:i A',strtotime($value->created_at)),
                           "office" => $value->office,
                           "office_name" => $value->dept_nick,
                           "particulars" => '<a href="#" onclick="viewmode('.$value->id.')">'.$value->particulars.'</a>',
                           "category" => $value->category,
                           "category_name" => $value->category_name,
                           "amount" => $value->amount,
                           "amount_format" => number_format($value->amount,2),
                           "remarks" => $value->remarks,
                           "supplier" => $value->supplier,
                           "check_no" => $value->check_no,
                           "payee" => $value->payee,
                           "type_leave" => $value->type_leave,
                           "date_leave" => $this->normalizeDate($value->date_leave),
                           "fa_category" => $value->type_fa,

                           "action" =>'<div class="btn-group" role="group" aria-label="Basic example">'.$btnfunc.$btn.'</div>',

                    );
        }

        return $arr;
    }





    public function print($id){
        list($cat_date,$cat_id,$cat_lgu,$cat_range)=explode("_",$id);

        $category = $cat_id;
        $data_cat = category::find($category);

        $arrnum = [];

        if ($cat_range != null){
            list($from,$to)=explode("@",$cat_range);
            list($prefixfrom,$fromnum)=explode("-",$from);
            list($prefixto,$tonum)=explode("-",$to);

            for ($i=$fromnum; $i <= $tonum; $i++) { 
                $arrnum[] = $prefixfrom .'-'.(int)$i;
            }

        }

        if ($cat_date == null){
            $datez = null;
        }else{
            $datez = $cat_date;
        }

        $office = $cat_lgu;
        $arr_cat = explode(",",Auth::user()->category);


        $data = outgoing::SELECT(DB::RAW('outgoings.*,category.category as category_name,departments.dept_nick,fa_category.type_fa'))
                         ->JOIN('category','outgoings.category','category.id')
                         ->LEFTJOIN('departments','outgoings.office','departments.id')
                         ->LEFTJOIN('fa_category','outgoings.fa_category','fa_category.id')
                         ->whereNull('deleted_at')
                         ->where(function ($query) use ($arrnum,$cat_range){
                            if ($cat_range != null){
                                $query->whereIN('outgoings.control_num',$arrnum);
                            }
                         }) 
                         ->where(function ($query) use ($category,$arr_cat){
                            if ($category != 0){
                                $query->where('outgoings.category',$category);
                            }else{
                                $query->whereIN('outgoings.category',$arr_cat);
                         
                            }
                         }) 
                         ->where(function ($query) use ($office){
                            if ($office != 0){
                                $query->where('outgoings.office',$office);
                            }
                         }) 
                         ->where(function ($query) use ($datez){
                            if ($datez != null){
                                $query->whereDate('outgoings.created_at',$datez);
                            }
                         })
                        
                         ->orderByRaw('CHAR_LENGTH(control_num)')
                         ->get();



        $arr = [];
        $x = 0;
        foreach ($data as $key => $value) {
            $btn = '';
            $btnfunc = '';
            if (Auth::user()->acl != 4){
                $btnfunc = '<button type="button" data-toggle="tooltip" data-placement="bottom" title="Edit Record" class="btn btn-primary btn-sm" onclick="editmode('.$value->id.')">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>
                                      
                                        <button type="button" data-toggle="tooltip" data-placement="bottom" title="Delete Record" class="btn btn-primary btn-sm" onclick="deletemode('.$value->id.')">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>';
            }


            if ($value->verified == null){
                if (Auth::user()->acl == 4 || Auth::user()->acl == 1){
                    $btn = '<button type="button" data-toggle="tooltip" data-placement="bottom" title="Verify Record" class="btn btn-danger btn-sm" onclick="verifydoc('.$value->id.')">Verify</button>';
                }else{
                    $btn = '<button type="button" data-toggle="tooltip" data-placement="bottom" title="Not Verify" class="btn btn-danger btn-sm">Not Verify</button>';
                }
            }else{
                $btn = '<button type="button" data-toggle="tooltip" data-placement="bottom" title="Verify Record" class="btn btn-success btn-sm" onclick="successdoc('.$value->id.')">Verified</button>';
            }


            $x++;

            $arr[] = array("number" => $x,
                           "id" => $value->id,
                           "control_num" => $value->control_num,
                           "date_receive" => $value->created_at,
                           "office" => $value->office,
                           "office_name" => $value->dept_nick,
                           "particulars" => $value->particulars,
                           "category" => $value->category,
                           "category_name" => $value->category_name,
                           "amount" => $value->amount,
                           "amount_format" => number_format($value->amount,2),
                           "remarks" => $value->remarks,
                           "supplier" => $value->supplier,
                           "check_no" => $value->check_no,
                           "payee" => $value->payee,
                           "type_leave" => $value->type_leave,
                           "date_leave" => $this->normalizeDate($value->date_leave),
                           "fa_category" => $value->type_fa,

                           "action" =>'<div class="btn-group" role="group" aria-label="Basic example">'.$btnfunc.$btn.'</div>',

                    );
        }

        if ($category == 23){
            $str_size = "LEGAL";
        }else{
            $str_size = "A4";

        }
        $pdf = PDF::loadview('outgoing.reports',compact('arr','datez','data_cat'));
        $pdf->setPaper($str_size, 'landscape');
        return $pdf->stream("Reports_".$datez.".pdf");
        // if ($category == 17){
        //     return view('outgoing.reports_fa',compact('arr','datez','data_cat','cat_date'));
        // }else{
        //     return view('outgoing.reports',compact('arr','datez','data_cat','cat_date'));
        // }

                         // return view('outgoing.reports',compact('arr','datez','data_cat'));
    }


    public function incomingdata(Request $r){

        $data = incoming::where('category',$r->id)
                        ->where('status',0)
                        ->whereNull('deleted_at')
                        ->get();

        return $data;
    }

}
