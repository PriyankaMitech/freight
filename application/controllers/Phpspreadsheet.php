<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpSpreadsheet\Spreadsheet;
use PhpSpreadsheet\Writer\Xlsx;
class Phpspreadsheet extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('Mymodel');
		// $this->load->library('PhpSpreadsheet\Writer\Xlsx');
		$this->load->library('Excel');
	}
	public function index(){
		$this->load->view('spreadsheet');
	}
	public function export(){
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Hello World !');
		$writer = new Xlsx($spreadsheet);
		$filename = 'name-of-the-generated-file';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output'); /* download file */
		}
		public function import(){
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		if(isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
		$arr_file = explode('.', $_FILES['upload_file']['name']);
		$extension = end($arr_file);
		if('csv' == $extension){
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} else {
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetData = $spreadsheet->getActiveSheet()->toArray();
		echo "<pre>";
		print_r($sheetData);
		}
	}
    public function salesregisterupload()
	{


		if (isset($_POST['import']))
		{
		
			$fileMimes = array(
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
			);
			
			if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
			{
				$csvFile1 = fopen($_FILES['file']['tmp_name'], 'r');
				fgetcsv($csvFile1);
				$error = '';
				while (($getData1 = fgetcsv($csvFile1, 10000, ",")) !== FALSE)
				{
					// echo $getData1[21];
					// echo "<pre>";print_r($getData1);exit();

					if (empty($getData1[21])) {
						$error = "LR Number is not available in the CSV file. Please provide LR Number for all records.";
						if ($error != '')
						{
							$this->session->set_flashdata('error', $error);
							fclose($csvFile1);  // Close the file before redirecting
							return redirect('sales_register');
						}
					}

					// Rest of your code...
				

	
				 	$contractData = $this->Mymodel->contractdatacheck($getData1[26],$getData1[5]);
					$kilometerData = $this->Mymodel->kilometerdatacheck($getData1[5]);
					$duplicateData = $this->Mymodel->duplicatedatacheck($getData1[2]);
					if($contractData == null)
					{
						$error = "Contract or contract amount not found for ".$getData1[26]." ".$getData1[5]." in contract master <br>";
						if($error != '')
						{
							$this->session->set_flashdata('error', $error);
								
							return redirect('sales_register');
						}
						
					}
					if($kilometerData == null )
					{
						$error = "Transit time not available for destination ".$getData1[5]." in kilometer master <br>";
						if($error != '')
						{
							$this->session->set_flashdata('error', $error);
								
							return redirect('sales_register');
						}
						
					}
					if($duplicateData != null )
					{
						$error = "Duplicate record found for invoice no. ".$getData1[2]." <br>";
						if($error != '')
						{
							$this->session->set_flashdata('error', $error);
								
							return redirect('sales_register');
						}
					}
					
				
				}
				fclose($csvFile1);  // Close the file after the loop

				if ($errorOccurred) {
					return redirect('sales_register');
				}
				
				$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
				fgetcsv($csvFile);
				while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
				{
					$saveData = $this->UserModel->uploadCsvFile($getData);	
				}
				fclose($csvFile);
	
				return redirect('sales_register');
				
			}
			else
			{
				$this->session->set_flashdata('error', 'Please select valid file');
				
				return redirect('sales_register');
			}
		}



		// echo 'excel';die;
		// if (isset($_POST["import"])) {

		// 	$allowedFileType = [
		// 		'application/vnd.ms-excel',
		// 		'text/xls',
		// 		'text/xlsx',
		// 		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
		// 	];
		
		// 	if (in_array($_FILES["file"]["type"], $allowedFileType)) {
		
		// 		$targetPath = 'uploads/' . $_FILES['file']['name'];
		// 		move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
		
		// 		$Reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		// 		// ini_set('memory_limit', '-1');
		// 		$spreadSheet = $Reader->load($targetPath);
		// 		$excelSheet = $spreadSheet->getActiveSheet();
		// 		$spreadSheetAry = $excelSheet->toArray();
		// 		$sheetCount = count($spreadSheetAry);
		// 		$sheetCountHeader = count($spreadSheetAry[0]);
        //         unset($spreadSheetAry[0]);
		//         // echo '<pre>';print_r($spreadSheetAry[0]);die;
				
		// 		$column_name = $this->db->list_fields('tbl_test');
		// 		unset($column_name[0]);
		// 		$count_column = count($column_name);
		// 		if ($sheetCount == $count_column) {
		// 			$this->session->set_flashdata('error', "Column count doesn't match..");
		// 			return redirect('sales_register');
		// 		}else {
		// 			$values = array();
		// 			$j=0;

		// 			for($i = 1; $i < $sheetCount; $i++){
		// 				$values[$j]['data'] = $spreadSheetAry[$i];
		// 				$j++;
		// 			}
		// 			//echo '<pre>';print_r($values);
		// 			$query = NULL;
		// 			foreach($values as $value){
		// 				$tmp = NULL;
		// 				foreach($value as $v){
		// 					for ($i=0; $i < $count_column ; $i++) { 
		// 					$tmp .= ($v[$i]=='')? 'NULL,' : "'$v[$i]',";
		// 					}
		// 				}
		// 				$tmp = rtrim($tmp,',');
		// 				$query .= "($tmp),";
		// 			}
		// 			$query = rtrim($query,',');
		// 			$saveData = $this->UserModel->saveData($query);
		// 			// print_r($saveData);die;
		// 		}
		// 		// print_r($sheetCountHeader);die;
				
				
		// 		if (! empty($saveData)) {
		// 			$type = "success";
		// 			$message = "Excel Data Imported into the Database";
		// 			return redirect('sales_register');
		// 		} else {
		// 			$type = "error";
		// 			$message = "Problem in Importing Excel Data";
		// 		}
		// 	} else {
		// 		$type = "error";
		// 		$message = "Invalid File Type. Upload Excel File.";
		// 	}
		// }
	}

	public function contractupload()
	{


		if (isset($_POST['import']))
		{
		
			$fileMimes = array(
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
			);
			

			if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
			{
					$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
					fgetcsv($csvFile);
					while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
					{
						$saveData = $this->UserModel->contractuploadCsvFile($getData);	
					}
					fclose($csvFile);
		
					return redirect('contract_master');
				
			}
			else
			{
				$this->session->set_flashdata('error', 'Please select valid file');
				
				return redirect('contract_master');
			}
		}



		// echo 'excel';die;
		// if (isset($_POST["import"])) {

		// 	$allowedFileType = [
		// 		'application/vnd.ms-excel',
		// 		'text/xls',
		// 		'text/xlsx',
		// 		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
		// 	];
		
		// 	if (in_array($_FILES["file"]["type"], $allowedFileType)) {
		
		// 		$targetPath = 'uploads/' . $_FILES['file']['name'];
		// 		move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
		
		// 		$Reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		// 		// ini_set('memory_limit', '-1');
		// 		$spreadSheet = $Reader->load($targetPath);
		// 		$excelSheet = $spreadSheet->getActiveSheet();
		// 		$spreadSheetAry = $excelSheet->toArray();
		// 		$sheetCount = count($spreadSheetAry);
		// 		$sheetCountHeader = count($spreadSheetAry[0]);
        //         unset($spreadSheetAry[0]);
		//         // echo '<pre>';print_r($spreadSheetAry[0]);die;
				
		// 		$column_name = $this->db->list_fields('tbl_test');
		// 		unset($column_name[0]);
		// 		$count_column = count($column_name);
		// 		if ($sheetCount == $count_column) {
		// 			$this->session->set_flashdata('error', "Column count doesn't match..");
		// 			return redirect('sales_register');
		// 		}else {
		// 			$values = array();
		// 			$j=0;

		// 			for($i = 1; $i < $sheetCount; $i++){
		// 				$values[$j]['data'] = $spreadSheetAry[$i];
		// 				$j++;
		// 			}
		// 			//echo '<pre>';print_r($values);
		// 			$query = NULL;
		// 			foreach($values as $value){
		// 				$tmp = NULL;
		// 				foreach($value as $v){
		// 					for ($i=0; $i < $count_column ; $i++) { 
		// 					$tmp .= ($v[$i]=='')? 'NULL,' : "'$v[$i]',";
		// 					}
		// 				}
		// 				$tmp = rtrim($tmp,',');
		// 				$query .= "($tmp),";
		// 			}
		// 			$query = rtrim($query,',');
		// 			$saveData = $this->UserModel->saveData($query);
		// 			// print_r($saveData);die;
		// 		}
		// 		// print_r($sheetCountHeader);die;
				
				
		// 		if (! empty($saveData)) {
		// 			$type = "success";
		// 			$message = "Excel Data Imported into the Database";
		// 			return redirect('sales_register');
		// 		} else {
		// 			$type = "error";
		// 			$message = "Problem in Importing Excel Data";
		// 		}
		// 	} else {
		// 		$type = "error";
		// 		$message = "Invalid File Type. Upload Excel File.";
		// 	}
		// }
	}

	public function budgetupload()
	{


		if (isset($_POST['import']))
		{
		
			$fileMimes = array(
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
			);

			if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
			{
					$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
					fgetcsv($csvFile);
					while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
					{
						// print_r($getData);
						$saveData = $this->UserModel->uploadBudgetFile($getData);	
					}
					fclose($csvFile);
		
					return redirect('budget_up');
				
			}
			else
			{
				echo "Please select valid file";
			}
		}
	}

	public function uploadfile() {
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
		
				$Reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				// ini_set('memory_limit', '-1');
				$spreadSheet = $Reader->load($targetPath);
				$excelSheet = $spreadSheet->getActiveSheet();
				$spreadSheetAry = $excelSheet->toArray();
				$sheetCount = count($spreadSheetAry);
				$sheetCountHeader = count($spreadSheetAry[0]);
                unset($spreadSheetAry[0]);
				
				$column_name = $this->db->list_fields('tbl_test');
				unset($column_name[0]);
				$count_column = count($column_name);
				if ($sheetCount == $count_column) {
					$this->session->set_flashdata('error', "Column count doesn't match..");
					// return redirect('sales_register');
				}else {
					$values = array();
					$j=0;

					for($i = 1; $i < $sheetCount; $i++){
						$values[$j]['data'] = $spreadSheetAry[$i];
						$j++;
					}
					//echo '<pre>';print_r($values);
					$query = NULL;
					foreach($values as $value){
						$tmp = NULL;
						foreach($value as $v){
							for ($i=0; $i < $count_column ; $i++) { 
							$tmp .= ($v[$i]=='')? 'NULL,' : "'$v[$i]',";
							}
						}
						$tmp = rtrim($tmp,',');
						$query .= "($tmp),";
					}
					$query = rtrim($query,',');
					$saveData = $this->UserModel->saveData($query);
					// print_r($saveData);die;
				}
				// print_r($sheetCountHeader);die;
				
				
				if (! empty($saveData)) {
					$type = "success";
					$message = "Excel Data Imported into the Database";
					// return redirect('sales_register');
				} else {
					$type = "error";
					$message = "Problem in Importing Excel Data";
				}
			} else {
				$type = "error";
				$message = "Invalid File Type. Upload Excel File.";
			}
		}
		   
   		// $object = PHPExcel_IOFactory::load($path);
		// if (isset($_POST["import"])) {

		// 	$allowedFileType = [
		// 		'application/vnd.ms-excel',
		// 		'text/xls',
		// 		'text/xlsx',
		// 		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
		// 	];
		
		// 	if (in_array($_FILES["file"]["type"], $allowedFileType)) {
		
		// 		$targetPath = 'uploads/' . $_FILES['file']['name'];
		// 		move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
		
		// 		$Reader = new PhpSpreadsheet\Reader\Xlsx();
		// 		// ini_set('memory_limit', '-1');
		// 		$spreadSheet = $Reader->load($targetPath);
		// 		$excelSheet = $spreadSheet->getActiveSheet();
		// 		$spreadSheetAry = $excelSheet->toArray();
		// 		$sheetCount = count($spreadSheetAry);
		// 		$sheetCountHeader = count($spreadSheetAry[0]);
		// 		unset($spreadSheetAry[0]);
		// 		// echo '<pre>';print_r($spreadSheetAry[0]);die;
				
		// 		$column_name = $this->db->list_fields('tbl_test');
		// 		unset($column_name[0]);
		// 		$count_column = count($column_name);
		// 		if ($sheetCount == $count_column) {
		// 			$this->session->set_flashdata('error', "Column count doesn't match..");
		// 			return redirect('sales_register');
		// 		}else {
		// 			$values = array();
		// 			$j=0;

		// 			for($i = 1; $i < $sheetCount; $i++){
		// 				$values[$j]['data'] = $spreadSheetAry[$i];
		// 				$j++;
		// 			}
		// 			//echo '<pre>';print_r($values);
		// 			$query = NULL;
		// 			foreach($values as $value){
		// 				$tmp = NULL;
		// 				foreach($value as $v){
		// 					for ($i=0; $i < $count_column ; $i++) { 
		// 					$tmp .= ($v[$i]=='')? 'NULL,' : "'$v[$i]',";
		// 					}
		// 				}
		// 				$tmp = rtrim($tmp,',');
		// 				$query .= "($tmp),";
		// 			}
		// 			$query = rtrim($query,',');
		// 			$saveData = $this->UserModel->saveData($query);
		// 			// print_r($saveData);die;
		// 		}
		// 		// print_r($sheetCountHeader);die;
				
				
		// 		if (! empty($saveData)) {
		// 			$type = "success";
		// 			$message = "Excel Data Imported into the Database";
		// 			return redirect('sales_register');
		// 		} else {
		// 			$type = "error";
		// 			$message = "Problem in Importing Excel Data";
		// 		}
		// 	} else {
		// 		$type = "error";
		// 		$message = "Invalid File Type. Upload Excel File.";
		// 	}
		// }
		die;
		if (isset($_POST['import']))
		{
			$fileMimes = array(
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
				'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				'text/plain'
			);

			if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
			{
				if ($fileMimes == 'application/csv') {
					$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
					fgetcsv($csvFile);
					while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
					{
						$saveData = $this->UserModel->uploadBudgetFile($getData);	
					}
					fclose($csvFile);
		
					// return redirect('budget_up');
				}else {
					$targetPath = 'uploads/' . $_FILES['file']['name'];
					move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
			
					// $Reader = new PhpSpreadsheet\Reader\Xlsx();
					// // ini_set('memory_limit', '-1');
					// $spreadSheet = $Reader->load($targetPath);
					// $excelSheet = $spreadSheet->getActiveSheet();
					// $spreadSheetAry = $excelSheet->toArray();
					// $sheetCount = count($spreadSheetAry);
					if (!empty($_FILES['file']['tmp_name'])) {
						$import_xls_file = $targetPath;
					} else {
						$import_xls_file = 0;
					}
					// print_r($import_xls_file);die;
					$inputFileName = $import_xls_file;
					try {
						$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
						$objReader = PHPExcel_IOFactory::createReader($inputFileType);
						$objPHPExcel = $objReader->load($inputFileName);
					} catch (Exception $e) {
						die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
								. '": ' . $e->getMessage());
					}
		

					
				}
					
				
			}
			else
			{
				echo "Please select valid file";
			}
		}
	}
}