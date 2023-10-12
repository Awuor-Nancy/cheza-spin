<!DOCTYPE html>
<html lang="en">

<?php 
	// Get Mpesa Settings from the database
	$mpesa_settings = $this->db->get_where('mpesa_settings', ['id' => 1])->row();
	$BussinessShortCode = $mpesa_settings->businessShortCode;
	$PartyB = $mpesa_settings->partyB;
	$AccountReference = $mpesa_settings->accountReference;
	$PassKey = $mpesa_settings->passKey;
	$ConsumerKey = $mpesa_settings->ConsumerKey;
	$SecretKey = $mpesa_settings->SecretKey;
?>

    <head>
        <meta charset="utf-8" />
        <title>User VIew</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico">
        <!-- Plugin css -->
        <link href="<?php echo base_url();?>assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>assets/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- Summernote css -->
        <link href="<?php echo base_url();?>assets/libs/summernote/summernote-bs4.css" rel="stylesheet" type="text/css" />
        <!-- App css -->
        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="<?php echo base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

    </head>

    <body data-layout="horizontal">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Navigation Bar-->
            <?php $this->load->view('admin/navigation.php'); ?>
            <!-- End Navigation Bar-->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start container-fluid -->
                    <div class="container-fluid">


                        <!-- start  -->
                        <div class="row">
                             <div class="col-lg-6">
                                <div class="mt-5">
                                    <h4 class="header-title mb-3">Login</h4>
                                    <p class="sub-header">
                                        Admin Login Details
                                    </p>

                                    <div class="mb-4">
                                        <form class="form-validation">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-md-4 form-control-label">Email<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text"  class="form-control" disabled="disabled"  placeholder="" value="<?php echo $admin_email; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="hori-pass1" class="col-md-4 form-control-label" >New Password<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" placeholder="Password" id="user_password" required class="form-control" >
                                                </div>
                                            </div>
                                            <div class="form-group row justify-content-end">
                                                <div class="col-md-8">
                                                    <button type="submit" class="btn btn-warning waves-effect waves-light mr-1" id="update_pass">
                                                       Update
                                                    </button>
                                                    <div id="output2"></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <!-- start  -->
                        <div class="row">
                             <div class="col-lg-6">
                                <div class="mt-5">
                                    <h4 class="header-title mb-3">Mpesa Payment Settings</h4>
                                    <p class="sub-header">
                                        Mpesa Activation Details
                                    </p>

                                    <div class="mb-4">
                                        <form class="form-validation" id="updateMpesaSettings">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-md-4 form-control-label">Store Number<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text"  class="form-control" name="business_code"  placeholder="" value="<?= $BussinessShortCode ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-md-4 form-control-label">Pay Bill/Till Number<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text"  class="form-control" name="party_b"  placeholder="" value="<?= $PartyB ?>">
                                                </div>
                                            </div>
											<div class="form-group row">
                                                <label for="inputEmail3" class="col-md-4 form-control-label">Account Reference<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text"  class="form-control" name="account_reference"  placeholder="" value="<?= $AccountReference ?>">
                                                </div>
                                            </div>
											<div class="form-group row">
                                                <label for="inputEmail3" class="col-md-4 form-control-label">Mpesa Pass-Key<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text"  class="form-control" name="pass_key"  placeholder="" value="<?= $PassKey ?>">
                                                </div>
                                            </div>
											<div class="form-group row">
                                                <label for="inputEmail3" class="col-md-4 form-control-label">Consumer Key<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text"  class="form-control" name="consumer_key"  placeholder="" value="<?= $ConsumerKey ?>">
                                                </div>
                                            </div>
											<div class="form-group row">
                                                <label for="inputEmail3" class="col-md-4 form-control-label">Secret Key<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text"  class="form-control" name="secret"  placeholder="" value="<?= $SecretKey ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row justify-content-end">
                                                <div class="col-md-8">
                                                    <button type="submit" class="btn btn-warning waves-effect waves-light mr-1" id="update_Mpesa_settings">
                                                       Update
                                                    </button>
                                                    <div id="output3"></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                    </div>
                    <!-- end container-fluid -->

                    

                    <!-- Footer Start -->
                    <footer class="footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    2022 &copy;  <a href="#">SpinPesa</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- end Footer -->

                </div>
                <!-- end content -->

            </div>
            <!-- END content-page -->

        </div>
        <!-- END wrapper -->



        <!-- Vendor js -->
        <script src="<?php echo base_url();?>assets/js/vendor.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/moment/moment.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/switchery/switchery.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/select2/select2.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/parsleyjs/parsley.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- Summernote js -->
        <script src="<?php echo base_url();?>assets/libs/summernote/summernote-bs4.min.js"></script>
        
        <!-- Datatables init -->
        <!-- Required datatable js -->
        <script src="<?php echo base_url();?>assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
        
        <!-- Buttons examples -->
        <script src="<?php echo base_url();?>assets/libs/datatables/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables/dataTables.select.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/jszip/jszip.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/pdfmake/pdfmake.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/pdfmake/vfs_fonts.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables/buttons.html5.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables/buttons.print.min.js"></script>
        
        <script src="<?php echo base_url();?>assets/js/pages/datatables.init.js"></script>

        <!-- Init js-->
        <script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url();?>assets/js/app.min.js"></script>
        
        <script>
        function swal_disabled(){
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: '...........'
            });
        } //end of swal disabled
        
    	$(document).ready(function(){
			//============================================================ Handle Mpesa Settings Update =========================================//
			$("#update_Mpesa_settings").click(function(e) {
				e.preventDefault();
				const form = $("#updateMpesaSettings");
				const payloadData = form.serialize();
				const url = '<?= site_url('admin/dashboard/update_mpesa_detsils') ?>'
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'JSON',
					data: payloadData,
					beforeSend: function() {
						$("#update_Mpesa_settings").attr('disabled', true);
						$("#update_Mpesa_settings").append('<div class="spinner-border text-light"></div>');
					},
					success: function(data) {
						if (data.status == 'success') {
							$("#update_Mpesa_settings").attr('disabled', false);
    		  				$("#update_Mpesa_settings").html('Update');		
    		  				$("#output3").append('<div class="alert alert-success">'+
                                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
                                                '<h4 class="text-success"><i class="fa fa-exclamation-circle"></i> Successfully Updated</h4> '+
                                            '</div>');
						}
					}
				});
				
			})
    	    

          //============================================================handle user pass details update=========================================//
    	$("#update_pass").click(function(event) {
    	$("#output").html('');
    	$("#update_pass").html('Processing');
    	$("#submitbtn_spin").append('<div class="spinner-border text-light"></div>');

    	event.preventDefault();
   
    	// FormData object 
    	var data = new FormData();
        data.append("client_id", $("#client_id").val());
        data.append("password", $("#user_password").val());
    	// disabled the submit button
    	$("#register_button").prop("disabled", true);
        alert('go ahead');
    	$.ajax({
    
    	  type: "POST",
    	  enctype: 'multipart/form-data',
    	  url: "<?php echo site_url().'/admin/update_password'; ?>",
    	  data: data,
    	  processData: false,
    	  contentType: false,
    	  cache: false,
    	  timeout: 800000,
    	  success: function(data) {
    		const obj = JSON.parse(data);
    		if (obj.code == 2) {
    		 

    		  $("#update_pass").html('Update');
    		  $("#register_button_spin").html('');
    		  $("#output2").append('<div class="alert alert-danger">'+
                                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
                                                '<h5 class="text-danger" style="font-size:12px;><i class="fa fa-exclamation-circle"></i> Error</h5> '+ obj.desc +
                                            '</div>');
    		}
    		if (obj.code == 1) {
    		  $("#update_pass").html('Update');
    		  $("#submitbtn_spin").html('');		
    		  $("#output2").append('<div class="alert alert-success">'+
                                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
                                                '<h4 class="text-success"><i class="fa fa-exclamation-circle"></i> Success</h4> '+ obj.desc +
                                            '</div>');
    		
    		}
    		
    		console.log("SUCCESS : ", data);
    		$("#register_button").prop("disabled", false);
    		
    	  },
    
    	  error: function(e) {
    		$("#update_pass").html('Update');
    		  $("#submitbtn_spin").html('');
    		$("#output2").append('<div class="alert alert-danger">'+
                                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
                                                '<h4 class="text-danger"><i class="fa fa-exclamation-circle"></i> Error</h4> An error has occured while submitting data. Please try again. '+
    											'If problem persists, contact system administrator'+ 
                                            '</div>');
    		console.log("ERROR : ", e);
    		$("#btnSubmit").prop("disabled", false);
    
    	  }
    
    	}); //end ajax
    
      });//end user pass details update
    	    
    	});
	
	
</script>

    </body>

</html>
