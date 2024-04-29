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

                                <h3 class="page-title">Delete LR</h3>

                               

                            </div>

                           

                        </div>

                    </div>

                    <!-- /Page Header -->

               

                    <!-- Report Filter -->

                    
                    <!-- /Report Filter -->

               
                    <div class="row">

                        <div class="col-sm-6">

                        <div class="card card-table"> 

                                <div class="card-body">

                                    <div class="table-responsive">

                                        <table class="table table-stripped table-hover datatable invoice-table" >

                                            <thead class="thead-light">

                                                <tr>

                                                   <th>SR NO</th>
                                                   <th>LR NO</th>
                                                   

                                                   <th class="text-end">Action</th>

                                                </tr>

                                            </thead>

                                            <tbody>
                                                <?php //print_r($getVehicle);
                                                $sr=1;
                                                    foreach($getlr as $lr){
                                                ?>

                                                <tr>

                                                    <td><?php echo $sr; ?></td>
                                                    <td><?php echo $lr->LR_NO; ?></td>

                                                  

                                                    <td class="text-end">

                                                        <!-- <a href="<?= base_url('?/Home/Delete_LR_NO/'.base64_encode($lr->LR_NO)) ?>" id="<?php echo base64_encode($lr->LR_NO) ?>" name="delete" type="" onclick="return confirm('Are you sure?');"><i class="far fa-trash-alt me-2"></i>Delete</a> -->


                                                        <a href="<?= base_url() ?>delete_LR_NO/<?php echo base64_encode($lr->LR_NO) ;?>"  name="delete" type="" onclick="return confirm('Are you sure?');"><i class="far fa-trash-alt me-2"></i>Delete</a>


                                                    </td>

                                                </tr>
                                                <?php $sr++; } ?>

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









<?php $this->load->view('partials/footer') ?>

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
                    url: "delete_LR_NO/" + id,
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