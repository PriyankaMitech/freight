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

        table.dataTable {

            margin: 0!important;

        }

        .card.card-table {

            padding: 0px;

        }

        .table .thead-light th {

            background-color: #00bfff;

        }

        .modal-dialog {

            max-width: 600px;

        }

        .modal-dialog .row>* {

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

                <a href="<?php echo base_url(); ?>?/transHistory" class="btn btn-success">Click here to go to History</a>

                <hr>
                <div class="row">
                    <form action="<?php echo base_url(); ?>transportal" method="post"> 



                    <div class="row align-items-center form-group ">

              

                        <div class="col-sm-6">

                            <div class="date-picker">

                                <div class="form-custom cal-icon">

                                    <input class="form-control datetimepicker" name="start_date" type="text" placeholder="Start Date" value="<?php echo $start_date ?>">

                                </div>

                            </div>

                            <div class="date-picker">

                                <div class="form-custom cal-icon">

                                    <input class="form-control datetimepicker" name="end_date" type="text" placeholder="End Date" value="<?php echo $end_date ?>">

                                </div>

                            </div>

                            <div class="invoice-setting-btn">
                                <!-- <input type="submit" name="submit" value="Search" > -->

                                <button type="submit" name="submit" value="submit" class="btn btn-success"><i class="fa fa-search"></i></button>

                                <button type="button" id="btnExport" name="export_excel" value="export_excel" class="btn btn-warning"><i class="fa fa-arrow-circle-down"></i></button>

                            </div>

                        </div>

                    </div>
                </form>



                </div>

                <div class="row">

                    <!-- <form method="post" id="formSubmit" action="<?php echo base_url(); ?>?/save_trans" enctype="multipart/form-data"> -->

                        <div class="card card-table"> 



                            <div class="card-body">



                                <div class="table-scroll">



                                    <table class="table table-striped table-hover table-bordered">



                                        <thead class="thead-light">



                                            <tr>

                                            <th></th>



                                            <th>LR. No.</th>



                                            <th>Billing Date</th> 

                                            

                                            <th>Name</th>


                                            <th>Location STP</th>



                                            <th>Quantity</th>

                                            

                                            <th>Boxes</th>



                                            <th>Incoterm</th>



                                            <th>Vehicle Type</th>



                                            <th>Vehicle No.</th>



                                            <th>GST-STP</th>



                                            <th>GST-SOP</th>

                                            <th>Contract Rate</th>
                                            

                                            <th>Reporting Date</th>



                                            <th>Releasing Date</th>



                                            </tr>



                                        </thead>



                                        <tbody>

                                            <?php 
                                            // echo '<pre>';print_r($getSales); 
                                            if(!empty($getSales)){

                                                $i = 1; ?>

                                                <?php foreach($getSales as $sales){

                                            ?>

                                            <tr>

                                                <td>

                                                    <input type="hidden" class="SALES_ID/<?php echo $i ?>" name="SALE_ID" value="<?php echo $sales['ID'] ?>">

                                                    <input type="radio" name="radio_release" value="<?php echo $sales['ID'] ?>"  data-bs-toggle="modal" data-bs-target="#top-modal1"></td>

                                                <td>

                                                    <input type="hidden" name="LR_NO" value="<?php echo $sales['LR_NO'] ?>">

                                                    <?php echo $sales['LR_NO']; ?></td>



                                                <td>

                                                    <input type="hidden" name="BILL_DT" value="<?php echo $sales['BILL_DT'] ?>">

                                                    <?php echo $sales['BILL_DT']; ?></td>

                                                <td>

                                                    <input type="hidden" name="NAME_SHIP_PARTY" value="<?php echo $sales['NAME_SHIP_PARTY'] ?>">

                                                    <?php echo $sales['NAME_SHIP_PARTY']; ?> 
                                                </td>

                                                <td>

                                                    <input type="hidden" name="LCN_SHIP_PARTY" value="<?php echo $sales['LCN_SHIP_PARTY'] ?>">

                                                    <?php echo $sales['LCN_SHIP_PARTY']; ?> 
                                                </td>



                                                <td>

                                                    <input type="hidden" name="BILL_QTY" value="<?php echo $sales['BILL_QTY_T'] ?>">

                                                    <?php echo $sales['BILL_QTY_T']; ?> </td>

                                                

                                                <td>

                                                    <input type="hidden" name="BOX_QTY_T" value="<?php echo $sales['BOX_QTY_T'] ?>">

                                                    <?php echo $sales['BOX_QTY_T']; ?></td>

                                                <td>

                                                    <input type="hidden" name="INCOTERMS" value="<?php echo $sales['INCOTERMS'] ?>">

                                                    <?php echo $sales['INCOTERMS']; ?></td>

                                                <td>

                                                    <input type="hidden" name="VEH_NAME" value="<?php echo $sales['VEH_NAME'] ?>">

                                                    <?php echo $sales['VEH_NAME']; ?> </td>

                                                <td>

                                                    <input type="hidden" name="VEH_NO" value="<?php echo $sales['VEH_NO'] ?>">

                                                    <?php echo $sales['VEH_NO']; ?> </td>

                                                <td>

                                                    <input type="hidden" name="GST_NO_SOLD" value="<?php echo $sales['GST_NO_SOLD'] ?>">

                                                    <?php echo $sales['GST_NO_SOLD']; ?> </td>

                                                <td>

                                                    <input type="hidden" name="GST_NO_SHIP" value="<?php echo $sales['GST_NO_SHIP'] ?>">

                                                    <?php echo $sales['GST_NO_SHIP']; ?> </td>

                                                <td>
 <!--
                                                    <input type="hidden" name="Rate" value="<?php //echo $sales['Rate'] ?>">

                                                    <?php// echo number_format($sales['Rate']); ?>  -->

                                                    <?php echo ($sales['TOTAL_VAL'])? number_format($sales['TOTAL_VAL']) :  number_format($sales['Rate']); ?>
                                                    </td>
                                                <td>

                                                    <input type="hidden" name="REP_DT" value="<?php echo $sales['REP_DT'] ?>">

                                                    <?php echo $sales['REP_DT']; ?></td>

                                                <td>

                                                    <input type="hidden" name="UNL_DT" value="<?php echo $sales['UNL_DT'] ?>">

                                                    <?php echo $sales['UNL_DT']; ?></td>



                                            </tr>

                                            <?php $i++; }  ?>
                                  


                                            <?php }else{ ?>
                                                <tr >
                                                <td class="text-center" colspan= 14 >No Data Found</td>
                                            </tr>

                                                <?php } ?>



                                        </tbody>



                                    </table>



                                </div>



                            </div>



                        </div>

                        <!-- modal start -->

                        <div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

                            <div class="modal-dialog modal-top">

                                <div class="modal-content">
                                    <form method="post" action="#" id="podform"  enctype="multipart/form-data">
                                    <div class="modal-body">

                                        <div class="row">    

                                            <div class="form-group">

                                                <label for="">Reporting Date: </label>

                                                <input type="hidden" value="" id="saleid">

                                                <input type="date" name="REPORT_DATE" id="REPORT_DATE" class="form-co">

                                                <label for="">Time: </label>

                                                <input type="time" name="REPORT_TIME" class="form-co">

                                            </div>

                                        </div>

                                        <div class="row"> 

                                            <div class="form-group">

                                                <label for="">Releasing Date: </label>

                                                <input type="date" name="RELEASE_DATE" class="form-co">

                                                <label for="">Time: </label>

                                                <input type="time" name="RELEASE_TIME" class="form-co">

                                            </div>

                                        </div>

                                        <div class="row"> 

                                            <div class="form-group">

                                                <label for="">POD: </label>

                                                <input type="file" name="pod" accept=".pdf" class="form-co pod">

                                            </div>

                                        </div>

                                    </div>

                                    <div class="modal-footer">

                                        <button type="button" id="save" class="btn btn-success">Save</button>

                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>

                                    </div>
                                    </form>

                                </div><!-- /.modal-content -->

                            </div><!-- /.modal-dialog -->

                        </div>

                        <!-- modal end -->

                    <!-- </form> -->

                </div>

            </div>



        </div>



        <!-- /Page Wrapper -->



    </div>



    <!-- end main content-->


<?php $this->load->view('partials/vendor-scripts') ?>

<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->


<script src="<?php echo base_url();?>/assets/js/xlsx.full.min.js"></script>

<script>
    $(document).ready(function () {
        // Handle export button click
        $('#btnExport').click(function () {
            // Create a new workbook
            var wb = XLSX.utils.book_new();

            // Convert table data to worksheet
            var ws = XLSX.utils.table_to_sheet($('.table')[0]);

            // Add the worksheet to the workbook
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

            // Save the workbook as an Excel file
            XLSX.writeFile(wb, 'exported_data.xlsx');
        });
    });
</script>

<script>

    $('input[name="radio_release"]').click(function() {

        if($(this).is(':checked')) {

                $('#top-modal').modal('show');

                var sale_id = $(this).attr('value');

                $('#saleid').val(sale_id);

        }

    });
    // var pod = $('.pod').val();

            

    //         $('#top-modal').modal('hide');

    //         if(pod === '')
    //         {
    //             alert("Upload POD");
    //             return;
    //         }
    //         else
    //         {
                
                
    //             $.ajax({

    //                 method: "POST",

    //                 url: "<?php echo base_url(); ?>save_trans/"+sale_id,

    //                 data: formData,

    //                 success:function(data)

    //                 {

    //                     console.log(data);

    //                     //window.location.href= "<?php echo base_url(); ?>/transportal"; 

    //                 }

    //                 })
    //         }

    $(document).ready(function () {

        // $('#save').click(function() {

        //     var formData = $("#formSubmit").serialize();

        //     var sale_id = $('#saleid').val();
        //     var pod = $('#pod').val();

        //     console.log(pod)

        //     $('#top-modal').modal('hide');

        //     $.ajax({

        //         method: "POST",

        //         url: "<?php echo base_url(); ?>save_trans/"+sale_id,

        //         data: formData,

        //         // method: 'POST',

        //         success:function(data)

        //         {

        //             console.log(data);

        //             //window.location.href= "<?php echo base_url(); ?>/transportal"; 

        //         }

        //     })

        // });
        $('#save').click(function() {
            var formData = new FormData($("#podform")[0]);
            var sale_id = $('#saleid').val();

            var pod = $('.pod').val();

            $('#top-modal').modal('hide');

            if(pod === '')
            {
                return;
            }
            else
            {
            
                $.ajax({

                    method: "POST",
                    url: "<?php echo base_url(); ?>?/save_trans/"+sale_id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success:function(data)
                    {
                        console.log(data);
                        window.location.href= "<?php echo base_url(); ?>?/transportal"; 
                    }

                })
            }
        });

    });



</script>



</body>







</html>