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

    <div class="main-wrapper">

    <?php $this->load->view('partials/menu') ?>

        <!-- Page Wrapper -->

        <div class="page-wrapper">

            <div class="content container-fluid">

        

                <!-- Page Header -->

                <div class="page-header">

                    <div class="row align-items-center">

                        <div class="col">

                            <h3 class="page-title">Kilometer Master</h3>

                            <ul class="breadcrumb">

                                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>

                                <li class="breadcrumb-item active">Kilometer Master</li>

                            </ul>

                        </div>

                        <div class="col-auto">

                            <a href="invoices" class="invoices-links active">

                                <i data-feather="list"></i>

                            </a>

                            <a href="invoice_grid" class="invoices-links">

                                <i data-feather="grid"></i>

                            </a>

                        </div>

                    </div>

                </div>

                <!-- /Page Header -->

            

                <!-- Report Filter -->

                
                <!-- /Report Filter -->



                <div class="card invoices-tabs-card">

                    <div class="card-body card-body p-0">

                        <div class="invoices-main-tabs">

                            <div class="row align-items-center">

                                <div class="col-lg-10 col-md-10">

                                    <div class="invoices-tabs">

                                        <ul>

                                            <li><a href="transport_master" >Transporter Master</a></li>

                                            <li><a href="vehicle_master" >Vehicle Master</a></li>  

                                            <li><a href="contract_master" class="active">Contract Master</a></li>        

                                            <li><a href="zone_master" >Zone Master</a></li>    

                                            <li><a href="diesel_master" >Disel Master</a></li>

                                            <li><a href="kilometer_master" >Kilometer Master</a></li>

                                        </ul>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-2 col-md-2">

                    <div class="invoices-settings-bt mb-3">

                        <a href="add_invoice" class="bt">

                            <i data-feather="plus-circle"></i> Add New 

                        </a>

                    </div>

                </div>

                <div class="row">

                    <div class="row align-items-center form-group ">
                        <label for="zipcode" class="col-sm-2 col-form-label input-label">Upload File</label>
                        <div class="col-sm-4">
                            <div class="invoices-upload-btn">
                                <input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)" class="hide-input">
                                <label for="file" class="upload"> upload File </label>
                            </div>
                        </div>
                        <div class="invoice-setting-btn col-sm-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="row align-items-center form-group ">
                        <label for="zipcode" class="col-sm-2 col-form-label input-label">Search contract</label>
                        <div class="col-sm-2">
                            <div class="">
                                <input type="text" name="image" id="file" class="form-control" placeholder="Destination">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="">
                                <input type="text" name="image" id="file" class="form-control" placeholder="Vehicle Name">
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