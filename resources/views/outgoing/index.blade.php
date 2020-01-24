@extends('layouts.master')

@section('content')
   <div class="sticky-offset">
        <div class="float-right">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Outgoing</li>
                </ol>
            </nav>
        </div>
        <h1>
            <strong>Outgoing Control Panel</strong> 
            <!-- <button class="btn btn-primary" onclick="newform()">ADD NEW</button> -->
            <button class="btn btn-primary" onclick="addfromincoming()">ADD FROM INCOMING</button>

        </h1>        
        <BR>



<nav class="navbar navbar-expand-lg navbar-light bg-light px-0">
  
    <form class="form-inline my-2 my-lg-0 float-right" id="advfilter">
        <select class="form-control mr-sm-2" id="txtfiltercategory" name="txtfiltercategory">
            <option SELECTED value="0">--ALL CATEGORY--</option>
            @foreach ($category as $value)
                <option value="{{ $value->id }}">{{ $value->category }}</option>
            @endforeach
        </select>
        <select class="form-control mr-sm-2" id="txtfilterlgu" name="txtfilterlgu">
            <option SELECTED value="0">--All Office--</option>
            @foreach ($departments as $value)
                <option value="{{ $value->id }}">{{ $value->dept_nick }}</option>
            @endforeach
        </select>
        <input type="date" name="txtfilterdate" id="txtfilterdate" class="form-control mr-sm-2">
        
                 
    </form>

        <button class="btn btn-outline-primary my-2 my-sm-0 mr-sm-2" onclick="filterfunc()">Filter</button>

        <form class="form-inline my-2 my-lg-0 float-right">   
            <label class="ml-5"><b>Print Range</b></label>      
            <input type="text" class="form-control mr-2 ml-1" name="txtrange" id="txtrange">
        </form>

        <button class="btn btn-outline-primary my-2 my-sm-0 mr-sm-2" onclick="filterprint()">Print</button>
        <!-- <button class="btn btn-outline-primary my-2 my-sm-0 mr-sm-2" onclick="filterchart()">Chart Analysis</button> -->
</nav>
<br>
      

        
        <table id="example" class="table table-striped table-bordered w-100 d-none" style="font-size:14px;">
            <thead>
                <tr>
                    <th id="thid">#</th> <!--0-->
                    <th id="thref">Ref No.</th><!--1-->
                    <th id="thdatereceive">Date Receive</th><!--2-->
                    <th id="thoffice">Office</th><!--3-->
                    <th id="thparticulars">Particulars</th><!--4-->
                    <th id="thcategory">Category</th><!--5-->
                    <th id="thamount">Amount</th><!--6-->
                    <th id="thsupplier">Supplier</th><!--7-->
                    <th id="thcheckno">Check No.</th><!--8-->
                    <th id="thpayee">Payee</th><!--9-->
                    <th id="thremarks">Remarks</th><!--10-->
                    <th id="thtypeleave">Type of Leave</th><!--11-->
                    <th id="thdateleave">Date of Leave</th><!--12-->
                    <th id="thfacategory">FA Category</th><!--13-->
                    <th id="thaction">Action</th><!--14-->
                </tr>
            </thead>
            <tbody>
               
            </tbody>
          
        </table>


        <div class="alert alert-success text-center font-weight-bold" role="alert" id="alertdata">
            ***** Please select the category first *****
        </div>
        <br>
        
   </div>

