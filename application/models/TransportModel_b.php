<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class TransportModel extends CI_Model {



    public function getSales() {

        $query = $this->db->query(

            "SELECT TR.[ID],TR.[LR_NO], SA.[NAME_SHIP_PARTY], TR.[BILL_DT], TR.[BILL_QTY_T] ,TR.[BOX_QTY_T] ,SA.[VEH_NAME], SA.[VEH_NO], SA.[COUNTRY_KEY], SA.[INCOTERMS], TR.[VENDOR], TR.[TRANS_NAME], SA.[GST_NO_SOLD], SA.[GST_NO_SHIP], SA.[STATE_NM_SOLD], TR.[SALES_ID], TR.[REP_DT], TR.[UNL_DT]  

            from [TRANSINVOICE] TR join tbl_sales SA ON TR.SALES_ID=SA.ID and TR.STATUS='N' ");



            // echo '<pre>';print_r($this->db->last_query());die;

        if($query->num_rows() > 0){

            $result = $query->result_array();

            return $result;

        }

        else{

            return false;

        }

    }



    public function save_trans($postData, $id)

    {

        // print_r($postData);die;

        $updateData = array(

            'REP_DT'	 =>	$postData['REPORT_DATE'],

            'UNL_DT'	 =>	$postData['RELEASE_DATE'],

            'STATUS'	 =>	'Y',

            'UPDATED_BY' =>	$this->session->userdata('id'),

            'UPDATED_DT' =>	date("Y-m-d")

        );

        $update = $this->db->where('ID', $id)->update('TRANSINVOICE', $updateData);

        // print_r($this->db->last_query());die;

        $this->session->set_flashdata('success', 'Record Updated successfully..!');

        return $update;

    }

    public function edit_trans($id)
    {
        $this->db->select('REP_DT, UNL_DT');

        $this->db->from('TRANSINVOICE');

        $this->db->where('ID', $id);

        $query = $this->db->get();

        print_r($this->db->last_query());die;

        if($query->num_rows() > 0){

            $result = $query->row();

            return $result;

        }

        else{

            return false;

        }
    }

    public function transHistory() {

        $query = $this->db->query(

            "SELECT TR.[ID],TR.[LR_NO], [BILL_NO], [NAME_SHIP_PARTY], [LCN_SHIP_PARTY], [BILLING_DOC], [REF_NO], SA.[NAME_SHIP_PARTY], TR.[BILL_DT], [DETENTION], [DETN_NOTE], SA.[VENDOR], TR.[BILL_QTY_T] ,TR.[BOX_QTY_T] ,SA.[VEH_NAME], SA.[VEH_NO], SA.[COUNTRY_KEY], SA.[INCOTERMS], TR.[VENDOR], TR.[TRANS_NAME], SA.[GST_NO_SOLD], SA.[GST_NO_SHIP], SA.[STATE_NM_SOLD], TR.[SALES_ID], TR.[REP_DT], TR.[UNL_DT]  

            from [TRANSINVOICE] TR join tbl_sales SA ON TR.SALES_ID=SA.ID and TR.STATUS='Y' ");



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

            "SELECT TR.[ID],TR.[LR_NO], [BILL_NO], [NAME_SHIP_PARTY], [LCN_SHIP_PARTY], [BILLING_DOC], [REF_NO], SA.[NAME_SHIP_PARTY], TR.[BILL_DT], [DETENTION], [DETN_NOTE], SA.[VENDOR], TR.[BILL_QTY_T] ,TR.[BOX_QTY_T] ,SA.[VEH_NAME], SA.[VEH_NO], SA.[COUNTRY_KEY], SA.[INCOTERMS], TR.[VENDOR], TR.[TRANS_NAME], SA.[GST_NO_SOLD], SA.[GST_NO_SHIP], SA.[STATE_NM_SOLD], TR.[SALES_ID], TR.[REP_DT], TR.[UNL_DT]  

            from [TRANSINVOICE] TR join tbl_sales SA ON TR.SALES_ID=SA.ID  ");



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