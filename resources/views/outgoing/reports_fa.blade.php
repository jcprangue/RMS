&nbsp;<!DOCTYPE html>
<html>
<head>
  <title> Reports {{ $datez }} </title>
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

  <style type="text/css">
    @page
    {
       size: portrait;
        margin: 5mm 5mm 5mm 5mm;  
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
          <strong><label style="font-size:14px;"><i>List of Outgoing Documents</i></label></strong>       
          @endif
        </div>
        <br><br>
      </th>
    </tr>
    <tr>
      <th colspan="11" class="text-right"><h2>{{ date('M d, Y',strtotime($cat_date)) }}</h2></th>
      
    </tr>
     <tr class="borderall" bgcolor="#ffc04c" style="height: 40px;">
        
        <th class="text-center"># </th>
        <th class="borderall">Name / Particular</th>
        <th class="borderall">Category</th>
        <th class="borderall">Amount</th>
        <th class="borderall">Received</th>
    </tr>
  </thead>
  <tbody>
      <?php $x = 0; ?>
      @foreach ($arr as $value)
      <?php $x++; ?>

          <tr>
            <td class="bottom-thin-border text-center" style="border-left:1px solid #000;">{{ $x }}</td>
            <td class="bottom-thin-border text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $value['particulars'] }}</td>
            <td class="bottom-thin-border text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $value['fa_category'] }}</td>
            <td class="bottom-thin-border text-right" style="border-right:1px solid #000;">{{ number_format($value['amount'],2) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td class="bottom-thin-border text-left" style="border-right:1px solid #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

          </tr>
        @endforeach

  </tbody>
</table>
</div>




</body>
</html>



