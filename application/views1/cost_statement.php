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
        .form-select.transport-select {
            background-color: #286090;
            color: #fff;
            text-align: center;
        }
        .form-select.transport-select:focus {
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

                <div class="row align-items-center form-group ">
                    <div class="col-md-3">
                    <select class="form-select transport-select" name="report">
                        <option>Select Transport</option>
                        <option>Detention report</option>
                        <option>Cost statement</option>
                        <option>Transporter Score Card</option>
                        <option>Customer Score Card</option>
                        <option>Cost v/s Recovery</option>
                        <option>Diesel Cost</option>
                        <option>Diesel Cost with Total Freight</option>
                        <option>Vehicle Utilization</option>
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
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="col-sm-12">

                            <div class="card card-table"> 

                                <div class="card-body">

                                    <div class="table-responsive">

                                        <table class="table table-striped table-hover datatable table-bordered">

                                            <thead class="thead-light">

                                                <tr>

                                                <th>SAP Billing Date </th>

                                                <th>Status</th>                       

                                                <th class="text-end">LR NO</th>

                                                </tr>

                                            </thead>

                                            <tbody>
                                                <?php //print_r($getZone); 
                                                    //foreach($getZone as $zone){
                                                ?>
                                                <tr>
                                                    <td><?php //echo $zone['STATE']; ?></td>

                                                    <td><?php //echo $zone['ZONE']; ?></td>

                                                    <td class="text-end"> </td>

                                                </tr>
                                                <?php //} ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>  
                    <div class="col-md-9">
                        <div class="col-sm-12">

                            <div class="card card-table"> 

                                <div class="card-body">

                                    <div class="table-responsive">

                                        <table class="table table-striped table-hover datatable table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="col-md-6" colspan="2">Transporter Name : AbhiImpact Logistic Solutions P.Ltd</td>
                                                    <td class="col-md-6" colspan="2"> Transporter Code : 14308</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Customer : Global Aqua Pvt. Ltd.</td>
                                                    <td>Box Quantity: 624 </td>
                                                    <td>Destination: Kolkata</td>
                                                </tr>
                                                <tr>
                                                    <td>Vehicle Type : Cont.-32Ft.</td>
                                                    <td>Vehicle No : OD01V6452</td>
                                                    <td>Loadability : 624</td>
                                                    <td>LR No : 2022AB2204294</td>
                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="col-sm-12">

                            <div class="card card-table"> 

                                <div class="card-body">

                                    <div class="table-responsive">

                                        <table class="table table-striped table-hover datatable table-bordered">
                                            <thead>
                                                <th>Reference</th>
                                                <th>Material No.</th>
                                                <th>Material Desc.</th>
                                                <th colspan="2">Hierarchy</th>
                                                <th>Billed Qty.</th>
                                                <th>No.Boxes</th>
                                                <th>Freight</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>IN20221977</td>
                                                    <td>172600547</td>
                                                    <td>Material description</td>
                                                    <td colspan="2">Hierarchy Hierarchy Hierarchy Hierarchy </td>
                                                    <td>3744000</td>
                                                    <td>624</td>
                                                    <td>99400</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Empty Loss :</td>
                                                    <td colspan="2"><input type="text"> </td>
                                                    <td></td>
                                                    <td colspan="2">Total:</td>
                                                    <td><input type="text"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Empty Loss Reason :</td>
                                                    <td><input type="text"> </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="2">Other Charges:</td>
                                                    <td><input type="text"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Penalty :</td>
                                                    <td><input type="text"> </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="2">Detention:</td>
                                                    <td><input type="text"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Penalty Note :</td>
                                                    <td><input type="text"> </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="2">Detention Note:</td>
                                                    <td><input type="text"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Bill No :</td>
                                                    <td><input type="text"> </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="2">Billed Charges:</td>
                                                    <td><input type="text"></td>
                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>

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

<?php $this->load->view('partials/vendor-scripts') ?>



</body>



</html>