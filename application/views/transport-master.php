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

        .alert-success {

            right: 4px;

            position: fixed;

            top: 5px;

            z-index: 1111;

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



                                <h3 class="page-title">Transporter Master</h3>



                                <ul class="breadcrumb">



                                    <li class="breadcrumb-item"><a href="<?php echo base_url()?>?/dashboard">Dashboard</a></li>



                                    <li class="breadcrumb-item active">Transporter Master</li>



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



                    <div class="card invoices-tabs-card">



                        <div class="card-body card-body pt-0 p-0">



                            <div class="invoices-main-tabs">



                                <div class="row align-items-center">



                                    <div class="col-lg-10 col-md-10">



                                        <div class="invoices-tabs">



                                            <ul class="nav nav-tabs">



                                               <li><a href="transport-master" class="active">Transporter Master</a></li>



                                                <li><a href="vehicle_master">Vehicle Master</a></li>  



                                                <li><a href="contract_master">Contract Master</a></li>        



                                                <li><a href="zone_master">Zone Master</a></li>    



                                                <li><a href="diesel_master">Diesel Master</a></li>



                                                <li><a href="kilometer_master" class="">Kilometer Master</a></li>



                                            </ul>



                                        </div>



                                    </div>



                                </div>



                            </div>



                        </div>



                    </div>

                    <?php 

                        //$session = \Config\Services::session();

                        if($this->session->flashdata('success'))

                        {

                            echo '<div class="alert alert-success alert-dismissible">'.$this->session->flashdata("success").'</div>';

                        }

                    ?>

                    <div class="col-lg-2 col-md-2">



                        <div class="invoices-settings-bt mb-3">



                            <a href="add-transporter" class="tn">



                                <i data-feather="plus-circle"></i> Add New Transporter



                            </a>



                        </div>



                    </div>

                    

                    <div class="row">



                        <div class="col-sm-12">



                            <div class="card card-table"> 



                                <div class="card-body">



                                    <div class="table-responsive">



                                        <table class="table table-striped table-hover datatable">



                                            <thead class="thead-light">



                                                <tr>



                                                   <th>Code</th>



                                                   <th>Name</th>



                                                   <th>Type</th>



                                                   <th>Address</th>



                                                   <th>Contact Person</th>



                                                   <th>Contact</th>



                                                   <th>Email</th>



                                                   <th>Status</th>



                                                   <th class="text-end">Action</th>



                                                </tr>



                                            </thead>



                                            <tbody>



                                                <?php //print_r($getTransport); 

                                                    foreach($getTransport as $transport){ ?>

                                                <tr>

                                                    <td><?php echo $transport->CODE;?></td>

                                                    <td><?php echo $transport->TRANSPORTER_NAME; ?></td>

                                                    <td><?php echo $transport->TRANSPORTER_TYPE; ?></td>

                                                    <td>

                                                        <h2 class="table-avatar">

                                                            <?php echo $transport->ADDRESS; ?>

                                                        </h2>

                                                    </td>

                                                    <td><?php echo $transport->CONTACT_PERSON; ?></td>

                                                    <td><?php echo $transport->CONTACT_PERSON; ?></td>

                                                    <td><?php echo $transport->PHONE; ?></td>

                                                    <td><?php echo $transport->TRANSPORTER_EMAIL; ?></td>

                                                    <td class="text-end">

                                                        <div class="dropdown dropdown-action">

                                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>

                                                            <div class="dropdown-menu dropdown-menu-end">

                                                            <a class="dropdown-item" href="<?php echo base_url(); ?>/edit_transporter/"><i class="far fa-edit me-2"></i>Edit</a>

                                                            <a class="dropdown-item" href="view_invoice"><i class="far fa-eye me-2"></i>View</a>



                                                            <a class="dropdown-item" href="delete_transporter/"><i class="far fa-trash-alt me-2"></i>Delete</a>

                                                            </div>

                                                        </div>

                                                    </td>

                                                </tr>

                                                        

                                                <?php    }

                                                ?>

                                                <tr>

                                                    <td>

                                                    <?php echo $transport->CODE; ?>



                                                        </td>



                                                        <td><?php echo $transport->TRANSPORTER_NAME; ?></td>



                                                        <td><?php echo $transport->TRANSPORTER_TYPE; ?></td>



                                                        <td>



                                                        <h2 class="table-avatar">



                                                        <?php echo $transport->ADDRESS; ?>



                                                        </h2>



                                                        </td>



                                                        <td><?php echo $transport->CONTACT_PERSON; ?></td>



                                                        <td><?php echo $transport->PHONE; ?></td>



                                                        <td><?php echo $transport->TRANSPORTER_EMAIL; ?></td>



                                                        <td><span class="badge bg-primary-light"><?php echo $transport->IS_ACTIVE; ?></span></td>



                                                        <td class="text-end">



                                                        <div class="dropdown dropdown-action">



                                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>



                                                            <div class="dropdown-menu dropdown-menu-end">



                                                                <a class="dropdown-item" href="<?php echo base_url(); ?>/edit_transporter/<?php echo base64_encode($transport['ID']); ?>"><i class="far fa-edit me-2"></i>Edit</a>



                                                                <a class="dropdown-item" href="view_invoice"><i class="far fa-eye me-2"></i>View</a>



                                                                <a class="dropdown-item" href="delete_transporter/<?php echo base64_encode($transport['ID']); ?>"><i class="far fa-trash-alt me-2"></i>Delete</a>



                                                            </div>



                                                        </div>



                                                        </td>

                                                </tr>

                                                <?php //} ?>



                                            </tbody>



                                        </table>



                                    </div>



                                </div>



                            </div>



                        </div>



                    </div>



                </div>



            </div>



            <!-- /Page Wrapper -->



    </div>



    <!-- end main content-->



















<?= $this->include('partials/vendor-scripts') ?>







</body>







</html>