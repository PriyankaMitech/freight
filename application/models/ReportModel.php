<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportModel extends CI_Model {

        
    public function getDetention($whereCond) {
        $this->db->select(" MAX(TR.ID) as ID,MAX(TR.LR_NO) as LR_NO, MAX(TR.BILL_NO) as BILL_NO, MAX(NAME_SHIP_PARTY) as NAME_SHIP_PARTY, MAX(LCN_SHIP_PARTY) as LCN_SHIP_PARTY, MAX(BILLING_DOC) as BILLING_DOC, MAX(SA.REF_NO) as REF_NO, MAX(SA.NAME_SHIP_PARTY) as NAME_SHIP_PARTY, MAX(TR.BILL_DT) as BILL_DT, MAX(DETENTION) as DETENTION, MAX(DETN_NOTE) as DETN_NOTE, MAX(SA.VENDOR) as VENDOR, MAX(TR.BILL_QTY_T) as  BILL_QTY_T,MAX(TR.BOX_QTY_T) as  BOX_QTY_T,MAX(SA.VEH_NAME) as VEH_NAME, MAX(SA.VEH_NO) as VEH_NO, MAX(SA.COUNTRY_KEY) as COUNTRY_KEY, MAX(SA.INCOTERMS) as INCOTERMS, MAX(TR.VENDOR) as VENDOR, MAX(TR.TRANS_NAME) as TRANS_NAME, MAX(SA.GST_NO_SOLD) as GST_NO_SOLD, MAX(SA.GST_NO_SHIP) as GST_NO_SHIP, MAX(SA.STATE_NM_SOLD) as STATE_NM_SOLD, MAX(TR.SALES_ID) as SALES_ID, MAX(TR.REP_DT) as REP_DT, MAX(TR.UNL_DT) as  UNL_DT");
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        $this->db->where($whereCond);
        $this->db->group_by('TR.LR_NO');
        $query = $this->db->from('TRANSINVOICE TR')->get();
        // echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();
            $sort = array();
            foreach($result as $k=>$v) {
                $sort['BILL_DT'][$k] = $v['BILL_DT'];
            }

            array_multisort($sort['BILL_DT'], SORT_ASC, $result);
            return $result;
        }
        else{
            return false;
        }
    }

    public function getCost($whereCond) {
        $this->db->select(" MAX(SA.ID) as ID, MAX(TR.FREIGHT_T) as FREIGHT_T, MAX(SA.FRT_AFT_ST) as FREIGHT,
        MAX(SA.NAME_SHIP_PARTY) as NAME_SHIP_PARTY, MAX(SA.LCN_SHIP_PARTY) as LCN_SHIP_PARTY, MAX(SA.BILLING_DOC) as BILLING_DOC,, MAX(TR.BILL_NO) as BILL_NO, MAX(SA.REF_NO) as REF_NO, MAX(TR.BILL_DT) as BILL_DT, MAX(TR.TOTAL_VAL) as TOTAL_VAL, MAX(SA.SHIP_TO_PARTY) as SHIP_TO_PARTY, MAX(DETN_NOTE) as DETN_NOTE,
        MAX(SA.VENDOR), MAX(TR.BILL_QTY_T), MAX(TR.BOX_QTY_T) as BOX_QTY, MAX(SA.VEH_NAME), MAX(SA.VEH_NO) as VEH_NO,
        MAX(SA.INCOTERMS), MAX(TR.VENDOR) as VENDOR, MAX(TR.TRANS_NAME) as TRANS_NAME,
        MAX(TR.DETENTION) as DETENTION,MAX(TR.STATUS) as STATUS, MAX(TR.OTHCHRGS) as OTHCHRGS,
        MAX(TR.PENALTY) as PENALTY, MAX(TR.LR_NO) as LR_NO,
        IF((TIMESTAMPDIFF(DAY, MAX(TR.REP_DT), MAX(TR.UNL_DT))) > 0, TIMESTAMPDIFF(DAY, MAX(TR.REP_DT), MAX(TR.UNL_DT)), 0) 'delaydays', MAX(CA.Rate) as Rate");
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        $this->db->join('tbl_contract CA', 'CA.Destination=SA.LCN_SHIP_PARTY and CA.Vehicle_Name=SA.VEH_NAME');
        $this->db->where($whereCond);
        $this->db->group_by('TR.LR_NO');
        $query = $this->db->from('TRANSINVOICE TR')->get();
        // echo '<pre>';echo $this->db->last_query();die;
        if($query->num_rows() > 0){
            $result = $query->result_array();
            foreach($result as $key => &$val){
                $this->db->select('TRANSPORTER_TYPE');
                $this->db->where('TRANSPORTER_NAME',$val['TRANS_NAME']);
                $row = $this->db->from('tbl_transporter_new')->get()->row();
                if($row){
                    $val['TRANSPORTER_TYPE'] = $row->TRANSPORTER_TYPE;
                }
                else{
                    
                    $val['TRANSPORTER_TYPE'] = '';
                    
                }
               
                
                
            }	

            foreach($result as $key => &$val){
                // echo "<pre>";print_r($result);exit();
                $this->db->select('SUM(BOX_QTY) as BOX_QTY_T');
                $this->db->where('LR_NO',$val['LR_NO']);

                // $this->db->group_by('LR_NO');
                $row = $this->db->from('tbl_sales')->get()->row();

                // echo "<pre>";print_r($row);exit();
                // echo "<pre>";
                // echo $this->db->last_query();
                if($row){
                    $val['BOX_QTY_T'] = $row->BOX_QTY_T;
                }
                else{
                    $val['BOX_QTY_T'] = 0;
                }
                
            }
            //die;
            $sort = array();
            foreach($result as $k=>$v) {
                $sort['BILL_DT'][$k] = $v['BILL_DT'];
            }

            array_multisort($sort['BILL_DT'], SORT_ASC, $result);
            return $result;
            // echo '<pre>';print_r($result);die;
        }
        else{
            return false;
        }
    }

   
    
    

    public function getTransporter($whereCond) {
        //print_r($_SESSION);die;
        
        $this->db->select(" SA.ID as ID, SUM(CAST( TR.FREIGHT_T as float)) as FREIGHT_T,SUM(SA.FRT_AFT_ST) as FREIGHT, TR.DETENTION, DETN_NOTE ,SA.VENDOR, TR.BILL_QTY_T ,SUM(TR.BOX_QTY_T) ,SA.VEH_NAME, SA.VEH_NO, SA.COUNTRY_KEY, SA.INCOTERMS, TR.VENDOR as VENDOR,TR.TOTAL_VAL as TOTAL_Va, TR.TRANS_NAME as TRANS_NAME, SA.GST_NO_SOLD, SA.GST_NO_SHIP, SA.STATE_NM_SOLD, TR.SALES_ID, TR.REP_DT, TR.UNL_DT, count(DISTINCT SA.LR_NO) as vehiclecount,COUNT(IF(TR.PENALTY > 0,1, NULL)) 'PENALTY',
       COUNT(IF(TR.PENALTY <= 0,1, NULL)) 'NOPENALTY',
        SUM(TR.DETENTION) as DETENTION1,TR.STATUS as STATUS, SUM(TR.OTHCHRGS) as OTHCHRGS1,
        SUM(TR.PENALTY) as PENALTY1,CA.Rate as Rate");
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        $this->db->join('tbl_contract CA', 'CA.Destination=SA.LCN_SHIP_PARTY and CA.Vehicle_Name=SA.VEH_NAME');
        $this->db->where($whereCond);
        $this->db->group_by('TR.TRANS_NAME');
        $query = $this->db->from('TRANSINVOICE TR')->get();

            // echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();
            foreach($result as $k => &$val){
                    $this->db->select('MAX(TR.TOTAL_VAL) as TOTAL_VAL,MAX(TR.STATUS) as STATUS,MAX(CA.Rate) as Rate, MAX(TR.DETENTION) as DETENTION, MAX(TR.PENALTY) as PENALTY, MAX(TR.OTHCHRGS) as OTHCHRGS');
                    $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
                    $this->db->join('tbl_contract CA', 'CA.Destination=SA.LCN_SHIP_PARTY and CA.Vehicle_Name=SA.VEH_NAME');
                    $this->db->where('TR.VENDOR',$val['VENDOR']);
                    $this->db->where($whereCond);
                    $this->db->group_by('TR.LR_NO');
                    $row = $this->db->from('TRANSINVOICE TR')->get()->result_array();
                    // echo "<br>".$this->db->last_query()."<br>".$val['TOTAL_V'];
                    $val['TOTAL_V']=0;
                    $val['TOTAL_Val']=0;
                    $val['TOTAL_bill']=0;
                    $val['DETENTION']=0;
                    $val['OTHCHRGS']=0;
                    foreach($row as $key => $val1){
                       if($val1['STATUS'] != 'K')
                       {
                            $val['TOTAL_V'] += ($val1['TOTAL_VAL']) ? $val1['TOTAL_VAL']+$val1['DETENTION']+$val1['PENALTY']+$val1['OTHCHRGS'] : $val1['Rate']+$val1['PENALTY']+$val1['OTHCHRGS']+$val1['DETENTION'] ;
                       }
                       else
                       {
                            $val['TOTAL_V'] += 0 ;
                            $val['TOTAL_bill']=($val1['TOTAL_VAL']) ? $val1['TOTAL_VAL'] : $val1['Rate'] ;
                       }

                       $val['TOTAL_Val'] += ($val1['TOTAL_VAL']) ? $val1['TOTAL_VAL'] : $val1['Rate'] ;
                       $val['DETENTION'] += ($val1['DETENTION']) ? $val1['DETENTION'] : 0 ;
                       $val['OTHCHRGS'] += ($val1['OTHCHRGS']) ? $val1['OTHCHRGS'] : 0 ;

                    //    if($val['TRANS_NAME']=='AbhiImpact Logistic Solutions P.Ltd'){
                    //     echo ' '.$val['TOTAL_Val'].' '.$val1['DETENTION'].' '.$val1['OTHCHRGS'];
                    //    }
                       
                    
                    }
                    //echo "<br>".$val['TOTAL_V'];
                    
                }
                //die;
             $sort = array();
            foreach($result as $k=>$v) {
                $sort['VENDOR'][$k] = $v['VENDOR'];
            }

            array_multisort($sort['VENDOR'], SORT_DESC, $result);
            //die;
            return $result;
        }
        else{
            return false;
        }
    }

    public function getCustomer($whereCond) {
        
        $this->db->select(" SA.ID as ID, SUM(TR.FREIGHT_T) as FREIGHT_T,SUM(SA.FRT_AFT_ST) as FREIGHT, SA.NAME_SHIP_PARTY as NAME_SHIP_PARTY, DETENTION as DETENTION, DETN_NOTE,SA.VENDOR as VENDOR, TR.BILL_QTY_T ,SUM(TR.BOX_QTY_T),TR.BILL_DT as BILL_DT ,SA.VEH_NAME, SA.VEH_NO, SA.COUNTRY_KEY, SA.INCOTERMS, TR.VENDOR, TR.TRANS_NAME, SA.GST_NO_SOLD, SA.GST_NO_SHIP, SA.STATE_NM_SOLD, TR.SALES_ID, TR.REP_DT, TR.UNL_DT, count(DISTINCT SA.LR_NO) as vehiclecount,COUNT(IF(TR.PENALTY > 0,1, NULL)) 'PENALTY',
       COUNT(IF(TR.PENALTY <= 0,1, NULL)) 'NOPENALTY', IF((TIMESTAMPDIFF(DAY, TR.REP_DT, TR.UNL_DT)) > 0, TIMESTAMPDIFF (DAY, TR.REP_DT, TR.UNL_DT), 0) 'delaydays'");
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        $this->db->where($whereCond);
        $this->db->group_by('SA.NAME_SHIP_PARTY');
        $query = $this->db->from('TRANSINVOICE TR')->get();

            // echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();
            $sort = array();
            foreach($result as $k=>$v) {
                $sort['BILL_DT'][$k] = $v['BILL_DT'];
            }

            array_multisort($sort['BILL_DT'], SORT_ASC, $result);
            return $result;
        }
        else{
            return false;
        }
    }

    public function getCostvsRecovery($whereCond) {
        $this->db->select(" SA.ID as ID, IF(TR.FREIGHT_T > 0,TR.FREIGHT_T, 0) 'FREIGHT_T', SUM(SA.FRT_AFT_ST) as FRT_AFT_ST,SA.NAME_SHIP_PARTY as NAME_SHIP_PARTY,SA.LCN_SHIP_PARTY as LCN_SHIP_PARTY,SA.BILLING_DOC as BILLING_DOC, SA.REF_NO as REF_NO, TR.BILL_DT as BILL_DT, SA.SHIP_TO_PARTY as SHIP_TO_PARTY, DETN_NOTE, SA.VENDOR, TR.BILL_QTY_T ,SUM(TR.BOX_QTY_T) ,SA.VEH_NAME, SA.VEH_NO, SA.COUNTRY_KEY, SA.INCOTERMS, TR.VENDOR, TR.TRANS_NAME, SA.GST_NO_SOLD, SA.GST_NO_SHIP, SA.STATE_NM_SOLD, TR.SALES_ID, TR.REP_DT, TR.UNL_DT, count(SA.VEH_NAME) as vehiclecount,COUNT(IF(TR.PENALTY > 0,1, NULL)) 'PENALTY',
       COUNT(IF(TR.PENALTY <= 0,1, NULL)) 'NOPENALTY',TR.LR_NO, IF((TIMESTAMPDIFF(DAY, TR.REP_DT, TR.UNL_DT)) > 0, TIMESTAMPDIFF(DAY, TR.REP_DT, TR.UNL_DT), 0) 'delaydays'");
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        $this->db->where($whereCond);
        $this->db->group_by('TR.LR_NO');
        $query = $this->db->from('TRANSINVOICE TR')->get();

            // echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();
            $sort = array();
            foreach($result as $k=>$v) {
                $sort['BILL_DT'][$k] = $v['BILL_DT'];
            }

            array_multisort($sort['BILL_DT'], SORT_ASC, $result);
            return $result;
        }
        else{
            return false;
        }
    }

    public function getdieselCost($whereCond) {
        //print_r($_SESSION);die;
        

        $this->db->select("max(SA.ID) as ID, IF(MAX(TR.FREIGHT_T) > 0,MAX(TR.FREIGHT_T), 0) 'FREIGHT_T',IF(MAX(SA.FRT_AFT_ST) > 0,MAX(SA.FRT_AFT_ST), 0) 'FRT_AFT_ST',SUM(TR.BOX_QTY_T) as BOX_QTY_T,MAX(SA.NAME_SHIP_PARTY) as NAME_SHIP_PARTY,MAX(SA.LCN_SHIP_PARTY) as LCN_SHIP_PARTY,MAX(SA.BILLING_DOC) as BILLING_DOC, MAX(SA.REF_NO), MAX(TR.BILL_DT) as BILL_DT, MAX(TR.BILL_QTY_T) as BILL_QTY_T,  MAX(SA.SHIP_TO_PARTY) as SHIP_TO_PARTY, MAX(SA.VENDOR) as VENDOR,MAX(SA.NAME_SHIP_PARTY), MAX(SA.LCN_SHIP_PARTY), MAX(SA.VEH_NO), MAX(SA.COUNTRY_KEY), MAX(TR.LR_NO) as LR_NO, MAX(SA.VEH_NAME) as VEH_NAME, MAX(SA.INCOTERMS), MAX(TR.TRANS_NAME) as TRANS_NAME, MAX(SA.STATE_NM_SOLD), MAX(CA.Rate) as Rate, MAX(VM.VEHICLE_AVERAGE) as VEHICLE_AVERAGE");
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        //$this->db->join('tbl_kilometer KT', 'KT.destination=SA.LCN_SHIP_PARTY');
        $this->db->join('tbl_vehicle_master1 VM', 'VM.VEHICLE_NAME=SA.VEH_NAME');
        $this->db->join('tbl_contract CA', 'CA.Destination=SA.LCN_SHIP_PARTY and CA.Vehicle_Name=SA.VEH_NAME');
        $this->db->where($whereCond);
        $this->db->group_by('TR.LR_NO');
        $query = $this->db->from('TRANSINVOICE TR')->get();

            // echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();


            $this->db->select('RATE');
            $this->db->order_by("ID", "desc");
            $row = $this->db->from('tbl_diesel_master')->get()->row();
            if($row){
                foreach($result as $key => &$val){
                    $val['Dieselrate'] = $row->RATE;
                }
                
            }
            else{
                foreach($result as $key => &$val){
                    $val['Dieselrate'] = 0;
                }
            }

            
            foreach($result as $key => &$val){
                $this->db->select('kilometer');
                $this->db->where('destination',$val['LCN_SHIP_PARTY']);
                $row = $this->db->from('tbl_kilometer')->get()->row();
                if($row){
                    $val['kilometer'] = $row->kilometer;
                }
                else{
                
                    $val['kilometer'] = 0;
                
                }
                
            }

            $sort = array();
            foreach($result as $k=>$v) {
                $sort['BILL_DT'][$k] = $v['BILL_DT'];
            }

            array_multisort($sort['BILL_DT'], SORT_ASC, $result);
            
            return $result;
        }
        else{
            return false;
        }
    }

    public function getBudgetvsActual($whereCond1,$whereCond,$month=null) {
        //print_r($_SESSION);die;
        //echo $month;

        $this->db->select("B.ID as ID,SA.NAME_SOLD_PARTY as NAME_SOLD_PARTY,SA.LCN_SOLD_PARTY as LCN_SOLD_PARTY,SA.BILLING_DOC as BILLING_DOC,B.".$month."_QTY as monthval,B.".$month." as monthdata,SA.BILL_QTY as BILL_QTY,B.FRT_PER_C as FRT_PER_C,B.CONS_SIZE as CONS_SIZE, SA.REF_NO as REF_NO, SA.SOLD_TO_PARTY as SOLD_TO_PARTY, SA.VENDOR, SA.VEH_NAME, SA.VEH_NO, SA.COUNTRY_KEY,SA.HIE_NO as HIE_NO, SA.HIE_DESC as HIE_DESC,TR.DETENTION as DETENTION, TR.PENALTY as PENALTY, TR.OTHCHRGS as OTHCHRGS, CA.Rate as Rate, SA.INCOTERMS, SA.GST_NO_SOLD, SA.GST_NO_SHIP, SA.STATE_NM_SOLD");
        $this->db->join('BUDGET B', 'SA.HIE_NO=B.HIE_M_ID');
        $this->db->join('TRANSINVOICE TR', 'TR.SALES_ID=SA.ID');
        $this->db->join('tbl_contract CA', 'CA.Destination=SA.LCN_SHIP_PARTY and CA.Vehicle_Name=SA.VEH_NAME');
        $this->db->where($whereCond1);
        $this->db->where($whereCond);
        $this->db->group_by('B.HIE_M_ID');
        $this->db->group_by('SA.SOLD_TO_PARTY');
        $this->db->order_by('B.HIE_M_ID','asc');
        
        $query = $this->db->from('tbl_sales SA')->get();

        // echo '<pre>';print_r($this->db->last_query());die;
            
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }
        else{
            return false;
        }
    }

    // public function getdieselCostwithfreight($whereCond) {
    //     //print_r($_SESSION);die;
        

    //     $this->db->select(" SA.ID as ID, IF(TR.FREIGHT_T > 0,TR.FREIGHT_T, 0) 'FREIGHT_T',IF(SA.FRT_AFT_ST > 0,SA.FRT_AFT_ST, 0) 'FRT_AFT_ST',SUM(DISTINCT TR.BOX_QTY_T) as BOX_QTY_T,SA.NAME_SHIP_PARTY as NAME_SHIP_PARTY, TR.TOTAL_VAL as TOTAL_VAL,SA.LCN_SHIP_PARTY as LCN_SHIP_PARTY,SA.BILLING_DOC as BILLING_DOC, SA.REF_NO, TR.BILL_DT as BILL_DT, SUM(DISTINCT TR.BILL_QTY_T) as BILL_QTY_T,TR.DETENTION as DETENTION, TR.PENALTY as PENALTY,TR.OTHCHRGS as OTHCHRGS,  SA.SHIP_TO_PARTY as SHIP_TO_PARTY, SA.VENDOR as VENDOR,SA.NAME_SHIP_PARTY, SA.LCN_SHIP_PARTY, SA.VEH_NO, SA.COUNTRY_KEY, TR.LR_NO as LR_NO, SA.VEH_NAME as VEH_NAME, SA.INCOTERMS, TR.TRANS_NAME as TRANS_NAME, SA.STATE_NM_SOLD, CA.Rate as Rate, VM.VEHICLE_AVERAGE as VEHICLE_AVERAGE, VM.VEHICLE_LOAD_ABILITY as VEHICLE_LOAD_ABILITY ");
    //     $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
    //     //$this->db->join('tbl_kilometer KT', 'KT.destination=SA.LCN_SHIP_PARTY');
    //     $this->db->join('tbl_vehicle_master1 VM', 'VM.VEHICLE_NAME=SA.VEH_NAME');
    //     $this->db->join('tbl_contract CA', 'CA.Destination=SA.LCN_SHIP_PARTY and CA.Vehicle_Name=SA.VEH_NAME');
    //     $this->db->where($whereCond);
    //     $this->db->group_by('TR.LR_NO');
    //     $query = $this->db->from('TRANSINVOICE TR')->get();

    //     if($query->num_rows() > 0){
    //         $result = $query->result_array();

    //         //echo '<pre>';print_r($this->db->last_query());die;

    //         $this->db->select('RATE');
    //         $this->db->order_by("ID", "desc");
    //         $row = $this->db->from('tbl_diesel_master')->get()->row();
    //         if($row){
    //             foreach($result as $key => &$val){
    //                 $val['Dieselrate'] = $row->RATE;
    //             }
                
    //         }
    //         else{
    //             foreach($result as $key => &$val){
    //                 $val['Dieselrate'] = 0;
    //             }
    //         }


    //         foreach($result as $key => &$val){
    //             $this->db->select('kilometer');
    //             $this->db->where('destination',$val['LCN_SHIP_PARTY']);
    //             $row = $this->db->from('tbl_kilometer')->get()->row();
    //             if($row){
    //                 $val['kilometer'] = $row->kilometer;
    //             }
    //             else{
                
    //                 $val['kilometer'] = 0;
                
    //             }
                
    //         }

    //         $sort = array();
    //         foreach($result as $k=>$v) {
    //             $sort['BILL_DT'][$k] = $v['BILL_DT'];
    //         }

    //         array_multisort($sort['BILL_DT'], SORT_ASC, $result);
            
    //         return $result;
    //     }
    //     else{
    //         return false;
    //     }
    // }


    // public function getdieselCostwithfreight($whereCond) {
    //     $this->db->select("SA.ID as ID, IF(TR.FREIGHT_T > 0, TR.FREIGHT_T, 0) 'FREIGHT_T', IF(SA.FRT_AFT_ST > 0, SA.FRT_AFT_ST, 0) 'FRT_AFT_ST', TR_SUM.BOX_QTY_SUM as BOX_QTY_T, SA.NAME_SHIP_PARTY as NAME_SHIP_PARTY, TR.TOTAL_VAL as TOTAL_VAL, SA.LCN_SHIP_PARTY as LCN_SHIP_PARTY, SA.BILLING_DOC as BILLING_DOC, SA.REF_NO, TR.BILL_DT as BILL_DT, TR_SUM.BILL_QTY_SUM as BILL_QTY_T, TR.DETENTION as DETENTION, TR.PENALTY as PENALTY, MAX(TR.OTHCHRGS) as OTHCHRGS, SA.SHIP_TO_PARTY as SHIP_TO_PARTY, SA.VENDOR as VENDOR, SA.NAME_SHIP_PARTY, SA.LCN_SHIP_PARTY, SA.VEH_NO, SA.COUNTRY_KEY, TR.LR_NO as LR_NO, SA.VEH_NAME as VEH_NAME, SA.INCOTERMS, TR.TRANS_NAME as TRANS_NAME, SA.STATE_NM_SOLD, CA.Rate as Rate, VM.VEHICLE_AVERAGE as VEHICLE_AVERAGE, VM.VEHICLE_LOAD_ABILITY as VEHICLE_LOAD_ABILITY ");
    //     $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
    //     $this->db->join('tbl_vehicle_master1 VM', 'VM.VEHICLE_NAME=SA.VEH_NAME');
    //     $this->db->join('tbl_contract CA', 'CA.Destination=SA.LCN_SHIP_PARTY and CA.Vehicle_Name=SA.VEH_NAME');
    
    //     $this->db->join('(SELECT LR_NO, SUM(BOX_QTY_T) as BOX_QTY_SUM, SUM(BILL_QTY_T) as BILL_QTY_SUM FROM TRANSINVOICE GROUP BY LR_NO) TR_SUM', 'TR.LR_NO = TR_SUM.LR_NO', 'left');



    
    //     $this->db->where($whereCond);
    //     $this->db->group_by('TR.LR_NO');
    
    //     $query = $this->db->from('TRANSINVOICE TR')->get();
    //     // print_r($this->db->last_query());die;
    //     if($query->num_rows() > 0){
    //         $result = $query->result_array();

    //         // echo "<pre>";print_r($result );exit();


    //         $this->db->select('RATE');
    //         $this->db->order_by("ID", "desc");
    //         $row = $this->db->from('tbl_diesel_master')->get()->row();
    //         if($row){
    //             foreach($result as $key => &$val){
    //                 $val['Dieselrate'] = $row->RATE;
    //             }
                
    //         }
    //         else{
    //             foreach($result as $key => &$val){
    //                 $val['Dieselrate'] = 0;
    //             }
    //         }


    //         foreach($result as $key => &$val){
    //             $this->db->select('kilometer');
    //             $this->db->where('destination',$val['LCN_SHIP_PARTY']);
    //             $row = $this->db->from('tbl_kilometer')->get()->row();
    //             if($row){
    //                 $val['kilometer'] = $row->kilometer;
    //             }
    //             else{
                
    //                 $val['kilometer'] = 0;
                
    //             }
                
    //         }
    //         // echo '<pre>';print_r($result);die;
    //         $sort = array();
    //         foreach($result as $k=>$v) {
    //             $sort['BILL_DT'][$k] = $v['BILL_DT'];
    //         }

    //         array_multisort($sort['BILL_DT'], SORT_ASC, $result);
            
    //         return $result;
    //     }
    //     else{
    //         return false;
    //     }
    // }



    public function getdieselCostwithfreight($whereCond) {
        $this->db->select("SA.ID as ID, SA.NAME_SHIP_PARTY as NAME_SHIP_PARTY, TR.TOTAL_VAL as TOTAL_VAL, SA.LCN_SHIP_PARTY as LCN_SHIP_PARTY, SA.BILLING_DOC as BILLING_DOC, SA.REF_NO, TR.BILL_DT as BILL_DT, TR.DETENTION as DETENTION, TR.PENALTY as PENALTY, MAX(TR.OTHCHRGS) as OTHCHRGS, SA.SHIP_TO_PARTY as SHIP_TO_PARTY, SA.VENDOR as VENDOR, SA.NAME_SHIP_PARTY, SA.LCN_SHIP_PARTY, SA.VEH_NO, SA.COUNTRY_KEY, TR.LR_NO as LR_NO, SA.VEH_NAME as VEH_NAME, SA.INCOTERMS, TR.TRANS_NAME as TRANS_NAME, SA.STATE_NM_SOLD, CA.Rate as Rate, VM.VEHICLE_AVERAGE as VEHICLE_AVERAGE, VM.VEHICLE_LOAD_ABILITY as VEHICLE_LOAD_ABILITY, TR.BILL_QTY_T as BILL_QTY_T, MAX(TR.BOX_QTY_T) as BOX_QTY,");
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        $this->db->join('tbl_vehicle_master1 VM', 'VM.VEHICLE_NAME=SA.VEH_NAME');
        $this->db->join('tbl_contract CA', 'CA.Destination=SA.LCN_SHIP_PARTY and CA.Vehicle_Name=SA.VEH_NAME');
        // $this->db->group_by('SA.ID');
        $this->db->group_by('TR.LR_NO');
        $this->db->where($whereCond);
    
        $query = $this->db->from('TRANSINVOICE TR')->get();
        // print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();
    
            $this->db->select('RATE');
            $this->db->order_by("ID", "desc");
            $row = $this->db->from('tbl_diesel_master')->get()->row();
            if($row){
                foreach($result as $key => &$val){
                    $val['Dieselrate'] = $row->RATE;
                }
            }
            else{
                foreach($result as $key => &$val){
                    $val['Dieselrate'] = 0;
                }
            }

            foreach($result as $key => &$val) {
                $this->db->select('SUM(BOX_QTY) as BOX_QTY_T, SUM(BILL_QTY) as BILL_QTY_T', false);
                $this->db->where('LR_NO', $val['LR_NO']);
            
                $row = $this->db->from('tbl_sales')->get()->row();
            
                if ($row) {
                    $val['BOX_QTY_T'] = $row->BOX_QTY_T;
                    $val['BILL_QTY_T'] = $row->BILL_QTY_T;
                } else {
                    $val['BOX_QTY_T'] = 0;
                    $val['BILL_QTY_T'] = 0;
                }
            }
            
    
            foreach($result as $key => &$val){
                $this->db->select('kilometer');
                $this->db->where('destination',$val['LCN_SHIP_PARTY']);
                $row = $this->db->from('tbl_kilometer')->get()->row();
                if($row){
                    $val['kilometer'] = $row->kilometer;
                }
                else{
                    $val['kilometer'] = 0;
                }
            }
    
            $sort = array();
            foreach($result as $k=>$v) {
                $sort['BILL_DT'][$k] = $v['BILL_DT'];
            }
    
            array_multisort($sort['BILL_DT'], SORT_ASC, $result);
    
            return $result;
        }
        else{
            return false;
        }
    }
    
    


    public function getvehicleutil($whereCond) {
        //print_r($_SESSION);die;
        

        $this->db->select(" SA.ID as ID, SA.NAME_SHIP_PARTY as NAME_SHIP_PARTY,SA.LCN_SHIP_PARTY as LCN_SHIP_PARTY,SA.BILLING_DOC as BILLING_DOC, SA.REF_NO as REF_NO, TR.BILL_DT as BILL_DT, SA.SHIP_TO_PARTY as SHIP_TO_PARTY ,SUM(SA.BOX_QTY) as ACT_LOAD_T ,SA.VEH_NAME as VEH_NAME, TR.VENDOR as VENDOR, SA.VEH_NO as VEH_NO, TR.TRANS_NAME as TRANS_NAME,TR.EMP_LS_RSN as EMP_LS_RSN, TR.LR_NO as LR_NO, VM.VEHICLE_LOAD_ABILITY as VEHICLE_LOAD_ABILITY, CA.Rate as Rate");
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        $this->db->join('tbl_vehicle_master1 VM', 'VM.VEHICLE_NAME=SA.VEH_NAME');
        $this->db->join('tbl_contract CA', 'CA.Destination=SA.LCN_SHIP_PARTY and CA.Vehicle_Name=SA.VEH_NAME');
        // $this->db->where('VM.VEHICLE_LOAD_ABILITY', 'SA.BOX_QTY', false);
        $this->db->where($whereCond);
        $this->db->group_by('TR.LR_NO');
        $query = $this->db->from('TRANSINVOICE TR')->get();

            // echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();
            foreach($result as $key => &$val){
                $this->db->select('sum(BOX_QTY) as BOX_QTY_T');
                $this->db->where('LR_NO',$val['LR_NO']);
                $this->db->group_by('LR_NO');
                $row = $this->db->from('tbl_sales')->get()->row();
                //echo $this->db->last_query();
                if($row){
                   
                    $val['ACT_LOAD'] = $row->BOX_QTY_T;
                    
                    
                }
                else{
                    
                    $val['ACT_LOAD'] = 0;
                    
                }
                
            }

            foreach($result as $key => &$val) {
                $this->db->select('SUM(BOX_QTY) as BOX_QTY_T, SUM(BILL_QTY) as BILL_QTY_T', false);
                $this->db->where('LR_NO', $val['LR_NO']);
            
                $row = $this->db->from('tbl_sales')->get()->row();
            
                if ($row) {
                    $val['BOX_QTY_T'] = $row->BOX_QTY_T;
                    $val['BILL_QTY_T'] = $row->BILL_QTY_T;
                } else {
                    $val['BOX_QTY_T'] = 0;
                    $val['BILL_QTY_T'] = 0;
                }
            }

            $sort = array();
            foreach($result as $k=>$v) {
                $sort['BILL_DT'][$k] = $v['BILL_DT'];
            }

            array_multisort($sort['BILL_DT'], SORT_ASC, $result);
            return $result;
        }
        else{
            return false;
        }
    }

    // public function getvehicleutil($whereCond) {
    //     $this->db->select("SA.ID, SA.NAME_SHIP_PARTY, SA.LCN_SHIP_PARTY, SA.BILLING_DOC, SA.REF_NO, TR.BILL_DT, SA.SHIP_TO_PARTY, SUM(SA.BOX_QTY) as ACT_LOAD_T, SA.VEH_NAME, TR.VENDOR, SA.VEH_NO, TR.TRANS_NAME, TR.EMP_LS_RSN, TR.LR_NO, VM.VEHICLE_LOAD_ABILITY, CA.Rate");
    //     $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
    //     $this->db->join('tbl_vehicle_master1 VM', 'VM.VEHICLE_NAME=SA.VEH_NAME');
    //     $this->db->join('tbl_contract CA', 'CA.Destination=SA.LCN_SHIP_PARTY and CA.Vehicle_Name=SA.VEH_NAME');
    //     $this->db->group_by('TR.LR_No'); // Group by both LR_NO and SA.ID
    
    //     $this->db->select('(SELECT SUM(BOX_QTY_T) FROM TRANSINVOICE WHERE LR_NO = TR.LR_NO) as ACT_LOAD', false);
    
    //     $this->db->where($whereCond);
    
    //     $query = $this->db->from('TRANSINVOICE TR')->get();
    
    //     if ($query->num_rows() > 0) {
    //         $result = $query->result_array();
    
    //         $sort = array();
    //         foreach ($result as $k => $v) {
    //             $sort['BILL_DT'][$k] = $v['BILL_DT'];
    //         }
    
    //         array_multisort($sort['BILL_DT'], SORT_ASC, $result);
    //         return $result;
    //     } else {
    //         return false;
    //     }
    // }
    
    
    public function getfreight($whereCond) {
        //print_r($_SESSION);die;
        

        $this->db->select(" SA.ID as ID, IF(SA.FRT_AFT_ST > 0,SA.FRT_AFT_ST, 0) 'FRT_AFT_ST',SA.NAME_SHIP_PARTY,SA.VENDOR,SA.BILLING_DOC, SA.REF_NO, TR.BILL_DT, SA.SHIP_TO_PARTY, TR.BILL_QTY_T ,TR.BOX_QTY_T , SA.INCOTERMS, TR.VENDOR, TR.TRANS_NAME, TR.LR_NO, SA.MAT_NO, SA.HIE_NO,TR.DETENTION as DETENTION,TR.PENALTY as PENALTY,TR.OTHCHRGS as OTHCHRGS, SA.VEH_NAME, SA.LCN_SHIP_PARTY,TR.SUBOTHCHRGS");
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        //$this->db->join('tbl_contract CA', 'CA.Destination=SA.LCN_SHIP_PARTY and CA.Vehicle_Name=SA.VEH_NAME' ,'right');
        $this->db->where($whereCond);
        // $this->db->group_by('TR.LR_NO');
        $query = $this->db->from('TRANSINVOICE TR')->get();

            // echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();
            foreach($result as $key => &$val){
            $this->db->select('SUM(BOX_QTY) as BOX_QTY_T');
            $this->db->where('LR_NO',$val['LR_NO']);
            $row = $this->db->from('tbl_sales')->get()->row();

            if($row){
                $val['total_box'] = $row->BOX_QTY_T;
            }
            else{
            
                $val['total_box'] = 0;
            
            }
            // echo "<pre>";print_r($row);exit();

        }

        foreach($result as $key => &$val){
            $this->db->select('LCN_SHIP_PARTY,VEH_NAME');
            $this->db->where('LR_NO',$val['LR_NO']);
            $row = $this->db->from('tbl_sales')->get()->row();
            if($row){
                $val['new_VEH_NAME'] = $row->VEH_NAME;
                $val['new_LCN_SHIP_PARTY'] = $row->LCN_SHIP_PARTY;
            }
            
        }

        
        foreach($result as $key => &$val){
            $this->db->select('MAX(Rate) as Rate');
            $this->db->where('Destination',$val['new_LCN_SHIP_PARTY']);
            $this->db->where('Vehicle_Name',$val['new_VEH_NAME']);
            //$this->db->group_by($val['LR_NO']);
            $row = $this->db->from('tbl_contract')->get()->row();
            if($row){
                $val['Rate'] = $row->Rate;
            }
            else{
            
                $val['Rate'] = 0;
            
            }
            
            //echo '<pre>';print_r($this->db->last_query());

            $columndatat = $this->db->query("SELECT bill_charge,TOTAL_VAL,DETENTION FROM TRANSINVOICE WHERE LR_NO = '".$val['LR_NO']."' order by ID desc")->row();
                if(!empty($columndatat)){
                    $val['TOTAL_VAL']=($columndatat->TOTAL_VAL) ? $columndatat->TOTAL_VAL : $val['Rate'];
                    $val['bill_charge']=($columndatat->bill_charge) ? $columndatat->bill_charge : $val['Rate'] + (($columndatat->DETENTION) ? $columndatat->DETENTION : 0) + (($val['SUBOTHCHRGS']) ? $val['SUBOTHCHRGS'] : 0);
                    
                    $val['dete']=0;
                }
                else
                {
                    $val['TOTAL_VAL']=$val['Rate'];
                    $val['bill_charge']=$val['Rate'];
                    $val['dete']=0;
                }
               
        }
        $sort = array();
            foreach($result as $k=>$v) {
                $sort['BILL_DT'][$k] = $v['BILL_DT'];
            }

            array_multisort($sort['BILL_DT'], SORT_ASC, $result);
            return $result;
        }
        else{
            return false;
        }
    }
}