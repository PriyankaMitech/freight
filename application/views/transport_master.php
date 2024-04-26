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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">

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



                                                <li><a href="<?=base_url();?>transport_master" class="active">Transporter Master</a></li>



                                                <li><a href="<?=base_url();?>vehicle_master">Vehicle Master</a></li>  



                                                <li><a href="<?=base_url();?>contract_master">Contract Master</a></li>        



                                                <li><a href="<?=base_url();?>zone_master">Zone Master</a></li>    



                                                <li><a href="<?=base_url();?>diesel_master">Diesel Master</a></li>



                                                <li><a href="<?=base_url();?>kilometer_master">Kilometer Master</a></li>



                                            </ul>



                                        </div>



                                    </div>



                                </div>



                            </div>



                        </div>



                    </div>





                    <div class="col-lg-2 col-md-2">



                        <div class="invoices-settings-bt mb-3">



                            <a href="<?=base_url();?>add_transporter" class="bt">



                                <i data-feather="plus-circle"></i> Add New Transporter



                            </a>

                        </div>



                    </div>  



                    <div class="row">

                        <div class="card card-table"> 



                            <div class="card-body">



                                <div class="table-scroll">



                                    <table class="table table-striped table-hover datatable">



                                        <thead class="thead-light">



                                            <tr>



                                                <th>Code</th>



                                                <th>Name</th>



                                                <th>Type</th>



                                                <th style="width:200px">Address</th>



                                                <th>Contact Person</th>



                                                <th>Contact</th>



                                                <th>Email</th>



                                                <!-- <th>Status</th> -->



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

                                                <!-- <td><?php //echo $transport->IS_ACTIVE; ?></td> -->



                                                <td class="text-end">



                                                    <div class="dropdown dropdown-action">



                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>



                                                        <div class="dropdown-menu dropdown-menu-end">



                                                            <a class="dropdown-item" href="edit_transporter/<?php echo base64_encode($transport->ID); ?>"><i class="far fa-edit me-2"></i>Edit</a>



                                                            <a class="dropdown-item" href="view_invoice"><i class="far fa-eye me-2"></i>View</a>



                                                            <!-- <a class="dropdown-item" href="delete_transporter/<?php echo base64_encode($transport->ID); ?>" onclick="deleteFunction()><i class="far fa-trash-alt me-2"></i>Delete</a> -->

                                                            <!-- <a class="dropdown-item" href="#" onclick="deleteFunction()"><i class="far fa-trash-alt me-2"></i>Delete</a> -->

                                                            <!-- <button class="dropdown-item remove-user" id="<?php echo base64_encode($transport->ID) ?>" name="delete" type=""><i class="far fa-trash-alt me-2"></i>Delete</button> -->
                                                            <button class="dropdown-item remove-user" id="<?php echo base64_encode($transport->ID) ?>" name="delete" type="" onclick="deleteFunction(this.id)"><i class="far fa-trash-alt me-2"></i>Delete</button>

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



            <!-- /Page Wrapper -->



    </div>



    <!-- end main content-->



















<?php $this->load->view('partials/vendor-scripts') ?>

<script>

    function deleteFunction1(id) {

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

        console.log(id)

                // form.submit();          // submitting the form when user press yes

                $.ajax({

                url: "<?=base_url();?>delete_transporter/" + id,

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

                window.location.href = "<?=base_url();?>delete_transporter/" + id;

                // swal("Deleted!", "Your imaginary file has been deleted.", "success");

            } else {

                swal("Cancelled", "Your record is safe :)", "error");

            }

        });

    }

    function deleteFunction(id) {

        swal.fire({
            title: 'Are you sure?',
            //text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                jQuery.ajax({
                    url: "<?=base_url();?>delete_transporter/" + id,
                    type: "GET",
                    dataType: 'html',
                    success: function () {
                        swal.fire("Done!", "It was succesfully deleted!", "success");
                    },
                    error: function () {
                        swal.fire("Error deleting!", "Please try again", "error");
                    }
                });
                window.location.href = "<?=base_url();?>delete_transporter/" + id;
            }
        });

    }
</script>
<script type="text/javascript">

    
    </script>


</body>







</html>