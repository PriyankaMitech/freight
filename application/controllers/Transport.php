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
		if(!$this->session->userdata('isLoggedIn'))
            redirect(base_url("?/Login"));
    }
    
	public function transportal()
	{
		$whereCon = "TR.STATUS != ''";
		$start_date = '';
		$end_date = '';
	
		if ($this->input->post('start_date') != '') {
			$start_date = date('d/m/Y', strtotime($this->input->post('start_date')));
			$whereCon .= " AND TR.BILL_DT >= STR_TO_DATE('$start_date', '%d/%m/%Y')";
		}
	
		if ($this->input->post('end_date') != '') {
			$end_date = date('d/m/Y', strtotime($this->input->post('end_date')));
			$whereCon .= " AND TR.BILL_DT <= STR_TO_DATE('$end_date', '%d/%m/%Y')";
		}
	
		$getData = $this->TransportModel->getSales($whereCon);

		// echo "<pre>";print_r($getData);exit();
	
		$data = [
			'end_date' => $end_date,
			'start_date' => $start_date,
			'title_meta' => ['title' => 'Transportal'],
			'page_title' => ['title' => 'Transportal', 'li_1' => 'SmartHr', 'li_2' => 'Transportal'],
			'getSales'   => $getData
		];
	
		$this->load->view('transportal', $data);
	}
	public function get_sales(){
		$whereCon = "TR.STATUS != ''";
		$start_date = '';
		$end_date = '';
	
		if ($this->input->post('start_date') != '') {
			$start_date = date('d/m/Y', strtotime($this->input->post('start_date')));
			$whereCon .= " AND TR.BILL_DT >= STR_TO_DATE('$start_date', '%d/%m/%Y')";
		}
	
		if ($this->input->post('end_date') != '') {
			$end_date = date('d/m/Y', strtotime($this->input->post('end_date')));
			$whereCon .= " AND TR.BILL_DT <= STR_TO_DATE('$end_date', '%d/%m/%Y')";
		}
	
		$getData = $this->TransportModel->getSales($whereCon);

		header('Content-Type: application/json');
		echo json_encode($getData);
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
	// public function TransView()
	// {
	// 	// print_r($_SESSION['id']);die();
	// 	//$whereCon = array('TR.STATUS' => 'K');
	// 	$whereCon = ("TR.STATUS != ''");
	// 	$Transporter_Code='';
	// 	$start_date='';
	// 	$end_date='';
	// 	if ($this->input->post('Transporter_Code') != '') {
            
    //         //$whereCon = array_merge($whereCon, array('SA.VENDOR'=>$this->input->post('Transporter_Code')));
	// 		$whereCon .= " and SA.VENDOR = '".$this->input->post('Transporter_Code')."'";
    //         $Transporter_Code = $this->input->post('Transporter_Code');
    //     }
	// 	if ($this->input->post('start_date') != '') {
    //         $start_date = date('d/m/Y',strtotime($this->input->post('start_date')));
    //         //$whereCon = array_merge($whereCon, array('TR.BILL_DT >='=> CONVERT(datetime, $start_date , 103) ));
	// 		$whereCon .= " and TR.BILL_DT >= CONVERT(datetime, '".$start_date."' , 103)";
    //         $data['start_date'] = $this->input->post('start_date');
    //     }
    //     if ($this->input->post('end_date') != '') {
    //         $end_date=date('d/m/Y',strtotime($this->input->post('end_date')));
    //         //$whereCon = array_merge($whereCon, array('TR.BILL_DT <= '=> CONVERT(datetime, date('d/m/Y',strtotime($this->input->post('end_date'))), 103) ));
	// 		$whereCon .= " and TR.BILL_DT <= CONVERT(datetime, '".$end_date."' , 103)";
    //         $data['end_date'] = $this->input->post('end_date');
    //     }
	// 	$getData = $this->TransportModel->TransView($whereCon);
	// 	// echo '<pre>';echo $this->db->last_query();die();
	// 	// echo 'pre';die;
	// 	$data = [
	// 		'end_date' => $end_date,
	// 		'Transporter_Code' => $Transporter_Code,
	// 		'start_date' => $start_date,
	// 		'title_meta' =>  ['title' => 'Transportal History'],
	// 		'page_title' => ['title' => 'Transportal History', 'li_1' => 'SmartHr', 'li_2' => 'Transportal History'],
	// 		'getSales'   => $getData
	// 	];
	// 	//echo "<pre>";print_r($data); echo $this->db->last_query();die();
	// 	$this->load->view('TransView', $data);

	// }


	public function TransView()
{
    // Initialize default conditions
    $whereCon = "TR.STATUS != ''";
    $Transporter_Code = '';
    $start_date = '';
    $end_date = '';

    // Check and add conditions based on form inputs
    if ($this->input->post('Transporter_Code') != '') {
        $whereCon .= " AND SA.VENDOR = '" . $this->input->post('Transporter_Code') . "'";
        $Transporter_Code = $this->input->post('Transporter_Code');
    }

    if ($this->input->post('start_date') != '') {
        $start_date = date('d/m/Y', strtotime($this->input->post('start_date')));
        $whereCon .= " AND TR.BILL_DT >= STR_TO_DATE('" . $start_date . "', '%d/%m/%Y')";
    }

    if ($this->input->post('end_date') != '') {
        $end_date = date('d/m/Y', strtotime($this->input->post('end_date')));
        $whereCon .= " AND TR.BILL_DT <= STR_TO_DATE('" . $end_date . "', '%d/%m/%Y')";
    }

    // Fetch data from the model
    $getData = $this->TransportModel->TransView($whereCon);

    // Prepare data for view
    $data = [
        'end_date' => $end_date,
        'Transporter_Code' => $Transporter_Code,
        'start_date' => $start_date,
        'title_meta' => ['title' => 'Transportal History'],
        'page_title' => ['title' => 'Transportal History', 'li_1' => 'SmartHr', 'li_2' => 'Transportal History'],
        'getSales'   => $getData
    ];

    // Load view
    $this->load->view('TransView', $data);
}
    
    public function save_trans($id)
	{
		$postData = $this->input->post();
		// print_r($postData);die;
		$getData = $this->TransportModel->save_trans($postData,$id);
		echo $getData;
	}

	public function edit_trans($id)
	{
		$postData = $this->input->post();
		// print_r($id);die;
		$getData = $this->TransportModel->edit_trans($id);
		echo $getData;
	}

	public function save_temp_trans()
	{
		$postData = $this->input->post();
		// echo "<pre>";print_r($postData);exit();
		$getData = $this->TransportModel->save_temp_trans($postData);
		echo $getData;
	}

	public function save_trans_knowoff()
	{
		$postData = $this->input->post();
		// echo '<pre>';print_r($postData);die;
		$getData = $this->TransportModel->save_trans_knowoff($postData);
		//  $this->load->view();
		return redirect('cost_statement');
	}

	public function download($file) {
    $path = "./assets/pod/".$file;
    if (file_exists($path)) {
        $size = filesize($path);
        header('Content-Description: File Transfer');
        header('Content-Type: application/force-download');
        header('Content-Disposition: attachment; filename="' . basename($path) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . $size);
        ob_clean();
        flush();
        readfile($path);
        exit;
    } else {
        echo "File not found!";
    }
}

}