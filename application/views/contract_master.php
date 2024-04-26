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



                            <h3 class="page-title">Contract Master</h3>



                            <ul class="breadcrumb">



                                <li class="breadcrumb-item"><a href="<?php echo base_url()?>?/dashboard">Dashboard</a></li>



                                <li class="breadcrumb-item active">Contract Master</li>



                            </ul>



                        </div>


                    </div>



                </div>



                <!-- /Page Header -->



            



                <!-- Report Filter -->



                

                <!-- /Report Filter -->







                <div class="card invoices-tabs-card">



                    <div class="card-body card-body p-0">



                        <div class="invoices-main-tabs">



                            <div class="row align-items-center">



                                <div class="col-lg-10 col-md-10">



                                    <div class="invoices-tabs">



                                        <ul>



                                            <li><a href="?/home/transport_master" >Transporter Master</a></li>



                                            <li><a href="?/home/vehicle_master" >Vehicle Master</a></li>  



                                            <li><a href="?/home/contract_master" class="active">Contract Master</a></li>        



                                            <li><a href="?/home/zone_master" >Zone Master</a></li>    



                                            <li><a href="?/home/diesel_master" >Diesel Master</a></li>



                                            <li><a href="?/home/kilometer_master" >Kilometer Master</a></li>



                                        </ul>



                                    </div>



                                </div>



                            </div>



                        </div>



                    </div>



                </div>



                <div class="col-lg-2 col-md-2">



                    <div class="invoices-settings-bt mb-3">



                        <!-- <a href="<?php echo base_url()?>?/add_contract" class="bt"><i data-feather="plus-circle"></i> Add New </a> -->



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



                    <form action="?/Phpspreadsheet/contractupload" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">

                    <div class="row align-items-center form-group ">
                        <label for="zipcode" class="col-sm-2 col-form-label input-label">Upload File</label>
                        <div class="col-sm-4">
                            <div class="invoices-upload-btn">
                                <input type="file" accept=".csv" name="file" id="file" onchange="loadFile(event)">
                                <!--<label for="file" class="upload"> upload File </label>-->
                                
                            </div>
                        </div>
                        <div class="invoice-setting-btn col-sm-3">
                            <button type="submit" id="submit" name="import" class="btn btn-primary">Submit</button>
                            <a href='<?= base_url() ?>?/Home/salesregisterdownload'><button type="button" id="" name="Download" class="btn btn-primary">Download</button></a>
                        </div>
                    </div>
                </form>



                </div>



                <div class="row">



                    <div class="row align-items-center form-group ">

                        <label for="zipcode" class="col-sm-2 col-form-label input-label">Search contract</label>

                        <div class="col-sm-2">

                            <div class="">

                                <input type="text" name="Destination" id="Destination" class="form-control" placeholder="Destination">

                            </div>

                        </div>

                        <div class="col-sm-2">

                            <div class="">

                                <input type="text" name="Vehicle_Name" id="Vehicle_Name" class="form-control" placeholder="Vehicle Name">

                            </div>

                        </div>

                    </div>



                </div>

                <div class="row hide_contract">



                    <div class="row align-items-center form-group ">

                    <table class="table" style="width:50%;" id="myTable">



                        <thead class="thead-light">



                            <tr>



                                <th>Vehicle Name</th>



                                <th>Rate</th>



                                <th>Destination</th>



                                <th>Date</th>



                            </tr>



                        </thead>

                            <tbody>
                        </tbody>

                    </table>

                        

                    </div>



                </div>



            </div>



        </div>



        <!-- /Page Wrapper -->



    </div>



    <!-- end main content-->



<?php $this->load->view('partials/vendor-scripts') ?>

<script type="text/javascript">

    $(".hide_contract").hide();
    
    
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

    $("#Vehicle_Name").on('keyup', function() {

        var Vehicle_Name= $(this).val();
        var Destination= $("#Destination").val();
      
      $.ajax({
        url: "<?= base_url() ?>?/Home/contract_data",
        method: "POST",
        data: {
          Vehicle_Name: Vehicle_Name,
          Destination: Destination
        },
        success: function(data) {
            console.log(data);

            json = $.parseJSON(data);
            $(".hide_contract").show();

            var content = '';
            for (var i = 0; i < json.length; i++) {
            content += '<tr id="' + json[i].ID + '">';
            content += '<td>' + json[i].Vehicle_Name + '</td>';
            content += '<td>' + json[i].Rate + '</td>';
            content += '<td>' + json[i].Destination + '</td>';
            content += '<td>' + json[i].UpdatedDate + '</td>';
            content += '</tr>';
            }
           
            $('#myTable tbody').html(content); 

            
          
        }
      });
    });

    $("#Destination").on('keyup', function() {

        var Vehicle_Name= $("#Vehicle_Name").val();
        var Destination= $(this).val();
      
      $.ajax({
        url: "<?= base_url() ?>?/Home/contract_data",
        method: "POST",
        data: {
          Vehicle_Name: Vehicle_Name,
          Destination: Destination
        },
        success: function(data) {
            console.log(data);

            json = $.parseJSON(data);
            $(".hide_contract").show();

            var content = '';
            //content += '<tbody>'; -- **superfluous**
            for (var i = 0; i < json.length; i++) {
            content += '<tr id="' + json[i].ID + '">';
            content += '<td>' + json[i].Vehicle_Name + '</td>';
            content += '<td>' + json[i].Rate + '</td>';
            content += '<td>' + json[i].Destination + '</td>';
            content += '<td>' + json[i].UpdatedDate + '</td>';
            content += '</tr>';
            }
           // content += '</tbody>';-- **superfluous**
            //$('table tbody').replaceWith(content);  **incorrect..**
             $('#myTable tbody').html(content);  // **better. give the table a ID, and replace**

            
          
        }
      });
    });

    

</script>







</body>







</html>