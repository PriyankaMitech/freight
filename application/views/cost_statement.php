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

        .highlight1 { background-color: #00bfff !important; }
    </style>
    
</head>

<?php $this->load->view('partials/body') ?>

    <div class="main-wrapper">

    <?php $this->load->view('partials/menu') ?>

        <!-- Page Wrapper -->

        <div class="page-wrapper">


            <div class="content container-fluid">
            <form action="<?php echo base_url(); ?>?/cost_statement" method="post" >     

                <div class="row align-items-center form-group ">
                    <div class="col-md-3">
                    <select class="form-select transport-select" id="selectTransport" name="trans_name">
                        <option>Select Transport</option>
                        <?php 
                            if(!empty($getTRANS_NAME)){
                               
                                foreach($getTRANS_NAME as $TRANS){ ?>
                                    <option value="<?php echo $TRANS->TRANS_NAME1; ?>" <?php if ($trans_name == $TRANS->TRANS_NAME1) echo "selected"; ?>><?php echo $TRANS->TRANS_NAME1; ?></option>
                                <?php  } } ?>
                        
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
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </form>

                <div class="row">
                    <div class="col-md-3">
                        <div class="col-sm-12">

                            <div class="card card-table"> 

                                <div class="card-body">

                                    <div class="table-scroll">
                                    <table id="data" class="table table-hover table-bordered">


                                    <!-- <table id="data" class="table table-hover datatable table-bordered"> -->
                                            <thead class="thead-light">

                                                <tr>

                                                <th>SAP Billing Date </th>

                                                <th>Status</th>                       

                                                <th class="text-end">LR NO</th>

                                                </tr>

                                            </thead>

                                            <tbody>
                                                <?php //print_r($getData); 
                                                if(!empty($getData)){
                                                    $i=1;
                                                    foreach($getData as $getd){
                                                ?>
                                                <tr class="sap_id" data-id="<?php echo $i ?>" data-sapid="<?php echo $getd['LR_NO']; ?>" data-lr="<?php echo $getd['LR_NO']; ?>" data-STATUS="<?php echo $getd['STATUS']; ?>">
                                                    <td><?php echo date('d-m-Y', strtotime($getd['BILL_DT'])); ?></td>

                                                    <td><?php echo $getd['STATUS']; ?></td>

                                                    <td class="text-end"><?php echo $getd['LR_NO']; ?></td>

                                                </tr>
                                                <?php $i++; } } ?>

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
                                                    <td class="col-md-6" colspan="2">Transporter Name : <span id="transport_name"></span></td>
                                                    <td class="col-md-6" colspan="2">Transporter Code : <span id="transport_code"></span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Customer : <span id="customer_name"></span></td>
                                                    <td>Box Quantity: <span id="box_qty"></span> </td>
                                                    <td>Destination: <span id="destination"></span></td>
                                                </tr>
                                                <tr>
                                                    <td>Vehicle Type : <span id="vehicle_type"></span></td>
                                                    <td>Vehicle No : <span id="vehicle_no"></span></td>
                                                    <td>Loadability : <span id="loadability"></span></td>
                                                    <td>LR No : <span class="lr_no"></span></td>
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

                                    <form method="post" id="formSubmit" action="<?php echo base_url(); ?>?/cost_statement" onsubmit="return confirm('Click OK to continue?')">

                                    <input type="hidden" name="start_date" id="" value="<?php echo $start_date; ?>">
                                    <input type="hidden" name="end_date" id="" value="<?php echo $end_date; ?>">
                                    <input type="hidden" name="trans_name" id="" value="<?php echo $trans_name; ?>">
                                    <input type="hidden" name="transport_code1" id="transport_code1" value="">
                                        <input type="hidden" name="trans_name1" id="trans_name1" value="">

                                        <table class="mytable table table-hover datatable table-bordered">
                                            <thead>
                                                <th>Reference</th>
                                                <th>Material No.</th>
                                                <th>Material Desc.</th>
                                                <th colspan="2">Hierarchy</th>
                                                <th>Billed Qty.</th>
                                                <th>No.Boxes</th>
                                                <th>Freight</th>
                                                <th>Other Charges</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    
                                                    <td><span id="Reference"></span></td>
                                                    <td><span id="MAT_NO"></span></td>
                                                    <td><span id="MAT_DESC"></span></td>
                                                    <td colspan="2"><span id="HIE_DESC"></span></td>
                                                    <td><span id="BILL_QTY"></span></td>
                                                    <td><span id="BOX_QTY"></span></td>
                                                    <td><span id="FREIGHT"></span></td>
                                                    <td><span id="FREIGHT"></span></td>
                                                </tr>
                                                <tr style="background-color: #d7f1ee;" class="removedata">
                                                    <input type="hidden" name="LR_NO" id="savelr_no" class="savelr_no">
                                                    <input type="hidden" name="save_status" id="save_status">
                                                    <td colspan="2">Empty Loss :</td>
                                                    <td colspan="5"><input type="text" name="EMP_LS" class="EMP_LS"> </td>
                                                    <!-- <td></td>
                                                    <td></td>
                                                    <td></td> -->
                                                   <td> Contract Freight : </td>
                                                    <td><input type="text" name="total" class="total"></td>
                                                </tr>
                                                <tr style="background-color: #d7f1ee;">
                                                    <td colspan="2">Empty Loss Reason :</td>
                                                    <td colspan="4"><select class="form-select" name="EMP_LS_RSN" id="EMP_LS_RSN" style="width:160px;" onchange='OtherLoss(this.value);' required>
                                                        <option value="">Enter Reason!!</option>
                                                        <option value="No EmptyLoss">No EmptyLoss</option>
                                                        <option value="No production">No production</option>
                                                        <option value="Steal Tampered or Broken">Steal Tampered or Broken</option>
                                                        <option value="Short Order Qty">Short Order Qty</option>
                                                        <option value="Small size vehicle">Small size vehicle</option>
                                                        <option value="Heavy Material">Heavy Material</option>
                                                        <option value="otherLoss">Other</option>
                                                    </select>
                                                </td>
                                                    <td>
                                                    <input type="text" name="otherLoss" id="otherLoss" style='display:none;'/></td>
                                                    <!-- <td></td> -->
                                                    <td>Other Charges:</td>
                                                    <td><input type="text" name="OTHCHRGS" class="OTHCHRGS" value="0" ></td>
                                                </tr>
                                                <tr style="background-color: #d7f1ee;">
                                                    <td colspan="2">Penalty :</td>
                                                    <td colspan="5"><input type="text" name="PENALTY" class="PENALTY" > </td>
                                                    <!-- <td></td>
                                                    <td></td> -->
                                                    <td>Detention:</td>
                                                    <td><input type="text" name="DETENTION" class="DETENTION"></td>
                                                </tr>
                                                <tr style="background-color: #d7f1ee;">
                                                    <td colspan="2">Penalty Note :</td>
                                                    <td colspan="4"><select class="form-select" name="PENALTY_RS" style="width:160px;" onchange='OtherPenalty(this.value);' required>
                                                        <option>Updated By:14308</option>
                                                        <option>No Penalty</option>
                                                        <option>Late Delivery</option>
                                                        <option>Transhipment</option>
                                                        <option>Change of vehicle without permission</option>
                                                        <option>Noncompliance vehicle checklist</option>
                                                        <option>Detected for alcohol</option>
                                                        <option>Loss of Documents</option>
                                                        <option>Misbehavior at customer premises</option>
                                                        <option value="otherPenalty">Other</option>
                                                    </select></td>
                                                    <td>
                                                    <input type="text" name="otherPenalty" id="otherPenalty" style='display:none;'/></td>
                                                    <td>Detention Note:</td>
                                                    <td><select class="form-select" name="DETENTION_RS" style="width:160px;" onchange='OtherDetention(this.value)' required>
                                                        <option>Updated By:14308</option>
                                                        <option>No Detention</option>
                                                        <option>No space</option>
                                                        <option>No call up</option>
                                                        <option>Audit</option>
                                                        <option>Wrong order</option>
                                                        <option>Wrong loading</option>
                                                        <option value="otherDetention">Other</option>
                                                    </select>
                                                    <input type="text" name="otherDetention " id="otherDetention" style='display: none;margin-top: 10px;'/>
                                                    </td>
                                                </tr>
                                                <tr style="background-color: #d7f1ee;">
                                                    <td colspan="2">Bill No :</td>
                                                    <td colspan="5"><input type="text" name="BILLING_DOC" class="BILLING_DOC"> </td>
                                                    <td>Total Freight Charges :</td>
                                                    <td><input type="text" name="bill_charge" class="bill_charge" value="0"></td>
                                                </tr>
                                                <tr style="background-color: #d7f1ee;">
                                                    <td colspan="8"></td>
                                                    <td><button type="submit" name="submit" value="submit" class="btn knockoff btn-success">Knock Off</button></td>
                                                </tr>

                                            </tbody>

                                        </table>
                                    </form>

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

<script>
      $('.OTHCHRGS').on('change', function() {
        // Call the calc_total function when 'OTHCHRGS' changes
        calc_total();
    });
    function calc_total(){
        var sum = 0;calc_total
        $(".other_charge").each(function(){
            sum += parseFloat($(this).val());
            // console.log('sum:', sum);
            $.ajax({
                url: "<?= base_url() ?>?/Transport/save_temp_trans",
                method: "POST",
                data: {
                LR_NO: $('.savelr_no').val(),
                VENDOR: $('#transport_code1').val(),
                TRANS_NAME: $('#trans_name1').val(),
                total: $('.total').val(),
                DETENTION: $('.DETENTION').val(),
                PENALTY: $('.PENALTY').val(),
                bill_charge: sum + parseInt($('.total').val()) + parseInt($('.DETENTION').val()),
                OTHCHRGS: sum,
                SUBOTHCHRGS: $(this).val(),
                tid: $(this).attr("data-id")
                },
                success: function(data) {

                }
             });
        });
        $('.OTHCHRGS').val(sum);
        var bill_charge = sum + parseInt($('.total').val()) + parseInt($('.DETENTION').val());
            $('.bill_charge').val(bill_charge);

            

    }
    $(function() {
        //    $(".knockoff").click(function(){
        //       if (confirm("Click OK to continue?")){
        //          $('form#formSubmit').submit();
        //       }
        //    });
    });

    $('.sap_id').click(function() {
      $('.OTHCHRGS').val(0);
      var single_c = 0;
 
        $(".mytable > tbody ").find("tr:not(:nth-last-child(7),:nth-last-child(6),:nth-last-child(5),:nth-last-child(4),:nth-last-child(3),:nth-last-child(2),:nth-last-child(1))").remove();
        var Id = $(this).attr('data-sapid');
        var STATUS = $(this).attr('data-STATUS');
        var selected = $(this).hasClass("highlight1");
        $("#data tr").removeClass("highlight1");
        $('.total').val(0);
        if(!selected)
            $(this).addClass("highlight1");
        
        $.ajax({
        url: "<?= base_url() ?>?/Home/getSAPwithid",
        method: "POST",
        data: {
          Id: Id,
          STATUS: STATUS
        },
        success: function(data) {

            var opt = $.parseJSON(data);
            

            table = $('.mytable');
                //table.find("tr:gt(0)").remove();
                $(".mytable > tbody tr:first-child").remove();

                var j = 1;
                var total = 0;
                var total_box = 0;
                var total_box_frt = 0;
                var EMP_LS = 0;
                var PENALTY = 0;
                var DETENTION = 0;
               
                 json = $.parseJSON(data);

                 $.each(opt, function(i, d) {
                    total_box_frt=parseInt(total_box_frt) + parseInt(d.BOX_QTY);
                });
                  //alert(opt.length);
                  var len = opt.length - 1;
                  $.each(opt, function(i, d) {
                    
                    var frt=0;

                    var subother=0;
                    var subother1 = 0; // Declare subother1 outside the event handler to make it accessible in the entire scope
                    if(d.SUBOTHCHRGS != null){
                        subother= d.SUBOTHCHRGS;
                $('.OTHCHRGS').on('keyup', function() {
                    var othercharges = $(this).val();
                    var box_qty = $('#box_qty').text();
                    var single_c = othercharges / box_qty;
                    subother1 = d.BOX_QTY * single_c;

                    // Set subother to the value of subother1 for the currently processed row
                    subother = parseFloat(subother1).toFixed(2);

                    $('.other_charge[data-id="' + d.TID + '"]').val(subother);

                });
             
                     
                  
                    }

                console.log('Input value changed1:', subother1);

        
                    d.MAT_DESC = (d.MAT_DESC).replace('<', ' ');
                    frt = Math.round((parseInt(json[0].grand_total)/total_box_frt) * d.BOX_QTY);
                    // alert(frt);
                    $(".mytable > tbody tr:first").before("<tr><td><input type='hidden' name='TID[]' id='TID' value='" + d.TID + "'><input type='hidden' name='HIE_DESC[]' id='HIE_DESC' value='" + d.HIE_DESC + "'><input type='hidden' name='REF_NO[]' id='REF_NO' value='" + d.REF_NO + "'>" + d.REF_NO + "</td><td><input type='hidden' name='MAT_NO[]' id='MAT_NO' value='" + d.MAT_NO + "'>" + d.MAT_NO + "</td><td>" + d.MAT_DESC + "</td><td colspan='2'>" + d.HIE_DESC + "</td><td>" + d.BILL_QTY + "</td><td>" + d.BOX_QTY + "</td><td><input type='hidden' name='frt[]' id='frt' value='" + frt + "'>" + frt + "<input type='hidden' name='MAT_DESC[]' id='MAT_DESC' value='" + d.MAT_DESC + "'></td><td><input type='text' name='other_charge' id='other_charge' class='other_charge' data-id='"+ d.TID +"'  value='"+ subother +"'></td></tr>");
                    j=j+1;
                    var FRT_AFT_ST = d.TOTAL_VAL;
                    

                    var emp_s = d.EMP_LS;
                    
                    total=parseInt(total) + Math.round((parseInt(json[0].grand_total)/total_box_frt) * d.BOX_QTY);
                    total_box=parseInt(total_box) + parseInt(d.BOX_QTY);

                    if(d.PENALTY == null)
                    {
                        d.PENALTY=0;
                    }
                    if(d.DETENTION == null)
                    {
                        d.DETENTION=0;
                    }
                    PENALTY=parseInt(PENALTY) + parseInt(d.PENALTY);
                    DETENTION=parseInt(DETENTION) + parseInt(d.DETENTION);
                    
                  });

                
                  total=json[0].grand_total;
           
            if(json[0].loadability == total_box){
            	EMP_LS=0;
            	
            }
            else
            {
            	EMP_LS=Math.round(((total)/json[0].loadability) * (json[0].loadability-total_box));
            }

            var OTHCHRGS=0;
            // alert(json[0].OTHCHRGS);
            if(json[0].OTHCHRGS != null){
                 OTHCHRGS = json[len].OTHCHRGS;
            }
            
            
            $('#transport_name').html(json[0].TRANS_NAME);
            $('#transport_code').html(json[0].VENDOR);
            $('#trans_name1').val(json[0].TRANS_NAME);
            $('#transport_code1').val(json[0].VENDOR);
            $('#customer_name').html(json[0].NAME_SHIP_PARTY);
            $('#box_qty').html(total_box);
            $('#destination').html(json[0].LCN_SHIP_PARTY);
            $('.lr_no').html(json[0].LR_NOT);
            $('#savelr_no').val(json[0].LR_NOT);
            $('#save_status').val(STATUS);
            $('#loadability').html((json[0].loadability));
            $('#vehicle_no').html(json[0].VEH_NO);
            $('#vehicle_type').html(json[0].VEH_NAME);
            //$('.BILLING_DOC').val(json[0].BILLING_DOC);
            $('.total').val(total);
            $('.EMP_LS').val(EMP_LS);
            $('.DETENTION').val(DETENTION);
            $('.OTHCHRGS').val(OTHCHRGS);
            
            $('.PENALTY').val(PENALTY);
            var bill_charge = parseInt($('.OTHCHRGS').val()) + parseInt(total) + parseInt(DETENTION);
            $('.bill_charge').val(bill_charge);
          
        }
      });
    //   calc_total()
    });

    

    $(".OTHCHRGS").on('keyup', function() {
      
      var bill_charge = parseInt($(this).val()) + parseInt($('.total').val()) + parseInt($('.DETENTION').val());
    //   console.log(bill_charge);
      $('.bill_charge').val(bill_charge);

      $.ajax({
        url: "<?= base_url() ?>?/Transport/save_temp_trans",
        method: "POST",
        data: {
          LR_NO: $('.savelr_no').val(),
          VENDOR: $('#transport_code1').val(),
          TRANS_NAME: $('#trans_name1').val(),
          total: $('.total').val(),
          DETENTION: $('.DETENTION').val(),
          PENALTY: $('.PENALTY').val(),
          bill_charge: $('.bill_charge').val(),
          OTHCHRGS: $(this).val()
        },
        success: function(data) {
            

          
        }
      });

    });

    $('.mytable').on('keyup', 'input.other_charge', function(){
    calc_total();
});

    $(".DETENTION").on('keyup', function() {
      
      var bill_charge = parseInt($(this).val()) + parseInt($('.total').val()) + parseInt($('.OTHCHRGS').val());
      $('.bill_charge').val(bill_charge);

      $.ajax({
        url: "<?= base_url() ?>?/Transport/save_temp_trans",
        method: "POST",
        data: {
          LR_NO: $('.savelr_no').val(),
          VENDOR: $('#transport_code1').val(),
          TRANS_NAME: $('#trans_name1').val(),
          total: $('.total').val(),
          DETENTION: $(this).val(),
          PENALTY: $('.PENALTY').val(),
          bill_charge: $('.bill_charge').val(),
          OTHCHRGS: $('.OTHCHRGS').val()
        },
        success: function(data) {
            

          
        }
      });

    });

//      $(".PENALTY").on('keyup', function() {
      
//       var bill_charge = parseInt($(this).val()) + parseInt($('.total').val()) + parseInt($('.OTHCHRGS').val()) + parseInt($('.DETENTION').val());
//       $('.bill_charge').val(bill_charge);

//       $.ajax({
//         url: "<?= base_url() ?>?/Transport/save_temp_trans",
//         method: "POST",
//         data: {
//           LR_NO: $('.savelr_no').val(),
//           VENDOR: $('#transport_code1').val(),
//           TRANS_NAME: $('#trans_name1').val(),
//           total: $('.total').val(),
//           DETENTION: $('.DETENTION').val(),
//           PENALTY: $(this).val(),
//           bill_charge: $('.bill_charge').val(),
//           OTHCHRGS: $('.OTHCHRGS').val()
//         },
//         success: function(data) {
            

          
//         }
//       });
    

    $(".total").on('keyup', function() {
      
      var bill_charge = parseInt($(this).val()) + parseInt($('.DETENTION').val()) + parseInt($('.OTHCHRGS').val());
      $('.bill_charge').val(bill_charge);
    });


    $(".total").on('keyup', function() {
        //alert($(this).val());
      
      
      $.ajax({
        url: "<?= base_url() ?>?/Transport/save_temp_trans",
        method: "POST",
        data: {
          LR_NO: $('.savelr_no').val(),
          VENDOR: $('#transport_code1').val(),
          TRANS_NAME: $('#trans_name1').val(),
          total: $(this).val(),
          DETENTION: $('.DETENTION').val(),
          PENALTY: $('.PENALTY').val(),
          bill_charge: $('.bill_charge').val(),
          OTHCHRGS: $('.OTHCHRGS').val()
        },
        success: function(data) {
            

          
        }
      });
    });

    function OtherLoss(val){
        if(val =='otherLoss'){
            $('#'+val+'').css('display', 'block');
            $('#otherLoss').focus();
        }else  {
            $('#otherLoss').css('display', 'none');
        }
    }

    function OtherPenalty(val){
        if(val =='otherPenalty'){
            $('#'+val+'').css('display', 'block');
            $('#otherPenalty').focus();
        }else  {
            $('#otherPenalty').css('display', 'none');
        }
    }

    function OtherDetention(val){
        if(val =='otherDetention'){
            $('#'+val+'').css('display', 'block');
            $('#otherDetention').focus();
        }else  {
        console.log('#other')
            $('#otherDetention').css('display', 'none');
        }
    }

</script>



</body>



</html>