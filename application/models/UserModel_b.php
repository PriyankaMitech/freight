<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class UserModel extends CI_Model {



    public function get_userdata()

    {

        $email = $this->input->post('email');

        $this->db->select('*');

        $this->db->from('tbl_user_details');

        $this->db->where('USER_EMAIL', $email);



        $query = $this->db->get();

        // print_r($this->db->last_query());die;

        if($query->num_rows() > 0){

            $result = $query->row();

            return $result;

        }

        else{

            return false;

        }

        // print_r($query->row());die;

    }



    public function saveTransporter($postData, $id)

    {

        // $session = \Config\Services::session();

        $insertData = array(

            'CODE'   => $postData['code'],

            'TRANSPORTER_NAME'   => $postData['transportername'],

            'TRANSPORTER_EMAIL'  => $postData['email'],

            'TRANSPORTER_TYPE'   => $postData['type'],

            'ADDRESS'    => $postData['address'],

            'CONTACT_PERSON'     => $postData['contactperson'],

            'PHONE'  => $postData['phone'],

            'CREATED_AT' => date("Y-m-d H:i:s"),

            'IS_ACTIVE'  => 'Y',

            'IS_DELETED' => 'N',

        );

        if ($id == '') {

            $insert = $this->db->insert('tbl_transporter_new', $insertData);

            $this->session->set_flashdata('success', 'Record Inserted successfully..!');

            return $insert;

        }else {

            $updateData = array(

                'CODE'   => $postData['code'],

                'TRANSPORTER_NAME'   => $postData['transportername'],

                'TRANSPORTER_EMAIL'  => $postData['email'],

                'TRANSPORTER_TYPE'   => $postData['type'],

                'ADDRESS'    => $postData['address'],

                'CONTACT_PERSON'     => $postData['contactperson'],

                'PHONE'  => $postData['phone'],

                'UPDATED_AT' => date("Y-m-d H:i:s"),

                'IS_ACTIVE'  => 'Y',

                'IS_DELETED' => 'N',

            );

            $update = $this->db->table('tbl_transporter_new')->where(["AUTO_ID" => $id])->set($updateData)->update();

            // print_r($this->db->last_query());die;

            $session->setFlashdata('success', 'Record Updated successfully..!');

            return $update;

        }

    }



    public function getTransport()

    {

        $this->db->select('*');

        $row = $this->db->from('tbl_transporter_new')->get()->result(); 

        

        // echo '<pre>';print_r($row);die;

        if ($row != '') {

            return $row;

        }else {

            return false;

        }

    }



    public function edit_transporter($id)

    {

        $this->db->select('*');

        $row = $this->db->from('tbl_transporter_new')->get()->result(); 

        // $row = $this->db->table('tbl_transporter')->where('ID', base64_decode($id))->get()->getRowArray();

        if ($row != '') {

            return $row;

        }else {

            return false;

        }

    }



    public function delete_transporter($id)

    {

        $this->db->where('ID', base64_decode($id));

        $this->db->delete('tbl_transporter_new');

    }



    public function saveVehicle($postData, $id)

    {

        // $session = \Config\Services::session();

        $insertData = array(

            'VEHICLE_NAME'   => $postData['name'],

            'VEHICLE_AVERAGE'    => $postData['average'],

            'VEHICLE_LOAD_ABILITY'   => $postData['loadability'],

            'CREATED_AT' => date("Y-m-d H:i:s"),

            'IS_ACTIVE'  => 'Y',

            'IS_DELETED' => 'N',

        );

        if ($id == '') {

            $insert = $this->db->insert('tbl_vehicle_master1', $insertData);

            $this->session->set_flashdata('success', 'Record Inserted successfully..!');

            return $insert;

        }else {

            $updateData = array(

                'VEHICLE_NAME'   => $postData['name'],

                'VEHICLE_AVERAGE'    => $postData['average'],

                'VEHICLE_LOAD_ABILITY'   => $postData['loadability'],

                'UPDATED_AT' => date("Y-m-d H:i:s"),

                'IS_ACTIVE'  => 'Y',

                'IS_DELETED' => 'N',

            );

            $update = $this->db->where('ID', $id)->update('tbl_vehicle_master1', $updateData);

            // print_r($this->db->last_query());die;

            $this->session->set_flashdata('success', 'Record Updated successfully..!');

            return $update;

        }

    }



    public function getVehicle()

    {

        $this->db->select('*');

        $row = $this->db->from('tbl_vehicle_master1')->get()->result(); 

        

        // echo '<pre>';print_r($row);die;

        if ($row != '') {

            return $row;

        }else {

            return false;

        }

    }



    public function edit_vehicle($id)

    {

        $row = $this->db->get_where('tbl_vehicle_master1', array('ID' => base64_decode($id)))->result_array();

        // $row = $this->db->get_where('tbl_vehicle_master1', array('id' => $id));

        // print_r($row);die;

        if ($row != '') {

            return $row;

        }else {

            return false;

        }

        // print_r($row);die;

    }



    public function delete_vehicle($id)

    {

        $this->db->where('ID', base64_decode($id));

        $this->db->delete('tbl_vehicle_master1');

    }



    public function saveDieselrate($postData, $id)

    {

        // print_r($postData);die;

        // $session = \Config\Services::session();

        $insertData = array(

            'DATE'   => $postData['datemonth'],

            'RATE'   => $postData['dieselrate'],

            'CREATED_AT' => date("Y-m-d H:i:s"),

            'IS_ACTIVE'  => 'Y',

            'IS_DELETED' => 'N',

        );

        if ($id == '') {

            $insert = $this->db->insert('tbl_diesel_master', $insertData);

            $this->session->set_flashdata('success', 'Record Inserted successfully..!');

            return $insert;

        }else {

            $updateData = array(

                'DATE'   => $postData['datemonth'],

                'RATE'   => $postData['dieselrate'],

                'UPDATED_AT' => date("Y-m-d H:i:s"),

                'IS_ACTIVE'  => 'Y',

                'IS_DELETED' => 'N',

            );

            $update = $this->db->where('ID', $id)->update('tbl_diesel_master', $updateData);

            // print_r($this->db->last_query());die;

            $this->session->set_flashdata('success', 'Record Updated successfully..!');

            return $update;

        }

    }



    public function getDieselrate()

    {

        $this->db->select('*');

        $row = $this->db->from('tbl_diesel_master')->get()->result();

        // $row = $this->db->table('tbl_diesel_master')->get()->getResultArray();   

        // echo '<pre>';print_r($row);die;

        if ($row != '') {

            return $row;

        }else {

            return false;

        }

    }



    public function edit_dieselrate($id)

    {

        $row = $this->db->get_where('tbl_diesel_master', array('ID' => base64_decode($id)))->result_array();

        // $row = $this->db->table('tbl_diesel_master')->where('ID', base64_decode($id))->get()->getRowArray();

        if ($row != '') {

            return $row;

        }else {

            return false;

        }

        print_r($row);die;

    }

    public function saveZone($postData, $id)

    {

        $insertData = array(

            'STATE'  => $postData['state'],

            'ZONE'   => $postData['zone'],

            'CREATED_AT' => date("Y-m-d H:i:s"),

            'IS_ACTIVE'  => 'Y',

            'IS_DELETED' => 'N',

        );

        if ($id == '') {

            $insert = $this->db->insert('tbl_zone_master1', $insertData);

            $this->session->set_flashdata('success', 'Record Inserted successfully..!');

            return $insert;

        }else {

            $updateData = array(

                'STATE'  => $postData['state'],

                'ZONE'   => $postData['zone'],

                'UPDATED_AT' => date("Y-m-d H:i:s"),

                'IS_ACTIVE'  => 'Y',

                'IS_DELETED' => 'N',

            );

            $update = $this->db->where('ID', $id)->update('tbl_zone_master1', $updateData);

            // print_r($this->db->last_query());die;

            $this->session->set_flashdata('success', 'Record Updated successfully..!');

            return $update;

        }

    }



    public function getZone()

    {

        $this->db->select('*');

        $row = $this->db->from('tbl_zone_master1')->get()->result();



        // $row = $this->db->table('tbl_zone_master')->get()->getResultArray();   

        // echo '<pre>';print_r($row);die;

        if ($row != '') {

            return $row;

        }else {

            return false;

        }

    }



    public function edit_zone($id)

    {

        $row = $this->db->get_where('tbl_zone_master1', array('ID' => base64_decode($id)))->result_array();

        if ($row != '') {

            return $row;

        }else {

            return false;

        }

        print_r($row);die;

    }



    public function sales_register($code, $name)

    {

        $insertData = array(

            'CODE'   => $code,

            'NAME'   => $name,

        );

        // if ($id == '') {

            $insert = $this->db->insert('tbl_sales_register', $insertData);

            $this->session->set_flashdata('success', 'Record Inserted successfully..!');

            return $insert;

    }



    public function uploadCsvFile($query)

    {
        // echo  "hii";
        // echo "<pre>";print_r($query);exit();
        

        // if ($id == '') {

            // echo '<pre>';print_r($query);

            // $sql = "INSERT INTO tbl_test ([Transporter ID], [Transporter],[STP Code],[STP Name],[STP Location],[Billing Doc],[Billing Date],[LR.No],[Mns Transty],[Dist. Km],[Contract Rate],[Fuel Average],[Diesel Cost],[% Cost],[Freight Total],[Total bill Qty],[Box Qty]) VALUES $query";

            //$insert = $this->db->insert('tbl_test', $query);

            $sales_insert = $this->db->query("INSERT INTO tbl_SALES ([BILLING_DOC], [BILL_DT],[REF_NO],[SHIP_TO_PARTY],[NAME_SHIP_PARTY],[SOLD_TO_PARTY],[LCN_SHIP_PARTY],[NAME_SOLD_PARTY],[LCN_SOLD_PARTY],[MAT_NO],[MAT_DESC],[HIE_NO],[HIE_DESC],[BILL_QTY],[BOX_QTY],[FRT_AFT_ST],[CITY],[COUNTRY_KEY],[INCOTERMS],[VENDOR],[TRANS_NAME],[LR_NO],[STATE_NM_SHIP],[STATE_NM_SOLD],[GST_NO_SOLD],[GST_NO_SHIP],[VEH_NAME],[VEH_NO],[STATUS]) VALUES (".$query[0].", '".$query[1]."','".$query[2]."', '".$query[3]."','".$query[4]."', '".$query[6]."','".$query[5]."','".$query[7]."','".$query[8]."', '".$query[9]."','".$query[10]."', '".$query[11]."','".$query[12]."', '".$query[13]."',".$query[14].",'".$query[15]."','".$query[16]."','".$query[17]."','".$query[18]."','".$query[19]."','".$query[20]."','".$query[21]."','".$query[22]."','".$query[23]."','".$query[24]."','".$query[25]."','".$query[26]."', '".$query[27]."','N')");

// echo "<pre>";print_r($sales_insert);exit();

            $sale_id =   $this->db->insert_id();

            

            $trans_insert = $this->db->query("INSERT INTO TRANSINVOICE ([LR_NO], [BILL_DT],[STATUS],[SALES_ID],[VENDOR],[TRANS_NAME],[BOX_QTY_T],[BILL_QTY_T],[BILL_NO]) VALUES ('".$query[21]."','".$query[1]."','N',$sale_id, '".$query[19]."','".$query[20]."',".$query[14].",'".$query[13]."',".$query[0].") ");



            // echo '<pre>';print_r($this->db->last_query());

            $insertAll = array(

                'sales_insert' => $sales_insert,

                'trans_insert' => $trans_insert    

            );

            if ($insertAll) {

                $this->session->set_flashdata('success', 'Excel Data Imported into the Database..!');

                return $insertAll;

            }else {

                return false;

            }

    }



    public function uploadBudgetFile($query)

    {

            $budget_insert = $this->db->query("INSERT INTO BUDGET ([YEAR], [JAN],[FEB],[MAR],[APR],[MAY],[JUN],[JUL],[AUG],[SEP],[OCT],[NOV],[DEC],[INCOT],[PACK_SIZE],[BOX_QTY],[CONS_SIZE],[FRT_PER_C],[HIKE],[FRT_PER_C_T]) VALUES (".$query[7].", '".$query[8]."', '".$query[9]."', '".$query[10]."', '".$query[11]."', '".$query[12]."', '".$query[13]."', '".$query[14]."' , '".$query[15]."', '".$query[16]."', '".$query[17]."', '".$query[18]."', '".$query[19]."', '".$query[21]."', '".$query[22]."', '".$query[23]."', ".$query[24].", ".$query[25].", '".$query[26]."', '".$query[27]."')");



            if ($budget_insert) {

                $this->session->set_flashdata('success', 'Excel Data Imported into the Database..!');

                return $budget_insert;

            }else {

                return false;

            }

    }



}