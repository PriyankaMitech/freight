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

                <a href="<?php echo base_url(); ?>?/transportal" class="btn btn-primary">Click here to go to index</a>

                <hr>

                <div class="row">

                    <form method="post" id="formSubmit" action="<?php echo base_url(); ?>?/save_trans">

                        <div class="card card-table"> 



                            <div class="card-body">



                                <div class="table-scroll">



                                    <table class="table table-striped table-hover datatable table-bordered">



                                        <thead class="thead-light">



                                            <tr>

                                            <th></th>



                                            <th>LR. No.</th>



                                            <th>Billing Date</th> 

                                            

                                            <th>Name & Location STP</th>



                                            <th>Quantity</th>

                                            

                                            <th>Boxes</th>



                                            <th>Incoterm</th>



                                            <th>Vehicle Type</th>



                                            <th>Vehicle No.</th>



                                            <th>GST-STP</th>



                                            <th>GST-SOP</th>

                                            

                                            <th>Reporting Date</th>



                                            <th>Releasing Date</th>



                                            </tr>



                                        </thead>



                                        <tbody>

                                            <?php //print_r($getSales); 
                                             if(!empty($getSales)){

                                                $i = 1;

                                                foreach($getSales as $sales){

                                            ?>

                                            <tr>

                                                <td>

                                                    <input type="hidden" class="SALES_ID/<?php echo $i ?>" name="SALES_ID" value="<?php echo $sales['ID'] ?>">

                                                    <input type="radio" name="radio_release" value="<?php echo $sales['ID'] ?>"  data-bs-toggle="modal" data-bs-target="#top-modal1"></td>

                                                <td>

                                                    <input type="hidden" name="LR_NO" value="<?php echo $sales['LR_NO'] ?>">

                                                    <?php echo $sales['LR_NO']; ?></td>



                                                <td>

                                                    <input type="hidden" name="BILL_DT" value="<?php echo $sales['BILL_DT'] ?>">

                                                    <?php echo $sales['BILL_DT']; ?></td>

                                                <td>

                                                    <input type="hidden" name="NAME_SHIP_PARTY" value="<?php echo $sales['NAME_SHIP_PARTY'] ?>">

                                                    <?php echo $sales['NAME_SHIP_PARTY']; ?> </td>



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

                                                    <input type="hidden" name="REP_DT" value="<?php echo $sales['REP_DT'] ?>">

                                                    <?php echo $sales['REP_DT']; ?></td>

                                                <td>

                                                    <input type="hidden" name="UNL_DT" value="<?php echo $sales['UNL_DT'] ?>">

                                                    <?php echo $sales['UNL_DT']; ?></td>



                                            </tr>

                                            <?php $i++; } } ?>



                                        </tbody>



                                    </table>



                                </div>



                            </div>



                        </div>

                        <!-- modal start -->

                        <div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

                            <div class="modal-dialog modal-top">

                                <div class="modal-content">

                                    <div class="modal-body">

                                        <div class="row">    

                                            <div class="form-group">

                                                <label for="">Reporting Date: </label>

                                                <input type="hidden" value="" id="saleid">

                                                <input type="date" name="REPORT_DATE" class="form-co">

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

                                    </div>

                                    <div class="modal-footer">

                                        <button type="button" id="save" class="btn btn-success">Save</button>

                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>

                                    </div>

                                </div><!-- /.modal-content -->

                            </div><!-- /.modal-dialog -->

                        </div>

                        <!-- modal end -->

                    </form>

                </div>

            </div>



        </div>



        <!-- /Page Wrapper -->



    </div>



    <!-- end main content-->



















<?php $this->load->view('partials/vendor-scripts') ?>



<script>

    $('input[name="radio_release"]').click(function() {

        if($(this).is(':checked')) {

                $('#top-modal').modal('show');

                var sale_id = $(this).attr('value');

                $('#saleid').val(sale_id);

        }

    });

    $(document).ready(function () {

        $('#save').click(function() {

            var formData = $("#formSubmit").serialize();

            var sale_id = $('#saleid').val();

            

            $('#top-modal').modal('hide');

            $.ajax({

                method: "POST",

                url: "<?php echo base_url(); ?>?/save_trans/"+sale_id,

                data: formData,

                success:function(data)

                {
                    alert(data);

                    console.log(data);

                    window.location.href= "<?php echo base_url(); ?>?/transportal"; 

                }

            })

        });

    });



</script>



</body>







</html>