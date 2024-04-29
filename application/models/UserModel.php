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

    public function savekilometer($postData, $id)
    {
        // $session = \Config\Services::session();
        $insertData = array(
            'state'   => $postData['state'],
            'zone'   => $postData['zone'],
            'destination'  => $postData['destination'],
            'kilometer'   => $postData['kilometer'],
            'transit_time'    => $postData['transit_time'],
            'CREATED_AT' => date("Y-m-d H:i:s"),
            'IS_ACTIVE'  => 'Y',
            'IS_DELETED' => 'N',
        );
        if ($id == '') {
            $insert = $this->db->insert('tbl_kilometer', $insertData);
            $this->session->set_flashdata('success', 'Record Inserted successfully..!');
            return $insert;
        }else {
            $updateData = array(
                'state'   => $postData['state'],
                'zone'   => $postData['zone'],
                'destination'  => $postData['destination'],
                'kilometer'   => $postData['kilometer'],
                'transit_time'    => $postData['transit_time'],
                'UPDATED_AT' => date("Y-m-d H:i:s"),
                'IS_ACTIVE'  => 'Y',
                'IS_DELETED' => 'N',
            );
            
            $update = $this->db->where('ID', $id)->update('tbl_kilometer', $updateData);
            // print_r($this->db->last_query());die;
            $this->session->set_flashdata('success', 'Record Updated successfully..!');
            return $update;
        }
    }

    public function getkilometer()
    {
        $this->db->select('*');
        $row = $this->db->from('tbl_kilometer')->get()->result(); 
        
        // echo '<pre>';print_r($row);die;
        if ($row != '') {
            return $row;
        }else {
            return false;
        }
    }

    public function edit_kilometer($id)
    {
        //$this->db->select('*');
        //$row = $this->db->from('tbl_kilometer')->get()->result(); 
        $row = $this->db->get_where('tbl_kilometer', array('ID' => base64_decode($id)))->result_array();
        if ($row != '') {
            return $row;
        }else {
            return false;
        }
    }

    public function delete_kilometer($id)
    {
        $this->db->where('ID', base64_decode($id));
        $this->db->delete('tbl_kilometer');
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

    public function Master_LR()
    {
        $this->db->select('MAX(ID) as ID,MAX(LR_NO) as LR_NO');
        $row = $this->db->from('tbl_sales')->group_by('LR_NO')->get()->result(); 
        
        // echo '<pre>';print_r($row);die;
        if ($row != '') {
            return $row;
        }else {
            return false;
        }
    }



    // public function delete_LR_NO($id)
    // {
    //     $decoded_id = base64_decode($id);

    //     // echo "$decoded_id";exit();
    //     $this->db->where('LR_NO',$decoded_id);
    //     $this->db->delete('tbl_sales');
    // }

    public function delete_LR_NO($id)
{
    $decoded_id = base64_decode($id);

    // Delete from the 'transinvoice' table
    $this->db->where('LR_NO', $decoded_id);
    $this->db->delete('transinvoice');

    // Delete from the 'tbl_sales' table
    $this->db->where('LR_NO', $decoded_id);
    $this->db->delete('tbl_sales');
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

    public function getdistinctvalue()
    {
        $this->db->distinct();
        $this->db->select('TRANS_NAME as TRANS_NAME1');
        $row = $this->db->from('tbl_sales')->get()->result();

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

    // public function getSAP($whereCond) {
        
    //     $this->db->select(' (TR.LR_NO),TR.STATUS, SA.ID as sapid,TR.BILL_DT as BILL_DT, SA.VEH_NAME,  SA.VEH_NO,  SA.COUNTRY_KEY,  SA.INCOTERMS,  SA.GST_NO_SOLD,  SA.GST_NO_SHIP,  SA.STATE_NM_SOLD');
    //     $this->db->where($whereCond);
    //     $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
    //     $this->db->group_by('TR.LR_NO');
    //     $this->db->group_by('TR.STATUS');
    //     $query = $this->db->from('TRANSINVOICE TR')->get();
 
    //     if($query->num_rows() > 0){
    //         $result = $query->result_array();
    //         return $result;
    //     }
    //     else{
    //         return false;
    //     }
    // }

    public function getSAP($whereCond) {
        $this->db->select('(TR.LR_NO), TR.STATUS, MAX(SA.ID) as sapid, MAX(TR.BILL_DT) as BILL_DT, MAX(SA.VEH_NAME), MAX(SA.VEH_NO), MAX(SA.COUNTRY_KEY), MAX(SA.INCOTERMS), MAX(SA.GST_NO_SOLD), MAX(SA.GST_NO_SHIP), MAX(SA.STATE_NM_SOLD)');
    
        $this->db->where($whereCond);
        $this->db->join('tbl_sales SA', 'TR.SALES_ID=SA.ID');
        $this->db->group_by('TR.LR_NO');
        $this->db->group_by('TR.STATUS');
    
        // Order by the datetime field directly in descending order
        $this->db->order_by("MAX(TR.BILL_DT) ASC");
    
        $query = $this->db->from('TRANSINVOICE TR')->get();
    
        if ($query->num_rows() > 0) {
            $result = $query->result_array();

            // echo "<pre>";print_r($result);exit();
            return $result;
        } else {
            return false;
        }
    }

    public function getSAPwithid($ID, $STATUS) {
        $query = $this->db->query(
            "SELECT *,TR.ID as TID,TR.LR_NO as LR_NOT, SA.ID as sapid,ROUND(TR.EMP_LS, 2) as EMP_LS, ROUND(TR.TOTAL_VAL, 2) as TOTAL_VAL from transinvoice TR join tbl_sales SA ON TR.SALES_ID=SA.ID where TR.LR_NO ='".$ID."' and TR.STATUS ='".$STATUS."' ");

           //  echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->result_array();

            $columndata = $this->db->query("SELECT Rate FROM tbl_contract WHERE Destination LIKE '%".$result[0]['LCN_SHIP_PARTY']."%' and Vehicle_Name = '".$result[0]['VEH_NAME']."'")->row();
            //echo "SELECT Rate FROM `tbl_contract` WHERE `Destination` LIKE '%".$result[0]['CITY']."%' and Vehicle_Name = '".$result[0]['VEH_NAME']."'";
            if(!empty($columndata)){
                $columndatat = $this->db->query("SELECT TOTAL_VAL FROM TRANSINVOICE WHERE LR_NO = '".$result[0]['LR_NO']."' order by ID desc")->row();
                if(!empty($columndatat)){
                    $result[0]['grand_total']=($columndatat->TOTAL_VAL) ? $columndatat->TOTAL_VAL : $columndata->Rate; 
                }
                else
                {
                    $result[0]['grand_total']=$columndata->Rate;
                }
                
            }
            else
            {
                $result[0]['grand_total']=0;
            }

            $loadability = $this->db->query("SELECT VEHICLE_LOAD_ABILITY FROM tbl_vehicle_master1 WHERE VEHICLE_NAME = '".$result[0]['VEH_NAME']."'")->row();
            //echo "SELECT Rate FROM `tbl_contract` WHERE `Destination` LIKE '%".$result[0]['CITY']."%' and Vehicle_Name = '".$result[0]['VEH_NAME']."'";
            if(!empty($loadability)){
                $result[0]['loadability']=$loadability->VEHICLE_LOAD_ABILITY;
            }
            else
            {
                $result[0]['loadability']=0;
            }
            
            return $result;
        }
        else{
            return false;
        }
    }


    public function contract_data($whereCond) {
        $this->db->select('*');
        $this->db->where($whereCond);
        $query = $this->db->from('tbl_contract')->get();
        
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }
        else{
            return false;
        }
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

    /*public function uploadCsvFile($query)
    {
        // if ($id == '') {
            // echo '<pre>';print_r($query);
            // $sql = "INSERT INTO tbl_test ([Transporter ID], [Transporter],[STP Code],[STP Name],[STP Location],[Billing Doc],[Billing Date],[LR.No],[Mns Transty],[Dist. Km],[Contract Rate],[Fuel Average],[Diesel Cost],[% Cost],[Freight Total],[Total bill Qty],[Box Qty]) VALUES $query";
            //$insert = $this->db->insert('tbl_test', $query);
        $lr_no=$query[21];
        $BILL_DT=$query[1];
        $VENDOR=$query[19];$TRANS_NAME=$query[20];$BOX_QTY_T=$query[14];$BILL_QTY_T=$query[13];$BILL_NO=$query[0];
            $sales_insert = $this->db->query("INSERT INTO tbl_sales (BILLING_DOC, BILL_DT,REF_NO,SHIP_TO_PARTY,NAME_SHIP_PARTY,SOLD_TO_PARTY,LCN_SHIP_PARTY,NAME_SOLD_PARTY,LCN_SOLD_PARTY,MAT_NO,MAT_DESC,HIE_NO,HIE_DESC,BILL_QTY,BOX_QTY,FRT_AFT_ST,CITY,COUNTRY_KEY,INCOTERMS,VENDOR,TRANS_NAME,LR_NO,STATE_NM_SHIP,STATE_NM_SOLD,GST_NO_SOLD,GST_NO_SHIP,VEH_NAME,VEH_NO,STATUS) VALUES (".$query[0].", '".$query[1]."','".$query[2]."', '".$query[3]."','".$query[4]."', '".$query[6]."','".$query[5]."','".$query[7]."','".$query[8]."', '".$query[9]."','".$query[10]."', '".$query[11]."','".$query[12]."', '".$query[13]."',".$query[14].",'".$query[15]."','".$query[16]."','".$query[17]."','".$query[18]."','".$query[19]."','".$query[20]."','".$query[21]."','".$query[22]."','".$query[23]."','".$query[24]."','".$query[25]."','".$query[26]."', '".$query[27]."','N')");

            $sale_id =   $this->db->insert_id();

            $query = $this->db->query("SELECT * from tbl_sales where ID ='".$sale_id."'");

            // echo '<pre>';print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->row();
            $EMP_LS=0;
            $total_val=0;

            $VEH_N = $result->VEH_NAME;

            switch ($VEH_N) {
              case "Cont.-20 Ft.":
                $column_name= 'Cont_20_Ft_360' ;
                $box_value=360;
                break;
              case "Tempo":
                $column_name= 'Tempo_407' ;
                $box_value=90;
                break;
              case "LCV-709":
                $column_name= 'LCV_709' ;
                $box_value=140;
                break;
              case "LCV":
                $column_name= 'LCV_17_Ft_200' ;
                $box_value=200;
                break;
                case "Truck.-19 Ft.":
                $column_name= 'Truck_19_Ft_240' ;
                $box_value=240;
                break;
              case "Cont.-19 Ft.":
                $column_name= 'Cont_19_Ft_240' ;
                $box_value=240;
                break;
              case "Cont.-32 Ft.":
                $column_name= 'Cont_32_Ft_620_7ton' ;
                $box_value=620;
                break;
                case "Cont.-32 Ft.9":
                $column_name= 'Cont_32_Ft_620_9ton' ;
                $box_value=620;
                break;
              
              default:
                $column_name= 'Pick_up' ;
                $box_value=100;
            }

            //echo "SELECT ".$column_name." FROM `tbl_contract` WHERE `destination` LIKE '%".$result->CITY."%'";
           
            $columndata = $this->db->query("SELECT ".$column_name." FROM `tbl_contract` WHERE `destination` LIKE '%".$result->CITY."%'")->result();
            foreach ($columndata as $keys) {
                foreach ($keys as $key => $value) {
                    
                    if ($key==$column_name) {
                    //echo $key."---".$column_name;
                    $columndata_new=$value;
                    
                    if($columndata_new=='-' || empty($columndata_new))
                    {
                        $EMP_LS=0;
                        $total_val=0;
                    }
                    else{
                        $columndata_new = str_replace(',', '', $columndata_new);
                        $EMP_LS=($columndata_new/$box_value) * ($box_value - $result->BOX_QTY);
                        $total_val=($columndata_new/$box_value) * ($result->BOX_QTY);
                    }
                }
                }
                
            }

            $trans_insert = $this->db->query("INSERT INTO transinvoice (LR_NO, BILL_DT,STATUS,SALES_ID,VENDOR,TRANS_NAME,BOX_QTY_T,BILL_QTY_T,BILL_NO,EMP_LS,TOTAL_VAL,LOADABILITY) VALUES ('".$lr_no."','".$BILL_DT."','N','".$sale_id."', '".$VENDOR."','".$TRANS_NAME."',".$BOX_QTY_T.",'".$BILL_QTY_T."',".$BILL_NO.",'".$EMP_LS."','".$total_val."','".$box_value."') ");
                

            }    // echo '<pre>';print_r($this->db->last_query());
            $insertAll = array(
                'sales_insert' => $sales_insert    
            );
            if ($insertAll) {
                $this->session->set_flashdata('success', 'Excel Data Imported into the Database..!');
                return $insertAll;
            }else {
                return false;
            }
    }*/

    public function uploadCsvFile($query)
    {
        // if ($id == '') {
            // $sql = "INSERT INTO tbl_test ([Transporter ID], [Transporter],[STP Code],[STP Name],[STP Location],[Billing Doc],[Billing Date],[LR.No],[Mns Transty],[Dist. Km],[Contract Rate],[Fuel Average],[Diesel Cost],[% Cost],[Freight Total],[Total bill Qty],[Box Qty]) VALUES $query";
            //$insert = $this->db->insert('tbl_test', $query);

            $FRT_AFT_ST=str_replace(',', '', $query[15]);
            $MAT_DESC=str_replace("'", "&#39;", $query[10]);
            $MAT_DESC=str_replace('"', '&#34;', $MAT_DESC);
            

            $sales_insert = $this->db->query("INSERT INTO tbl_sales (BILLING_DOC, BILL_DT,REF_NO,SHIP_TO_PARTY,NAME_SHIP_PARTY,SOLD_TO_PARTY,LCN_SHIP_PARTY,NAME_SOLD_PARTY,LCN_SOLD_PARTY,MAT_NO,MAT_DESC,HIE_NO,HIE_DESC,BILL_QTY,BOX_QTY,FRT_AFT_ST,CITY,COUNTRY_KEY,INCOTERMS,VENDOR,TRANS_NAME,LR_NO,STATE_NM_SHIP,STATE_NM_SOLD,GST_NO_SOLD,GST_NO_SHIP,VEH_NAME,VEH_NO,STATUS) VALUES (".$query[0].", '".$query[1]."','".$query[2]."', '".$query[3]."','".$query[4]."', '".$query[6]."','".$query[5]."','".$query[7]."','".$query[8]."', '".$query[9]."','".$MAT_DESC."', '".$query[11]."','".$query[12]."', '".$query[13]."',".$query[14].",'".$FRT_AFT_ST."','".$query[16]."','".$query[17]."','".$query[18]."','".$query[19]."','".$query[20]."','".$query[21]."','".$query[22]."','".$query[23]."','".$query[24]."','".$query[25]."','".$query[26]."', '".$query[27]."','N')");

            $sale_id =   $this->db->insert_id();

            $date = str_replace('/', '-', $query[1]);

            $bill = date("Y-m-d H:i:s", strtotime($date));

            $qty=str_replace(',', '', $query[13]);
            
            $trans_insert = $this->db->query("INSERT INTO TRANSINVOICE (LR_NO, BILL_DT,STATUS,SALES_ID,VENDOR,TRANS_NAME,BOX_QTY_T,BILL_QTY_T, UPDATED_BY) VALUES ('".$query[21]."','".$bill."','N',$sale_id, '".$query[19]."','".$query[20]."',".$query[14].",'".$qty."', '".$_SESSION['id']."') ");

            // echo '<pre>';print_r($this->db->last_query());
            $insertAll = array(
                'sales_insert' => $sales_insert,
                'trans_insert' => $trans_insert    
            );
            if ($insertAll) {
                $this->session->set_flashdata('success', 'Excel Data Imported into the Database..!');
                return $insertAll;
            }else {
                $this->session->set_flashdata('error', 'Please select valid file');
                return false;
            }
    }

    public function contractuploadCsvFile($query)
    {
        // if ($id == '') {
            // echo '<pre>';print_r($query);
            // $sql = "INSERT INTO tbl_test ([Transporter ID], [Transporter],[STP Code],[STP Name],[STP Location],[Billing Doc],[Billing Date],[LR.No],[Mns Transty],[Dist. Km],[Contract Rate],[Fuel Average],[Diesel Cost],[% Cost],[Freight Total],[Total bill Qty],[Box Qty]) VALUES $query";
            //$insert = $this->db->insert('tbl_test', $query);
            $contract_insert = $this->db->query("INSERT INTO tbl_contract (Vehicle_Name,Rate, Destination,UpdatedDate) VALUES ('".$query[0]."','".$query[1]."','".$query[2]."', '".$query[3]."')");

            $contract_id =   $this->db->insert_id();
            
            
            $insertAll = array(
                'contract_insert' => $contract_insert   
            );
            if ($insertAll) {
                $this->session->set_flashdata('success', 'Excel Data Imported into the Database..!');
                return $insertAll;
            }else {
                $this->session->set_flashdata('error', 'Please select valid file');
                return false;
            }
    }

    public function uploadBudgetFile($query)
    {
        $query[27]=str_replace(',', '', $query[27]);
        $query[28]=str_replace(',', '', $query[28]);
        $query[29]=str_replace(',', '', $query[29]);
        $query[30]=str_replace(',', '', $query[30]);
        $query[31]=str_replace(',', '', $query[31]);
        $query[32]=str_replace(',', '', $query[32]);
        $query[33]=str_replace(',', '', $query[33]);
        $query[34]=str_replace(',', '', $query[34]);
        $query[35]=str_replace(',', '', $query[35]);
        $query[36]=str_replace(',', '', $query[36]);
        $query[37]=str_replace(',', '', $query[37]);
        $query[38]=str_replace(',', '', $query[38]);
            $budget_insert = $this->db->query("INSERT INTO BUDGET (HIE_M_ID,YEAR, JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DEC,INCOT,PACK_SIZE,BOX_QTY,CONS_SIZE,FRT_PER_C,HIKE,FRT_PER_C_T, JAN_QTY,FEB_QTY,MAR_QTY,APR_QTY,MAY_QTY,JUN_QTY,JUL_QTY,AUG_QTY,SEP_QTY,OCT_QTY,NOV_QTY,DEC_QTY,SOLD_TO_PARTY) VALUES ('".$query[1]."','".$query[7]."', '".$query[8]."', '".$query[9]."', '".$query[10]."', '".$query[11]."', '".$query[12]."', '".$query[13]."', '".$query[14]."' , '".$query[15]."', '".$query[16]."', '".$query[17]."', '".$query[18]."', '".$query[19]."', '".$query[21]."', '".$query[22]."','".$query[20]."', '".$query[23]."', '".$query[24]."', '".$query[25]."', '".$query[26]."', '".$query[27]."', '".$query[28]."', '".$query[29]."', '".$query[30]."', '".$query[31]."', '".$query[32]."', '".$query[33]."', '".$query[34]."', '".$query[35]."', '".$query[36]."', '".$query[37]."', '".$query[38]."', '".$query[3]."')");

            if ($budget_insert) {
                $this->session->set_flashdata('success', 'Excel Data Imported into the Database..!');
                return $budget_insert;
            }else {
                return false;
            }
    }
    public function get_user($email)
    {
        
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
    public function save_password($postData, $id)
    {
        $insertData = array(
            'USER_old_PASS'  => $postData['old_pass'],
            'USER_PASS'  => $postData['new_pass'],
            'USER_EMAIL'   => $postData['USER_EMAIL'],
            'CREATED_AT' => date("Y-m-d H:i:s"),
            'IS_ACTIVE'  => 'Y',
            'IS_DELETED' => 'N',
        );
        if ($id == '') {
            $insert = $this->db->insert('tbl_user_details', $insertData);
            $this->session->set_flashdata('success', 'Record Inserted successfully..!');
            return $insert;
        }else {
            $updateData = array(
                'USER_old_PASS'  => $postData['old_pass'],
                'USER_PASS'  => $postData['new_pass'],
                'USER_EMAIL'   => $postData['USER_EMAIL'],
                'UPDATED_AT' => date("Y-m-d H:i:s"),
                'IS_ACTIVE'  => 'Y',
                'IS_DELETED' => 'N',
            );
            $update = $this->db->where('ID', $id)->update('tbl_user_details', $updateData);
            // print_r($this->db->last_query());die;
            $this->session->set_flashdata('success', 'Record Updated successfully..!');
            return $update;
        }
    }

}