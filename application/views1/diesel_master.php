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

                                <h3 class="page-title">Diesel Master</h3>

                                <ul class="breadcrumb">

                                    <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>

                                    <li class="breadcrumb-item active">Diesel Master</li>

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

                        <div class="card-body card-body pt-0 p-0">

                            <div class="invoices-main-tabs">

                                <div class="row align-items-center">

                                    <div class="col-lg-10 col-md-10">

                                        <div class="invoices-tabs">

                                            <ul>
 
												<li><a href="transport_master" >Transporter Master</a></li>

                                                <li><a href="vehicle_master" >Vehicle Master</a></li>  

                                                <li><a href="contract_master">Contract Master</a></li>        

                                                <li><a href="zone_master" >Zone Master</a></li>    

                                                <li><a href="diesel_master" class="active">Disel Master</a></li>

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
                            
                            <a href="<?php echo base_url(); ?>add_dieselrate" class="bt">

                                <i data-feather="plus-circle"></i> Add New Rate

                            </a>

                        </div>

                    </div>
                    
                    <div class="row">

                        <div class="col-sm-4">

                            <div class="card card-table"> 

                                <div class="card-body">

                                    <div class="table-responsive">

                                        <table class="table table-striped table-hover datatable">

                                            <thead class="thead-light">

                                                <tr>

                                                   <th>Month/Date</th>

                                                   <th>Price</th>


                                                   

                                                   <th class="text-end">Action</th>

                                                </tr>

                                            </thead>

                                            <tbody>
                                                <?php //print_r($getDieselRate); 
                                                    foreach($getDieselRate as $dieselrate){
                                                ?>
                                                <tr>
                                                    <td><?php echo $dieselrate->DATE; ?></td>

                                                    <td><?php echo $dieselrate->RATE; ?></td>

                                                    <td class="text-end">

                                                        <div class="dropdown dropdown-action">

                                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>

                                                            <div class="dropdown-menu dropdown-menu-end">

                                                                <a class="dropdown-item" href="<?php echo base_url(); ?>edit_dieselrate/<?php echo base64_encode($dieselrate->ID); ?>"><i class="far fa-edit me-2"></i>Edit</a>

                                                                <a class="dropdown-item" href="view_invoice"><i class="far fa-eye me-2"></i>View</a>

                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>


                                                            </div>

                                                        </div>

                                                    </td>

                                                </tr>
                                                    <?php } ?>

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









<?php $this->load->view('partials/vendor-scripts') ?>



</body>



</html>