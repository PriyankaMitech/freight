<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpSpreadsheet\Reader\Xlsx;
class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('TransportModel');
		// $this->load->library('excel');
    }

    public function index()

	{		

		$data = [

			'title_meta' =>  ['title' => 'Dashboard'],

			'page_title' => ['title' => 'Dashboard', 'li_1' => 'SmartHr', 'li_2' => 'Dashboard']

		];

		$this->load->view('login', $data);

	}

    public function dashboard()

	{		

		$data = [

			'title_meta' =>  ['title' => 'Dashboard'],

			'page_title' => ['title' => 'Dashboard', 'li_1' => 'SmartHr', 'li_2' => 'Dashboard']

		];

		$this->load->view('dashboard', $data);

	}

    public function transport_master()
    {
		// $getOrganization = $this->request->getVar('billType');
		$getData = $this->UserModel->getTransport();
        // print_r($getData);die;
        $data = [

			'title_meta' => ['title' => 'Transport Master'],

			'page_title' => ['title' => 'Transport Master', 'li_1' => 'SmartHr', 'li_2' => 'Transport Master'],
			
			'getTransport'     => $getData

		];
        $this->load->view('transport_master', $data);
    }
	
	public function vehicle_master()
    {
		$getData = $this->UserModel->getVehicle();

        $data = [

			'title_meta' => ['title' => 'Vehicle Master'],

			'page_title' => ['title' => 'Vehicle Master', 'li_1' => 'SmartHr', 'li_2' => 'Vehicle Master'],

			'getVehicle'     => $getData

		];
        $this->load->view('vehicle_master', $data);
    }
	
	public function zone_master()
    {
		$model = new UserModel();
		$getData = $model->getZone();

        $data = [

			'title_meta' => ['title' => 'Zone Master'],

			'page_title' => ['title' => 'Zone Master', 'li_1' => 'SmartHr', 'li_2' => 'Zone Master'],

			'getZone' => $getData

		];
        $this->load->view('zone_master', $data);
    }	
	
	public function diesel_master()
    {
		$model = new UserModel();
		$getData = $model->getDieselrate();

        $data = [

			'title_meta' => ['title' => 'Diesel Master'],

			'page_title' => ['title' => 'Diesel Master', 'li_1' => 'SmartHr', 'li_2' => 'Diesel Master'],

			'getDieselRate'     => $getData

		];
        $this->load->view('diesel_master', $data);
    }
	public function kilometer_master()
    {
        $data = [

			'title_meta' => ['title' => 'Kilometer Master'],

			'page_title' => ['title' => 'Kilometer Master', 'li_1' => 'SmartHr', 'li_2' => 'Kilometer Master'],

		];
        $this->load->view('kilometer_master', $data);
    }
	public function contract_master()
    {
        $data = [

			'title_meta' => ['title' => 'Contract Master'],

			'page_title' => ['title' => 'Contract Master', 'li_1' => 'SmartHr', 'li_2' => 'Contract Master'],

		];
        $this->load->view('contract_master', $data);
    }
	
	public function add_transporter()
    {
        $data = [

			'title_meta' => ['title' => 'Add transporter'],

			'page_title' => ['title' => 'Add transporter', 'li_1' => 'SmartHr', 'li_2' => 'Add transporter']

		];
        $this->load->view('add-transporter', $data);
    }
	
	public function save_transporter()
    {
        $id = $this->input->post('id');
		
		$postData = $this->input->post();
		// $validation =  \Config\Services::validation();
		// $validation->setRules([
		// 	'org-name' => 'required|string',
		// 	'org_email' => 'required|valid_email'
		// ]);
		// $res = $validation->withRequest($this->request)->run();
		
		// $model = new userModel();
		// $session = \Config\Services::session();
		$data = $this->UserModel->saveTransporter($postData, $id);
		
		$data = [
			'title_meta' => ['title' => 'Transporter'],
		];

		return redirect('transport_master', $data);
    }

	public function edit_transporter($id)
	{
		$model = new userModel();
		$editData = $model->edit_transporter($id);
		$data = [
			'title_meta' => ['title' => 'Edit Transporter'],
			'edit' => $editData
		];

		$this->load->view('add-transporter', $data);
	}

	public function delete_transporter($id)
	{
		$deleteData = $this->UserModel->delete_transporter($id);
		return redirect('transport_master');
	}
	
	public function add_vehicle()
    {
        $data = [

			'title_meta' => ['title' => 'Add vehicle'],
			'title' => 'Add Vehicle',

			'page_title' => ['title' => 'Add vehicle', 'li_1' => 'SmartHr', 'li_2' => 'Add vehicle']

		];
        $this->load->view('add_vehicle', $data);
    }
	
	public function save_vehicle()
    {
        $id = $this->input->post('id');
		
		$postData = $this->input->post();
		$data = $this->UserModel->saveVehicle($postData, $id);
		
		$data = [
			'title_meta' => ['title' => 'Vehicle'],
		];

		return redirect('vehicle_master', $data);
    }

	public function edit_vehicle($id)
	{
		$model = new userModel();
		$editData = $model->edit_vehicle($id);
		$data = [
			'title_meta' => ['title' => 'Edit Vehicle'],
			'title' => 'Update Vehicle',
			'edit' => $editData
		];
		$this->load->view('add_vehicle', $data);
	}

	public function delete_vehicle($id)
	{
		$deleteData = $this->UserModel->delete_vehicle($id);
		return redirect('vehicle_master');
	}
	
	public function add_dieselrate()
    {
        $data = [

			'title_meta' => ['title' => 'Add Diesel Rate'],
			'title' => 'Add Diesel Rate',

			'page_title' => ['title' => 'Add Diesel Rate', 'li_1' => 'SmartHr', 'li_2' => 'Add Diesel Rate']

		];
        $this->load->view('add_dieselrate', $data);
    }
	
	public function save_dieselrate()
    {
        $id = $this->input->post('id');
		
		$postData = $this->input->post();
		$data = $this->UserModel->saveDieselrate($postData, $id);
		
		$data = [
			'title_meta' => ['title' => 'Diesel master'],
		];

		return redirect('diesel_master', $data);
    }

	public function edit_dieselrate($id)
	{
		$model = new userModel();
		$editData = $model->edit_dieselrate($id);
		$data = [
			'title_meta' => ['title' => 'Edit Rate'],
			'title' => 'Update Diesel Rate',
			'edit' => $editData
		];
		$this->load->view('add_dieselrate', $data);
	}
	
	public function add_zone()
    {
        $data = [

			'title_meta' => ['title' => 'Add Zone'],
			'title' => 'Add Zone',

			'page_title' => ['title' => 'Add Zone', 'li_1' => 'SmartHr', 'li_2' => 'Add Zone']

		];
        $this->load->view('add_zone', $data);
    }
	
	public function save_zone()
    {
        $id = $this->input->post('id');
		
		$postData = $this->input->post();
		$data = $this->UserModel->saveZone($postData, $id);
		
		$data = [
			'title_meta' => ['title' => 'Zone master'],
		];

		return redirect('zone_master', $data);
    }

	public function edit_zone($id)
	{
		$model = new userModel();
		$editData = $model->edit_zone($id);
		$data = [
			'title_meta' => ['title' => 'Edit Zone'],
			'title' => 'Update Zone ',
			'edit' => $editData
		];
		$this->load->view('add_zone', $data);
	}

	public function sales_register()
	{
		$data = [
			'title_meta' => ['title' => 'Sales Register'],
			'title' => 'Sales Register'
		];
		$this->load->view('sales_register', $data);
	}

	public function salesregisterupload()
	{
		if (isset($_POST["import"])) {

			$allowedFileType = [
				'application/vnd.ms-excel',
				'text/xls',
				'text/xlsx',
				'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
			];
		
			if (in_array($_FILES["file"]["type"], $allowedFileType)) {
		
				$targetPath = 'uploads/' . $_FILES['file']['name'];
				move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
		
				$Reader = new \PhpSpreadsheet\Reader\Xlsx();
		
				$spreadSheet = $Reader->load($targetPath);
				$excelSheet = $spreadSheet->getActiveSheet();
				$spreadSheetAry = $excelSheet->toArray();
				$sheetCount = count($spreadSheetAry);
		
				for ($i = 0; $i <= $sheetCount; $i ++) {
					$name = "";
					if (isset($spreadSheetAry[$i][0])) {
						$name = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
					}
					$description = "";
					if (isset($spreadSheetAry[$i][1])) {
						$description = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
					}
		
					if (! empty($name) || ! empty($description)) {
						$query = "insert into tbl_info(name,description) values(?,?)";
						$paramType = "ss";
						$paramArray = array(
							$name,
							$description
						);
						$insertId = $db->insert($query, $paramType, $paramArray);
		
						if (! empty($insertId)) {
							$type = "success";
							$message = "Excel Data Imported into the Database";
						} else {
							$type = "error";
							$message = "Problem in Importing Excel Data";
						}
					}
				}
			} else {
				$type = "error";
				$message = "Invalid File Type. Upload Excel File.";
			}
		}
	}

	public function reports()
	{
		$getData = $this->TransportModel->getDetention();
		$data = [
			'title_meta' => ['title' => 'Reports'],
			'title' => 'Reports',
			'getSales'     => $getData
		];
		$this->load->view('reports', $data);
	}

	public function budget_up()
	{
		$data = [
			'title_meta' => ['title' => 'Budget up'],
			'title' => 'Budget up'
		];
		$this->load->view('budget_up', $data);
	}

	public function cost_statement()
	{
		$data = [
			'title_meta' => ['title' => 'Cost allocation screen'],
			'title' => 'Cost allocation screen'
		];
		$this->load->view('cost_statement', $data);
	}

	public function detention_report()
	{
		$getData = $this->TransportModel->transHistory();
		$data = [
			'title_meta' => ['title' => 'Detention Report'],
			'title' => 'Detention Report',
			'getSales'     => $getData
		];
		$this->load->view('detention_report', $data);
	}
}