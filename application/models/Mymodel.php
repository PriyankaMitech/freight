
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends CI_Model {

        
    public function contractdatacheck($VEH_N, $destination) {
        $this->db->select('Rate');
        $this->db->from('tbl_contract');
        $this->db->where('Vehicle_Name', $VEH_N);
        $this->db->like('Destination', $destination);

        $query = $this->db->get();
        // print_r($this->db->last_query());
        if($query->num_rows() > 0){
            $result = $query->row();
            return $result;
        }
        else{
            return false;
        }
    }
    public function kilometerdatacheck($destination) {
        // print_r($destination);die;
        $query = $this->db->query("SELECT `transit_time` FROM `tbl_kilometer` WHERE `destination` LIKE '%".trim($destination)."%' ");
        // $this->db->select('transit_time');
        // $this->db->from('tbl_kilometer');
        // $this->db->like('destination', $destination);
        // $query = $this->db->get();
        // print_r($this->db->last_query());
        // echo ';<br>';
        if($query->num_rows() > 0){
            $result = $query->row();
            return $result;
        }
        else{
            return false;
        }
    }
    public function duplicatedatacheck($REF_NO) {
        $this->db->select('REF_NO');
        $this->db->from('tbl_sales');
        $this->db->where('REF_NO', $REF_NO);
        $query = $this->db->get();
        // print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            $result = $query->row();
            return $result;
        }
        else{
            return false;
        }
    }
    
}