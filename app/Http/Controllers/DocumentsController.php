<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use PDF;
use \App\incoming;
use \App\category;
use \App\departments;
use \App\facategory;


class DocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    ####!important
    public function index(){
	    $arr_cat = explode(",",Auth::user()->category);
        $category = category::whereIN('id',$arr_cat)->orderby('category','ASC')->get();
    	$departments = departments::orderby('dept_nick','ASC')->get();
        $facategory = facategory::all();
               

    	return view('document.index',compact('category','departments','facategory'));

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
    public function edit(Request $r){


        $datas = incoming::where('id',$r->id)->first();
        return $datas;
    }


    ####!important
    public function save(Request $r){

        $ext = category::find($r->txtcategory);
        
        if ($r->txtid == '' || $r->txtid == null){
            $docu = New incoming;

            $count_incoming = incoming::where('category',$r->txtcategory)->count();

            if ($count_incoming){
                $control_num = $count_incoming + 1;
            }else{
                $control_num = 1;
            }

            $docu->control_num = $ext->nick.'-'.$control_num;
        }else{
            $docu = incoming::find($r->txtid);
        }
       
       

        // $docu->date_receive = $r->txtdate;
        $docu->office = $r->txtoffice;
        $docu->particulars = $r->txtparticulars;
        $docu->amount = $r->txtamount;
        $docu->check_no = $r->txtcheckno;
        $docu->payee = $r->txtpayee;
        $docu->supplier = $r->txtsupplier;
        $docu->category = $r->txtcategory;
        $docu->remarks = $r->txtremarks;
        $docu->date_leave = $r->txtdateleave;
        $docu->type_leave = $r->txttypeleave;
        $docu->fa_category = $r->txtfacategory;

        $docu->save();

        $arr = array('Message'=>'Success','Data'=>$docu);
        return json_encode($arr);
    }

    ####!important
    public function delete(Request $r){
        $data = incoming::find($r->id);
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->save();

        return json_encode('Success');
    }


    ####!important
    public function records(){
        $arr_cat = explode(",",Auth::user()->category);

    	$data = incoming::SELECT(DB::RAW('incomings.*,category.category as category_name,departments.dept_nick'))
    					 ->JOIN('category','incomings.category','category.id')
    					 ->LEFTJOIN('departments','incomings.office','departments.id')
                         ->whereIN('incomings.category',$arr_cat)
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

            if ($value->verified == null){
                if (Auth::user()->acl == 4 || Auth::user()->acl == 1){
                    $btn = '<button type="button" data-toggle="tooltip" data-placement="bottom" title="Verify Record" class="btn btn-danger btn-sm" onclick="verifydoc('.$value->id.')">Verify</button>';
                }else{
                    $btn = '<button type="button" data-toggle="tooltip" data-placement="bottom" title="Not Verify" class="btn btn-danger btn-sm">Not Verify</button>';
                }
            }else{
                $btn = '<button type="button" data-toggle="tooltip" data-placement="bottom" title="Verify Record" class="btn btn-success btn-sm" onclick="successdoc('.$value->id.')">Verified</button>';
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


        $data = incoming::SELECT(DB::RAW('incomings.*,category.category as category_name,departments.dept_nick,fa_category.type_fa'))
                         ->JOIN('category','incomings.category','category.id')
                         ->LEFTJOIN('departments','incomings.office','departments.id')
                         ->LEFTJOIN('fa_category','incomings.fa_category','fa_category.id')
                         ->whereNull('deleted_at')
                         ->where(function ($query) use ($category,$arr_cat){
                            if ($category != 0){
                                $query->where('incomings.category',$category);
                            }else{
                                $query->whereIN('incomings.category',$arr_cat);
                         
                            }
                         }) 
                         ->where(function ($query) use ($office){
                            if ($office != 0){
                                $query->where('incomings.office',$office);
                            }
                         }) 
                         ->where(function ($query) use ($datez){
                            if ($datez != null){
                                $query->whereDate('incomings.created_at',$datez);
                            }
                         })
                        
                         ->ORDERBY('created_at','DESC')
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
                    $btn = '<button type="button" data-toggle="tooltip" data-placement="bottom" title="Verify Record" class="btn btn-danger btn-sm" id="btn_'.$value->id.'" onclick="verifydoc('.$value->id.')">Verify</button>';
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
                           "date_receive" => date('M d, Y | h:i A ',strtotime($value->created_at)),
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
                           "action" =>'<div class="btn-group" role="group" aria-label="Basic example" id="formbtn_'.$value->id.'" >'.$btnfunc.$btn.'</div>',

                    );
        }



        return $arr;
    }



    public function changestatus(Request $r){
        
        $data = incoming::find($r->id);
        $data->verified = date('Y-m-d H:i:s');
        $data->verified_by = Auth::user()->name;
        $data->save();

        return $data;
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


        $data = incoming::SELECT(DB::RAW('incomings.*,category.category as category_name,departments.dept_nick,fa_category.type_fa'))
                     ->JOIN('category','incomings.category','category.id')
                     ->LEFTJOIN('departments','incomings.office','departments.id')
                     ->LEFTJOIN('fa_category','incomings.fa_category','fa_category.id')
                     ->whereNull('deleted_at')
                     ->where(function ($query) use ($arrnum,$cat_range){
                        if ($cat_range != null){
                            $query->whereIN('incomings.control_num',$arrnum);
                        }
                     }) 
                     ->where(function ($query) use ($category,$arr_cat){
                        if ($category != 0){
                            $query->where('incomings.category',$category);
                        }else{
                            $query->whereIN('incomings.category',$arr_cat);
                     
                        }
                     }) 
                     ->where(function ($query) use ($office){
                        if ($office != 0){
                            $query->where('incomings.office',$office);
                        }
                     }) 
                     ->where(function ($query) use ($datez){
                        if ($datez != null){
                            $query->whereDate('incomings.created_at',$datez);
                        }
                     })
                    
                        ->orderByRaw('CHAR_LENGTH(control_num)')
                        ->orderby('id','ASC')
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
                           "action" =>"<div class='btn-group' role='group'>".$btnfunc.$btn."</div>",

                    );
        }

        if ($category == 23){
            $str_size = "legal";
        }else{
            $str_size = "a4";

        }


        $pdf = PDF::loadview('document.reports',compact('arr','datez','data_cat','cat_date'));
        $pdf->setPaper($str_size, 'landscape');
        return $pdf->stream("Reports_".$datez.".pdf");

        // if ($category == 17){
        //     return view('document.reports_fa',compact('arr','datez','data_cat','cat_date'));
        // }else{
        //     return view('document.reports',compact('arr','datez','data_cat','cat_date'));
        // }
    }


    public function showinfoverify(Request $r){

        $data = incoming::find($r->id);

        $diffhr = $this->biss_hours($data->created_at,$data->verified);
        $arr = array('Name'=>$data->verified_by,'Date'=>date('M d, Y h:i A',strtotime($data->verified)),'Duration'=>$diffhr);
        return $arr;
    }




    public static function biss_hours($start, $end){
        #found from: https://www.sitepoint.com/community/t/calculate-the-number-of-working-day-hours-between-two-dates/43086/4

        $startDate = new \DateTime($start);
        $endDate = new \DateTime($end);
        $periodInterval = new \DateInterval( "PT1H" );

        $period = new \DatePeriod( $startDate, $periodInterval, $endDate );
        $count = 0;

        foreach($period as $date){

        $startofday = clone $date;
        $startofday->setTime(8,00);

        $endofday = clone $date;
        $endofday->setTime(17,00);

            if($date > $startofday && $date <= $endofday && !in_array($date->format('l'), array('Sunday','Saturday'))){

                $count++;
            }

        }
        
        //Get seconds of Start time
        $start_d = date("Y-m-d H:00:00", strtotime($start));
        $start_d_seconds = strtotime($start_d);
        $start_t_seconds = strtotime($start);
        $start_seconds = $start_t_seconds - $start_d_seconds;
                                
        //Get seconds of End time
        $end_d = date("Y-m-d H:00:00", strtotime($end));
        $end_d_seconds = strtotime($end_d);
        $end_t_seconds = strtotime($end);
        $end_seconds = $end_t_seconds - $end_d_seconds;
                                        
        $diff = $end_seconds-$start_seconds;
        
        if($diff!=0):
            $count--;
        endif;
            
        $days = floor($count/8);
        $hrs = $count%8;

        $min = date('i',$diff);
        
        $dd = ($days>1)?'days':'day';
        $hh = ($hrs>1)?'hrs':'hr';
        $mm = ($min>1)?'mins':'min';
        
        $d = ($days>0)?'<b>'.$days.'</b> '.$dd.' ':'';
        $h = ($hrs>0)?'<b>'.$hrs.'</b> '.$hh.' ':'';
        $m = ($min>0)?'<b>'.(int)$min.'</b> '.$mm.'':'';

        return "{$d}{$h}{$m}";
    }

    public function employee_list(){

        $casual = DB::table('casual_dtr_listemployee')->get();
        $perma = DB::table('permanent_info')->get();


        foreach ($casual as $key => $value) {
            $casual_employee[] = $value->emp_firstname . " " . $value->emp_middle_name . " " . $value->emp_lastname;
        }

        foreach ($perma as $key => $value) {
            $perma_employee[] = $value->Fname . " " . substr($value->Mname,0,1). ". " . $value->Lname;
        }

        $array['casual'] = $casual_employee;
        $array['permanent'] = $perma_employee;

        return json_encode($array);
    }
}
