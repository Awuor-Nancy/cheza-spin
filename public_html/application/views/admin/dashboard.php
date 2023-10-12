<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Dashboard</title>
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
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <h4 class="header-title mb-3">Welcome !</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="card-box widget-inline">
                                        <div class="row">
                                            <div class="col-xl-3 col-sm-6 widget-inline-box">
                                                <div class="text-center p-3">
                                                    <h2 class="mt-2"><i class="text-primary mdi mdi-access-point-network mr-2"></i> <b><?php echo number_format($dashboard_stats["completePayment"],2); ?></b></h2>
                                                    <p class="text-muted mb-0">Successful Deposits</p>
                                                </div>
                                            </div>

                                            <div class="col-xl-3 col-sm-6 widget-inline-box">
                                                <div class="text-center p-3">
                                                    <h2 class="mt-2"><i class="text-warning mdi mdi-airplay mr-2"></i> <b><?php echo number_format($dashboard_stats["offlinePayment"] ?? 0,2); ?></b></h2>
                                                    <p class="text-muted mb-0">Offline Deposits</p>
                                                </div>
                                            </div>

                                            <div class="col-xl-3 col-sm-6 widget-inline-box">
                                                <div class="text-center p-3">
                                                    <h2 class="mt-2"><i class="text-info mdi mdi-black-mesa mr-2"></i> <b><?php echo $total_users; ?></b></h2>
                                                    <p class="text-muted mb-0">Total users</p>
                                                </div>
                                            </div>

                                            <div class="col-xl-3 col-sm-6">
                                                <div class="text-center p-3">
                                                    <h2 class="mt-2"><i class="text-danger mdi mdi-cellphone-link mr-2"></i> <b><?php echo $susp_spins; ?></b></h2>
                                                    <p class="text-muted mb-0">Suspicious Spins</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row -->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="font-14 mb-3">Latest Deposits</h5>
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-info btn-sm mr-3" id="account_button" onclick="checkAccountBalance()">Check Account Balance</button>
                                            <h5 lass="font-18 mb-3 mr-3">Balance: KES <?= number_format(10000, 2) ?></h5>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table id="" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Mpesa Transaction ID</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
    
                                            <tbody>
                                                <?php
													if (!empty($latest_deposits)):
														
                                                    foreach($latest_deposits as $deposit){
                                                        $clientPhone = str_replace('254', '0', $deposit['phone_number']);
														// Get client name from the clients table
														$clientData = $this->db->get_where('clients', array('client_phone_num' => $clientPhone))->row_array();
														// Prepare date and time
														$date = strtotime($deposit['created_at']);
														$transDate = date('F j, Y', $date);
														$transTime = date('g:i a', $date);
                                                        ?>
                                                        <tr>
															<td><?php echo $deposit["mpesa_recipt_number"];?></td>
                                                            <td><?php echo $clientData["client_name"];?></td>
                                                            <td><?php echo $clientPhone;?></td>
                                                            <td><?php echo "Ksh. ".number_format($deposit["amount"],2);?></td>
                                                            <td><?php echo $transDate;?></td>
                                                            <td><?php echo $transTime;?></td>
                                                            
															<?php if ($deposit['customer_message'] == 'Requested'): ?>
                                                            <td class="text-warning">REQUESTED</td>
															<?php elseif ($deposit['customer_message'] == 'Failed'):?>
																<td class="text-danger">FAILED</td>
															<?php elseif ($deposit['customer_message'] == 'Paid'):?>
																<td class="text-success">SUCCESSFULL</td>
															<?php endif; ?>
															
                                                        </tr>
                                                        <?php
                                                    } //end foreach
                                                ?>
												<?php else: ?>
													<tr class="text-center">
														<td colspan="7">No transactions available.</td>
													</tr>
												<?php endif;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mt-0 font-14 mb-3">Offline Payments</h5>
                                        <h5 lass="font-18 mb-3 mr-3">Balance: KES <?= number_format(10000, 2) ?></h5>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Mpesa Transaction ID</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
    
                                            <tbody>
                                                <?php
													if (!empty($offline_deposits)):
														
                                                    foreach($offline_deposits as $deposit){
                                                        $clientPhone = $deposit['BillRefNumber'];
														// Get client name from the clients table
														$clientData = $this->db->get_where('clients', array('client_phone_num' => $clientPhone))->row_array();
														// Prepare date and time
														$date = strtotime(DateTime::createFromFormat('YmdHis', $deposit['TransTime'])->format('Y-m-d H:i:s'));
														$transDate = date('F j, Y', $date);
														$transTime = date('g:i a', $date);
                                                        ?>
                                                        <tr>
															<td><?php echo $deposit["TransID"]; ?></td>
                                                            <td><?php echo $clientData["client_name"] ?? '--'; ?></td>
                                                            <td><?php echo $clientPhone; ?></td>
                                                            <td><?php echo "Ksh. ".number_format($deposit["TransAmount"],2);?></td>
                                                            <td><?php echo $transDate;?></td>
                                                            <td><?php echo $transTime;?></td>
                                                            <td class="text-success">SUCCESSFULL</td>

                                                        </tr>
                                                        <?php
                                                    } //end foreach
                                                ?>
												<?php else: ?>
													<tr class="text-center">
														<td colspan="7">No transactions available.</td>
													</tr>
												<?php endif;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
                    </div>
                    <!-- end container-fluid -->
                    <!-- Footer Start -->
                    <?php $this->load->view('admin/footer') ?>
                    <!-- end Footer -->
                </div>
                <!-- end content -->
            </div>
            <!-- END content-page -->
        </div>
        <!-- END wrapper -->

      

        <!-- Vendor js -->
        <script src="<?php echo base_url();?>assets/js/vendor.min.js"></script>

        <script src="<?php echo base_url();?>assets/libs/morris-js/morris.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/raphael/raphael.min.js"></script>

        <script src="<?php echo base_url();?>assets/js/pages/dashboard.init.js"></script>
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
        <!-- Datatables init -->
        <script src="<?php echo base_url();?>assets/js/pages/datatables.init.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url();?>assets/js/app.min.js"></script>
        
        <!-- Custom Script-->
        <script>
            function checkAccountBalance() {
                const endpoint = "<?= base_url("mpesa_payment/checkAccountBalance") ?>"
                
                $.ajax({
                  url: endpoint,
                  method: 'GET',
                  dataType: 'JSON',
                  beforeSend: function() {
                      $('#account_button').html('Checking please wait...');
                  },
                  success: function(response) {
                      if (response.status === 'success') {
                          onsole.log(response.message)
                          // Handle the response here
                        $('#account_button').html('Check Account Balance')
                      }
                      
                      if (response.status === 'error') {
                          $('#account_button').html('Check Account Balance')
                          console.log(response.message)
                      }
                  },
                  error: function(xhr, status, error) {
                    console.error('Error:', error);
                    // Handle the error here
                    $('#account_button').html('Check Account Balance')
                  }
                });
            }
        </script>

    </body>

</html>
