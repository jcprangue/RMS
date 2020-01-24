@extends('layouts.app')
<style type="text/css">
    body{
        background: #FFFFFF !important;
    }
</style>
@section('content')
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
              <div class="text-center">
                <img src="{{ asset('/images/police.jpg') }}"> 
                <h1 class="font-weight-bold">Ooops! You don't have the previledge to access this page</h1>
                <a href="home"class="btn btn-success btn-lg">Back</a>
              </div>     
            </div>
        </div>
    </div>


  
@endsection
