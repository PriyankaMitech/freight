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

                                    <li class="breadcrumb-item"><a href="<?php echo base_url()?>?/dashboard">Dashboard</a></li>

                                    <li class="breadcrumb-item active">Kilometer Master</li>

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

                                            <ul>
 
                                                <li><a href="?/home/transport_master" >Transporter Master</a></li>

                                                <li><a href="?/home/vehicle_master" >Vehicle Master</a></li>  

                                                <li><a href="?/home/contract_master">Contract Master</a></li>        

                                                <li><a href="?/home/zone_master" >Zone Master</a></li>    

                                                <li><a href="?/home/diesel_master" >Diesel Master</a></li>

                                                <li><a href="?/home/kilometer_master" class="active">Kilometer Master</a></li>

                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="col-lg-2 col-md-2">

                        <div class="invoices-settings-bn mb-3">

                            <a href="?/home/add_kilometer" class="bn">

                                <i data-feather="plus-circle"></i> Add New 

                            </a>

                        </div>

                    </div>                   
                    <div class="row">

                        <div class="col-sm-6">

                            <div class="card card-table"> 

                                <div class="card-body">

                                    <div class="table-scroll">

                                        <table class="table table-stripped table-hover datatable">

                                            <thead class="thead-light">

                                                <tr>

                                                   <th style="width: 100px">State</th>

                                                   <th style="width: 100px">Zone</th>
                                                   
                                                   <th style="width: 100px">Destination</th>
                                                   
                                                   <th style="width: 100px">Kilometer</th>
                                                   
                                                   <th style="width: 100px">Transit Time</th>

                                                   <th style="width: 100px" class="text-end">Action</th>

                                                </tr>

                                            </thead>

                                            <tbody>
                                                <?php //print_r($getVehicle); 
                                                    foreach($getkilometer as $kilometer){
                                                ?>

                                                <tr>
                                                    <td><?php echo $kilometer->state; ?></td>

                                                    <td><?php echo $kilometer->zone; ?></td>
                                                    
                                                    <td><?php echo $kilometer->destination; ?></td>
                                                    
                                                    <td><?php echo $kilometer->kilometer; ?></td>
                                                    
                                                    <td><?php echo $kilometer->transit_time; ?></td>

                                                    <td class="text-end">

                                                        <div class="dropdown dropdown-action">

                                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>

                                                            <div class="dropdown-menu dropdown-menu-end">

                                                                <a class="dropdown-item" href="edit_kilometer/<?php echo base64_encode($kilometer->ID); ?>"><i class="far fa-edit me-2"></i>Edit</a>

                                                                <a class="dropdown-item" href="view_kilometer"><i class="far fa-eye me-2"></i>View</a>

                                                                <a class="dropdown-item" id="<?php echo base64_encode($kilometer->ID) ?>" name="delete" type="" onclick="deleteFunction(this.id)"><i class="far fa-trash-alt me-2"></i>Delete</a>


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
                    url: "delete_kilometer/" + id,
                    type: "GET",
                    dataType: 'html',
                    success: function () {
                        swal.fire("Done!", "It was succesfully deleted!", "success");
                    },
                    error: function () {
                        swal.fire("Error deleting!", "Please try again", "error");
                    }
                });
                window.location.href = "delete_kilometer/" + id;
            }
        });

    }
</script>

</body>



</html>