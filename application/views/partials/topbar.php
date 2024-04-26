            <!-- Header -->


            <div class="header header-one">

            

                <!-- Logo -->

                <div class="header-left header-left-one">

                    <a href="dashboard" class="logo">

                        <img src="<?php echo base_url();?>/assets/img/logo-bericap.png" alt="Logo">

                    </a>

                    <a href="dashboard" class="white-logo">

                        <img src="<?php echo base_url();?>/assets/img/logo-white.png" alt="Logo">

                    </a>

                    <a href="dashboard" class="logo logo-small">

                        <img src="<?php echo base_url();?>/assets/img/Bericap_favicon.jpg" alt="Logo" width="30" height="30">

                    </a>

                </div>

                <!-- /Logo -->

                

                <!-- Sidebar Toggle -->

                <!-- <a href="javascript:void(0);" id="toggle_btn">

                    <i class="fas fa-bars"></i>

                </a> -->

                <!-- /Sidebar Toggle -->

                

                <!-- Mobile Menu Toggle -->

                <a class="mobile_btn" id="mobile_btn">

                    <i class="fas fa-bars"></i>

                </a>

                <!-- /Mobile Menu Toggle -->

                

                <!-- Header Menu -->

                <ul class="nav nav-tabs user-menu">

                    <!-- Flag -->
                    <?php if (!empty($_SESSION)) { ?>
                        <?php if($_SESSION['role_id'] == 3){ ?>

                            <li class="nav-item dropdown has-arrow flag-nav">

                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">

                                    <span>Freight</span>

                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="<?php echo base_url(); ?>reports" class="dropdown-item"> Reports </a>
                                </div>


                            </li>
                        <?php }else{ ?>
                            <li class="nav-item dropdown has-arrow flag-nav">

                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">

                                    <span>Freight</span>

                                </a>

                                <div class="dropdown-menu dropdown-menu-right">

                                    <a href="<?php echo base_url();?>transport_master" class="dropdown-item"> Freight Master </a>

                                    <a href="<?php echo base_url();?>ChangePassword" class="dropdown-item"> Change Password </a>

                                    <a href="<?php echo base_url();?>sales_register" class="dropdown-item"> Sales Register </a>

                                    <a href="<?php echo base_url(); ?>budget_up" class="dropdown-item"> Budget </a>

                                    <a href="<?php echo base_url(); ?>cost_statement" class="dropdown-item"> Cost Allocation Screen </a>

                                    <a href="<?php echo base_url(); ?>reports" class="dropdown-item"> Reports </a>

                                    <a href="<?php echo base_url(); ?>TransView" class="dropdown-item"> Transporter Invoices </a>

                                    <a href="<?php echo base_url(); ?>transcred" class="dropdown-item"> Transporter Credentials </a>

                                    <a href="<?php echo base_url(); ?>delete_lr" class="dropdown-item"> Delete Lr </a>

                                </div>


                            </li>
                        <?php } ?>
                    <?php } ?>

                    <!-- /Flag -->

                    

                    <!-- User Menu -->

                    <li class="nav-item dropdown has-arrow main-drop">

                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">

                            <span class="user-img">

                                <img src="<?php echo base_url();?>/assets/img/profiles/avatar-01.jpg" alt="">

                                <span class="status online"></span>

                            </span>

                            <span>Admin</span>

                        </a>

                        <div class="dropdown-menu">

                            <a class="dropdown-item" href="profile"><i data-feather="user" class="me-1"></i> Profile</a>

                            <a class="dropdown-item" href="settings"><i data-feather="settings" class="me-1"></i> Settings</a>

                            <a class="dropdown-item" href="Logout"><i data-feather="log-out" class="me-1"></i> Logout</a>

                        </div>

                    </li>

                    <!-- /User Menu -->

                    

                </ul>

                <!-- /Header Menu -->

                

            </div>

            <!-- /Header -->