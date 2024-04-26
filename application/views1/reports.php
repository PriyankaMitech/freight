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

                    <div class="row align-items-center form-group ">
                        <div class="col-md-3">
                        <select class="form-select report-select" name="report" id="report">
                            <option value="reports">Select report</option>
                            <option value="detention">Detention report</option>
                            <option value="cost">Cost statement</option>
                            <option value="transport">Transporter Score Card</option>
                            <option>Customer Score Card</option>
                            <option>Cost v/s Recovery</option>
                            <option>Diesel Cost</option>
                            <option>Diesel Cost with Total Freight</option>
                            <option value="vehicleUtilization">Vehicle Utilization</option>
                            <option>Freight</option>
                        </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="date-picker">
                                <div class="form-custom cal-icon">
                                    <input class="form-control datetimepicker" type="text" placeholder="Start Date">
                                </div>
                            </div>
                            <div class="date-picker">
                                <div class="form-custom cal-icon">
                                    <input class="form-control datetimepicker" type="text" placeholder="End Date">
                                </div>
                            </div>
                            <div class="invoice-setting-btn">
                                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                                <button type="submit" class="btn btn-warning"><i class="fa fa-arrow-circle-down"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
                <?php
                    $income = 0;
                    foreach($getSales as $sales){
                        if (is_numeric($sales['DETENTION'])) {
                            $total_fare = floatval($sales['DETENTION']);
                            }
                            else {
                                $total_fare = 0.00;
                            }
                            $income += $total_fare;
                    }
                ?>
                <div id="detention" class="d-none reports">
                    <h3 class="text-info">Total Detention Amount: <?php echo $income; ?></h3>
                    <div class="card card-table"> 

                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-striped table-hover datatable table-bordered">

                                    <thead class="thead-light">

                                        <tr>

                                        <th>LR. No.</th>

                                        <th>Bill No</th> 
                                        
                                        <th>Name of the ship to party</th>

                                        <th>Code of ship to party</th>
                                        
                                        <th>Location</th>

                                        <th>Billing Document</th>

                                        <th>Reference No.</th>

                                        <th>Reporting Date & Time</th>

                                        <th>Releasing Date & Time</th>

                                        <th>Billing Date</th>
                                        
                                        <th>Detention</th>

                                        <th>Reason</th>

                                        </tr>

                                    </thead>

                                    <tbody>
                                        <?php //print_r($getSales); 
                                            $i = 1;
                                            $income = 0;
                                            foreach($getSales as $sales){
                                        ?>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="LR_NO" value="<?php //echo $sales['LR_NO'] ?>">
                                                <?php echo $sales['LR_NO']; ?></td>

                                            <td>
                                                <input type="hidden" name="BILL_NO" value="<?php //echo $sales['BILL_NO'] ?>">
                                                <?php echo $sales['BILL_NO']; ?></td>
                                            <td>
                                                <input type="hidden" name="NAME_SHIP_PARTY" value="<?php //echo $sales['NAME_SHIP_PARTY'] ?>">
                                                <?php echo $sales['NAME_SHIP_PARTY']; ?> </td>

                                            <td>
                                                <input type="hidden" name="VENDOR" value="<?php //echo $sales['VENDOR'] ?>">
                                                <?php echo $sales['VENDOR']; ?> </td>
                                            
                                            <td>
                                                <input type="hidden" name="LCN_SHIP_PARTY" value="<?php //echo $sales['LCN_SHIP_PARTY'] ?>">
                                                <?php echo $sales['LCN_SHIP_PARTY']; ?></td>
                                            <td>
                                                <input type="hidden" name="BILLING_DOC" value="<?php //echo $sales['BILLING_DOC'] ?>">
                                                <?php echo $sales['BILLING_DOC']; ?></td>
                                            <td>
                                                <input type="hidden" name="REF_NO" value="<?php //echo $sales['REF_NO'] ?>">
                                                <?php echo $sales['REF_NO']; ?> </td>
                                            <td>
                                                <input type="hidden" name="REP_DT" value="<?php //echo $sales['REP_DT'] ?>">
                                                <?php echo $sales['REP_DT']; ?> </td>
                                            <td>
                                                <input type="hidden" name="UNL_DT" value="<?php //echo $sales['UNL_DT'] ?>">
                                                <?php echo $sales['UNL_DT']; ?> </td>
                                            <td>
                                                <input type="hidden" name="BILL_DT" value="<?php //echo $sales['BILL_DT'] ?>">
                                                <?php echo $sales['BILL_DT']; ?> </td>
                                            <td>
                                                <input type="hidden" name="DETENTION" value="<?php //echo $sales['DETENTION'] ?>">
                                                <?php echo $sales['DETENTION']; ?></td>
                                            <td>
                                                <input type="hidden" name="DETN_NOTE" value="<?php //echo $sales['DETN_NOTE'] ?>">
                                                <?php echo $sales['DETN_NOTE']; ?></td>

                                        </tr>
                                        <?php $i++; } ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>
                </div>
                <div id="cost" class="d-none reports">
                    <h3 class="text-info">Total Detention Amount: <?php echo $income; ?></h3>
                    <div class="card card-table"> 

                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-striped table-hover datatable table-bordered">

                                    <thead class="thead-light">

                                        <tr>

                                        <th>LR. No.</th>

                                        <th>Bill No</th> 
                                        
                                        <th>Name of the ship to party</th>

                                        <th>Code of ship to party</th>
                                        
                                        <th>Location</th>

                                        <th>Billing Document</th>

                                        <th>Reference No.</th>

                                        <th>Reporting Date & Time</th>

                                        <th>Releasing Date & Time</th>

                                        <th>Billing Date</th>
                                        
                                        <th>Detention</th>

                                        <th>Reason</th>

                                        </tr>

                                    </thead>

                                    <tbody>
                                        <?php //print_r($getSales); 
                                            $i = 1;
                                            $income = 0;
                                            foreach($getSales as $sales){
                                        ?>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="LR_NO" value="<?php //echo $sales['LR_NO'] ?>">
                                                <?php echo $sales['LR_NO']; ?></td>

                                            <td>
                                                <input type="hidden" name="BILL_NO" value="<?php //echo $sales['BILL_NO'] ?>">
                                                <?php echo $sales['BILL_NO']; ?></td>
                                            <td>
                                                <input type="hidden" name="NAME_SHIP_PARTY" value="<?php //echo $sales['NAME_SHIP_PARTY'] ?>">
                                                <?php echo $sales['NAME_SHIP_PARTY']; ?> </td>

                                            <td>
                                                <input type="hidden" name="VENDOR" value="<?php //echo $sales['VENDOR'] ?>">
                                                <?php echo $sales['VENDOR']; ?> </td>
                                            
                                            <td>
                                                <input type="hidden" name="LCN_SHIP_PARTY" value="<?php //echo $sales['LCN_SHIP_PARTY'] ?>">
                                                <?php echo $sales['LCN_SHIP_PARTY']; ?></td>
                                            <td>
                                                <input type="hidden" name="BILLING_DOC" value="<?php //echo $sales['BILLING_DOC'] ?>">
                                                <?php echo $sales['BILLING_DOC']; ?></td>
                                            <td>
                                                <input type="hidden" name="REF_NO" value="<?php //echo $sales['REF_NO'] ?>">
                                                <?php echo $sales['REF_NO']; ?> </td>
                                            <td>
                                                <input type="hidden" name="REP_DT" value="<?php //echo $sales['REP_DT'] ?>">
                                                <?php echo $sales['REP_DT']; ?> </td>
                                            <td>
                                                <input type="hidden" name="UNL_DT" value="<?php //echo $sales['UNL_DT'] ?>">
                                                <?php echo $sales['UNL_DT']; ?> </td>
                                            <td>
                                                <input type="hidden" name="BILL_DT" value="<?php //echo $sales['BILL_DT'] ?>">
                                                <?php echo $sales['BILL_DT']; ?> </td>
                                            <td>
                                                <input type="hidden" name="DETENTION" value="<?php //echo $sales['DETENTION'] ?>">
                                                <?php echo $sales['DETENTION']; ?></td>
                                            <td>
                                                <input type="hidden" name="DETN_NOTE" value="<?php //echo $sales['DETN_NOTE'] ?>">
                                                <?php echo $sales['DETN_NOTE']; ?></td>

                                        </tr>
                                        <?php $i++; } ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>
                </div>
                <div id="transport" class="d-none reports">
                    <h4 class="text-info">Total Billed Amount: <?php echo $income; ?></h4>
                    <div class="card card-table"> 

                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-striped table-hover datatable table-bordered">

                                    <thead class="thead-light">

                                        <tr>

                                        <th>LR. No.</th>

                                        <th>Bill No</th> 
                                        
                                        <th>Name of the ship to party</th>

                                        <th>Code of ship to party</th>
                                        
                                        <th>Location</th>

                                        <th>Billing Document</th>

                                        <th>Reference No.</th>

                                        <th>Reporting Date & Time</th>

                                        <th>Releasing Date & Time</th>

                                        <th>Billing Date</th>
                                        
                                        <th>Detention</th>

                                        <th>Reason</th>

                                        </tr>

                                    </thead>

                                    <tbody>
                                        <?php //print_r($getSales); 
                                            $i = 1;
                                            $income = 0;
                                            foreach($getSales as $sales){
                                        ?>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="LR_NO" value="<?php //echo $sales['LR_NO'] ?>">
                                                <?php echo $sales['LR_NO']; ?></td>

                                            <td>
                                                <input type="hidden" name="BILL_NO" value="<?php //echo $sales['BILL_NO'] ?>">
                                                <?php echo $sales['BILL_NO']; ?></td>
                                            <td>
                                                <input type="hidden" name="NAME_SHIP_PARTY" value="<?php //echo $sales['NAME_SHIP_PARTY'] ?>">
                                                <?php echo $sales['NAME_SHIP_PARTY']; ?> </td>

                                            <td>
                                                <input type="hidden" name="VENDOR" value="<?php //echo $sales['VENDOR'] ?>">
                                                <?php echo $sales['VENDOR']; ?> </td>
                                            
                                            <td>
                                                <input type="hidden" name="LCN_SHIP_PARTY" value="<?php //echo $sales['LCN_SHIP_PARTY'] ?>">
                                                <?php echo $sales['LCN_SHIP_PARTY']; ?></td>
                                            <td>
                                                <input type="hidden" name="BILLING_DOC" value="<?php //echo $sales['BILLING_DOC'] ?>">
                                                <?php echo $sales['BILLING_DOC']; ?></td>
                                            <td>
                                                <input type="hidden" name="REF_NO" value="<?php //echo $sales['REF_NO'] ?>">
                                                <?php echo $sales['REF_NO']; ?> </td>
                                            <td>
                                                <input type="hidden" name="REP_DT" value="<?php //echo $sales['REP_DT'] ?>">
                                                <?php echo $sales['REP_DT']; ?> </td>
                                            <td>
                                                <input type="hidden" name="UNL_DT" value="<?php //echo $sales['UNL_DT'] ?>">
                                                <?php echo $sales['UNL_DT']; ?> </td>
                                            <td>
                                                <input type="hidden" name="BILL_DT" value="<?php //echo $sales['BILL_DT'] ?>">
                                                <?php echo $sales['BILL_DT']; ?> </td>
                                            <td>
                                                <input type="hidden" name="DETENTION" value="<?php //echo $sales['DETENTION'] ?>">
                                                <?php echo $sales['DETENTION']; ?></td>
                                            <td>
                                                <input type="hidden" name="DETN_NOTE" value="<?php //echo $sales['DETN_NOTE'] ?>">
                                                <?php echo $sales['DETN_NOTE']; ?></td>

                                        </tr>
                                        <?php $i++; } ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>
                </div>
                
                <div id="vehicleUtilization" class="d-none reports">
                    <h4 class="text-info">Total Billed Amount: <?php echo $income; ?></h4>
                    <div class="card card-table"> 

                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-striped table-hover datatable table-bordered">

                                    <thead class="thead-light">

                                        <tr>

                                        <th>LR. No.</th>

                                        <th>Bill No</th> 
                                        
                                        <th>Name of the ship to party</th>

                                        <th>Code of ship to party</th>
                                        
                                        <th>Location</th>

                                        <th>Billing Document</th>

                                        <th>Reference No.</th>

                                        <th>Reporting Date & Time</th>

                                        <th>Releasing Date & Time</th>

                                        <th>Billing Date</th>
                                        
                                        <th>Detention</th>

                                        <th>Reason</th>

                                        </tr>

                                    </thead>

                                    <tbody>
                                        <?php //print_r($getSales); 
                                            $i = 1;
                                            $income = 0;
                                            foreach($getSales as $sales){
                                        ?>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="LR_NO" value="<?php //echo $sales['LR_NO'] ?>">
                                                <?php echo $sales['LR_NO']; ?></td>

                                            <td>
                                                <input type="hidden" name="BILL_NO" value="<?php //echo $sales['BILL_NO'] ?>">
                                                <?php echo $sales['BILL_NO']; ?></td>
                                            <td>
                                                <input type="hidden" name="NAME_SHIP_PARTY" value="<?php //echo $sales['NAME_SHIP_PARTY'] ?>">
                                                <?php echo $sales['NAME_SHIP_PARTY']; ?> </td>

                                            <td>
                                                <input type="hidden" name="VENDOR" value="<?php //echo $sales['VENDOR'] ?>">
                                                <?php echo $sales['VENDOR']; ?> </td>
                                            
                                            <td>
                                                <input type="hidden" name="LCN_SHIP_PARTY" value="<?php //echo $sales['LCN_SHIP_PARTY'] ?>">
                                                <?php echo $sales['LCN_SHIP_PARTY']; ?></td>
                                            <td>
                                                <input type="hidden" name="BILLING_DOC" value="<?php //echo $sales['BILLING_DOC'] ?>">
                                                <?php echo $sales['BILLING_DOC']; ?></td>
                                            <td>
                                                <input type="hidden" name="REF_NO" value="<?php //echo $sales['REF_NO'] ?>">
                                                <?php echo $sales['REF_NO']; ?> </td>
                                            <td>
                                                <input type="hidden" name="REP_DT" value="<?php //echo $sales['REP_DT'] ?>">
                                                <?php echo $sales['REP_DT']; ?> </td>
                                            <td>
                                                <input type="hidden" name="UNL_DT" value="<?php //echo $sales['UNL_DT'] ?>">
                                                <?php echo $sales['UNL_DT']; ?> </td>
                                            <td>
                                                <input type="hidden" name="BILL_DT" value="<?php //echo $sales['BILL_DT'] ?>">
                                                <?php echo $sales['BILL_DT']; ?> </td>
                                            <td>
                                                <input type="hidden" name="DETENTION" value="<?php //echo $sales['DETENTION'] ?>">
                                                <?php echo $sales['DETENTION']; ?></td>
                                            <td>
                                                <input type="hidden" name="DETN_NOTE" value="<?php //echo $sales['DETN_NOTE'] ?>">
                                                <?php echo $sales['DETN_NOTE']; ?></td>

                                        </tr>
                                        <?php $i++; } ?>

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
    $('select[option]').change(function(){
        alert('df');
    })
    // function selectReport(){
    //     alert('sdsd');
    // }
    $("#report").change(function() {
        var option = $(this).val();
        // alert(option)
        $('.reports').addClass('d-none');
        $("#"+option).removeClass('d-none');
        // window.location.href = "reports";
    });
</script>

</body>



</html>