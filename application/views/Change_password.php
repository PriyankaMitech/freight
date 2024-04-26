<!DOCTYPE html>

<html lang="en">



<head>



    <?php //print_r($title_meta) ?>



    <?php $this->load->view('partials/head-css') ?>

    <style>

        .sidebar {

            display: none;

        }

        .page-wrapper {

            margin-left: 0px;

        }

        .date-picker {

            width: auto;

        }

    </style>



</head>



<?php $this->load->view('partials/body') ?>





    <!-- ============================================================== -->

    <!-- Start right Content here -->

    <!-- ============================================================== -->

    <div class="main-wrapper">

    <?php $this->load->view('partials/menu') ?>



            <!-- Page Wrapper -->

            <div class="page-wrapper">

                <div class="content container-fluid">

                

                    <!-- Page Header -->

                    <div class="page-header">

                        <div class="row">

                            <div class="col-sm-12">

                                <h3 class="page-title">Change Password</h3>

                                

                            </div>

                        </div>

                    </div>

                    <!-- /Page Header -->

                    

                    <div class="row">

                        <div class="col-md-12">

                            <div class="card">

                                <div class="card-body">

                                    <!-- <h4 class="card-title">Basic Info</h4> -->

                                    <form action="<?php echo base_url(); ?>?/home/save_password" method="post">

                                        <div class="row">

                                            <div class="col-md-4">

                                                <div class="form-group">

                                                    <label>User Name</label>

                                                    <input type="hidden" name="id" value="<?php if(isset($edit)){ print_r($edit->ID);}  ?>">

                                                    <input type="text" name="USER_EMAIL" class="form-control" value="<?php if(isset($edit)){ echo ($edit->USER_EMAIL);}  ?>">

                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">

                                                    <label>Old Password</label>

                                                    <input type="text" name="old_pass" class="form-control" value="<?php if(isset($edit)){ print_r($edit->USER_PASS);}  ?>">

                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">

                                                    <label>New Password</label>

                                                    <input type="text" name="new_pass" class="form-control" value="">

                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            
                                            <div class="col-md-4">

                                                <div class="text-end mt-4">

                                                    <button type="submit" class="btn btn-primary"><?php echo $title_meta['title'] ?></button>

                                                </div>

                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- /Page Wrapper -->

    </div>

    <!-- end main content-->









<?php $this->load->view('partials/vendor-scripts') ?>



</body>



</html>