<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpSpreadsheet\src\Spreadsheet;
use PhpSpreadsheet\src\Reader\Xlsx;
class Report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('TransportModel');
        $this->load->model('ReportModel');
        // $this->load->library('Spreadsheet');
        if(!$this->session->userdata('isLoggedIn'))
        redirect(base_url("?/Login"));

    }



    public function index()
    {
        $start_date='';
        $end_date='';
        //$whereCon = array('TR.STATUS !=' => '');
        $whereCon = ("TR.STATUS != ''");
        $report='';

        $getDetentio= array();

        $getTransporter= array();

        $getCustomer= array();

        $getCostvsRecovery= array();

        $getBudgetvsActual= array();

        $getCost= array();

        $getdieselCost= array();

        $getdieselCostwithfreight= array();

        $getvehicleutil= array();

        $getfreight= array();

        if($this->input->post('report') != ''){
            $report=$this->input->post('report');
        }
        if ($this->input->post('start_date') != '') {
            $start_date = date('y-m-d',strtotime($this->input->post('start_date')));
            $month=strtoupper(date('M',strtotime($this->input->post('start_date'))));
            $whereCon1 = "B.YEAR = ".date('Y',strtotime($this->input->post('start_date')));
            // print_r($start_date);die;
            // $whereCon = array_merge($whereCon, array('TR.BILL_DT >='=> CONVERT(datetime, $start_date , 103) ));
            $whereCon .= " and TR.BILL_DT >= '".$start_date."' ";
            $data['start_date'] = $this->input->post('start_date');
        }
        else{
            $month=strtoupper(date('M'));
            $whereCon1="B.YEAR = ".date('Y');
        }
        if ($this->input->post('end_date') != '') {
            $end_date=date('y-m-d',strtotime($this->input->post('end_date')));
            //$whereCon = array_merge($whereCon, array('TR.BILL_DT <= '=> CONVERT(datetime, date('d/m/Y',strtotime($this->input->post('end_date'))), 103) ));
            $whereCon .= " and TR.BILL_DT <= '".$end_date."' ";
            // print_r($end_date);die;
            $data['end_date'] = $this->input->post('end_date');
        }
        if($report=='detention')
            $getDetentio = $this->ReportModel->getDetention($whereCon);
        if($report=='transport')
            $getTransporter = $this->ReportModel->getTransporter($whereCon);
        if($report=='Customer')
            $getCustomer = $this->ReportModel->getCustomer($whereCon);
        if($report=='CostvsRecovery')
            $getCostvsRecovery = $this->ReportModel->getCostvsRecovery($whereCon);
        if($report=='BudgetvsActual')
            $getBudgetvsActual = $this->ReportModel->getBudgetvsActual($whereCon1,$whereCon,$month);
        if($report=='cost')
            $getCost = $this->ReportModel->getCost($whereCon);

        // echo "string".$this->db->last_query();die();
        if($report=='dieselCost')
            $getdieselCost = $this->ReportModel->getdieselCost($whereCon);
                    // echo "<pre>";print_r($getdieselCost);die();

        if($report=='dieselWithFreight')
            $getdieselCostwithfreight = $this->ReportModel->getdieselCostwithfreight($whereCon);
                // echo "<pre>";print_r($getdieselCostwithfreight);die();

        if($report=='vehicleUtilization')
            $getvehicleutil = $this->ReportModel->getvehicleutil($whereCon);

                    // echo "<pre>";print_r($getvehicleutil);exit();
 
        if($report=='freight')
            $getfreight = $this->ReportModel->getfreight($whereCon);

        // echo "<pre>";print_r($getfreight);exit();
        // echo "string".$this->db->last_query();die();

            $start_date_input = $this->input->post('start_date');
            $end_date_input = $this->input->post('end_date');

            // Check if the input values are not null before using strtotime
            $start_date_formatted = $start_date_input ? date('d-m-y', strtotime($start_date_input)) : '';
            $end_date_formatted = $end_date_input ? date('d-m-y', strtotime($end_date_input)) : '';

            $data = [

                'title_meta' => ['title' => 'Dashboard'],

                'page_title' => ['title' => 'Dashboard', 'li_1' => 'SmartHr', 'li_2' => 'Dashboard'],

                'report' => $report,

                'getSales' => $getDetentio,

                'getTransporter' => $getTransporter,

                'getCustomer' => $getCustomer,

                'getCostvsRecovery' => $getCostvsRecovery,

                'getBudgetvsActual' => $getBudgetvsActual,

                'getCost' => $getCost,

                'getdieselCost' => $getdieselCost,

                'getdieselCostwithfreight' => $getdieselCostwithfreight,

                'getvehicleutil' => $getvehicleutil,

                'getfreight' => $getfreight,

                'end_date' => $end_date_formatted,

                'start_date' => $start_date_formatted

            ];
            // echo "<pre>";
            // print_r($getCost);die;

        $this->load->view('reports', $data);

    }



}