<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Login extends CI_Controller {



    public function __construct()

    {

        parent::__construct();

        $this->load->model('UserModel');

    }



    public function index()

    {
        if ($this->session->userdata('isLoggedIn') == '1' && $this->session->userdata('role_id') == '1') {
            $data = [

                'title_meta' =>  ['title' => 'Dashboard'],
    
                'page_title' => ['title' => 'Dashboard', 'li_1' => 'SmartHr', 'li_2' => 'Dashboard']
    
            ];
            redirect('dashboard', $data);
            // $this->load->view('dashboard', $data);
        } else if ($this->session->userdata('isLoggedIn') == '1' && $this->session->userdata('role_id') == '2') {
            $data = [

                'title_meta' =>  ['title' => 'Dashboard'],
    
                'page_title' => ['title' => 'Dashboard', 'li_1' => 'SmartHr', 'li_2' => 'Dashboard']
    
            ];
            redirect('dashboard', $data);
            // $this->load->view('transportal', $data);
        } else {
            // print_r($this->session->userdata());die;
            $data = [

                'title_meta' =>  ['title' => 'Dashboard'],

                'page_title' => ['title' => 'Dashboard', 'li_1' => 'SmartHr', 'li_2' => 'Dashboard']

            ];

            $this->load->view('login', $data);
        }

    }

    public function login_auth()

    {

        $get_user_details = $this->UserModel->get_userdata($this->session->userdata("email_id"));

        // echo '<pre>';print_r($get_user_details);die;

        // $email = $this->request->getVar('email');

        $password = $this->input->post('password');
        //$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        

        // echo '<pre>';print_r($password);die;

        // $data = $userModel->where('USER_EMAIL', $email)->first();

        // echo '<pre>';print_r($data);die;

        if($get_user_details){

            $pass = $get_user_details->USER_PASS;

            $authenticatePassword = password_verify($password, $pass);
           
            // print_r($authenticatePassword);die;

            if($password == $pass){
                // echo $password .'=='. $pass;

                $ses_data = [

                    'id' => $get_user_details->ID,

                    'name' => $get_user_details->USER_NAME,

                    'role_id' => $get_user_details->ROLE_ID,

                    'email' => $get_user_details->USER_EMAIL,

                    'isLoggedIn' => TRUE

                ];

                if ($get_user_details->ROLE_ID == 1) {

                    $this->session->set_userdata($ses_data);

                    redirect("dashboard");

                } else if($get_user_details->ROLE_ID == 2) {

                    $this->session->set_userdata($ses_data);

                    redirect("transportal");

                }

                else if($get_user_details->ROLE_ID == 3) {

                    $this->session->set_userdata($ses_data);

                    redirect("dashboard");

                }

            

            }else{

                $this->session->set_flashdata('msg', 'Password is incorrect.');

                $this->load->view("login");

            }

        }else{

            $this->session->set_flashdata('msg', 'Email does not exist.');

            $this->load->view("login");

        }

    }

    public function Logout()
    {
        $this->session->unset_userdata('isLoggedIn');
        $this->session->sess_destroy();
        $this->session->set_flashdata("success", "Sign Out Successfully.!");
        redirect()->to('/');
    }

}