@extends('layouts.master')

@section('content')
	<div class="sticky-offset">
		<div class="float-right">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Settings</li>
                </ol>
            </nav>
        </div>

        <h1><strong>Settings Control Panel</strong></h1><br>
        
        <div class="row">
        	<div class="col-md-4">
        		<div class="card">
		        	<div class="card-header bg-primary">
		        		<div class="form-group row mb-0">
		    			
		    				<label for="staticEmail" class="col-sm-3 col-form-label text-white font-weight-bold">Category</label>
						    <div class="col-sm-9">
						    	<input type="text" class="form-control" id="staticEmail">
					    	</div>
					  	
					  	</div>
		        	</div>

		        	<div class="card-body">
							<ul class="list-group">
								@foreach($category as $value)
							  		<li class="list-group-item d-flex justify-content-between align-items-center">
							    		{{$value->category}}
							    		<a href="#" class="badge badge-primary badge-pill" onclick="deletecategory('{{ $value->id }}')">X</a>
							  		</li>
							  	@endforeach
							</ul>
		        	</div>		
		        </div>        
		        
        	</div>
        	
        	<div class="col-md-4">
        		<div class="card">
		        	<div class="card-header bg-primary">
		        		<div class="form-group row mb-0">
		    			
		    				<label for="staticEmail" class="col-sm-3 col-form-label text-white font-weight-bold">Contractor</label>
						    <div class="col-sm-9">
						    	<input type="text" class="form-control" id="staticEmail">
					    	</div>
					  	
					  	</div>
		        	</div>

		        	<div class="card-body">
							<ul class="list-group">
								@foreach($contractor as $value)
							  		<li class="list-group-item d-flex justify-content-between align-items-center">
							    		{{$value->contractor}}
							    		<a href="#" class="badge badge-primary badge-pill" onclick="deletecontractor('{{ $value->id }}')">X</a>
							  		</li>
							  	@endforeach
							</ul>
		        	</div>		
		        </div>        
		        
        	</div>

        </div>


	</div>


	<script type="text/javascript">
		$('document').ready(function(){
			
		});

		function deletecategory(id){
			$.ajax({
				url:'/settings/deletecategory',
				type:'POST',
				data:{id:id},
				dataType:'JSON',
				success:function(data){
					alert('Record has been deleted');
					location.reload();
				}
			})
		}

		function deletecontractor(id){
			$.ajax({
				url:'/settings/deletecontractor',
				type:'POST',
				data:{id:id},
				dataType:'JSON',
				success:function(data){
					alert('Record has been deleted');
					location.reload();
				}
			})
		}
	</script>
@endsection