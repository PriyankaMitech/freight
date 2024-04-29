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

                <div class="row">
                    <form action="<?php echo base_url(); ?>TransView" method="post"> 



                    <div class="row align-items-center form-group ">

                        <div class="col-md-3">

                        <input class="form-control" type="text" placeholder="Transporter Code" name="Transporter_Code" value="<?php echo $Transporter_Code ?>">

                        </div>

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

                                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>

                                <button type="submit" class="btn btn-warning"><i class="fa fa-arrow-circle-down"></i></button>

                            </div>

                        </div>

                    </div>
                </form>



                </div>

                <div class="card card-table"> 

                    <div class="card-body">

                        <div class="table-scroll">

                            <table class="table table-striped table-hover table-bordered">

                                <thead class="thead-light">

                                    <tr>

                                    <th>Transporter Code</th>

                                    <th>Name</th>

                                    <th>Reporting Date & Time</th>

                                    <th>Releasing Date & Time</th>

                                    <th>Status</th>

                                    <th>Updated By</th>

                                    <th>Updated Date</th>                                 

                                    <th>Note</th>

                                    <th>LR. No.</th>

                                    <th>Billing Date</th>

                                    <th width="90px">Action</th>

                                    </tr>



                                </thead>

                                <tbody>

                                    <?php

                                    $income = 0;

                                    if(!empty($getSales)){

                                        foreach($getSales as $sales){ ?>

                                            <tr>

                                                <td>

                                                    <input type="hidden" name="VENDOR" value="<?php //echo $sales['VENDOR'] ?>">

                                                    <?php echo $sales['VENDOR']; ?></td>

                                                <td>

                                                    <input type="hidden" name="NAME_SHIP_PARTY" value="<?php //echo $sales['NAME_SHIP_PARTY'] ?>">

                                                    <?php echo $sales['NAME_SHIP_PARTY']; ?> </td>
                                                

                                                <td>

                                                    <input type="hidden" name="REP_DT" value="<?php //echo $sales['REP_DT'] ?>">

                                                    <?php echo $sales['REP_DT']; ?> </td>

                                                <td>

                                                    <input type="hidden" name="UNL_DT" value="<?php //echo $sales['UNL_DT'] ?>">

                                                    <?php echo $sales['UNL_DT']; ?> </td>
                                                <td>

                                                    <input type="hidden" name="STATUST" value="<?php //echo $sales['STATUST'] ?>">

                                                    <?php echo $sales['STATUST']; ?></td>
                                                <td>

                                                    <input type="hidden" name="UPDATED_BY" value="<?php //echo $sales['UPDATED_BY'] ?>">

                                                    <?php echo $sales['USER_NAME']; ?></td>

                                                <td>

                                                    <input type="hidden" name="UPDATED_DT" value="<?php //echo $sales['UPDATED_DT'] ?>">

                                                    <?php echo $sales['UPDATED_DT']; ?></td>

                                                <td>

                                                    <input type="hidden" name="NOTE" value="<?php //echo $sales['NOTE'] ?>">

                                                    <?php echo $sales['NOTE']; ?></td>
                                                <td>

                                                    <input type="hidden" name="LR_NO" value="<?php //echo $sales['LR_NO'] ?>">

                                                    <?php echo $sales['LR_NO']; ?></td>

                                                <td>

                                                    <input type="hidden" name="BILL_DT" value="<?php //echo $sales['BILL_DT'] ?>">

                                                    <?php echo $sales['BILL_DT']; ?> 
                                                </td>

                                                <td>
                                                <a  data-toggle="tooltip" data-placement="top" data-id="<?php echo $sales['ID']; ?> " class="edit_trans" title="Edit" ><i class="far fa-edit me-2"></i></i></a> 
                                                    <?php if($sales['POD'] != '') { ?>
                                                        <a href="<?=base_url('assets/pod/'.$sales['POD'])?>" data-toggle="tooltip" data-placement="top" title="View" target="_blank"><i class="far fa-eye me-2"></i></a> 
                                                       
                                                        <a href="<?= base_url('download/'.$sales['POD'])?>" data-toggle="tooltip" data-placement="top" title="Download"><i class="fa fa-arrow-circle-down"></i></a> <?php } else { echo ' <i class="far fa-eye me-2"></i> <i class="fa fa-arrow-circle-down"> '; } ?>
                                                </td>


                                            </tr>
                    

                                    <?php }} ?>


                                </tbody>

                            </table>

                        </div>

                    </div>

                </div> 
                
                <div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

                    <div class="modal-dialog modal-top">

                        <div class="modal-content">
                            
                        <form method="post" id="formSubmit" action="<?php echo base_url(); ?>?/save_trans" enctype="multipart/form-data">
                            <div class="modal-body">

                                <div class="row">    

                                    <div class="form-group">

                                        <label for="">Reporting Date: </label>

                                        <input type="hidden" value="" id="saleid">

                                        <input type="date" name="REPORT_DATE" id="REPORT_DATE" class="form-co">

                                        <label for="">Time: </label>

                                        <input type="time" name="REPORT_TIME" id="REPORT_TIME" class="form-co">

                                    </div>

                                </div>

                                <div class="row"> 

                                    <div class="form-group">

                                        <label for="">Releasing Date: </label>

                                        <input type="date" name="RELEASE_DATE" id="RELEASE_DATE" class="form-co">

                                        <label for="">Time: </label>

                                        <input type="time" name="RELEASE_TIME" id="RELEASE_TIME" class="form-co">

                                    </div>

                                </div>

                            </div>
                        </form>

                            <div class="modal-footer">

                                <button type="button" id="save" class="btn btn-success">Save</button>

                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>

                            </div>

                        </div><!-- /.modal-content -->

                    </div><!-- /.modal-dialog -->

                </div>

            </div>



        </div>
        <!-- /Page Wrapper -->





    </div>



    <!-- end main content-->



<?php $this->load->view('partials/vendor-scripts') ?>

<script>

$('.edit_trans').click(function() {

        $('#top-modal').modal('show');

        var sale_id = $(this).attr('data-id');
        console.log(sale_id)

        $('#saleid').val(sale_id);

        $.ajax({

            method: "POST",
            url: "<?php echo base_url(); ?>?/Transport/edit_trans/"+sale_id,
            data: sale_id,
            dataType: 'json',
            processData: false,
            contentType: false,
            success:function(data)
            {
                console.log(data);
                $('#REPORT_DATE').val(data.rptdate)
                $('#REPORT_TIME').val(data.rpttime)
                $('#RELEASE_DATE').val(data.unldate)
                $('#RELEASE_TIME').val(data.unltime)

                // var today = date.toISOString().split('T')[0];
                // $("#REPORT_DATE").val(today);
                // window.location.href= "<?php //echo base_url(); ?>/TransView"; 
            }

            })

});

    $('select[option]').change(function(){

        alert('df');

    })

    $("#report").change(function() {

        var option = $(this).val();

        // alert(option)

        $('.reports').addClass('d-none');

        $("#"+option).removeClass('d-none');

        // window.location.href = "reports";

    });


    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip({
            placement : 'top'
        });
    });

    $(document).ready(function () {

        $('#save').click(function() {

            var formData = new FormData($("#formSubmit")[0]);

            var sale_id = $('#saleid').val();

                $.ajax({

                    method: "POST",
                    url: "<?php echo base_url(); ?>?/Transport/save_trans/"+sale_id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success:function(data)
                    {
                        console.log(data);
                        window.location.href= "<?php echo base_url(); ?>?/Transport/TransView"; 
                    }

                })
        });

    });

</script>



</body>







</html>