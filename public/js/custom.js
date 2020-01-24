 function postForm(url,data,successcallback=function(){},method="POST",returntype="json"){
                $.ajax({
                    url : url,
                    method: method,
                    data: data,
                    dataType: returntype,
                    success : function(responsedata){
                        // showNotify('Success','Successfully Saved');
                        successcallback(responsedata);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('error in processing');
                        if(jqXHR.status==422) {
                            var errors = '';
                            for(index in jqXHR.responseJSON){
                                $('#'+index).parent().addClass('has-error')
                                errors += jqXHR.responseJSON[index] + '<br>';
                            }
                            if(errors != ''){
                                // showNotify('Error!',errorThrown);
                            }
                        }
                        // showNotify('Error!',errorThrown);
                        
                        /*console.log("It failed!");
                        console.log(jqXHR);
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);*/
                    }
                });
            }