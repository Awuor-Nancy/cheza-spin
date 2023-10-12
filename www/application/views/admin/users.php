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
                                    <h4 class="header-title mb-3">View => Users</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->



                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h5 class="mt-0 font-14 mb-3">Users</h5>
                                    <div class="table-responsive">
                                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>User ID</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Current Balance</th>
                                                    <th>Date Registered</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
    
                                            <tbody>
                                                <?php
                                                    foreach($users as $client){
                                                        $client_status ="UNKNOWN";
                                                        $client_class = "text-info";
                                                        if($client["status"] == 'ACTIVE'){
                                                            $client_class = "text-success";
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $client["client_id"];?></td>
                                                            <td><?php echo $client["client_name"];?></td>
                                                            <td><a href="<?php echo site_url('admin/users/view/'.$client["client_id"]);?>"><?php echo $client["client_phone_num"];?></a></td>
                                                            <td><?php echo $client["client_wallet_bal"];?></td>
                                                            <td><?php echo $client["date_registered"];?></td>
                                                            <td class="<?php echo $client_class;?>"><?php echo $client["status"];?></td>
                                                        </tr>
                                                        <?php
                                                    } //end foreach
                                                ?>
                                                
                                                
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
                    <footer class="footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    2017 - 2020 &copy; Simple theme by <a href="#">Coderthemes</a>
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

        <script src="<?php echo base_url();?>assets/libs/morris-js/morris.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/raphael/raphael.min.js"></script>

        
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
        <!--script src="<?php echo base_url();?>assets/js/pages/datatables.init.js"></script-->

        <!-- App js -->
        <script src="<?php echo base_url();?>assets/js/app.min.js"></script>
        
        <script>
            $(document).ready(function() {
            $("#datatable").DataTable({
                order: [[0, 'desc']],
            });
            var a = $("#datatable-buttons").DataTable({
                lengthChange: !1,
                buttons: ["copy", "excel", "pdf"],
                order: [[0, 'desc']],
            });
            $("#key-table").DataTable({
                keys: !0
            }), $("#responsive-datatable").DataTable(), $("#selection-datatable").DataTable({
                select: {
                    style: "multi"
                }
            }), a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
        });
        </script>

    </body>

</html>