<?php
    if(!isset($_SESSION['admin_email'])){
        ?>
        <div style="padding: 100px;">
            <div class="alert alert-danger" role="alert" style="text-align: center;">
              <h4 class="alert-heading">No Session!</h4>
              <p>Kindly login to proceed</p>
              <hr>
              <p class="mb-0"><a href="<?= site_url("admin/login") ?>">Go to Login</a></p>
            </div>
        </div>
        
        <?php
        die();
    }
?>
<header id="topnav">
    <!-- Topbar Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-right mb-0">

                <li class="dropdown notification-list">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>

           


                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">

                        <span class="pro-user-name d-none d-xl-inline-block ml-2">
                                                Administrator  <i class="mdi mdi-chevron-down"></i> 
                                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                     

                        <!-- item-->


                        <!-- item-->
                        <a href="<?php echo site_url('admin/settings');?>" class="dropdown-item notify-item">
                            <i class="mdi mdi-settings-outline"></i>
                            <span>Settings</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="<?php echo site_url('admin/login');?>" class="dropdown-item notify-item">
                            <i class="mdi mdi-logout-variant"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>

            </ul>



            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">

                    <li class="has-submenu">
                        <a href="<?= site_url('admin'); ?>">
                            <i class="ti-home"></i>Dashboard
                        </a>
                    </li>

                    <li class="has-submenu">
                        <a href="#"> <i class="ti-files"></i>Users</a>
                        <ul class="submenu">
                            <li><a href="<?php echo site_url('admin/users');?>">Users List</a></li>
                            <li><a href="<?php echo site_url('admin/users/deposits');?>">Users Deposits</a></li>
                           

                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"> <i class="ti-files"></i>Spin Wheel </a>
                        <ul class="submenu">
                            <li><a href="<?php echo site_url();?>/admin/spin_wheel_settings/demo">Demo Spin Wheel Settings</a></li>
                            <li><a href="<?php echo site_url();?>/admin/spin_wheel_settings/demo">Live Spin Wheel Settings</a></li>

                        </ul>
                    </li>
                </ul>
                <!-- End navigation menu -->

                <div class="clearfix"></div>
            </div>
            <!-- end #navigation -->

            <div class="clearfix"></div>
        </div>
    </div>
    <!-- end Topbar -->
</header>
