<!DOCTYPE html>

<html lang="en">
<head>
    <?php //echo $title_meta ?>
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

    <div class="main-wrapper">

    <?php $this->load->view('partials/menu') ?>

        <!-- Page Wrapper -->

        <div class="page-wrapper">

            <div class="content container-fluid">                
                <div class="row">

                    <div class="row align-items-center form-group ">
                        <label for="zipcode" class="col-sm-2 col-form-label input-label">Select Report</label>
                        <div class="col-sm-9">
                            <div class="date-picker">
                                <div class="form-custom cal-icon">
                                    <input class="form-control datetimepicker" type="text" placeholder="Form">
                                </div>
                            </div>
                            <div class="date-picker">
                                <div class="form-custom cal-icon">
                                    <input class="form-control datetimepicker" type="text" placeholder="To">
                                </div>
                            </div>
                            <div class="invoice-setting-btn">
                                <button type="submit" class="btn btn-primary">Submit</button>
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