<!-- Modal -->
<div class="modal fade rounded-0" id="modalform" tabindex="-1" role="dialog" aria-labelledby="modalformLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg rounded-0" role="document">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary rounded-0">
            <h5 class="modal-title text-white font-weight-bold" id="modalformLabel">New Outgoing</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white font-weight-bold">&times;</span>
            </button>
        </div>
      
        <div class="modal-body rounded-0">
            <form id="mainform">
                @csrf
                <div class="row">
                    <div class="col">
                        <label class="font-weight-bold">Category:</label>
                        <select class="form-control" id="txtcategory" name="txtcategory">
                            <option SELECTED DISABLED value="">--Select Option--</option>
                            @foreach ($category as $value)
                                <option value="{{ $value->id }}">{{ $value->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div><br>

                        <input type="hidden" name="txtid" id="txtid">

                <!-- <div class="row">
                    <div class="col">
                        <label class="font-weight-bold">Reference Number:</label>
                        <input type="text" name="txtrefno" id="txtrefno" class="form-control">
                    </div>

                    <div class="col">
                        <label class="font-weight-bold">Date Received:</label>
                        <input type="date" name="txtdate" id="txtdate" class="form-control">
                    </div>
                </div><br> -->

                <div class="row">
                    <div class="col">
                        <label class="font-weight-bold" id="lblparticulars">Particulars:</label>
                        <input type="text" name="txtparticulars" id="txtparticulars" class="form-control">
                    </div>

                    <div class="col">
                        <label class="font-weight-bold" id="lblamount">Amount:</label>
                       <input type="number" name="txtamount" id="txtamount" class="form-control">
                    </div>

                   
                </div><br>

                <div class="row">
                    <div class="col">
                        <label class="font-weight-bold" id="lbloffice">Office:</label>
                        <select class="form-control" id="txtoffice" name="txtoffice">
                            <option SELECTED DISABLED value="">--Select Option--</option>
                            @foreach ($departments as $value)
                                <option value="{{ $value->id }}">{{ $value->dept_nick }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <label class="font-weight-bold" id="lblsupplier">Supplier:</label>
                       <input type="text" name="txtsupplier" id="txtsupplier" class="form-control">
                    </div>
                    
                  
                </div><br>

                <div class="row">
                    <div class="col">
                        <label class="font-weight-bold" id="lblchknum">Check Number:</label>
                        <input type="text" name="txtcheckno" id="txtcheckno" class="form-control">
                    </div>

                    <div class="col">
                        <label class="font-weight-bold" id="lblpayee">Payee:</label>
                       <input type="text" name="txtpayee" id="txtpayee" class="form-control">
                    </div>

                   
                </div><br>
               
                <div class="row">
                    <div class="col">
                        <label class="font-weight-bold" id="lbltypeleave">Type of Leave:</label>
                        <input type="text" name="txttypeleave" id="txttypeleave" class="form-control">
                    </div>

                    <div class="col">
                        <label class="font-weight-bold" id="lbldateleave">Date of Leave:</label>
                        <input type="text" name="txtdateleave" id="txtdateleave" class="form-control" />
                    </div>

                   
                </div><br>

                <div class="row">
                    <div class="col">
                        <label class="font-weight-bold" id="lblfacategory">FA Category:</label>
                        <select class="form-control" id="txtfacategory" name="txtfacategory">
                            <option SELECTED DISABLED value="">--Select Option--</option>
                            @foreach ($facategory as $value)
                                <option value="{{ $value->id }}">{{ $value->type_fa }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">

                    </div>
                    
                  
                </div><br>
               

                <div class="row">
                    <div class="col">
                        <label class="font-weight-bold">Remarks:</label>
                        <textarea class="form-control" name="txtremarks" id="txtremarks" rows="4"></textarea>
                    </div>

                   
                </div>

               


        </form>
                    

      </div>
      <div class="modal-footer rounded-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="savedata()">Save changes</button>
      </div>
    </div>
  </div>
</div>





<!-- Modal -->
<div class="modal fade rounded-0" id="modalallfromout" tabindex="-1" role="dialog" aria-labelledby="modalformLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg rounded-0" role="document">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary rounded-0">
            <h5 class="modal-title text-white font-weight-bold" id="modalformLabel">Search from Incoming Records</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white font-weight-bold">&times;</span>
            </button>
        </div>
      
        <div class="modal-body rounded-0">
            <form id="formadd">
                @csrf
                <div class="row">
                    <div class="col">
                         <label class="font-weight-bold">Incoming List:</label>
                        <!--<input list="browsers" class="form-control" id="txtincoming" name="txtincoming" placeholder="Type to Search">
                        <datalist id="browsers">
                        
                        </datalist> -->
                       
                        <select class="w-100" id="txtincoming" name="txtincoming" multiple>
                            <!-- <option value=""></option>
                            <option value="1">one</option>
                            <option value="2">two</option>
                            <option value="3">three</option>
                            <option value="4">four</option>
                            <option value="5">five</option> -->
                        </select>       

                        <input type="hidden" name="arrincoming" id="arrincoming">

                    </div>
                   
                </div><br>

               <!--  <div class="row">
                    <div class="col">
                        <label class="font-weight-bold">Date Out:</label>
                        <input type="date" class="form-control" id="txtoutdate" name="txtoutdate">
                    </div>
                    
                   
                </div><br>
 -->
                <div class="row">
                    <div class="col">
                        <label class="font-weight-bold">Remarks:</label>
                        <textarea class="form-control" name="txtremarks" id="txtremarks" rows="4"></textarea>
                    </div>

                   
                </div>

            </form>

        </div>

        <div class="modal-footer rounded-0">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="addout()">Add to Outgoing</button>
        </div>
    </div>
  </div>
</div>



    <script type="text/javascript">
        var table;
        var htmldata;
        var method;

        $(document).ready(function() {

            // table = $('#example').DataTable( {
            //     select: true,
            //     responsive: true,
            //     "processing": true,
            //     "ajax": {
            //     "url": "/outgoing/records",
            //     "dataSrc": "",
                
            //     },
            //      "columns": [
            //         { "data": "number" },
            //         { "data": "control_num" },
            //         { "data": "date_receive" },
            //         { "data": "office_name" },
            //         { "data": "particulars" },
            //         { "data": "category_name" },
            //         { "data": "amount_format" },
            //         { "data": "supplier" },
            //         { "data": "check_no" },
            //         { "data": "payee" },
            //         { "data": "remarks" },
            //         { "data": "action" },
                    
            //     ],
             
            // });


         
            $('#txtcategory').on('change',function(){
                 if (method == 'new'){
                    editdatas('new')
                }else{
                    editdatas('edit')

                }
            }); 

         

        });

        function newform(){
            $("#mainform")[0].reset();
            $('#modalform').modal('show');
            method = 'new';
        }

        function editdatas(met){
            
                if ($('#txtcategory').val() == 5 || $('#txtcategory').val() == 8){ // PR
                    //set readonly
                    $('#txtsupplier').prop('readonly', true);
                    $('#txtcheckno').prop('readonly', true);
                    $('#txtpayee').prop('readonly', true);
                    $('#txtamount').prop('readonly', false);
                    $('#txttypeleave').prop('readonly', true);
                    $('#txtoffice').attr('disabled', false);
                    $('#txtdateleave').prop('readonly', true);
                    $('#txtfacategory').attr('disabled', true);

                    //set clear
                    
                    
                }else if($('#txtcategory').val() == 1 || $('#txtcategory').val() == 6){ //PO

                    $('#txtsupplier').prop('readonly', false);
                    $('#txtcheckno').prop('readonly', true);
                    $('#txtpayee').prop('readonly', true);
                    $('#txtamount').prop('readonly', false);
                    $('#txttypeleave').prop('readonly', true);
                    $('#txtdateleave').prop('readonly', true);
                    $('#txtoffice').attr('disabled', false);
                    $('#txtfacategory').attr('disabled', true);


                    //set clear
                   

                }else if($('#txtcategory').val() == 12 || $('#txtcategory').val() == 13 || $('#txtcategory').val() == 14 || $('#txtcategory').val() == 15){ //BAC BER CA NOA

                    $('#txtsupplier').prop('readonly', false);
                    $('#txtcheckno').prop('readonly', true);
                    $('#txtpayee').prop('readonly', true);
                    $('#txtamount').prop('readonly', false);
                    $('#txttypeleave').prop('readonly', true);
                    $('#txtdateleave').prop('readonly', true);
                    $('#txtoffice').attr('disabled', true);
                    $('#txtfacategory').attr('disabled', true);

                    //set clear
                   

                }else if($('#txtcategory').val() == 2 || $('#txtcategory').val() == 7 || $('#txtcategory').val() == 10 || $('#txtcategory').val() == 16){ //voucher payroll

                    $('#txtsupplier').prop('readonly', true);
                    $('#txtcheckno').prop('readonly', true);
                    $('#txtpayee').prop('readonly', false);
                    $('#txtamount').prop('readonly', false);
                    $('#txttypeleave').prop('readonly', true);
                    $('#txtoffice').attr('disabled', false);
                    $('#txtdateleave').prop('readonly', true);
                    $('#txtfacategory').attr('disabled', true);

                    //set clear
                   

                }else if($('#txtcategory').val() == 3){ //check

                    $('#txtsupplier').prop('readonly', true);
                    $('#txtcheckno').prop('readonly', false);
                    $('#txtpayee').prop('readonly', false);
                    $('#txtamount').prop('readonly', false);
                    $('#txttypeleave').prop('readonly', true);
                    $('#txtoffice').attr('disabled', false);
                    $('#txtdateleave').prop('readonly', true);
                    $('#txtfacategory').attr('disabled', true);

                    //set clear
                   

                }else if($('#txtcategory').val() == 4 || $('#txtcategory').val() == 9){ //RIS

                    $('#txtsupplier').prop('readonly', false);
                    $('#txtcheckno').prop('readonly', true);
                    $('#txtpayee').prop('readonly', true);
                    $('#txtamount').prop('readonly', false);
                    $('#txttypeleave').prop('readonly', true);
                    $('#txtoffice').attr('disabled', false);
                    $('#txtdateleave').prop('readonly', true);
                    $('#txtfacategory').attr('disabled', true);

                    //set clear
                   
                }else if($('#txtcategory').val() == 11){ //Leave

                    $('#txtsupplier').prop('readonly', true);
                    $('#txtcheckno').prop('readonly', true);
                    $('#txtpayee').prop('readonly', true);
                    $('#txtamount').prop('readonly', true);
                    $('#txttypeleave').prop('readonly', false);
                    $('#txtoffice').attr('disabled', false);
                    $('#txtdateleave').prop('readonly', false);
                    $('#txtfacategory').attr('disabled', true);

                    //set clear
                   
                }else if($('#txtcategory').val() == 17 || $('#txtcategory').val() == 18 || $('#txtcategory').val() == 19 || $('#txtcategory').val() == 20 || $('#txtcategory').val() == 21){ //FA

                    $('#txtsupplier').prop('readonly', true);
                    $('#txtcheckno').prop('readonly', true);
                    $('#txtpayee').prop('readonly', true);
                    $('#txtamount').prop('readonly', false);
                    $('#txttypeleave').prop('readonly', true);
                    $('#txtoffice').attr('disabled', true);
                    $('#txtdateleave').prop('readonly', true);
                    $('#txtfacategory').attr('disabled', false);
                    //set clear
                   
                }else if($('#txtcategory').val() == 18){ //AD

                    $('#txtsupplier').prop('readonly', false);
                    $('#txtcheckno').prop('readonly', true);
                    $('#txtpayee').prop('readonly', false);
                    $('#txtamount').prop('readonly', false);
                    $('#txttypeleave').prop('readonly', true);
                    $('#txtoffice').attr('disabled', true);
                    $('#txtdateleave').prop('readonly', false);
                    $('#txtfacategory').attr('disabled', true);

                    //set clear
                   
                }else if($('#txtcategory').val() == 23){ //AD
                    $('#txtpayee').prop('readonly', true);
                    $('#txttypeleave').prop('readonly', true);
                    $('#txtamount').prop('readonly', true);
                    $('#txtfacategory').attr('disabled', true);
                    //set clear
                }


                if ($('#txtcategory').val() == 18){
                    $('#lblparticulars').html('Title');
                    $('#lblsupplier').html('Implementor');
                    $('#lblpayee').html('Venue');
                    $('#lbldateleave').html('Date');
                }else if ($('#txtcategory').val() == 23){

                    $('#lblparticulars').html('Employees');
                    $('#lbldateleave').html('Date of Travel');
                    $('#lblchknum').html('Travel Destination');
                    $('#lvlremarks').html('Purpose');
                    $('#lblsupplier').html('Type of Vehicle');

                }else{
                    $('#lblparticulars').html('Particulars');
                    $('#lblsupplier').html('Supplier');
                    $('#lblpayee').html('Payee');
                    $('#lbldateleave').html('Date of Leave');
                }


                if (met == 'new'){

                    $('#txtsupplier').val('');
                    $('#txtcheckno').val('');
                    $('#txtpayee').val('');
                }
        }

        $('#txtincoming').on('change',function(){
            var arrdata = $('#txtincoming').val();
            var strdata = arrdata.join(',');

            $('#arrincoming').val(strdata);
        });
    
        function addout(){
            var datas = $("#formadd").serialize();
            
          
            
            postForm("{{ url('/outgoing/saveadd') }}",datas,cleardata);
            $("#formadd")[0].reset();

            // var $select = $('#txtincoming').select2();
            // var control = $select[0].selectize;
            // control.clear();
            $('#txtincoming').val(null).trigger('change');

            $('#modalallfromout').modal('hide');
           
            alert('Saved');


            shownotif('Success','New Outgoing has been added/updated to database')
             filterfunc();

        }
        function savedata(){
            var datas = $("#mainform").serialize();
        
            postForm("{{ url('/outgoing/save') }}",datas,cleardata);
            
            
            shownotif('Success','New Document has been added/updated to database')
            filterfunc();
        }


        function cleardata(){
            $("#mainform")[0].reset();
            $('#modalform').modal('hide');

        }

        function shownotif(title,text,type_){
            new PNotify({
                title: title,
                text: text,
                type: type_
            });
        }

        function editmode(id_arr){

           $.ajax({
            url:'outgoing/editdata',
            type:'POST',
            dataType:'JSON',
            data:{id:id_arr},
            success:function(data){

              
                method = 'edit';
               
                $('#txtid').val(data.id)
                
                $('#txtrefno').val(data.control_num)
                $('#txtdate').val(data.date_receive)

                $('#txtparticulars').val(data.particulars)
                $('#txtamount').val(data.amount)
                $('#txtremarks').val(data.remarks)

                $('#txtsupplier').val(data.supplier)
                $('#txtpayee').val(data.payee)
                $('#txtcheckno').val(data.check_no)


                $('#txttypeleave').val(data.type_leave)
                $('#txtdateleave').val(data.date_leave)

                $('#txtcategory').val(data.category).change();
                $('#txtoffice').val(data.office).change();
                $('#txtfacategory').val(data.fa_category).change();

               
                $('#modalform').modal('show');

            }
           })
        }



        function deletemode(id){
            new PNotify({
                title: 'Do you want to delete this record?',
                text: 'Are you sure?',
                icon: 'glyphicon glyphicon-question-sign',
                hide: false,
                
                confirm: {
                    confirm: true
                },
                
                buttons: {
                    closer: false,
                    sticker: false
                },
                
                history: {
                    history: false
                },

                addclass: 'stack-modal',
                stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
                }).get().on('pnotify.confirm', function(){
                    $.ajax({
                        url:'outgoing/delete',
                        type:'POST',
                        dataType:'JSON',
                        data:{id:id},
                        success:function(data){
                            alert('DELETED');
                            filterfunc();
                        }
                    })
                }).on('pnotify.cancel', function(){
                    shownotif('Message','Great choices, you choose not to delete this record','Info')
                });


           
        }

      

         function filterfunc(){

            $('#example').removeClass('d-none');
            $('#alertdata').addClass('d-none');
           
            $.ajax({
                url:'outgoing/filter',
                type:'POST',
                dataType:'JSON',
                data:{cat_id:$('#txtfiltercategory').val(),cat_date:$('#txtfilterdate').val(),cat_lgu:$('#txtfilterlgu').val()},
                success:function(data){
                    $('#example').dataTable().fnDestroy();
                    table = $('#example').DataTable( {
                        select: true,
                        responsive: true,
                        "aaData": data,
                         "columns": [
                            // { "data": "ID" },
                            { "data": "number" },
                            { "data": "control_num" },
                            { "data": "date_receive" },
                            { "data": "office_name" },
                            { "data": "particulars" },
                            { "data": "category_name" },
                            { "data": "amount_format" },
                            { "data": "supplier" },
                            { "data": "check_no" },
                            { "data": "payee" },
                            { "data": "remarks" },
                            { "data": "type_leave" },
                            { "data": "date_leave" },
                            { "data": "fa_category" },
                            { "data": "action" },
                            
                        ],
                    }); 


                    if ($('#txtfiltercategory').val() == 1 || $('#txtfiltercategory').val() == 6){ //PO
                    
                        table.column( 8 ).visible( false );//checkno
                        table.column( 9 ).visible( false );//payee
                        table.column( 11 ).visible( false );//type-leave
                        table.column( 12 ).visible( false );//date-leave
                        table.column( 13 ).visible( false );//FA

                    }else if ($('#txtfiltercategory').val() == 12 || $('#txtfiltercategory').val() == 13 || $('#txtfiltercategory').val() == 14 || $('#txtfiltercategory').val() == 15){ //BAC BER CA
                    
                        table.column( 8 ).visible( false );//checkno
                        table.column( 9 ).visible( false );//payee
                        table.column( 11 ).visible( false );//type-leave
                        table.column( 12 ).visible( false );//date-leave
                        table.column( 3 ).visible( false );//date-leave
                        table.column( 13 ).visible( false );//FA


                    }else if ($('#txtfiltercategory').val() == 2 || $('#txtfiltercategory').val() == 7 || $('#txtfiltercategory').val() == 10 || $('#txtfiltercategory').val() == 16){ // DV Payroll
                        table.column( 7 ).visible( false );//supplier
                        table.column( 8 ).visible( false );//checkno
                        table.column( 11 ).visible( false );//type-leave
                        table.column( 12 ).visible( false );//date-leave
                        table.column( 13 ).visible( false );//FA

                    }else if ($('#txtfiltercategory').val() == 3){ //CHECK
                        table.column( 7 ).visible( false );//payee
                        table.column( 11 ).visible( false );//type-leave
                        table.column( 12 ).visible( false );//date-leave
                        table.column( 13 ).visible( false );//FA

                    }else if ($('#txtfiltercategory').val() == 4 || $('#txtfiltercategory').val() == 9){ //RIS
                        table.column( 8 ).visible( false );//checkno
                        table.column( 9 ).visible( false );//payee
                        table.column( 11 ).visible( false );//type-leave
                        table.column( 12 ).visible( false );//date-leave
                        table.column( 13 ).visible( false );//FA
                        
                    }else if ($('#txtfiltercategory').val() == 5 || $('#txtfiltercategory').val() == 8){ //PR
                        table.column( 7 ).visible( false );//supplier
                        table.column( 8 ).visible( false );//checkno
                        table.column( 9 ).visible( false );//payee
                        table.column( 11 ).visible( false );//type-leave
                        table.column( 12 ).visible( false );//date-leave
                        table.column( 13 ).visible( false );//FA
                        
                    }else if ($('#txtfiltercategory').val() == 11){ //Leave
                        table.column( 7 ).visible( false );//supplier
                        table.column( 8 ).visible( false );//checkno
                        table.column( 9 ).visible( false );//payee
                        table.column( 13 ).visible( false );//FA
                        
                    }else if ($('#txtfiltercategory').val() == 17){ //FA
                        table.column( 7 ).visible( false );//supplier
                        table.column( 8 ).visible( false );//checkno
                        table.column( 9 ).visible( false );//payee
                        table.column( 10 ).visible( false );//payee
                        table.column( 11 ).visible( false );//payee
                        table.column( 12 ).visible( false );//payee
                        
                    }else if ($('#txtfiltercategory').val() == 18){ //AD
                        table.column( 8 ).visible( false );//checkno
                        table.column( 11 ).visible( false );//type-leave
                        table.column( 13 ).visible( false );//FA
                    }else if ($('#txtfiltercategory').val() == 23){ //TO
                        table.column( 6 ).visible( false );//amount
                        table.column( 9 ).visible( false );//payee
                        table.column( 11 ).visible( false );//payee
                        table.column( 13 ).visible( false );//payee
                        
                        
                    }


                    if ($('#txtfiltercategory').val() == 18){

                        $('#thparticulars').html('Title');
                        $('#thsupplier').html('Implementor');
                        $('#thpayee').html('Venue');
                        $('#thdateleave').html('Date');
                        
                    }else if ($('#txtfiltercategory').val() == 23){
                        $('#thparticulars').html('Employee Name');
                        $('#thsupplier').html('Type of Vehicle');
                        $('#thcheckno').html('Travel Destination');
                        $('#thremarks').html('Purposes');
                        $('#thdateleave').html('Travel Dates');


                    }else{

                        $('#thparticulars').html('Particulars');
                        $('#thsupplier').html('Supplier');
                        $('#thpayee').html('Payee');
                        $('#thdateleave').html('Date of Leave');
                        
                    }

         
                }
            });
        }

        function filterprint(){
            cat_id = $('#txtfiltercategory').val()
            cat_date = $('#txtfilterdate').val()
            cat_lgu = $('#txtfilterlgu').val()
            cat_range = $('#txtrange').val()
            window.open('/outgoing/printreports/'+cat_date+'_'+cat_id+'_'+cat_lgu+'_'+cat_range, '_blank');
        }



        function addfromincoming(){
            $("#formadd")[0].reset();

            if ($('#txtfiltercategory').val() == 0){
                alert('Please select category first')
            }else{
                $('#modalallfromout').modal('show');
            }
            
        }
        $('#modalallfromout').on('show.bs.modal', function (e) {
            $.ajax({
                    url:'/outgoing/incomingdata',
                    type:'POST',
                    dataType:'HTML',
                    data:{id:$('#txtfiltercategory').val()},
                    success:function(data){
                        arr = JSON.parse(data);

                            console.log(arr)
                        var strarr = '';
                        $('#txtincoming').html('')
                        payee = "";
                        for (var i = arr.length - 1; i >= 0; i--) {

                            if (arr[i].payee != null){
                                payee = ' ( ' + arr[i].payee + ' - ' + arr[i].amount +' )';
                            }

                            if (arr[i].category == 5 || arr[i].category == 6 || arr[i].category == 8){
                                strarr += '<option value="'+ arr[i].id + '">'+ arr[i].control_num +' - ' + arr[i].particulars+'</option>';
                            }else if (arr[i].category == 1) {
                                strarr += '<option value="'+ arr[i].id +'">'+ arr[i].control_num +' - ' + arr[i].supplier +' </option>';

                            }else{
                                strarr += '<option value="'+ arr[i].id +'">'+ arr[i].control_num +' - ' + arr[i].particulars + payee +' </option>';

                            }


                        }


                        $('#txtincoming').append(strarr);
                        $('#txtincoming').selectize();

                    }
                })
        })




    </script>
        
@endsection
