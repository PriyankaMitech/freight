<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpSpreadsheet\Reader\Xlsx;
class Transport extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('TransportModel');
		// $this->load->library('excel');
    }
    
    public function transportal()
	{
		$getData = $this->TransportModel->getSales();
		$data = [
			'title_meta' =>  ['title' => 'Transportal'],
			'page_title' => ['title' => 'Transportal', 'li_1' => 'SmartHr', 'li_2' => 'Transportal'],
			'getSales'   => $getData
		];
		$this->load->view('transportal', $data);

	}
    
    public function transHistory()
	{
		$getData = $this->TransportModel->transHistory();
		$data = [
			'title_meta' =>  ['title' => 'Transportal History'],
			'page_title' => ['title' => 'Transportal History', 'li_1' => 'SmartHr', 'li_2' => 'Transportal History'],
			'getSales'   => $getData
		];
		$this->load->view('transHistory', $data);

	}
    
    public function save_trans($id)
	{
		$postData = $this->input->post();
		// echo '<pre>';print_r($postData);die;
		$getData = $this->TransportModel->save_trans($postData,$id);
		echo $getData;
	}
}