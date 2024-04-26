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

                                                <li><a href="diesel_master" >Disel Master</a></li>

                                                <li><a href="kilometer_master" class="active">Kilometer Master</a></li>

                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="col-lg-2 col-md-2">

                        <div class="invoices-settings-bn mb-3">

                            <a href="add_invoice" class="bn">

                                <i data-feather="plus-circle"></i> Add New 

                            </a>

                        </div>

                    </div>                   
                    <div class="row">

                        <div class="col-sm-12">

                            <div class="card card-table"> 

                                <div class="card-body">

                                    <div class="table-responsive">

                                        <table class="table table-stripped table-hover datatable">

                                            <thead class="thead-light">

                                                <tr>

                                                   <th>State</th>

                                                   <th>Zone</th>
												   
                                                   <th>Destination</th>
												   
                                                   <th>Kilometer</th>
												   
                                                   <th>Transit Time</th>

                                                   <th class="text-end">Action</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <tr>
                                                    <td></td>

                                                    <td></td>
													
                                                    <td></td>
													
                                                    <td></td>
													
                                                    <td></td>

                                                    <td class="text-end">

                                                        <div class="dropdown dropdown-action">

                                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>

                                                            <div class="dropdown-menu dropdown-menu-end">

                                                                <a class="dropdown-item" href="edit_invoice"><i class="far fa-edit me-2"></i>Edit</a>

                                                                <a class="dropdown-item" href="view_invoice"><i class="far fa-eye me-2"></i>View</a>

                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>


                                                            </div>

                                                        </div>

                                                    </td>

                                                </tr>

                                                <tr>

                                                  

                                                    <td></td>

                                                    <td></td>
													
                                                    <td></td>
													
                                                    <td></td>
													
                                                    <td></td>


                                                    <td class="text-end">

                                                        <div class="dropdown dropdown-action">

                                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>

                                                            <div class="dropdown-menu dropdown-menu-end">

                                                                <a class="dropdown-item" href="edit_invoice"><i class="far fa-edit me-2"></i>Edit</a>

                                                                <a class="dropdown-item" href="view_invoice"><i class="far fa-eye me-2"></i>View</a>

                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>

                                                                

                                                            </div>

                                                        </div>

                                                    </td>

                                                </tr>

                                                <tr>

                                                   
                                                    <td></td>

                                                    <td></td>
													
                                                    <td></td>
													
                                                    <td></td>
													
                                                    <td></td>


                                                    <td class="text-end">

                                                        <div class="dropdown dropdown-action">

                                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>

                                                            <div class="dropdown-menu dropdown-menu-end">

                                                                <a class="dropdown-item" href="edit_invoice"><i class="far fa-edit me-2"></i>Edit</a>

                                                                <a class="dropdown-item" href="view_invoice"><i class="far fa-eye me-2"></i>View</a>

                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>

                                                               

                                                            </div>

                                                        </div>

                                                    </td>

                                                </tr>

                                                <tr>


                                                    <td></td>

                                                    <td></td>
													
                                                    <td></td>
													
                                                    <td></td>
													
                                                    <td></td>


                                                    <td class="text-end">

                                                        <div class="dropdown dropdown-action">

                                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>

                                                            <div class="dropdown-menu dropdown-menu-end">

                                                                <a class="dropdown-item" href="edit_invoice"><i class="far fa-edit me-2"></i>Edit</a>

                                                                <a class="dropdown-item" href="view_invoice"><i class="far fa-eye me-2"></i>View</a>

                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>

                                                             

                                                            </div>

                                                        </div>

                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td></td>

                                                    <td></td>
													
                                                    <td></td>
													
                                                    <td></td>
													
                                                    <td></td>


                                                  
                                                    <td class="text-end">

                                                        <div class="dropdown dropdown-action">

                                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>

                                                            <div class="dropdown-menu dropdown-menu-end">

                                                                <a class="dropdown-item" href="edit_invoice"><i class="far fa-edit me-2"></i>Edit</a>

                                                                <a class="dropdown-item" href="view_invoice"><i class="far fa-eye me-2"></i>View</a>

                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>

                                                                
                                                            </div>

                                                        </div>

                                                    </td>

                                                </tr>

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