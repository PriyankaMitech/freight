<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportModel extends CI_Model {

        
    public function getDetention() {
        $query = $this->db->query(
            "SELECT TR.ID,TR.LR_NO, TR.BILL_NO, NAME_SHIP_PARTY, LCN_SHIP_PARTY, BILLING_DOC, SA.REF_NO, SA.NAME_SHIP_PARTY, TR.BILL_DT, DETENTION, DETN_NOTE, SA.VENDOR, TR.BILL_QTY_T ,TR.BOX_QTY_T ,SA.VEH_NAME, SA.VEH_NO, SA.COUNTRY_KEY, SA.INCOTERMS, TR.VENDOR, TR.TRANS_NAME, SA.GST_NO_SOLD, SA.GST_NO_SHIP, SA.STATE_NM_SOLD, TR.SALES_ID, TR.REP_DT, TR.UNL_DT  
            from TRANSINVOICE TR join tbl_sales SA ON TR.SALES_ID=SA.ID  ");

            //echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();
            // print_r($result);die;
            return $result;
        }
        else{
            return false;
        }
    }

    public function getCost($whereCond) {
        //print_r($_SESSION);die;
        
		// echo '<pre>';print_r($whereCond);die;

        $this->db->select(" MAX(TR.FREIGHT_T) as FREIGHT_T, MAX(SA.FRT_AFT_ST) as FREIGHT,
        MAX(SA.NAME_SHIP_PARTY) as NAME_SHIP_PARTY, MAX(SA.LCN_SHIP_PARTY) as LCN_SHIP_PARTY, MAX(SA.BILLING_DOC) as BILLING_DOC,, MAX(TR.BILL_NO) as BILL_NO, MAX(SA.REF_NO) as REF_NO, MAX(TR.BILL_DT) as BILL_DT, MAX(SA.SHIP_TO_PARTY) as SHIP_TO_PARTY, MAX(DETN_NOTE) as DETN_NOTE,
        MAX(SA.VENDOR), MAX(TR.BILL_QTY_T), MAX(TR.BOX_QTY_T) as BOX_QTY, MAX(SA.VEH_NAME), MAX(SA.VEH_NO),
        MAX(SA.INCOTERMS), MAX(TR.VENDOR) as VENDOR, MAX(TR.TRANS_NAME) as TRANS_NAME,
        MAX(TR.DETENTION) as DETENTION,MAX(TR.STATUS) as STATUS, MAX(TR.OTHCHRGS) as OTHCHRGS,
        MAX(TR.PENALTY) as PENALTY, MAX(TR.LR_NO) as LR_NO,
        IIF((datediff(DAY, MAX(TR.REP_DT), MAX(TR.UNL_DT))) > 0, datediff(DAY, MAX(TR.REP_DT), MAX(TR.UNL_DT)), 0) 'delaydays', MAX(CA.Rate) as Rate");
        //$this->db->select("SA.*,TR.*");
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        $this->db->join('tbl_contract CA', 'CA.Destination=SA.LCN_SHIP_PARTY and CA.Vehicle_Name=SA.VEH_NAME');
        //$this->db->where('TR.STATUS ', 'K');
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
                //echo $this->db->last_query();
                if($row){
                   
                    $val['TRANSPORTER_TYPE'] = $row->TRANSPORTER_TYPE;
                    
                    
                }
                else{
                    
                    $val['TRANSPORTER_TYPE'] = '';
                    
                }
                foreach($result as $key => &$val){
                    $this->db->select('sum(BOX_QTY_T) as BOX_QTY_T');
                    $this->db->where('LR_NO',$val['LR_NO']);
                    $this->db->group_by('LR_NO');
                    $row = $this->db->from('TRANSINVOICE')->get()->row();
                    //echo $this->db->last_query();
                    if($row){
                       
                        $val['BOX_QTY_T'] = $row->BOX_QTY_T;
                        
                        
                    }
                    else{
                        
                        $val['BOX_QTY_T'] = 0;
                        
                    }
                    
                }
                
                
            }
            //die;
            
            
            return $result;
        }
        else{
            return false;
        }
    }

    public function getTransporter($whereCond) {
        //print_r($_SESSION);die;
        

        $this->db->select(" SUM(CAST( TR.FREIGHT_T as float)) as FREIGHT_T,SUM(SA.FRT_AFT_ST) as FREIGHT, MAX(TR.DETENTION), MAX(DETN_NOTE), MAX(SA.VENDOR), MAX(TR.BILL_QTY_T) ,SUM(TR.BOX_QTY_T) ,MAX(SA.VEH_NAME), MAX(SA.VEH_NO), MAX(SA.COUNTRY_KEY), MAX(SA.INCOTERMS), MAX(TR.VENDOR) as VENDOR, MAX(TR.TRANS_NAME) as TRANS_NAME, MAX(SA.GST_NO_SOLD), MAX(SA.GST_NO_SHIP), MAX(SA.STATE_NM_SOLD), MAX(TR.SALES_ID), MAX(TR.REP_DT), MAX(TR.UNL_DT), count(SA.VEH_NAME) as vehiclecount,COUNT(IIF(TR.PENALTY > 0,1, NULL)) 'PENALTY',
       COUNT(IIF(TR.PENALTY <= 0,1, NULL)) 'NOPENALTY'");
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        $this->db->where($whereCond);
        $this->db->group_by('TR.TRANS_NAME');
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

    public function getCustomer($whereCond) {
        //print_r($_SESSION);die;
        

        $this->db->select(" SUM(TR.FREIGHT_T) as FREIGHT_T,SUM(SA.FRT_AFT_ST) as FREIGHT, MAX(SA.NAME_SHIP_PARTY) as NAME_SHIP_PARTY, MAX(DETENTION) as DETENTION, MAX(DETN_NOTE), MAX(SA.VENDOR) as VENDOR, MAX(TR.BILL_QTY_T) ,SUM(TR.BOX_QTY_T) ,MAX(SA.VEH_NAME), MAX(SA.VEH_NO), MAX(SA.COUNTRY_KEY), MAX(SA.INCOTERMS), MAX(TR.VENDOR), MAX(TR.TRANS_NAME), MAX(SA.GST_NO_SOLD), MAX(SA.GST_NO_SHIP), MAX(SA.STATE_NM_SOLD), MAX(TR.SALES_ID), MAX(TR.REP_DT), MAX(TR.UNL_DT), count(SA.VEH_NAME) as vehiclecount,COUNT(IIF(TR.PENALTY > 0,1, NULL)) 'PENALTY',
       COUNT(IIF(TR.PENALTY <= 0,1, NULL)) 'NOPENALTY', IIF((datediff(DAY, MAX(TR.REP_DT), MAX(TR.UNL_DT))) > 0, datediff (DAY, MAX(TR.REP_DT), MAX(TR.UNL_DT)), 0) 'delaydays'");
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        $this->db->where($whereCond);
        $this->db->group_by('SA.NAME_SHIP_PARTY');
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

    public function getCostvsRecovery($whereCond) {
        //print_r($_SESSION);die;
        

        $this->db->select(" IIF(MAX(TR.FREIGHT_T) > 0,MAX(TR.FREIGHT_T), 0) 'FREIGHT_T',SUM(SA.FRT_AFT_ST) as FRT_AFT_ST,MAX(SA.NAME_SHIP_PARTY) as NAME_SHIP_PARTY,MAX(SA.LCN_SHIP_PARTY) as LCN_SHIP_PARTY,MAX(SA.BILLING_DOC) as BILLING_DOC, MAX(SA.REF_NO) as REF_NO, MAX(TR.BILL_DT) as BILL_DT, MAX(SA.SHIP_TO_PARTY) as SHIP_TO_PARTY, MAX(DETN_NOTE), MAX(SA.VENDOR), MAX(TR.BILL_QTY_T) ,SUM(TR.BOX_QTY_T) ,MAX(SA.VEH_NAME), MAX(SA.VEH_NO), MAX(SA.COUNTRY_KEY), MAX(SA.INCOTERMS), MAX(TR.VENDOR), MAX(TR.TRANS_NAME), MAX(SA.GST_NO_SOLD), MAX(SA.GST_NO_SHIP), MAX(SA.STATE_NM_SOLD), MAX(TR.SALES_ID), MAX(TR.REP_DT), MAX(TR.UNL_DT), count(SA.VEH_NAME) as vehiclecount,COUNT(IIF(TR.PENALTY > 0,1, NULL)) 'PENALTY',
       COUNT(IIF(TR.PENALTY <= 0,1, NULL)) 'NOPENALTY', IIF((datediff(DAY, MAX(TR.REP_DT), MAX(TR.UNL_DT))) > 0, datediff(DAY, MAX(TR.REP_DT), MAX(TR.UNL_DT)), 0) 'delaydays'");
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
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

    public function getdieselCost($whereCond) {
        //print_r($_SESSION);die;
        

        $this->db->select(" IIF(MAX(TR.FREIGHT_T) > 0,MAX(TR.FREIGHT_T), 0) 'FREIGHT_T',IIF(MAX(SA.FRT_AFT_ST) > 0,MAX(SA.FRT_AFT_ST), 0) 'FRT_AFT_ST',SUM(TR.BOX_QTY_T) as BOX_QTY_T,MAX(SA.NAME_SHIP_PARTY) as NAME_SHIP_PARTY,MAX(SA.LCN_SHIP_PARTY) as LCN_SHIP_PARTY,MAX(SA.BILLING_DOC) as BILLING_DOC, MAX(SA.REF_NO), MAX(TR.BILL_DT) as BILL_DT, MAX(TR.BILL_QTY_T) as BILL_QTY_T,  MAX(SA.SHIP_TO_PARTY) as SHIP_TO_PARTY, MAX(SA.VENDOR) as VENDOR,MAX(SA.NAME_SHIP_PARTY), MAX(SA.LCN_SHIP_PARTY), MAX(SA.VEH_NO), MAX(SA.COUNTRY_KEY), MAX(TR.LR_NO) as LR_NO, MAX(SA.VEH_NAME) as VEH_NAME, MAX(SA.INCOTERMS), MAX(TR.TRANS_NAME) as TRANS_NAME, MAX(SA.STATE_NM_SOLD), MAX(CA.Rate) as Rate, MAX(VM.VEHICLE_AVERAGE) as VEHICLE_AVERAGE");
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
            
            return $result;
        }
        else{
            return false;
        }
    }

    public function getBudgetvsActual($whereCond1,$whereCond,$month=null) {
        //print_r($_SESSION);die;
        //echo $month;

        $this->db->select("max(B.ID) as ID,MAX(SA.NAME_SOLD_PARTY) as NAME_SOLD_PARTY,MAX(SA.LCN_SOLD_PARTY) as LCN_SOLD_PARTY,MAX(SA.BILLING_DOC) as BILLING_DOC,MAX(B.".$month."_QTY) as monthval,MAX(B.".$month.") as monthdata,max(SA.BILL_QTY) as BILL_QTY,max(B.FRT_PER_C) as FRT_PER_C,max(B.CONS_SIZE) as CONS_SIZE, MAX(SA.REF_NO) as REF_NO, MAX(SA.SOLD_TO_PARTY) as SOLD_TO_PARTY, MAX(SA.VENDOR),MAX(SA.VEH_NAME), MAX(SA.VEH_NO), MAX(SA.COUNTRY_KEY),MAX(SA.HIE_NO) as HIE_NO,MAX(SA.HIE_DESC) as HIE_DESC,MAX(TR.DETENTION) as DETENTION, MAX(TR.PENALTY) as PENALTY,MAX(TR.OTHCHRGS) as OTHCHRGS, MAX(CA.Rate) as Rate, MAX(SA.INCOTERMS), MAX(SA.GST_NO_SOLD), MAX(SA.GST_NO_SHIP), MAX(SA.STATE_NM_SOLD)");
        $this->db->join('BUDGET B', 'SA.HIE_NO=B.HIE_M_ID');
        $this->db->join('TRANSINVOICE TR', 'TR.SALES_ID=SA.ID');
        $this->db->join('tbl_contract CA', 'CA.Destination=SA.LCN_SHIP_PARTY and CA.Vehicle_Name=SA.VEH_NAME');
        $this->db->where($whereCond1);
        $this->db->where($whereCond);
        $this->db->group_by('B.HIE_M_ID');
        $this->db->group_by('SA.SOLD_TO_PARTY');
        $this->db->order_by('B.HIE_M_ID','asc');
        
        $query = $this->db->from('tbl_sales SA')->get();

        //echo '<pre>';print_r($this->db->last_query());die;
            
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }
        else{
            return false;
        }
    }

    public function getdieselCostwithfreight($whereCond) {
        //print_r($_SESSION);die;
        

        $this->db->select(" IIF(MAX(TR.FREIGHT_T) > 0,MAX(TR.FREIGHT_T), 0) 'FREIGHT_T',IIF(MAX(SA.FRT_AFT_ST) > 0,MAX(SA.FRT_AFT_ST), 0) 'FRT_AFT_ST',SUM(TR.BOX_QTY_T) as BOX_QTY_T,MAX(SA.NAME_SHIP_PARTY) as NAME_SHIP_PARTY,MAX(SA.LCN_SHIP_PARTY) as LCN_SHIP_PARTY,MAX(SA.BILLING_DOC) as BILLING_DOC, MAX(SA.REF_NO), MAX(TR.BILL_DT) as BILL_DT, MAX(TR.BILL_QTY_T) as BILL_QTY_T,MAX(TR.DETENTION) as DETENTION, MAX(TR.PENALTY) as PENALTY,MAX(TR.OTHCHRGS) as OTHCHRGS,  MAX(SA.SHIP_TO_PARTY) as SHIP_TO_PARTY, MAX(SA.VENDOR) as VENDOR,MAX(SA.NAME_SHIP_PARTY), MAX(SA.LCN_SHIP_PARTY), MAX(SA.VEH_NO), MAX(SA.COUNTRY_KEY), MAX(TR.LR_NO) as LR_NO, MAX(SA.VEH_NAME) as VEH_NAME, MAX(SA.INCOTERMS), MAX(TR.TRANS_NAME) as TRANS_NAME, MAX(SA.STATE_NM_SOLD), MAX(CA.Rate) as Rate, MAX(VM.VEHICLE_AVERAGE) as VEHICLE_AVERAGE, MAX(VM.VEHICLE_LOAD_ABILITY) as VEHICLE_LOAD_ABILITY ");
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
            
            return $result;
        }
        else{
            return false;
        }
    }

    public function getvehicleutil($whereCond) {
        //print_r($_SESSION);die;
        

        $this->db->select(" MAX(SA.NAME_SHIP_PARTY) as NAME_SHIP_PARTY,MAX(SA.LCN_SHIP_PARTY) as LCN_SHIP_PARTY,MAX(SA.BILLING_DOC) as BILLING_DOC, MAX(SA.REF_NO) as REF_NO, MAX(TR.BILL_DT) as BILL_DT, MAX(SA.SHIP_TO_PARTY) as SHIP_TO_PARTY ,SUM(SA.BOX_QTY) as ACT_LOAD_T ,MAX(SA.VEH_NAME) as VEH_NAME, MAX(SA.VEH_NO) as VEH_NO, MAX(TR.TRANS_NAME) as TRANS_NAME,MAX(TR.EMP_LS_RSN) as EMP_LS_RSN, MAX(TR.LR_NO) as LR_NO, MAX(VM.VEHICLE_LOAD_ABILITY) as VEHICLE_LOAD_ABILITY, MAX(CA.Rate) as Rate");
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        $this->db->join('tbl_vehicle_master1 VM', 'VM.VEHICLE_NAME=SA.VEH_NAME');
        $this->db->join('tbl_contract CA', 'CA.Destination=SA.LCN_SHIP_PARTY and CA.Vehicle_Name=SA.VEH_NAME');
        $this->db->where($whereCond);
        $this->db->group_by('TR.LR_NO');
        $query = $this->db->from('TRANSINVOICE TR')->get();

            // echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();
            foreach($result as $key => &$val){
                $this->db->select('sum(BOX_QTY_T) as BOX_QTY_T');
                $this->db->where('LR_NO',$val['LR_NO']);
                $this->db->group_by('LR_NO');
                $row = $this->db->from('TRANSINVOICE')->get()->row();
                //echo $this->db->last_query();
                if($row){
                   
                    $val['ACT_LOAD'] = $row->BOX_QTY_T;
                    
                    
                }
                else{
                    
                    $val['ACT_LOAD'] = 0;
                    
                }
                
            }
            return $result;
        }
        else{
            return false;
        }
    }

    public function getfreight($whereCond) {
        //print_r($_SESSION);die;
        

        $this->db->select(" IIF(SA.FRT_AFT_ST > 0,SA.FRT_AFT_ST, 0) 'FRT_AFT_ST',SA.NAME_SHIP_PARTY,SA.VENDOR,SA.BILLING_DOC, SA.REF_NO, TR.BILL_DT, SA.SHIP_TO_PARTY, TR.BILL_QTY_T ,TR.BOX_QTY_T , SA.INCOTERMS, TR.VENDOR, TR.TRANS_NAME, TR.LR_NO, SA.MAT_NO, SA.HIE_NO,TR.DETENTION as DETENTION,TR.PENALTY as PENALTY,TR.OTHCHRGS as OTHCHRGS, SA.VEH_NAME, SA.LCN_SHIP_PARTY");
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        //$this->db->join('tbl_contract CA', 'CA.Destination=SA.LCN_SHIP_PARTY and CA.Vehicle_Name=SA.VEH_NAME' ,'right');
        $this->db->where($whereCond);
        //$this->db->group_by('TR.LR_NO');
        $query = $this->db->from('TRANSINVOICE TR')->get();

            // echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();
            foreach($result as $key => &$val){
            $this->db->select('SUM(BOX_QTY_T) as BOX_QTY_T');
            $this->db->where('LR_NO',$val['LR_NO']);
            $row = $this->db->from('TRANSINVOICE')->get()->row();
            if($row){
                $val['total_box'] = $row->BOX_QTY_T;
            }
            else{
            
                $val['total_box'] = 0;
            
            }
        }
        foreach($result as $key => &$val){
            $this->db->select('Rate');
            $this->db->where('Destination',$val['LCN_SHIP_PARTY']);
            $this->db->where('Vehicle_Name',$val['VEH_NAME']);
            $row = $this->db->from('tbl_contract')->get()->row();
            if($row){
                $val['Rate'] = $row->Rate;
            }
            else{
            
                $val['Rate'] = 0;
            
            }
        }
            return $result;
        }
        else{
            return false;
        }
    }
}