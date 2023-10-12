<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Login </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App css -->
        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="<?php echo base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

    </head>

    <body>
        <div class="account-pages my-5 pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mb-4 mt-3">
                                    <a href="index.html">
                                        <span><img src="assets/images/logo-dark.png" alt="" height="30"></span>
                                    </a>

                                </div>
                                <form action="" class="p-2" id="login-form">
                                    <div class="form-group">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" name="email" id="emailaddress" required="" placeholder="Admin Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required="" name="password" id="password" placeholder="Enter your password">
                                    </div>

                                    <div class="form-group mb-4 pb-3">
                                        <div id="output"></div>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <button class="btn btn-primary btn-block" id="submit-btn" type="submit"> Sign In <span id="submitbtn_spin"></span> </button>
                                    </div>
                                </form>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                       
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
        	<!-- jQuery -->
	<script src="<?php echo base_url('assets/front/');?>js/jquery-3.2.1.min.js"></script>

        <!-- Vendor js -->
        <script src="<?php echo base_url();?>assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url();?>assets/js/app.min.js"></script>
        <script>
            $(document).ready(function(){
                	//================================================================handle login==================================================//
            	$("#submit-btn").click(function(event) {
            	$("#output").html('');
            	$("#submit-btn").html('Processing');
            	$("#submitbtn_spin").append('<div class="spinner-border text-light"></div>');
            
            	//stop submit the form, we will post it manually.
            
            	event.preventDefault();
            	// Get form
            
            	var form = $('#login-form')[0];
            	// FormData object 
            
            	var data = new FormData(form);
            	// If you want to add an extra field for the FormData
                //data.append("CustomField", "This is some extra data, testing");
            
            	// disabled the submit button
            	$("#submit-btn").prop("disabled", true);
            
            	$.ajax({
            
            	  type: "POST",
            	  enctype: 'multipart/form-data',
            	  url: "<?php echo site_url().'/admin/login/validate'; ?>",
            	  data: data,
            	  processData: false,
            	  contentType: false,
            	  cache: false,
            	  timeout: 800000,
            	  success: function(data) {
            		const obj = JSON.parse(data);
            		if (obj.code == 1) {
            		    if(obj.placeholder == 1){
            		        $('#cust_name').addClass("error"); 
            		    }
            		  $("#submit-btn").html('Sign In');
            		  $("#submitbtn_spin").html('');
            		  $("#output").append('<div class="alert alert-danger">'+
                                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
                                                        '<h4 class="text-danger"><i class="fa fa-exclamation-circle"></i> Error</h4> '+ obj.desc +
                                                    '</div>');
                    $("#submit-btn").prop("disabled", false);
            		}
            		if (obj.code == 2) {
            		   window.location.href = "<?php echo site_url("admin") ?>";
            		  
            		  $("#submit-btn").html('Verified');
            		  $("#submitbtn_spin").html('');		
            		  $("#output").append('<div class="alert alert-success">'+
                                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
                                                        '<h4 class="text-success"><i class="fa fa-exclamation-circle"></i> Success</h4> '+ obj.desc +
                                                    '</div>');
            		  
            		}
            		
            		if (obj.code == 3) {
            		  $("#submitbtn_txt").html('Verified');
            		  $("#submitbtn_spin").html('');		
            		  $("#output").append('<div class="alert alert-success">'+
                                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
                                                        '<h4 class="text-success"><i class="fa fa-exclamation-circle"></i> Success</h4> '+ obj.desc +
                                                    '</div>');
            		  window.location.href = "<?php echo site_url().'/admin/dashboard'; ?>";
            		}
            		
            		console.log("SUCCESS : ", data);
            		$("#btnSubmit").prop("disabled", false);
            		
            	  },
            
            	  error: function(e) {
            		$("#submit-btn").html('Error ! Try again');
            		  $("#submitbtn_spin").html('');
            		$("#output").append('<div class="alert alert-danger">'+
                                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
                                                        '<h4 class="text-danger"><i class="fa fa-exclamation-circle"></i> Error</h4> An error has occured while submitting data. Please try again. '+
            											'If problem persists, contact system administrator'+ 
                                                    '</div>');
            		console.log("ERROR : ", e);
            		 $("#submit-btn").prop("disabled", false);
            
            	  }
            
            	});
            
              }); //end handle ogin
            });
        </script>

    </body>

</html>
