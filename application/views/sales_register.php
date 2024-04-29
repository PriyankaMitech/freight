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

            /* right: 4px;

            position: fixed;

            top: 5px;

            z-index: 1111; */

        }

    </style>

</head>







<?php $this->load->view('partials/body') ?>



    <div class="main-wrapper">



    <?php $this->load->view('partials/menu') ?>



            <!-- Page Wrapper -->



            <div class="page-wrapper">



                <div class="content container-fluid">            



                    <div class="card invoices-tabs-card">



                        <div class="card-body card-body pt-0 p-0">



                            <div class="invoices-main-tabs">



                                <div class="row align-items-center">



                                    <div class="col-lg-10 col-md-10">



                                        <div class="invoices-tabs">

                                            

                                            <ul class="nav nav-tabs">



                                               <li><a href="sales_register" class="active">Sales Register Upload</a></li>



                                            </ul>



                                        </div>



                                    </div>



                                </div>



                            </div>



                        </div>



                    </div>

                    

                    <?php 

                        if($this->session->flashdata('error'))

                        {

                            echo '<div class="alert alert-danger alert-dismissible">'.$this->session->flashdata("error").'</div>';

                        }

                        if($this->session->flashdata('success'))

                        {

                            echo '<div class="alert alert-success alert-dismissible">'.$this->session->flashdata("success").'</div>';

                        }

                    ?>

                    <div class="row">



                        <form action="?/Phpspreadsheet/salesregisterupload" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">

                            <div>

                                <label>Choose Excel File</label> 

                                <input type="file" name="file" id="file" accept=".csv">

                                <button type="submit" id="submit" name="import" class="btn btn-primary">Import</button>
                                <a href='<?= base_url() ?>Home/salesregisterdownload'><button type="button" id="" name="Download" class="btn btn-primary">Download</button></a>

                        

                            </div>

                        </form>



                    </div>



                </div>



            </div>



            <!-- /Page Wrapper -->



    </div>



    <!-- end main content-->



















<?php $this->load->view('partials/vendor-scripts') ?>


<script type="text/javascript">
    
    
    <?php 

        if($this->session->flashdata('error'))

        {?>
            var alert = "<?php echo $this->session->flashdata('error') ?>";

           alert(alert);

       <?php  }

        if($this->session->flashdata('success'))

        { ?>
            var alerts = "<?php echo $this->session->flashdata('success') ?>";

            alert(alerts);

      <?php  }

    ?>

    
    

</script>




</body>







</html>