<!DOCTYPE html>

<html lang="en">



<head>

    <?php $this->load->view('partials/head-css') ?>

    <style>

        .sidebar {

            /* display: none; */

        }

        .page-wrapper {

            margin-left: 0px;

        }

        .date-picker {

            width: auto;

        }

    </style>

<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/plugins/select2/css/select2.min.css">

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

                                <h3 class="page-title">Transporters</h3>

                                <ul class="breadcrumb">

                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>?/dashboard">Dashboard</a></li>

                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>?/transport_master">Transporters</a></li>

                                    <li class="breadcrumb-item active">Add Transporters</li>

                                </ul>
                                <div class="mt-3">
                                    <a href="<?php echo base_url(); ?>?/transport_master"><button type="button" class="btn btn-primary"> ❮ Back</button></a>
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

                                    <form action="<?php echo base_url(); ?>?/home/save_transporter" method="post">

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label>Code</label>

                                                    <input type="text" name="code" class="form-control" value="<?php if(isset($edit)){ print_r($edit[0]->CODE);}  ?>">

                                                </div>

                                                <div class="form-group">

                                                    <label>Email</label>

                                                    <input type="email" name="email" class="form-control" value="<?php if(isset($edit)){ print_r($edit[0]->TRANSPORTER_EMAIL);}  ?>">

                                                </div>

                                                <div class="form-group">

                                                    <label>Address:</label>

                                                    <textarea rows="5" cols="5" name="address" class="form-control"><?php if(isset($edit)){ print_r($edit[0]->ADDRESS);}  ?></textarea>

                                                </div>

                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label>Transporter Name</label>

                                                    <input type="text" name="transportername" class="form-control" value="<?php if(isset($edit)){ print_r($edit[0]->TRANSPORTER_NAME);}  ?>">

                                                </div>

                                                <div class="form-group">

                                                    <label>Type</label>

                                                    <select class="select" name="type" value="<?php if(isset($edit)){ print_r($edit[0]->TRANSPORTER_TYPE);}  ?>">

                                                        <option>Select Type</option>

                                                        <option <?php if(isset($edit) && $edit[0]->TRANSPORTER_TYPE == 'full'){ print_r($edit[0]->ADDRESS);}  ?>>full</option>

                                                        <option>part</option>

                                                        <option>export</option>

                                                    </select>

                                                </div>

                                                <div class="form-group">

                                                    <label>Contact Person</label>

                                                    <input type="text" name="contactperson" class="form-control" value="<?php if(isset($edit)){ print_r($edit[0]->CONTACT_PERSON);}  ?>">

                                                </div><div class="form-group">

                                                    <label>Phone</label>

                                                    <input type="text" name="phone" class="form-control" value="<?php if(isset($edit)){ print_r($edit[0]->PHONE);}  ?>">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="text-end mt-4">

                                            <button type="submit" class="btn btn-primary"><?php echo $title_meta['title'] ?></button>

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

<script>



</script>

</body>



</html>