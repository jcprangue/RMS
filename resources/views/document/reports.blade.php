&nbsp;<!DOCTYPE html>
<html>
<head>
  
  <title> Reports {{ $datez }} </title>
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

  <style type="text/css">
    @page
    {
       size: landscape;
        margin: 0.5mm 0.5mm 0.5mm 0.5mm;  
    }

     @media all {
      body {font-family: arial; margin-top: 0.11in; margin-bottom: 0.11in; margin-left: 0.05in; margin-right: 0.05in;}
      html{color: #000; font-family: arial; font-size: 12px;}
      table{
        width: 100%;
        border-collapse: collapse;
      }
      .bottom-thin-border{border-bottom: 0.5px solid #e2e2e2;}
      .text-bold{ font-weight: bold;}
      .text-left{ text-align: left!important;}
      .text-right{ text-align: right!important;}
      .text-center{ text-align: center!important;}
      .text-small{ font-size: 0.9em!important; line-height: 1.2em!important;}
      .text-smaller{ font-size: 0.7em!important; line-height: 1.2em!important;}
      .text-smallest{ font-size: 0.6em!important; line-height: 1.2em!important;}
      .text-smallestest{ font-size: 0.5em!important;}
      .text-big{ font-size: 1.2em!important;}
      .text-bigger{ font-size: 1.4em!important;}
      .text-white{ color:transparent;}
      .border-topbottom{ border-top: 1px solid #000; border-bottom: 2px solid #000; padding:8px;}
      .noborderall{ border: 0px;}
      .push-to-right{
        float: right;
        margin-bottom: 10px;
      }
      .borderall{
        border:1px solid #000;
      }
      img{
         position: absolute;
         top: 10px;
         left: 250px;
         margin: 0 auto;
         width: 100px;
         height: 100px;
      }
      .headercolor{
        background-color: #FFD27F;
      }
      .centerlabel{
        width: 100%;
        text-align: center;
      }
  }

  </style>

  <script type="text/javascript">
     window.onload = function() { window.print(); }
  </script>
</head>
<body>

<div style="align:center;bacground-color:red; width:100%" >
  <table class="table table-bordered table-sm table-striped" style="font-size:12px; width: 100% !important;">
  <thead >
    <tr>
      <th colspan="11">
        <div align="center">
          <strong><label style="font-size:15px;">PROVINCIAL GOVERNMENT OF ORIENTAL MINDORO</label></strong>
        </div>
        <div align="center" style="background-color:#FFDAB9;">
          <strong><label style="font-size:14px;">Provincial Administrator's Office</label>
        </div>
        <div align="center">
          @if ($data_cat)
          <strong><label style="font-size:14px;"><i>{{ $data_cat->category }}</i></label></strong>       
          @else
          <strong><label style="font-size:14px;"><i>List of Incoming Documents</i></label></strong>       
          @endif
        </div>
        <br><br>
      </th>
    </tr>
    <tr class="borderall" bgcolor="#ffc04c">
        
        <th class="borderall text-center" style="width:40px !important;">#</th>
        @if ($data_cat->id == 23)
          <th class="borderall text-center" style="width:70px !important;">Ref No.</th>
          <th class="borderall text-center" style="width:140px !important;">Date | Time </th>
        @else
          <th class="borderall text-center" style="width:100px !important;">Ref No.</th>
          <th class="borderall text-center" style="width:150px !important;">Date | Time </th>
        @endif
        <th class="borderall text-center" style="width:60px !important;">Office</th>
        @if ($data_cat->id == 23)
          <th class="borderall text-center" style="width: 180px;">Name</th>
        @else
          <th class="borderall text-center" style="width: 200px;">Particulars</th>
        @endif
        @if (!$data_cat)
        <th class="borderall text-center">Category </th>
        @else
          
          @if ($data_cat->id == 1 || $data_cat->id == 4 || $data_cat->id == 12 || $data_cat->id == 13 || $data_cat->id == 14 || $data_cat->id == 15)
            <th class="borderall text-center">Supplier</th>
          @elseif ($data_cat->id == 18)
            <th class="borderall text-center">Implementor</th>
            <th class="borderall text-center">Venue</th>
            <th class="borderall text-center">Date</th>

          @elseif ($data_cat->id == 2 || $data_cat->id == 7)
            <th class="borderall text-center" style="width:150px !important;">Payee</th>
          @elseif ($data_cat->id == 3)
            <th class="borderall text-center" style="width:250px !important;">Payee</th>
            <th class="borderall text-center" style="width:80px !important;">Check No.</th>
          @elseif ($data_cat->id == 11)
            <th class="borderall text-center" style="width:150px !important;">Leave Type</th>
            <th class="borderall text-center" style="width:150px !important;">Date Leave</th>
          @elseif ($data_cat->id == 23)
            <th class="borderall text-center" >Travel Destination</th>
            <th class="borderall text-center" style="width:100px !important;">Type of Vehicle</th>
            <th class="borderall text-center" style="width:150px !important;">Date of Travel</th>
          
          @endif

        @endif

        @if ($data_cat->id == 11 || $data_cat->id == 23)
        @else
        <th class="borderall text-center" style="width:100px !important;">Amount</th>
        @endif
        
        @if($data_cat->id == 23)
        <th class="borderall text-center" style="width:150px !important;">Remarks</th>
        <th class="borderall text-center" style="width:80px !important;">Received</th>

        @else
        <th class="borderall text-center" style="width:80px !important;">Remarks</th>
        @endif
    </tr>
  </thead>
  <tbody>
    <?php $x = 0; ?>
      @foreach ($arr as $value)
      <?php $x++; ?>

          <tr >
            <td class="bottom-thin-border text-center">{{ $x }}</td>
            <td class="bottom-thin-border text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $value['control_num'] }}</td>
            <td class="bottom-thin-border text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date("M d, Y | h:i A",strtotime($value['date_receive'])) }}</td>
            <td class="bottom-thin-border text-left">{{ $value['office_name'] }}</td>
            @if ($data_cat->id == 16 || $data_cat->id == 5 )
            <td class="bottom-thin-border text-left" style="width:350px !important;">{{ $value['particulars'] }}</td>
            @elseif ($data_cat->id == 11)
            <td class="bottom-thin-border text-left" style="width:200px !important;">{{ $value['particulars'] }}</td>
            @elseif ($data_cat->id == 3)
            <td class="bottom-thin-border text-left" style="width:100px !important;">{{ $value['particulars'] }}</td>
            @elseif ($data_cat->id == 23)
            <td class="bottom-thin-border text-left" style="width:150px !important;">
              <?php 
                $name = explode(",",$value['particulars']);
                foreach ($name as $key => $newname) {
                  echo $newname . '<BR>';
                }
              ?>
            </td>
            @else

            <td class="bottom-thin-border text-left" style="width:280px !important;">{{ $value['particulars'] }}</td>
            <!-- <td class="bottom-thin-border text-left">{{ $value['particulars'] }}</td> -->

            @endif
            @if (!$data_cat)
            <td class="bottom-thin-border text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $value['category_name'] }}</td>
            @else
             @if ($data_cat->id == 1 || $data_cat->id == 4 || $data_cat->id == 12 || $data_cat->id == 13 || $data_cat->id == 14 || $data_cat->id == 15)
                <td class="bottom-thin-border text-left" style="width:150px !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $value['supplier'] }}</td>
              @elseif ($data_cat->id == 18)
                <td class="bottom-thin-border text-right">{{ $value['supplier'] }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="bottom-thin-border text-right">{{ $value['payee'] }}</td>
                <td class="bottom-thin-border text-center">{{ $value['date_leave'] }}</td>
              @elseif ($data_cat->id == 2 || $data_cat->id == 7)
                <td class="bottom-thin-border text-right">{{ $value['payee'] }}</td>
              @elseif ($data_cat->id == 3)
                <td class="bottom-thin-border text-right">{{ $value['payee'] }}</td>
                <td class="bottom-thin-border text-right">{{ $value['check_no'] }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              @elseif ($data_cat->id == 11)
                <td class="bottom-thin-border text-right">{{ $value['type_leave'] }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="bottom-thin-border text-right">{{ $value['date_leave'] }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              @elseif ($data_cat->id == 23)
                <td class="bottom-thin-border text-right">{{ $value['check_no'] }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="bottom-thin-border text-right">{{ $value['supplier'] }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="bottom-thin-border text-right">{{ $value['date_leave'] }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              
              @endif


            @endif

            @if ($data_cat->id == 11 || $data_cat->id == 23)
            @else
            <td class="bottom-thin-border text-right">{{ number_format($value['amount'],2) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
           
            @endif

            @if ($data_cat->id == 16 || $data_cat->id == 5 )
             <td class="bottom-thin-border text-left"  style="width:150px !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $value['remarks']}}</td>
            @elseif ($data_cat->id == 3)
             <td class="bottom-thin-border text-left"  style="width:80px !important;">{{ $value['remarks']}}</td>
            @elseif ($data_cat->id == 10 || $data_cat->id == 6 || $data_cat->id == 8 || $data_cat->id == 9)
             <td class="bottom-thin-border text-left"  style="width:200px !important;">{{ $value['remarks']}}</td>
            @else
             <td class="bottom-thin-border text-left"  style="width:100px !important;">{{ $value['remarks']}}</td>
             <td class="bottom-thin-border text-left"  style="width:100px !important;">&nbsp;</td>
            
            @endif
           

          </tr>
        @endforeach

  </tbody>
</table>
</div>




</body>
</html>



