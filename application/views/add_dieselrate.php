<!DOCTYPE html>

<html lang="en">



<head>



    <?php $title_meta ?>



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

                                <h3 class="page-title">Diesel Rate</h3>

                                <ul class="breadcrumb">

                                    <li class="breadcrumb-item"><a href="<?php echo base_url()?>?/dashboard">Dashboard</a></li>

                                    <li class="breadcrumb-item"><a href="<?php echo base_url()?>?/diesel_master">Diesel Rate</a></li>

                                    <li class="breadcrumb-item active"><?php echo $title_meta['title'] ?></li>

                                </ul>

                                <div class="mt-3">
                                    <a href="<?php echo base_url(); ?>?/home/diesel_master"><button type="button" class="btn btn-primary"> ❮ Back</button></a>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- /Page Header -->

                    

                    <div class="row">

                        <div class="col-md-12">

                            <div class="card">

                                <div class="card-body">

                                    <!-- <h4 class="card-title">Basic Info</h4> -->

                                    <form action="<?php echo base_url(); ?>?/home/save_dieselrate" method="post">

                                        <div class="row">

                                            <div class="col-md-4">

                                                <div class="form-group">

                                                    <label>Month/Date</label>

                                                    <input type="hidden" name="id" value="<?php if(isset($edit)){ print_r($edit[0]['ID']);}  ?>">

                                                    <input type="date" name="datemonth" class="form-control" value="<?php if(isset($edit)){ print_r($edit[0]['DATE']);}  ?>">

                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">

                                                    <label>Rate</label>

                                                    <input type="text" name="dieselrate" class="form-control" value="<?php if(isset($edit)){ print_r($edit[0]['RATE']);}  ?>">

                                                </div>

                                            </div>

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