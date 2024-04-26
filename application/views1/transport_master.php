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
            <?php 
                        // $session = \Config\Services::session();
                        if($this->session->flashdata('success'))
                        {
                            echo '<div class="alert alert-success alert-dismissible">'.$this->session->flashdata("success").'</div>';
                        }
                    ?>
            <div class="page-wrapper">

                <div class="content container-fluid">

                    <!-- Page Header -->

                    <div class="page-header">

                        <div class="row align-items-center">

                            <div class="col">

                                <h3 class="page-title">Transporter Master</h3>

                                <ul class="breadcrumb">

                                    <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>

                                    <li class="breadcrumb-item active"><?php echo $title_meta['title'] ?></li>

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

                                            <ul class="nav nav-tabs">

                                                <li><a href="transport_master" class="active">Transporter Master</a></li>

                                                <li><a href="vehicle_master">Vehicle Master</a></li>  

                                                <li><a href="contract_master">Contract Master</a></li>        

                                                <li><a href="zone_master">Zone Master</a></li>    

                                                <li><a href="diesel_master">Disel Master</a></li>

                                                <li><a href="kilometer_master">Kilometer Master</a></li>

                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="col-lg-2 col-md-2">

                        <div class="invoices-settings-bt mb-3">

                            <a href="add-transporter" class="bt">

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
                                                <?php //print_r($getVehicle); 
                                                    foreach($getTransport as $transport){
                                                ?>
                                                <tr>

                                                    <td><?php echo $transport->CODE; ?></td>

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
                                                    <td><?php echo $transport->IS_ACTIVE; ?></td>

                                                    <td class="text-end">

                                                        <div class="dropdown dropdown-action">

                                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>

                                                            <div class="dropdown-menu dropdown-menu-end">

                                                                <a class="dropdown-item" href="edit_transporter/<?php echo base64_encode($transport->ID); ?>"><i class="far fa-edit me-2"></i>Edit</a>

                                                                <a class="dropdown-item" href="view_invoice"><i class="far fa-eye me-2"></i>View</a>

                                                                <!-- <a class="dropdown-item" href="delete_transporter/<?php echo base64_encode($transport->ID); ?>" onclick="deleteFunction()><i class="far fa-trash-alt me-2"></i>Delete</a> -->
                                                                <!-- <a class="dropdown-item" href="#" onclick="deleteFunction()"><i class="far fa-trash-alt me-2"></i>Delete</a> -->
                                                                <button class="dropdown-item" id="<?php echo base64_encode($transport->ID) ?>" name="delete" type="" onclick="deleteFunction(this.id)"><i class="far fa-trash-alt me-2"></i>Delete</button>
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
<script>
    function deleteFunction(id) {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form
                swal({
        title: "Are you sure?",
        // text: "But you will still be able to retrieve this file.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: false,
        closeOnCancel: false
        },
        function(isConfirm){
        if (isConfirm) {
            // form.submit();          // submitting the form when user press yes
            $.ajax({
            url: "delete_transporter/" + id,
            type: 'GET',
            dataType: 'html'
            })
            .done(function(data){
                console.log(data);
                swal("Deleted!", "Your record has been deleted.", "success");
            })
            .fail(function(){
                swal("Deleted_Error", "Error while deleting. :)", "error");
            });
            // window.location.href = "<?php echo site_url("delete_transporter/");?>";
            window.location.href = "delete_transporter/" + id;
            // swal("Deleted!", "Your imaginary file has been deleted.", "success");
        } else {
            swal("Cancelled", "Your record is safe :)", "error");
        }
        });
    }
</script>

</body>



</html>