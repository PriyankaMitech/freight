<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('TransportModel');
        $this->load->model('ReportModel');
		$this->load->library('excel');
		if(!$this->session->userdata('isLoggedIn'))
            redirect(base_url("?/Login"));
        
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
		$start_date='';
		$end_date='';		
		//$whereCon = array('TR.STATUS !=' => '');
		$whereCon = ("TR.STATUS != ''");
		$report='';

		if($this->input->post('report') != ''){
			$report=$this->input->post('report');
		}
		if ($this->input->post('start_date') != '') {
            $start_date = date('d/m/Y',strtotime($this->input->post('start_date')));
            //$whereCon = array_merge($whereCon, array('TR.BILL_DT >='=> CONVERT(datetime, $start_date , 103) ));
			$whereCon .= " and TR.BILL_DT >= CONVERT(datetime, '".$start_date."' , 103)";
            $data['start_date'] = $this->input->post('start_date');
        }
        if ($this->input->post('end_date') != '') {
            $end_date=date('d/m/Y',strtotime($this->input->post('end_date')));
            //$whereCon = array_merge($whereCon, array('TR.BILL_DT <= '=> CONVERT(datetime, date('d/m/Y',strtotime($this->input->post('end_date'))), 103) ));
			$whereCon .= " and TR.BILL_DT <= CONVERT(datetime, '".$end_date."' , 103)";
            $data['end_date'] = $this->input->post('end_date');
        }
		// echo "hiii";exit();
		$getDetentio = $this->ReportModel->getDetention();
		$getTransporter = $this->ReportModel->getTransporter($whereCon);
		// echo 'pre';die;
		// echo "string".$this->db->last_query();die();
		$getCustomer = $this->ReportModel->getCustomer($whereCon);
		$getCostvsRecovery = $this->ReportModel->getCostvsRecovery($whereCon);	
		$getData = $this->TransportModel->getDetention();
		
		$data = [

			'title_meta' =>  ['title' => 'Dashboard'],

			'page_title' => ['title' => 'Dashboard', 'li_1' => 'SmartHr', 'li_2' => 'Dashboard'],

			'report' => $report,
			
			'getSales'     => $getDetentio,

			'getTransporter'     => $getTransporter,

			'getCustomer'     => $getCustomer,

			'getCostvsRecovery'     => $getCostvsRecovery,

			'end_date' => $end_date,

			'start_date' => $start_date

		];

		$this->load->view('reports1', $data);

	}

	public function transcred()

	{		
		$getData = $this->TransportModel->transcred();
		$data = [

			'title_meta' =>  ['title' => 'Dashboard'],

			'page_title' => ['title' => 'Dashboard', 'li_1' => 'SmartHr', 'li_2' => 'Dashboard'],
			
			'gettranscred'     => $getData

		];

		$this->load->view('Transcred', $data);

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
    	$getData = $this->UserModel->getkilometer();
        $data = [

			'title_meta' => ['title' => 'Kilometer Master'],

			'page_title' => ['title' => 'Kilometer Master', 'li_1' => 'SmartHr', 'li_2' => 'Kilometer Master'],

			'getkilometer'     => $getData

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
        $id = $this->input->post('ID');
		
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

	public function add_kilometer()
    {
        $data = [

			'title_meta' => ['title' => 'Add kilometer'],

			'page_title' => ['title' => 'Add kilometer', 'li_1' => 'SmartHr', 'li_2' => 'Add kilometer']

		];
        $this->load->view('add-kilometer', $data);
    }
	
	public function save_kilometer()
    {
        $id = $this->input->post('ID');
		
		$postData = $this->input->post();
		// $validation =  \Config\Services::validation();
		// $validation->setRules([
		// 	'org-name' => 'required|string',
		// 	'org_email' => 'required|valid_email'
		// ]);
		// $res = $validation->withRequest($this->request)->run();
		
		// $model = new userModel();
		// $session = \Config\Services::session();
		$data = $this->UserModel->savekilometer($postData, $id);
		
		$data = [
			'title_meta' => ['title' => 'kilometer'],
		];

		return redirect('home/add_kilometer', $data);
    }

	public function edit_kilometer($id)
	{
		$model = new userModel();
		$editData = $model->edit_kilometer($id);
		$data = [
			'title_meta' => ['title' => 'Edit kilometer'],
			'edit' => $editData
		];

		$this->load->view('add-kilometer', $data);
	}

	public function delete_kilometer($id)
	{
		$deleteData = $this->UserModel->delete_kilometer($id);
		return redirect('kilometer_master');
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

	public function Master_LR()
    {
    	$getData = $this->UserModel->Master_LR();
        $data = [

			'title_meta' => ['title' => 'Delete LR'],

			'page_title' => ['title' => 'Delete LR', 'li_1' => 'SmartHr', 'li_2' => 'Delete LR'],

			'getlr'     => $getData

		];
        $this->load->view('Delete_lrno', $data);
    }

		public function delete_LR_NO()
		{
			$id = $this->uri->segment(2);

			// echo $id;exit();
			$deleteData = $this->UserModel->delete_LR_NO($id);
			return redirect('delete_lr');
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
				// 'application/vnd.ms-excel',
				// 'text/xls',
				// 'text/xlsx',
				// 'text/csv',
				// 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
				'text/x-comma-separated-values',
				'text/comma-separated-values',
				'application/octet-stream',
				'application/vnd.ms-excel',
				'application/x-csv',
				'text/x-csv',
				'text/csv',
				'application/csv',
				'application/excel',
				'application/vnd.msexcel',
				'text/plain'
			];
		
			if (in_array($_FILES["file"]["type"], $allowedFileType)) {
		
				$targetPath = 'uploads/' . $_FILES['file']['name'];
				move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
		
				$Reader = new \PhpSpreadsheet\Reader\Xlsx();
		
			echo '<pre>';print_r($targetPath);die;
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

	public function salesregisterdownload()
	{
			
		$filename = 'salesregister_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   
		   
		   $file = fopen('php://output', 'w');
		 
		   $header = array("Billing Document","Billing Date","Reference","Ship-to party","Name of the ship-to party", "Location of the ship-to party",	"Sold-to party",	"Sold-to party Name",	"Location of the sold-to party",	"Material",	"Description",	"Product hierarchy",	"Product Hierarchy Description",	"Billed Quantity",	"No of Boxes",	"Freight Aft .ST",	"City",	"Country Key",	"Incoterms",	"Vendor",	"Transporter Name",	"Lr. Number",	"State Ship-to party",	"State Sold-to party",	"GST number Sold to Party",	"GST number Ship to Party",	"Vehicle Name",	"Vehicle NO"); 
		   fputcsv($file, $header);
		   
		   fclose($file); 
		   exit; 
		
	}

	public function contractdownload()
	{
			
		$filename = 'contract_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   
		   
		   $file = fopen('php://output', 'w');
		 
		   $header = array(	"Vehicle Name",	"Rate", "Destination", "UpdatedDate"); 
		   fputcsv($file, $header);
		   
		   fclose($file); 
		   exit; 
		
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
    $data['trans_name'] = '';
    $data['start_date'] = '';
    $data['end_date'] = '';

    if (isset($_POST['submit'])) {
        $postData = $this->input->post();
        $getData = $this->TransportModel->save_trans_knowoff($postData);
    }

    $whereCon = "TR.STATUS != 'K'";

    if ($this->input->post('trans_name') != '' && $this->input->post('trans_name') != 'Select Transport') {
        $whereCon .= " and SA.TRANS_NAME = '" . $this->input->post('trans_name') . "'";
        $data['trans_name'] = $this->input->post('trans_name');
    }

    if ($this->input->post('start_date') != '') {
        $start_date = date('d/m/Y', strtotime($this->input->post('start_date')));
        $whereCon .= " and TR.BILL_DT >= STR_TO_DATE('" . $start_date . "', '%d/%m/%Y')";
        $data['start_date'] = $this->input->post('start_date');
    }

    if ($this->input->post('end_date') != '') {
        $end_date = date('d/m/Y', strtotime($this->input->post('end_date')));
        $whereCon .= " and TR.BILL_DT <= STR_TO_DATE('" . $end_date . "', '%d/%m/%Y')";
        $data['end_date'] = $this->input->post('end_date');
    }

    $data['getData'] = $this->UserModel->getSAP($whereCon);
    $data['getTRANS_NAME'] = $this->UserModel->getdistinctvalue();

    $this->load->view('cost_statement', $data);
}


	public function getSAPwithid()
	{
		$id = $_POST["Id"];
		$STATUS = $_POST["STATUS"];
		$getData = $this->UserModel->getSAPwithid($id,$STATUS);
		// echo "<pre>";print_r($getData);exit();
		echo json_encode($getData);
	}

	public function contract_data()
	{
		$Vehicle_Name = $_POST["Vehicle_Name"];
		$Destination = $_POST["Destination"];
		$whereCon='';
		if($Destination != '')
		$whereCon .= " Destination LIKE '%".$Destination."%'";
		if($Vehicle_Name != '')
		$whereCon .= " and Vehicle_Name LIKE '%".$Vehicle_Name."%'";
		$getData = $this->UserModel->contract_data($whereCon);
		echo json_encode($getData);
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

	public function test_query()
	{
		$query = $this->db->query("SELECT SUM(TR.FREIGHT_T) as FREIGHT_T, SUM(TR.FREIGHT) as FREIGHT, `SA`.`NAME_SHIP_PARTY`, `DETENTION`, `DETN_NOTE`, `SA`.`VENDOR`, `TR`.`BILL_QTY_T`, `TR`.`BOX_QTY_T`, `SA`.`VEH_NAME`, `SA`.`VEH_NO`, `SA`.`COUNTRY_KEY`, `SA`.`INCOTERMS`, `TR`.`VENDOR`, `TR`.`TRANS_NAME`, `SA`.`GST_NO_SOLD`, `SA`.`GST_NO_SHIP`, `SA`.`STATE_NM_SOLD`, `TR`.`SALES_ID`, `TR`.`REP_DT`, `TR`.`UNL_DT`, count(SA.VEH_NAME) as vehiclecount, COUNT(IF(TR.PENALTY > 0, 1, NULL)) 'PENALTY', COUNT(IF(TR.PENALTY <= 0, 1, NULL)) 'NOPENALTY', IF((timestampdiff(DAY, `TR`.`REP_DT`, TR.UNL_DT)) > 0, timestampdiff(DAY, `TR`.`REP_DT`, TR.UNL_DT), 0) 'delaydays' FROM `transinvoice` `TR` JOIN `tbl_sales` `SA` ON `TR`.`SALES_ID`=`SA`.`ID` WHERE `TR`.`STATUS` != '' AND `TR`.`BILL_DT` >= '01/01/2023' AND `TR`.`BILL_DT` <= '29/01/2023' GROUP BY `SA`.`NAME_SHIP_PARTY`")->result();
		 echo '<pre>';print_r($query);die;
	}
	public function ChangePassword()
    {
		$get_user_details = $this->UserModel->get_user($this->session->userdata("email"));
        $data = [

			'title_meta' => ['title' => 'Change Password'],
			'title' => 'Change Password',
			'edit' => $get_user_details

		];
        $this->load->view('Change_password', $data);
    }
	
	public function save_password()
    {
        $id = $this->input->post('id');
		
		$postData = $this->input->post();
		$data = $this->UserModel->save_password($postData, $id);
		
		$data = [
			'title_meta' => ['title' => 'Zone master'],
		];

		return redirect('ChangePassword', $data);
    }

	public function excel()
	{
		$this->load->library('excel');
		$setacativesheet = $this->excel->setActiveSheetIndex(0);

		//name the worksheet
		$yourdata = [0 => 
			['id' => 1, 'menu_id' => 12, 'title' => 'Register Domain name for free','sub_title' => 'This is the subtitle', 'content' => 'this content', 'description' => 'description', 'section' => 'sect'],
			1 => ['id' => 1, 'menu_id' => 12, 'title' => 'Register Domain name for free','sub_title' => 'This is the subtitle', 'content' => 'this content', 'description' => 'description', 'section' => 'sect']
		];
			$i = 0;
			foreach($yourdata as $key => $val)
			{
				$val1[$i] = $val;
				$i++;
					// echo '<pre>';
				foreach($val1 as $key2 => $newVal)
				{
					$title[$i] = $newVal;
				}
			}
					// print_r($newVal);
				foreach($newVal as $key3 => $newVal1)
				{
					// print_r($key3);
					//or echo it echo $key2 and echo $newVal
				}
		$title = $this->excel->getActiveSheet()->setTitle('Countries');
		//retrive contries table data
		$rs = $this->db->get('TRANSINVOICE');
		$exceldata=[];
		// $i = 0;
		$A = 'A';
		$num = 4;
		foreach ($rs->result_array() as $key=>$value){
			// $exceldata = $row;
			$A++;
			$cell = $A.$num;
			$valnew[$i] = $value;
			$i++;
			foreach ($valnew as $key1 => $value1) {
				$title1[$i] = $value1;
			}
		// $this->excel->getActiveSheet()->setCellValue(''.$cell.'', ''.$key3.'');
		}
		$a = 'A';
			foreach($value1 as $key3 => $newVal1)
				{
					$a++;
					$cell = $a.$num;
					//or echo it echo $key2 and echo $newVal
					// echo '<pre>';print_r($cell);
					$test = $this->excel->getActiveSheet()->setCellValue(''.$cell.'', ''.$key3.'');
				}
		//set cell A1 content with some text
		// $this->excel->getActiveSheet()->setCellValue('A1', 'Country Excel Sheet');
		// $this->excel->getActiveSheet()->setCellValue('A4', 'S.No.');
		// $this->excel->getActiveSheet()->setCellValue('B4', 'Country Code');
		// $this->excel->getActiveSheet()->setCellValue('C4', 'Country Name');
		
		//set aligment to center for that merged cell (A1 to C1)
		//$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//make the font become bold
		// $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		// $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		// $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
		// for($col = ord('A'); $col <= ord('C'); $col++){ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
		//change the font size
		// $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

		// $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// }
		//Fill data
		$index = 4;
		foreach ($rs->result_array() as $row){
			$index++;
			$exceldata = $row;
			// echo '<pre>';print_r($exceldata);
			$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A'.$index.'');
		}
		// $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A5');

		// // $this->excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// // $this->excel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// // $this->excel->getActiveSheet()->getStyle(‘C4′)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$filename='PHPExcelDemo.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
}