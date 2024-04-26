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

            min-height: auto!important;

        }

        .date-picker {

            width: auto;

        }

        .form-select.report-select {

            background-color: #286090;

            color: #fff;

            text-align: center;

        }

        .form-select.report-select:focus {

            box-shadow: none;

            border: none;

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

                                <h3 class="page-title">Transcred</h3>

                            </div>

                        </div>

                    </div>

                    <!-- /Page Header -->                

               

                <div class="card card-table w-auto"> 



                    <div class="card-body">



                        <div class="table-responsive">



                            <table class="table table-striped table-hover table-bordered">



                                <thead class="thead-light">



                                    <tr>
                                    

                                    <th>User ID</th>



                                    <th>Password</th>



                                    <th>Active Status</th>



                                    <th>Old Password</th>



                                    </tr>



                                </thead>



                                <tbody>

                                <?php

                                    

                                    if(!empty($gettranscred)){

                                        foreach($gettranscred as $sales){ ?>

                                            <tr>

                                                



                                                <td>

                                                    <?php echo $sales['USER_EMAIL']; ?></td>

                                                <td>
                                                    <?php echo $sales['USER_PASS']; ?> </td>
                                                

                                                <td>

                                                   

                                                    <?php echo $sales['IS_ACTIVE']; ?> </td>

                                                <td>

                                                    

                                                    <?php echo $sales['USER_PASS']; ?> </td>

                                                </tr>
                    

                                               <?php }
                                            }

                                        ?>


                                        </tbody>



                                    </table>



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