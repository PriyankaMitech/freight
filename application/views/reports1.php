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

    </style>

</head>



<?php $this->load->view('partials/body') ?>



    <div class="main-wrapper">



    <?php $this->load->view('partials/menu') ?>



        <!-- Page Wrapper -->



        <div class="page-wrapper">



            <div class="content container-fluid">                

                <div class="row">


                	<form action="<?php echo base_url(); ?>?/report" method="post">
                    <div class="row align-items-center form-group ">

                        <div class="col-md-3">

                        <select class="form-select report-select" name="report" id="report">

                            <option value="reports">Select report</option>

                            <option value="detention" <?php echo ($report == 'detention')? 'Selected' : '' ?>>Detention report</option>

                            <option value="cost" <?php echo ($report == 'cost')? 'Selected' : '' ?>>Cost statement</option>

                            <option value="transport" <?php echo ($report == 'transport')? 'Selected' : '' ?>>Transporter Score Card</option>

                            <option  value="Customer" <?php echo ($report == 'Customer')? 'Selected' : '' ?>>Customer Score Card</option>

                            <option value="CostvsRecovery" <?php echo ($report == 'CostvsRecovery')? 'Selected' : '' ?>>Cost v/s Recovery</option>

                            <option value="BudgetvsActual" <?php echo ($report == 'BudgetvsActual')? 'Selected' : '' ?>>Freight Budget v/s Actual</option>

                            <option value="dieselCost" <?php echo ($report == 'dieselCost')? 'Selected' : '' ?>>Diesel Cost</option>

                            <option value="dieselWithFreight" <?php echo ($report == 'dieselWithFreight')? 'Selected' : '' ?>>Diesel Cost with Total Freight</option>

                                <option value="vehicleUtilization" <?php echo ($report == 'vehicleUtilization')? 'Selected' : '' ?>>Vehicle Utilization</option>

                                <option value="freight" <?php echo ($report == 'freight')? 'Selected' : '' ?>>Freight</option>

                        </select>

                        </div>

                        <div class="col-sm-6">

                            <div class="date-picker">

                                <div class="form-custom cal-icon">

                                    <input class="form-control datetimepicker" type="text" name="start_date" placeholder="Start Date" value="<?php echo $start_date ?>">

                                </div>

                            </div>

                            <div class="date-picker">

                                <div class="form-custom cal-icon">

                                    <input class="form-control datetimepicker" type="text" name="end_date" placeholder="End Date" value="<?php echo $end_date ?>">

                                </div>

                            </div>

                            <div class="invoice-setting-btn">

                                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>

                                <button type="button" class="btn btn-warning"><i class="fa fa-arrow-circle-down"></i></button>

                            </div>

                        </div>

                    </div>
                	</form>



                </div>

                <?php
                $income = 0;
                if(!empty($getSales)){

                    

                    foreach($getSales as $sales){

                        if (is_numeric($sales['DETENTION'])) {

                            $total_fare = floatval($sales['DETENTION']);

                            }

                            else {

                                $total_fare = 0.00;

                            }

                            $income += $total_fare;

                    } }

                ?>

                <div id="" class="<?php echo ($report != 'detention')? 'd-none' : '' ?> reports">

                    <h3 class="text-info">Total Detention Amount: <?php echo $income; ?></h3>

                    <div class="card card-table"> 



                        <div class="card-body">



                            <div class="table-responsive">



                                <table class="table">



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

                                            if(!empty($getSales)){

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

                                        <?php $i++; } } ?>



                                    </tbody>



                                </table>



                            </div>



                        </div>



                    </div>

                </div>

                <div id="" class="<?php echo ($report != 'cost')? 'd-none' : '' ?> reports">

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
                                            if(!empty($getSales)){

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

                                        <?php $i++; } } ?>



                                    </tbody>



                                </table>



                            </div>



                        </div>



                    </div>

                </div>

                <div id="" class="<?php echo ($report != 'transport')? 'd-none' : '' ?> reports">

                	 <?php
		                $TotalBilledAmount = 0;
		                $TotalNoehiclesplaced = 0;
		                $TotalUnbilledAmount = 0;
		                $Totaldelayindelivery = 0;
		                $TotalBillingAmount = 0;
		                if(!empty($getTransporter)){

		                    

		                    foreach($getTransporter as $Transporter){

		                        if (is_numeric($Transporter['vehiclecount'])) {

		                            $TotalNoehiclesplaced += ($Transporter['vehiclecount']);

	                            }

	                            else {

	                                $TotalNoehiclesplaced += 0;

	                            }

	                            if (is_numeric($Transporter['FREIGHT'])) {

		                            $TotalUnbilledAmount += ($Transporter['FREIGHT']);

	                            }

	                            else {

	                                $TotalUnbilledAmount += 0;

	                            }

	                            if (is_numeric($Transporter['PENALTY'])) {

		                            $Totaldelayindelivery += ($Transporter['PENALTY']);

	                            }

	                            else {

	                                $Totaldelayindelivery += 0;

	                            }

	                            if (is_numeric($Transporter['FREIGHT_T'])) {

		                            $TotalBillingAmount += ($Transporter['FREIGHT_T']);

	                            }

	                            else {

	                                $TotalBillingAmount += 0;

	                            }

		                            

		                    } }

		                ?>

                    <div class="NewHorizontalTable">
	                    <table style="width: 70%;">
						    <tr>
						        <td>Total Billed Amount</td>
						        <td><?php echo $TotalBillingAmount; ?></td>
						        <td> Total No. Vehicles placed</td>
						        <td><?php echo $TotalNoehiclesplaced; ?></td>
						    </tr>
						    <tr>
						        <td>Total Unbilled Amount</td>
						        <td><?php echo $TotalUnbilledAmount; ?></td>
						        <td> Total delay in delivery</td>
						        <td> <?php echo $Totaldelayindelivery; ?> </td>
						    </tr>
						    <tr>
						        <td>Total Billing Amount</td>
						        <td><?php echo $TotalBillingAmount; ?></td>
						        <td> Percent Delay</td>
						        <td> <?php echo ($TotalNoehiclesplaced > 0) ? number_format((($Totaldelayindelivery/$TotalNoehiclesplaced)*100), 2) : 0 ;  ?></td>
						    </tr>
						</table>
					</div>

                    <div class="card card-table"> 



                        <div class="card-body">



                            <div class="table-responsive">



                                <table class="table table-striped table-hover datatable table-bordered">



                                    <thead class="thead-light">



                                        <tr>



                                        <th>Transporter Name</th>



                                        <th>Code</th> 

                                        

                                        <th>No. Vehicles Placed</th>



                                        <th>Delay in delivery</th>

                                        

                                        <th>Billing Amount</th>



                                        <th>Unbilled</th>



                                        <th>%</th>



                                        </tr>



                                    </thead>



                                    <tbody>

                                        <?php //print_r($getSales); 

                                            $i = 1;

                                            $income = 0;

                                            if(!empty($getTransporter)){

                                            foreach($getTransporter as $Transporter){

                                        ?>

                                        <tr>

                                            <td>

                                                <?php echo $Transporter['TRANS_NAME']; ?></td>


                                            <td>

                                                <?php echo $Transporter['VENDOR']; ?></td>

                                            <td>

                                                <?php echo $Transporter['vehiclecount']; ?> </td>


                                            <td>

                                                <?php echo $Transporter['PENALTY'] ; ?> </td>
                                            

                                            <td>

                                                <?php echo ($Transporter['FREIGHT_T'])? $Transporter['FREIGHT_T'] : 0 ; ?></td>

                                            <td>

                                                <?php echo ($Transporter['FREIGHT'])? $Transporter['FREIGHT'] : 0 ; ?></td>

                                            <td>

                                                <?php echo $Transporter['FREIGHT']; ?> </td>

                                            


                                        </tr>

                                        <?php $i++; } } ?>



                                    </tbody>



                                </table>



                            </div>



                        </div>



                    </div>

                </div>

                <div id="" class="<?php echo ($report != 'Customer')? 'd-none' : '' ?> reports">

                	 <?php
		                $TotalBilledAmount = 0;
		                $TotalNoehiclesplaced = 0;
		                $Totalnoofdetentionday = 0;
		                $Totaldelayindelivery = 0;
		                $TotalBillingAmount = 0;
		                if(!empty($getTransporter)){

		                    

		                    foreach($getCustomer as $Customer){

		                        if (is_numeric($Customer['vehiclecount'])) {

		                            $TotalNoehiclesplaced += ($Customer['vehiclecount']);

	                            }

	                            else {

	                                $TotalNoehiclesplaced += 0;

	                            }

	                            if (is_numeric($Customer['delaydays'])) {

		                            $Totalnoofdetentionday += ($Customer['FREIGHT']);

	                            }

	                            else {

	                                $Totalnoofdetentionday += 0;

	                            }

	                            if (is_numeric($Customer['PENALTY'])) {

		                            $Totaldelayindelivery += ($Customer['PENALTY']);

	                            }

	                            else {

	                                $Totaldelayindelivery += 0;

	                            }

	                            if (is_numeric($Customer['FREIGHT_T'])) {

		                            $TotalBillingAmount += ($Customer['FREIGHT_T']);

	                            }

	                            else {

	                                $TotalBillingAmount += 0;

	                            }

		                            

		                    } }

		                ?>

                    <div class="NewHorizontalTable">
	                    <table style="width: 70%;">
						    <tr>
						        
						        <td> Total No. Vehicles placed</td>
						        <td><?php echo $TotalNoehiclesplaced; ?></td>
						        <td></td>
						        <td></td>
						    </tr>
						    <tr>
						        <td>Total No. of Detention Days</td>
						        <td><?php echo $Totalnoofdetentionday; ?></td>
						        <td> Total delay in delivery</td>
						        <td> <?php echo $Totaldelayindelivery; ?> </td>
						    </tr>
						    <tr>
						        <td>Percent Detention</td>
						        <td><?php echo "0.00%"; ?></td>
						        <td> Percent Delay</td>
						        <td> <?php echo ($TotalNoehiclesplaced > 0) ? number_format((($Totaldelayindelivery/$TotalNoehiclesplaced)*100), 2)."%" : 0 ;  ?></td>
						    </tr>
						</table>
					</div>

                    <div class="card card-table"> 



                        <div class="card-body">



                            <div class="table-responsive">



                                <table class="table table-striped table-hover datatable table-bordered">



                                    <thead class="thead-light">



                                        <tr>



                                        <th>Customer Name</th>



                                        <th>Code</th> 

                                        

                                        <th>Vehicles Placed</th>



                                        <th>Delay in delivery</th>



                                        <th>Delay %</th>

                                        

                                        <th>Detention day</th>



                                        <th>Detention %</th>
                                        



                                        </tr>



                                    </thead>



                                    <tbody>

                                        <?php //print_r($getSales); 

                                            $i = 1;

                                            $income = 0;

                                            if(!empty($getCustomer)){

                                            foreach($getCustomer as $Customer){

                                        ?>

                                        <tr>

                                            <td>

                                                <?php echo $Customer['NAME_SHIP_PARTY']; ?></td>


                                            <td>

                                                <?php echo $Customer['VENDOR']; ?></td>

                                            <td>

                                                <?php echo $Customer['vehiclecount']; ?> </td>


                                            <td>

                                                <?php echo $Customer['PENALTY'] ; ?> </td>

                                            <td> 

                                                <?php echo number_format((($Customer['PENALTY']/$Customer['vehiclecount'])*100), 2)."%";  ?> </td>
                                            

                                            <td>

                                                <?php echo $Customer['delaydays']; ?></td>

                                            <td>

                                                <?php echo ($Customer['FREIGHT'])? $Customer['FREIGHT'] : 0 ; ?></td>

                                            

                                            


                                        </tr>

                                        <?php $i++; } } ?>



                                    </tbody>



                                </table>



                            </div>



                        </div>



                    </div>

                </div>

                <div id="" class="<?php echo ($report != 'CostvsRecovery')? 'd-none' : '' ?> reports">

                	 <?php
		                $TotalBilledAmount = 0;
		                $TotalNoehiclesplaced = 0;
		                $TotalUnbilledAmount = 0;
		                $Totaldelayindelivery = 0;
		                $TotalBillingAmount = 0;
		                if(!empty($getCostvsRecovery)){

		                    

		                    foreach($getCostvsRecovery as $CostvsRecovery){

		                        if (is_numeric($CostvsRecovery['vehiclecount'])) {

		                            $TotalNoehiclesplaced += ($CostvsRecovery['vehiclecount']);

	                            }

	                            else {

	                                $TotalNoehiclesplaced += 0;

	                            }

	                            if (is_numeric(str_replace(',', '', $CostvsRecovery['FRT_AFT_ST']))) {

		                            $TotalUnbilledAmount += str_replace(',', '', $CostvsRecovery['FRT_AFT_ST']);

	                            }

	                            else {

	                                $TotalUnbilledAmount += 0;

	                            }

	                            if (is_numeric($CostvsRecovery['PENALTY'])) {

		                            $Totaldelayindelivery += ($CostvsRecovery['PENALTY']);

	                            }

	                            else {

	                                $Totaldelayindelivery += 0;

	                            }

	                            if (is_numeric($CostvsRecovery['FREIGHT_T'])) {

		                            $TotalBillingAmount += ($CostvsRecovery['FREIGHT_T']);

	                            }

	                            else {

	                                $TotalBillingAmount += 0;

	                            }

		                            

		                    } }

		                ?>

                    <div class="NewHorizontalTable">
	                    <table style="width: 70%;">
						    <tr>
						        <td>Total Billed Amount</td>
						        <td><?php echo $TotalBillingAmount; ?></td>
						        <td> Total No. Vehicles placed</td>
						        <td><?php echo $TotalNoehiclesplaced; ?></td>
						    </tr>
						    <tr>
						        <td>Total Unbilled Amount</td>
						        <td><?php echo $TotalUnbilledAmount; ?></td>
						        <td> Total delay in delivery</td>
						        <td> <?php echo $Totaldelayindelivery; ?> </td>
						    </tr>
						    
						</table>
					</div>

                    <div class="card card-table"> 



                        <div class="card-body">



                            <div class="table-responsive">



                                <table class="table table-striped table-hover datatable table-bordered">



                                    <thead class="thead-light">



                                        <tr>



                                        <th>Ship To Party</th>



                                        <th>Name of the Ship To Party</th> 

                                        

                                        <th>Location</th>



                                        <th>Billing Document</th>



                                        <th>Reference</th>

                                        

                                        <th>Billing Date</th>



                                        <th>Freight Paid</th>



                                        <th>Freight Recover</th>



                                        <th>Short Recovery</th>



                                        <th>Excess Recovery</th>



                                        </tr>



                                    </thead>



                                    <tbody>

                                        <?php //print_r($getSales); 

                                            $i = 1;

                                            $income = 0;

                                            if(!empty($getCostvsRecovery)){
                                                // echo "<pre>";print_r($getCostvsRecovery);exit();

                                            foreach($getCostvsRecovery as $CostvsRecovery){

                                        ?>

                                        <tr>

                                            <td>

                                                <?php echo $CostvsRecovery['SHIP_TO_PARTY']; ?></td>


                                            <td>

                                                <?php echo $CostvsRecovery['NAME_SHIP_PARTY']; ?></td>

                                            <td>

                                                <?php echo $CostvsRecovery['LCN_SHIP_PARTY']; ?> </td>


                                            <td>

                                                <?php echo $CostvsRecovery['BILLING_DOC'] ; ?> </td>
                                            

                                            <td>

                                                <?php echo ($CostvsRecovery['REF_NO']); ?></td>

                                            <td>

                                                <?php echo $CostvsRecovery['BILL_DT']; ?></td>

                                            <td>

                                                <?php echo $CostvsRecovery['FREIGHT_T']; ?> </td>
                                                
                                            <td>

                                                <?php echo str_replace(',', '', $CostvsRecovery['FRT_AFT_ST']); ?> </td>
                                                
                                            <td>

                                                <?php echo $CostvsRecovery['FREIGHT_T'] - str_replace(',', '', $CostvsRecovery['FRT_AFT_ST']); ?> </td>

                                            <td>

                                                <?php echo str_replace(',', '', $CostvsRecovery['FRT_AFT_ST']) - $CostvsRecovery['FREIGHT_T']; ?> </td>

                                            


                                        </tr>

                                        <?php $i++; } } ?>



                                    </tbody>



                                </table>



                            </div>



                        </div>



                    </div>

                </div>

                <div id="dieselCost" class="<?php echo ($report != 'dieselCost')? 'd-none' : '' ?> reports">

                    <div class="card card-table">
                    <?php
        $TotalRate = 0;
        $TotalFREIGHT_T = 0;
        if(!empty($getdieselCost)){

            

            foreach($getdieselCost as $dieselCostwith){

                

                if (is_numeric(str_replace(',', '', $dieselCostwith['Rate']))) {

                    $TotalRate += (str_replace(',', '', $dieselCostwith['Rate']));

                }

                else {

                    $TotalRate += 0;

                }

                $dieseldata= ($dieselCostwith['kilometer']/$dieselCostwith['VEHICLE_AVERAGE']) * $dieselCostwith['Dieselrate'];

                $dieseldatain = ($dieseldata/$TotalRate)*100;

                if (is_numeric($dieselCostwith['FREIGHT_T'])) {

                    $TotalFREIGHT_T += ($dieselCostwith['FREIGHT_T']);

                }

                else {

                    $TotalFREIGHT_T += 0;

                }

                
                    

            } }

        ?>
                        <div class="NewHorizontalTable">
                            <table>
                            <tr>
                                    <td class="Heading1">Total Contract Amount</td>
                                    <td class="HeadVal1"><?php echo $TotalRate; ?></td>

                                </tr>
                                <tr>
                                    <td class="Heading1">Total Diesel Cost</td>
                                    <td class="HeadVal1"><?php echo $dieseldata; ?></td>

                                </tr>
                                <tr>
                                    <td class="Heading1">Average %</td>
                                    <td class="HeadVal1"><?php echo number_format(($dieseldatain), 2); ?>%</td>

                                </tr>

                            </table>
                        </div>

                        <div class="card-body">



                            <div class="table-responsive">



                                <table class="table table-striped table-hover datatable table-bordered">



                                    <thead class="thead-light">



                                        <tr>



                                            <th>Transporter</th>



                                            <th>Name</th>



                                            <th>Ship to Party code</th>



                                            <th>Ship to Party name</th>



                                            <th>Ship to Party Lcn</th>



                                            <th>Billing Doc</th>



                                            <th>Lr No</th>



                                            <th>Bill Date</th>



                                            <th>Vehicle name</th>



                                            <th>Km </th>



                                            <th>Contract Amt</th>



                                            <th>Fuel Avg</th>



                                            <th>Diesel Cost</th>



                                            <th>% Cost</th>



                                        </tr>



                                    </thead>



                                    <tbody>

                                        <?php //print_r($getSales); 

                                        $i = 1;

                                        $income = 0;

                                        foreach ($getdieselCost as $dieselCost) {

                                        ?>

                                                <tr>

                                                <td>

                                                    <?php echo $dieselCost['VENDOR']; ?></td>

                                                <td>

                                                    <?php echo $dieselCost['TRANS_NAME']; ?></td>


                                                <td>

                                                    <?php echo $dieselCost['SHIP_TO_PARTY']; ?></td>


                                                <td>

                                                    <?php echo $dieselCost['NAME_SHIP_PARTY']; ?></td>


                                                <td>

                                                    <?php echo $dieselCost['LCN_SHIP_PARTY']; ?></td>

                                                <td>

                                                    <?php echo $dieselCost['BILLING_DOC']; ?></td>


                                                <td>

                                                    <?php echo $dieselCost['LR_NO']; ?></td>

                                                <td>

                                                    <?php echo $dieselCost['BILL_DT']; ?></td>

                                                <td>

                                                    <?php echo $dieselCost['VEH_NAME']; ?></td>

                                                <td>

                                                    <?php echo $dieselCost['kilometer']; ?></td>

                                                <td>

                                                    <?php echo $dieselCost['Rate']; ?></td>

                                                <td>

                                                    <?php echo $dieselCost['VEHICLE_AVERAGE']; ?></td>

                                                <td>

                                                    <?php echo $dieseldata= ($dieselCost['kilometer']/$dieselCost['VEHICLE_AVERAGE']) * $dieselCost['Dieselrate']; ?></td>

                                                <td>

                                                    <?php echo number_format((($dieseldata/$dieselCost['Rate'])*100), 2)."%"; ?></td>

                        
                                            </tr>

                                        <?php $i++;
                                        } ?>



                                    </tbody>



                                </table>



                            </div>



                        </div>



                    </div>

                </div>


                <div id="dieselWithFreight" class="<?php echo ($report != 'dieselWithFreight')? 'd-none' : '' ?> reports">

                    <div class="card card-table">

                    <?php
        $TotalRate = 0;
        $TotalFREIGHT_T = 0;
        if(!empty($getdieselCostwithfreight)){

            

            foreach($getdieselCostwithfreight as $dieselCostwith){

                

                if (is_numeric(str_replace(',', '', $dieselCostwith['Rate']))) {

                    $TotalRate += (str_replace(',', '', $dieselCostwith['Rate']));

                }

                else {

                    $TotalRate += 0;

                }

                $dieseldata= ($dieselCostwith['kilometer']/$dieselCostwith['VEHICLE_AVERAGE']) * $dieselCostwith['Dieselrate'];

                $dieseldatain = ($dieseldata/$TotalRate)*100;

                if (is_numeric($dieselCostwith['FREIGHT_T'])) {

                    $TotalFREIGHT_T += ($dieselCostwith['FREIGHT_T']);

                }

                else {

                    $TotalFREIGHT_T += 0;

                }

                
                    

            } }

        ?>
                        <div class="NewHorizontalTable">
                            <table>
                                <tr>
                                    <td class="Heading1">Total Contract Amount</td>
                                    <td class="HeadVal1"><?php echo $TotalRate; ?></td>

                                </tr>
                                <tr>
                                    <td class="Heading1">Total Diesel Cost</td>
                                    <td class="HeadVal1"><?php echo $dieseldata; ?></td>

                                </tr>
                                <tr>
                                    <td class="Heading1">Average %</td>
                                    <td class="HeadVal1"><?php echo number_format(($dieseldatain), 2); ?>%</td>

                                </tr>
                                <tr>
                                    <td class="Heading1">Freight Total</td>
                                    <td class="HeadVal1"><?php echo $TotalFREIGHT_T; ?></td>

                                </tr>


                            </table>
                        </div>

                        <div class="card-body">



                            <div class="table-responsive">



                                <table class="table table-striped table-hover datatable table-bordered">



                                    <thead class="thead-light">



                                        <tr>



                                            <th>Transporter</th>



                                            <th>Name</th>



                                            <th>Ship to Party code</th>



                                            <th>Ship to Party name</th>



                                            <th>Ship to Party Lcn</th>



                                            <th>Billing Doc</th>



                                            <th>Lr No</th>



                                            <th>Bill Date</th>



                                            <th>Vehicle name</th>



                                            <th>Km </th>



                                            <th>Contract Amt</th>



                                            <th>Fuel Avg</th>



                                            <th>Diesel Cost</th>



                                            <th>% Cost</th>



                                            <th>Freight Total</th>



                                            <th>Total Bill Quantity</th>

                                            <th>Box Quantity</th>



                                        </tr>



                                    </thead>



                                    <tbody>

                                        <?php //print_r($getdieselCostwithfreight); 

                                        $i = 1;

                                        $income = 0;

                                        foreach ($getdieselCostwithfreight as $dieselCostwithfreight) {

                                        ?>

                                        <tr>

                                            <td>

                                                <?php echo $dieselCostwithfreight['VENDOR']; ?></td>

                                            <td>

                                                <?php echo $dieselCostwithfreight['TRANS_NAME']; ?></td>


                                            <td>

                                                <?php echo $dieselCostwithfreight['SHIP_TO_PARTY']; ?></td>


                                            <td>

                                                <?php echo $dieselCostwithfreight['NAME_SHIP_PARTY']; ?></td>


                                            <td>

                                                <?php echo $dieselCostwithfreight['LCN_SHIP_PARTY']; ?></td>

                                            <td>

                                                <?php echo $dieselCostwithfreight['BILLING_DOC']; ?></td>


                                            <td>

                                                <?php echo $dieselCostwithfreight['LR_NO']; ?></td>

                                            <td>

                                                <?php echo $dieselCostwithfreight['BILL_DT']; ?></td>

                                            <td>

                                                <?php echo $dieselCostwithfreight['VEH_NAME']; ?></td>

                                            <td>

                                                <?php echo $dieselCostwithfreight['kilometer']; ?></td>

                                            <td>

                                                <?php echo $dieselCostwithfreight['Rate']; ?></td>

                                            <td>

                                                <?php echo $dieselCostwithfreight['VEHICLE_AVERAGE']; ?></td>

                                            <td>

                                                <?php echo $dieseldata= ($dieselCostwithfreight['kilometer']/$dieselCostwithfreight['VEHICLE_AVERAGE']) * $dieselCostwithfreight['Dieselrate']; ?></td>

                                            <td>

                                                <?php echo number_format((($dieseldata/$dieselCostwithfreight['Rate'])*100), 2)."%"; ?></td>

                                            <td>

                                            <?php echo $dieselCostwithfreight['FRT_AFT_ST']; ?></td>
                                           
                                            <td>

                                            <?php echo $dieselCostwithfreight['BILL_QTY_T']; ?></td>

                                            <td>

                                            <?php echo $dieselCostwithfreight['BOX_QTY_T']; ?></td>




                                        </tr>

                                        <?php $i++;
                                        } ?>



                                    </tbody>



                                </table>



                            </div>



                        </div>



                    </div>

                </div>


                <div id="vehicleUtilization" class="<?php echo ($report != 'vehicleUtilization')? 'd-none' : '' ?> reports">

                    <h4 class="text-info">Total Empty Loss Amount: <?php echo $income; ?></h4>

                    <div class="card card-table">



                        <div class="card-body">



                            <div class="table-responsive">



                                <table class="table table-hover datatable table-bordered">



                                    <thead class="thead-light">



                                        <tr>



                                            <th>Trnsporter</th>



                                            <th>Ship-to party</th>



                                            <th>Name of the ship-to party</th>



                                            <th>Location of the ship-to party</th>



                                            <th>Billing Document</th>



                                            <th>Billing Date</th>



                                            <th>Reference</th>



                                            <th>Lr. No.</th>



                                            <th>Loadability</th>



                                            <th>Actual loaded</th>



                                            <th>Empty space cost in INR</th>



                                            <th>Empty Loss reasons</th>



                                        </tr>



                                    </thead>



                                    <tbody>

                                    <?php //print_r($getSales); 

                                    $i = 1;

                                    if(!empty($getvehicleutil)){

                                    foreach ($getvehicleutil as $sales) {

                                    ?>

                                        <tr>

                                            <td>

                                                <?php echo $sales['TRANS_NAME']; ?>
                                            </td>



                                            <td>

                                                <?php echo $sales['SHIP_TO_PARTY']; ?>
                                            </td>

                                            <td>

                                                <?php echo $sales['NAME_SHIP_PARTY']; ?>
                                            </td>



                                            <td>

                                                <?php echo $sales['LCN_SHIP_PARTY']; ?>
                                            </td>



                                            <td>

                                                <?php echo $sales['BILLING_DOC']; ?>
                                            </td>

                                            <td>

                                                <?php echo $sales['BILL_DT']; ?>
                                            </td>

                                            <td>

                                                <?php echo $sales['REF_NO']; ?>
                                            </td>

                                            <td>

                                                <?php echo $sales['LR_NO']; ?>
                                            </td>

                                            <td>
                                                <?php echo $sales['VEHICLE_LOAD_ABILITY']; ?>
                                            </td>

                                            <td>

                                                <?php echo $sales['ACT_LOAD']; ?>
                                            </td>

                                            <td>

                                                <?php echo ($sales['VEHICLE_LOAD_ABILITY'] == $sales['ACT_LOAD'])? 0 :  $sales['Rate']/$sales['VEHICLE_LOAD_ABILITY'] * $sales['ACT_LOAD']; ?>
                                            </td>

                                            <td style="<?php echo ($sales['EMP_LS_RSN'] == '')? 'background-color: #d83439;' : ''; ?>">

                                                <?php echo $sales['EMP_LS_RSN']; ?>
                                            </td>



                                        </tr>

                                    <?php $i++;
                                    } } ?>



                                </tbody>



                                </table>



                            </div>



                        </div>



                    </div>

                </div>


                <div id="freight" class="<?php echo ($report != 'freight')? 'd-none' : '' ?> reports">

                    <div class="card card-table">
                    <?php
        $TotalFREIGHT = 0;
        $TotalFREIGHT_T = 0;
        if(!empty($getfreight)){

            

            foreach($getfreight as $freight){

                if (is_numeric(str_replace(',', '', $freight['FRT_AFT_ST']))) {

                    $TotalFREIGHT += (str_replace(',', '', $freight['FRT_AFT_ST']));

                }

                else {

                    $TotalFREIGHT += 0;

                }

                if (is_numeric($freight['FREIGHT_T'])) {

                    $TotalFREIGHT_T += ($freight['FREIGHT_T']);

                }

                else {

                    $TotalFREIGHT_T += 0;

                }

                
                    

            } }

        ?>
    <div class="NewHorizontalTable">
        <table>
            <tr>
                <td class="Heading1">Freight</td>
                <td class="HeadVal1"><?php echo $TotalFREIGHT; ?></td>
                <td class="Heading1">Freight Total</td>
                <td class="HeadVal1"><?php echo $TotalFREIGHT_T; ?></td>

            </tr>
        </table>
    </div>

                        <div class="card-body">



                            <div class="table-responsive">



                                <table class="table table-striped table-hover datatable table-bordered">



                                    <thead class="thead-light">



                                        <tr>



                                            <th>Cust Name</th>



                                            <th>Code</th>



                                            <th>Billing Doc</th>



                                            <th>Billing Date</th>



                                            <th>Mat No.</th>



                                            <th>Hie No.</th>



                                            <th>Incoterms</th>



                                            <th>Total Bill Qty</th>



                                            <th>Box Qty</th>



                                            <th>Lr No. </th>



                                            <th>Freight</th>



                                            <th>Freight Total</th>



                                        </tr>



                                    </thead>



                                    <tbody>

                    <?php //print_r($getSales); 

                    $i = 1;
                    if(!empty($getfreight)){

                    foreach ($getfreight as $sales) {

                    ?>

                        <tr>

                            <td>

                                <?php echo $sales['NAME_SHIP_PARTY']; ?>
                            </td>



                            <td>

                                <?php echo $sales['VENDOR']; ?>
                            </td>

                            <td>

                                <?php echo $sales['BILLING_DOC']; ?>
                            </td>



                            <td>

                                <?php echo $sales['BILL_DT']; ?>
                            </td>



                            <td>

                                <?php echo $sales['MAT_NO']; ?>
                            </td>

                            <td>

                                <?php echo $sales['HIE_NO']; ?>
                            </td>

                            <td>

                                <?php echo $sales['INCOTERMS']; ?>
                            </td>

                            <td>

                                <?php echo $sales['BILL_QTY_T']; ?>
                            </td>

                            <td>

                                <?php echo $sales['BOX_QTY_T']; ?>
                            </td>

                            <td>

                                <?php echo $sales['LR_NO']; ?>
                            </td>

                            <td>

                                <?php echo $sales['FRT_AFT_ST']; ?>
                            </td>


                            <td>

                                <?php echo $sales['FREIGHT_T']; ?>
                            </td>

    
                        </tr>

                    <?php $i++;
                    } } ?>



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

</script>



</body>







</html>