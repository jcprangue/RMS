@extends('layouts.master')
<style type="text/css">
    .bg-mintgreen{
            overflow: hidden;
            padding: 20px;
            width: 100%;
            background: #107aec;
            background: -webkit-gradient(linear, left top, right bottom, color-stop(60%, #0d52bc), color-stop(50%, #0d52bc));
            background: linear-gradient(to right bottom, #0d52bc 60%, #107aec 50%);
            border: 0px;
            border-radius: 10px;
            -webkit-box-shadow: 0px 1px 2px grey;
            box-shadow: 0px 1px 2px grey;
    }
</style>
@section('content')

<div class="row">

    <div class="col-md-6" style="margin-top: 56px;">
         <div class="row">
                <div class="col-md-6">
                    <div class="card bg-mintgreen mt-4 text-white py-0 pt-3">
                        <i class="fa fa-files-o fa-5x text-white p-0" aria-hidden="true"></i>  
                        <h1 class="text-right" id="lbltotal">26</h1>
                        <small><label class="text-right w-100">Total Documents</label></small>
                    </div>
                </div>

                 <div class="col-md-6">
                    <div class="card bg-mintgreen mt-4 text-white py-0 pt-3">
                    
                        <i class="fa fa-handshake-o fa-5x text-white" aria-hidden="true"></i>  
                        <h1 class="text-right" id="lblincoming">26</h1>
                        <small><label class="text-right w-100">Incoming Documents</label></small>
                    </div>
                </div>
           </div>
    </div>

    <div class="col-md-6" style="margin-top: 56px;">
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-mintgreen mt-4 text-white py-0 pt-3">
                        <i class="fa fa-paper-plane fa-5x text-white p-0" aria-hidden="true"></i>  
                        <h1 class="text-right" id="lbloutgoing">26</h1>
                        <small><label class="text-right w-100">Outgoing Documents</label></small>
                    </div>
                </div>

              

                
           </div>
            
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <canvas id="mybarChart" class="getpic mt-3" class="img-fluid"></canvas>
    </div>

    <div class="col-md-6">
        <canvas id="mybarChart1" class="getpic mt-3" class="img-fluid"></canvas>
    </div>

</div>




<script type="text/javascript">
    var myBarChart;
    $('document').ready(function(){
        getnumberofdocs();
        getchartdata()
        getchartdataout()
        // getoutgoing();
    });


    function getnumberofdocs(){
        $.ajax({
            url:'dashboard/numdocs',
            type:'GET',
            success:function(data){
                console.log(data);
                $('#lbltotal').html(data['all']);
                $('#lblincoming').html(data['incoming']);
                $('#lbloutgoing').html(data['outgoing']);
            },
        })
    }

    function getchartdata(){
        
        $.ajax({
            url:'dashboard/chartdata',
            type:'GET',
            success:function(data){
                if (myBarChart) {
                    myBarChart.destroy();
                }
                var ctx = document.getElementById("mybarChart");
                myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: data['label'],
                      datasets: [{
                        label: 'Number of Incoming per Month',
                        backgroundColor: "#26B99A",
                        data: data['values']
                      }]
                    },
                    options: {
                      scales: {
                        yAxes: [{
                          ticks: {
                            beginAtZero: true
                          }
                        }]
                      }
                    },
                });


            },
        })
    }

     function getchartdataout(){
        
        $.ajax({
            url:'dashboard/chartdataout',
            type:'GET',
            success:function(data){
                console.log(data);
                if (myBarChart) {
                    myBarChart.destroy();
                }
                var ctx = document.getElementById("mybarChart1");
                myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: data['label'],
                      datasets: [{
                        label: 'Number of Outgoing per Month',
                        backgroundColor: "#26B99A",
                        data: data['values']
                      }]
                    },
                    options: {
                      scales: {
                        yAxes: [{
                          ticks: {
                            beginAtZero: true
                          }
                        }]
                      }
                    },
                });


            },
        })
    }



</script>

@endsection
