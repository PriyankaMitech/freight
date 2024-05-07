<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransportModel extends CI_Model {

    // public function getSales($whereCon) {
    //     $query = $this->db->query(
    //         "SELECT MAX(TR.ID) as ID, MAX(TR.LR_NO) as LR_NO, MAX(SA.NAME_SHIP_PARTY) as NAME_SHIP_PARTY,
    //          MAX(SA.LCN_SHIP_PARTY) as LCN_SHIP_PARTY, MAX(TR.BILL_DT) as BILL_DT, 
    //          MAX(TR.BILL_QTY_T) as BILL_QTY_T, MAX(TR.BOX_QTY_T) as BOX_QTY_T ,
    //          MAX(SA.VEH_NAME) as VEH_NAME, MAX(SA.VEH_NO) as VEH_NO, MAX(SA.COUNTRY_KEY) as COUNTRY_KEY,
    //          MAX(SA.INCOTERMS) as INCOTERMS, MAX(TR.VENDOR) as VENDOR, MAX(TR.TRANS_NAME) as TRANS_NAME, 
    //          MAX(SA.GST_NO_SOLD) as GST_NO_SOLD, MAX(SA.GST_NO_SHIP) as GST_NO_SHIP, MAX(SA.STATE_NM_SOLD) as STATE_NM_SOLD, 
    //          MAX(TR.SALES_ID) as SALES_ID, MAX(TR.REP_DT) as REP_DT, MAX(TR.UNL_DT) as UNL_DT, MAX(C.Rate) as Rate 
    //         FROM TRANSINVOICE TR 
    //         JOIN tbl_sales SA ON TR.SALES_ID = SA.ID AND TR.STATUS = 'N' 
    //         JOIN tbl_contract C ON C.Vehicle_Name = SA.VEH_NAME 
    //         WHERE $whereCon 
    //         GROUP BY TR.LR_NO"
    //     );

    //     if ($query->num_rows() > 0) {
    //         $result = $query->result_array();
    //         return $result;
    //     } else {
    //         return false;
    //     }
    // }
    public function getSales($whereCon) {
        $query = $this->db->query(
            "SELECT 
                MAX(TR.ID) as ID, 
                MAX(TR.LR_NO) as LR_NO, 
                MAX(SA.NAME_SHIP_PARTY) as NAME_SHIP_PARTY,
                MAX(SA.LCN_SHIP_PARTY) as LCN_SHIP_PARTY, 
                MAX(TR.BILL_DT) as BILL_DT, 
                MAX(TR.BILL_QTY_T) as BILL_QTY_T, 
                MAX(TR.BOX_QTY_T) as BOX_QTY_T,
                MAX(SA.VEH_NAME) as VEH_NAME, 
                MAX(SA.VEH_NO) as VEH_NO, 
                MAX(SA.COUNTRY_KEY) as COUNTRY_KEY,
                MAX(SA.INCOTERMS) as INCOTERMS, 
                MAX(TR.VENDOR) as VENDOR, 
                MAX(TR.TRANS_NAME) as TRANS_NAME, 
                MAX(SA.GST_NO_SOLD) as GST_NO_SOLD, 
                MAX(SA.GST_NO_SHIP) as GST_NO_SHIP, 
                MAX(SA.STATE_NM_SOLD) as STATE_NM_SOLD, 
                MAX(TR.SALES_ID) as SALES_ID, 
                MAX(TR.REP_DT) as REP_DT, 
                MAX(TR.UNL_DT) as UNL_DT, 
                IF((TIMESTAMPDIFF(DAY, MAX(TR.REP_DT), MAX(TR.UNL_DT))) > 0, TIMESTAMPDIFF(DAY, MAX(TR.REP_DT), MAX(TR.UNL_DT)), 0) as delaydays, 
                MAX(CA.Rate) as Rate,  -- Added this line for Rate
                MAX(TR.TOTAL_VAL) as TOTAL_VAL
            FROM 
                TRANSINVOICE TR 
            JOIN 
                tbl_sales SA ON TR.SALES_ID = SA.ID AND TR.STATUS = 'N' 
            JOIN 
                tbl_contract CA ON CA.Destination = SA.LCN_SHIP_PARTY AND CA.Vehicle_Name = SA.VEH_NAME  -- Modified this line
            WHERE 
                $whereCon 
            GROUP BY 
                TR.LR_NO"
        );
    
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        } else {
            return false;
        }
    }
    
    
  
    public function save_trans($postData, $id)
    {
        // Retrieve detention amount based on matching VEHICLE_NAME
        $query = $this->db->query("
            SELECT TR.ID, SA.ID as sale_id, TR.BILL_DT, DETENTION, DETN_NOTE, SA.VENDOR, TR.BILL_QTY_T, TR.BOX_QTY_T, SA.VEH_NAME, SA.VEH_NO, SA.COUNTRY_KEY, SA.LCN_SHIP_PARTY, TR.VENDOR, TR.TRANS_NAME, SA.GST_NO_SOLD, SA.GST_NO_SHIP, SA.STATE_NM_SOLD, TR.SALES_ID, TR.REP_DT, TR.UNL_DT, VM.detention_amount
            FROM TRANSINVOICE TR
            JOIN tbl_sales SA ON TR.SALES_ID = SA.ID AND TR.ID = ".$id."
            LEFT JOIN tbl_vehicle_master1 VM ON SA.VEH_NAME = VM.VEHICLE_NAME
        ");
    
        // Initialize variables
        $PENALTY = 0;
        $DETENTION = 0;
        $Transit_Time = 0;
        $detentionAmount = 0;
    
        if ($query->num_rows() > 0) {
            $result = $query->row();
            $date = str_replace('-', '/', $result->BILL_DT);
            $bill = date("Y/m/d", strtotime($date));
            $datetime1 = new DateTime($bill." 07:00");
            $datetime2 = new DateTime($postData['REPORT_DATE'].' '.$postData['REPORT_TIME']);
            $interval = $datetime1->diff($datetime2);
           
            $BILL_DT = ($interval->format('%d'));
            $columndata = $this->db->query("SELECT transit_time FROM tbl_kilometer WHERE destination LIKE '%".$result->LCN_SHIP_PARTY."%'")->row();
            $Transit_Time = $columndata->transit_time;
            $pena = ($BILL_DT - $Transit_Time) * 1500;
            $PENALTY = ($BILL_DT > $Transit_Time) ? $pena : 0 ;
    
            $datetime1 = new DateTime($postData['REPORT_DATE'].' '.$postData['REPORT_TIME']);
            $datetime2 = new DateTime($postData['RELEASE_DATE'].' '.$postData['RELEASE_TIME']);
            $interval = $datetime1->diff($datetime2);
            $DETENTION = ($interval->format('%d'));
            $dete = ($DETENTION) * $result->detention_amount;
            $DETENTION = ($DETENTION >= 1) ? $dete : 0 ;
    
                  // print_r($dete);die;
            $detentionAmount = $result->detention_amount;
        }
    
       

        $query1 = $this->db->query("SELECT * from tbl_sales where ID ='".$result->sale_id."'");

            // echo '<pre>';print_r($this->db->last_query());die;
        
            $result = $query1->row();
            $EMP_LS=0;
            $total_val=0;
            $lrno = $result->LR_NO;


            $query_v = $this->db->query("SELECT VEHICLE_LOAD_ABILITY from tbl_vehicle_master1 where VEHICLE_NAME ='".$result->VEH_NAME."'")->row();

            $VEH_N = $result->VEH_NAME;
            $box_value=$query_v->VEHICLE_LOAD_ABILITY;
           
            $columndata = $this->db->query("SELECT Rate FROM tbl_contract WHERE Destination LIKE '%".$result->LCN_SHIP_PARTY."%' and Vehicle_Name = '".$VEH_N."'")->row();
           
            $columndata_new = str_replace(',', '', $columndata->Rate);
            //$EMP_LS=round(($columndata_new/$box_value) * ($box_value - $result->BOX_QTY));
            //$total_val= ($columndata_new/$box_value) ;

            $file_name = "";
            $config['upload_path']          = "assets/pod/";//file save path
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 100000;


            // $this->load->library('upload', $config);
             $this->load->library('upload');
             $this->upload->initialize($config);

            if ( ! $this->upload->do_upload('pod'))
            {
                    $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
            }

        
            $updateData = array(
                'REP_DT'     => $postData['REPORT_DATE'].' '.$postData['REPORT_TIME'],
                'UNL_DT'     => $postData['RELEASE_DATE'].' '.$postData['RELEASE_TIME'],
                'PENALTY'     => $PENALTY,
                'DETENTION'     => $DETENTION,
                'POD' => $file_name,
                'EMP_LS'     => $EMP_LS,
                'TOTAL_VAL'     => $total_val,
                'LOADABILITY'     => $box_value,
                'STATUS'     => 'Y',
                'UPDATED_BY' => $this->session->userdata('id'),
                'UPDATED_DT' => date("Y-m-d")
            );
    

        $updateData1 = array(
            // 'REP_DT'     => $postData['REPORT_DATE'].' '.$postData['REPORT_TIME'],
            // 'UNL_DT'     => $postData['RELEASE_DATE'].' '.$postData['RELEASE_TIME'],
            'PENALTY'     => '0',
            'DETENTION'     => '0',
            // 'EMP_LS'     => $EMP_LS,
            // 'TOTAL_VAL'     => $total_val,
            // 'LOADABILITY'     => $box_value,
            'STATUS'     => 'Y',
            'UPDATED_BY' => $this->session->userdata('id'),
            'UPDATED_DT' => date("Y-m-d")
        );

        $update = $this->db->where('ID', $id)->update('TRANSINVOICE', $updateData);

        //echo '<pre>';print_r($this->db->last_query());

        $update1 = $this->db->where('LR_NO', $lrno)->where('ID !=', $id)->update('TRANSINVOICE', $updateData1);
        //echo '<pre>';print_r($this->db->last_query());die;
        
        $this->session->set_flashdata('success', 'Record Updated successfully..!');
        return $update;
    }

    public function save_temp_trans($postData)
    {
        // echo "<pre>";
        // print_r($postData);exit();
        $row = $this->db->query("SELECT SUM(BOX_QTY_T) as BOX_QTY_T from TRANSINVOICE where LR_NO ='".$postData['LR_NO']."'")->row(); 
        

        $query = $this->db->query("SELECT * from TRANSINVOICE where LR_NO ='".$postData['LR_NO']."'");

        if($query->num_rows() > 0){
            $result = $query->result_array();

            $totalbox_qty=$row->BOX_QTY_T;
            $count_result=count($result);
            $i=1;

            $othercharges = 0;
            // echo "<pre>"; print_r($postData);exit();
            foreach($result as $key => &$val){
                $freight = ($postData['total'] / $totalbox_qty) * $val['BOX_QTY_T'];
                $FREIGHT_T = ($postData['bill_charge'] / $totalbox_qty) * $val['BOX_QTY_T'];
                $subothercharge = ($postData['SUBOTHCHRGS']) ? $postData['SUBOTHCHRGS'] : 0;

                $othercharges = + $postData['OTHCHRGS'];

                $updateData = array(
                
                    'bill_charge'     => $postData['bill_charge'],
                    'DETENTION'     => $postData['DETENTION'],
                    'PENALTY'     => $postData['PENALTY'],
                    'OTHCHRGS'     => $postData['OTHCHRGS'],
                    // 'SUBOTHCHRGS'     => $subothercharge,
                    'TOTAL_VAL'     => $postData['total'],
                    'FREIGHT_T'     => round($FREIGHT_T),
                    'FREIGHT'     => round($freight),
                    'UPDATED_BY' => $this->session->userdata('id'),
                    'UPDATED_DT' => date("Y-m-d")
                );
                $updateData1 = array(
                
                    'bill_charge'     => $postData['bill_charge'],
                    'DETENTION'     => 0,
                    'PENALTY'     => 0,
                    'OTHCHRGS'     => $postData['OTHCHRGS'],
                //    'SUBOTHCHRGS'     => $subothercharge,
                    'TOTAL_VAL'     => $postData['total'],
                    'FREIGHT_T'     => round($FREIGHT_T),
                    'FREIGHT'     => round($freight),
                    'UPDATED_BY' => $this->session->userdata('id'),
                    'UPDATED_DT' => date("Y-m-d")
                );
                // echo "<pre>";print_r($postData["tid"]);exit();
            
            if($postData["tid"]){
                $update = $this->db->where('ID', $postData['tid'])->update('TRANSINVOICE', array('SUBOTHCHRGS' => $subothercharge, 'OTHCHRGS' => $othercharges));
            }

                if($i==$count_result){
                    $update = $this->db->where('ID', $val['ID'])->update('TRANSINVOICE', $updateData);
                }
                else
                {
                    $update = $this->db->where('ID', $val['ID'])->update('TRANSINVOICE', $updateData1);
                }
                $i++;
                
            }
            // echo '<pre>';print_r($this->db->last_query());
            // echo '<pre>';print_r($updateData);
            
            return true;
        }
        else{
            return false;
        }
       
        
    }

    public function edit_trans($id)
    {
        $this->db->select('REP_DT, UNL_DT');

        $this->db->from('TRANSINVOICE');

        $this->db->where('ID', $id);

        $query = $this->db->get();

        // print_r($this->db->last_query());die;

        if($query->num_rows() > 0){

            //$result = json_encode($query->row());
             $result = $query->row();
             $date1 = $result->REP_DT;
             $date2 = $result->UNL_DT;
             if ($date1 == '' && $date2 == '') {
                $rptdate = '';
                $rpttime = '';
                $unldate = '';
                $unltime = '';
             }else {
                $rptdate = date("Y-m-d", strtotime($date1));
                $rpttime = date("H:i", strtotime($date1));
                $unldate = date("Y-m-d", strtotime($date2));
                $unltime = date("H:i", strtotime($date2));
             }
            // print_r($rptdate);die;
             $splitTimeStamp = array(
                'rptdate' => $rptdate,
                'rpttime' => $rpttime,
                'unldate' => $unldate,
                'unltime' => $unltime
             );
            return json_encode($splitTimeStamp);

        }

        else{

            return false;

        }
    }

    public function save_trans_knowoff($postData)
    {
        if (!empty($postData['TID'])) {
            $i = 1;
            $view = 0;
            for ($d = 0; $d < count($postData['TID']); $d++) {
                $updateDataarr = array(
                    'REF_NO'     => $postData['REF_NO'][$d],
                    'MAT_NO' => $postData['MAT_NO'][$d],
                    'MAT_DESC' => $postData['MAT_DESC'][$d],
                    'HIE_DESC' => $postData['HIE_DESC'][$d],
                    'FREIGHT_T' => $postData['frt'][$d],
                    'bill_charge' => 0,//$postData['bill_charge'],
                    'PENALTY' => 0,//$postData['PENALTY'],
                    'OTHCHRGS' => 0,//$postData['OTHCHRGS'],
                    'DETENTION' => 0,//$postData['DETENTION'],
                    'PENALTY_NOTE' => 0,//$postData['PENALTY_RS'],
                    'DETN_NOTE' => 0,//$postData['DETENTION_RS'],
                    'EMP_LS' => 0,//$postData['EMP_LS'],
                    'EMP_LS_RSN' => 0,//$postData['EMP_LS_RSN'],
                    'BILL_NO' => 0,//$postData['BILLING_DOC'],
                    'TOTAL_VAL' => 0,//$postData['total']
                );
                //echo "<pre>";print_r($updateDataarr);
                $update = $this->db->where('ID', $postData['TID'][$d])->update('TRANSINVOICE', $updateDataarr);

            }
        }

        if (!empty($postData['TID'][0])) {
            $i = 1;
            $view = 0;
            if ($postData['otherLoss'] == '') {
                $EMP_LS_RSN = $postData['EMP_LS_RSN'];
            }else{
                $EMP_LS_RSN = $postData['otherLoss'];
            }

            if ($postData['otherPenalty'] == '') {
                $PENALTY_RS = $postData['PENALTY_RS'];
            }else{
                $PENALTY_RS = $postData['otherPenalty'];
            }

            if ($postData['otherDetention_'] == '') {
                $DETENTION_RS = $postData['DETENTION_RS'];
            }else{
                $DETENTION_RS = $postData['otherDetention_'];
            }

            $updateDataarr = array(
                
                'bill_charge' => $postData['bill_charge'],
                'PENALTY' => $postData['PENALTY'],
                'OTHCHRGS' => $postData['OTHCHRGS'],
                'DETENTION' => $postData['DETENTION'],
                'PENALTY_NOTE' => $PENALTY_RS,
                'DETN_NOTE' => $DETENTION_RS,
                'EMP_LS_RSN' => $EMP_LS_RSN,
                'EMP_LS' => $postData['EMP_LS'],
                'BILL_NO' => $postData['BILLING_DOC'],
                'TOTAL_VAL' => $postData['total']
            );
            //echo "<pre>";print_r($updateDataarr);die;
            $update = $this->db->where('ID', $postData['TID'][0])->update('TRANSINVOICE', $updateDataarr);

            
        }
        //print_r($_POST);die;
        
        $updateData = array(
            'STATUS'     => 'K',
            'UPDATED_BY' => $this->session->userdata('id'),
            'UPDATED_DT' => date("Y-m-d")
        );
        $update = $this->db->where('LR_NO', $postData['LR_NO'])->where('STATUS', $postData['save_status'])->update('TRANSINVOICE', $updateData);
        // print_r($updateData);die;
        $this->session->set_flashdata('success', 'Record Updated successfully..!');
        return $update;
    }
    
    public function transHistory() {
        $TRANS_NAME = $_SESSION['name'];
        $query = $this->db->query(
            "SELECT MAX(TR.ID) as ID,MAX(TR.LR_NO) as LR_NO, MAX(SA.NAME_SHIP_PARTY) as NAME_SHIP_PARTY, MAX(TR.BILL_DT) as BILL_DT, MAX(TR.BILL_QTY_T) as BILL_QTY_T,MAX(TR.BOX_QTY_T) as BOX_QTY_T ,MAX(SA.VEH_NAME) as VEH_NAME, MAX(SA.VEH_NO) as VEH_NO, MAX(SA.COUNTRY_KEY) as COUNTRY_KEY, MAX(SA.INCOTERMS) as INCOTERMS, MAX(TR.VENDOR) as VENDOR, MAX(TR.TRANS_NAME) as TRANS_NAME, MAX(SA.GST_NO_SOLD) as GST_NO_SOLD, MAX(SA.GST_NO_SHIP) as GST_NO_SHIP, MAX(SA.STATE_NM_SOLD) as STATE_NM_SOLD, MAX(TR.SALES_ID) as SALES_ID, MAX(TR.REP_DT) as REP_DT, MAX(TR.UNL_DT) as  UNL_DT  
            from TRANSINVOICE TR join tbl_sales SA ON TR.SALES_ID=SA.ID and TR.STATUS='Y' GROUP BY TR.LR_NO ");

            // echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }
        else{
            return false;
        }
    }

    public function transcred() {
        $query = $this->db->query("SELECT * from tbl_user_details where ROLE_ID ='2'");

            // echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }
        else{
            return false;
        }
    }

    public function TransView($whereCond) {
        //print_r($_SESSION);die;
        

        // $this->db->select('SA.BILL_DT,TR.ID,TR.LR_NO, BILL_NO,TR.STATUS as STATUST,TR.NOTE as NOTE,TR.UPDATED_BY as UPDATED_BY,TR.UPDATED_DT as UPDATED_DT, NAME_SHIP_PARTY, LCN_SHIP_PARTY, BILLING_DOC,TR.REF_NO, SA.NAME_SHIP_PARTY, TR.BILL_DT, DETENTION, DETN_NOTE, SA.VENDOR, TR.BILL_QTY_T ,TR.BOX_QTY_T ,SA.VEH_NAME, SA.VEH_NO, SA.COUNTRY_KEY, SA.INCOTERMS, TR.VENDOR, TR.TRANS_NAME, SA.GST_NO_SOLD, SA.GST_NO_SHIP, SA.STATE_NM_SOLD, TR.SALES_ID, TR.REP_DT, TR.UNL_DT, UA.USER_NAME');
        // $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        // $this->db->join('tbl_user_details UA', 'TR.UPDATED_BY=UA.ID');
        // $this->db->where($whereCond);
        // // $this->db->group_by('TR.LR_NO');
        // $query = $this->db->from('TRANSINVOICE TR')->get();


        $this->db->select('MAX(SA.BILL_DT) as BILL_DT ,MAX(TR.ID)as ID,MAX(TR.LR_NO) as LR_NO, MAX(BILL_NO) as BILL_NO,MAX(TR.STATUS) as STATUST,MAX(TR.NOTE) as NOTE,MAX(TR.UPDATED_BY) as UPDATED_BY,MAX(TR.UPDATED_DT) as UPDATED_DT, MAX(LCN_SHIP_PARTY) as LCN_SHIP_PARTY, MAX(BILLING_DOC) as BILLING_DOC,MAX(TR.REF_NO) as REF_NO, MAX(SA.NAME_SHIP_PARTY) as NAME_SHIP_PARTY, MAX(TR.BILL_DT) as BILL_DT, MAX(DETENTION) as DETENTION, MAX(DETN_NOTE) as DETN_NOTE, MAX(SA.VENDOR) as VENDOR, MAX(TR.BILL_QTY_T) as BILL_QTY_T,MAX(TR.BOX_QTY_T) as BOX_QTY_T ,MAX(SA.VEH_NAME) as VEH_NAME, MAX(SA.VEH_NO) as VEH_NO, MAX(SA.COUNTRY_KEY) as COUNTRY_KEY, MAX(SA.INCOTERMS) as INCOTERMS, MAX(TR.VENDOR) as VENDOR, MAX(TR.TRANS_NAME) as TRANS_NAME, MAX(SA.GST_NO_SOLD) as GST_NO_SOLD, MAX(SA.GST_NO_SHIP) as GST_NO_SHIP, MAX(SA.STATE_NM_SOLD) as STATE_NM_SOLD, MAX(TR.SALES_ID) as SALES_ID, MAX(TR.REP_DT) as REP_DT, MAX(TR.UNL_DT) as UNL_DT,MAX(TR.POD) as POD, MAX(UA.USER_NAME) as USER_NAME');
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        $this->db->join('tbl_user_details UA', 'TR.UPDATED_BY=UA.ID');
        $this->db->where($whereCond);
        $this->db->group_by('TR.LR_NO');
        $query = $this->db->from('TRANSINVOICE TR')->get();

            // echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }
        else{
            return false;
        }
    }
    
    
    public function getDetention() {
        $query = $this->db->query(
            "SELECT TR.ID,TR.LR_NO, BILL_NO, NAME_SHIP_PARTY, LCN_SHIP_PARTY, BILLING_DOC, TR.REF_NO, SA.NAME_SHIP_PARTY, TR.BILL_DT, DETENTION, DETN_NOTE, SA.VENDOR, TR.BILL_QTY_T ,TR.BOX_QTY_T ,SA.VEH_NAME, SA.VEH_NO, SA.COUNTRY_KEY, SA.INCOTERMS, TR.VENDOR, TR.TRANS_NAME, SA.GST_NO_SOLD, SA.GST_NO_SHIP, SA.STATE_NM_SOLD, TR.SALES_ID, TR.REP_DT, TR.UNL_DT  
            from TRANSINVOICE TR join tbl_sales SA ON TR.SALES_ID=SA.ID  ");

            // echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();
            // print_r($result);die;
            return $result;
        }
        else{
            return false;
        }
    }
}