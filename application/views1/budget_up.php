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
        .invoices-tabs-card.budget-card{
            background: #337ab7;
        }
        .invoices-tabs-card.budget-card .invoices-tabs ul li a:not(.active) {
            color: #fff;
        }
    </style>
</head>

<?php $this->load->view('partials/body') ?>

    <div class="main-wrapper">

    <?php $this->load->view('partials/menu') ?>

        <!-- Page Wrapper -->

        <div class="page-wrapper">

            <div class="content container-fluid">

                <div class="card invoices-tabs-card budget-card">

                    <div class="card-body card-body p-0">

                        <div class="invoices-main-tabs">

                            <div class="row align-items-center">

                                <div class="col-lg-10 col-md-10">

                                    <div class="invoices-tabs">

                                        <ul>

                                            <li><a href="budget_up" class="active">Budget Upload</a></li>

                                            <li><a href="vehicle_master" >Unlock Budget</a></li>  

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

                    <form action="budgetupload" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                        <div>
                            <label>Choose File</label> 
                            <input type="file" name="file" id="file" accept=".csv">
                            <button type="submit" id="submit" name="import" class="btn btn-primary">Import</button>
                    
                        </div>
                    </form>

                </div>

            </div>

        </div>

        <!-- /Page Wrapper -->

    </div>

    <!-- end main content-->

<?php $this->load->view('partials/vendor-scripts') ?>



</body>



</html>