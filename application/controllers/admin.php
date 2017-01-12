<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
       {
            parent::__construct();
            $this->load->model('admin_model');
       }

    public function index()
    {
        if($this->session->userdata('role') != "1")
        {
            // User is not logged in
            redirect('admin/login', 'refresh');
            return FALSE;
        }



        $this->load->view('_header');
        $this->load->view('admin/index');


    }

    public function view()
    {
        if($this->session->userdata('role') != "1")
        {
            // User is not logged in
            redirect('admin/login', 'refresh');
            return FALSE;
        }

        $this->load->model('admin_model');

        $this->load->view('admin_header');
        $this->load->view('admin/chat-view');

    }

    public function change_mode()
    {
        $this->load->model('admin_model');
        if($this->session->userdata('role') != "1")
        {
            // User is not logged in
            redirect('admin/login', 'refresh');
            return FALSE;
        }

        if($this->input->post('id'))
        {
            echo $this->input->post('id');
            $str = explode("_",$this->input->post('id'));
            print_r($str);
            $id = $str[1];
            $this->admin_model->change_chat_mode($id);

            //lazy..
            echo "Mode changed to: ";
            switch($id)
            {
                case "1":
                    echo "chat on - single colour";
                    break;

                case "2":
                    echo "chat on - multi colour";
                    break;

                case "3":
                    echo "chat off";
                    break;
            }
        }
    }


    public function clear_chat()
    {
        if($this->session->userdata('role') != "1")
        {
            // User is not logged in
            redirect('admin/login', 'refresh');
            exit();
        }
        $this->load->model('Chat_model');
        $this->Chat_model->insert_message("<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>");
    }


    // Login stuff

    public function login()
    {
        $this->load->view('_header');
        $this->load->view('admin/login');
    }

    public function logout()
    {
        $this->session->unset_userdata('role');

        redirect('admin/login', 'refresh');
        exit();
    }

    public function processlogin()
    {
        if($this->input->post('username'))
        {
            $this->load->model('admin_model');
            $process = $this->admin_model->process_login($this->input->post('username'), $this->input->post('password'));
            if($process == TRUE)
            {
                //user has logged in!
                redirect('admin/index', 'refresh');
            } else {
                // login failed :(
                $this->session->set_flashdata('error', 'Your login deets are incorrect. Try again.');
                redirect('admin/login', 'refresh');

            }
        } else {
            // You'll need to post something to use this page, son!
            redirect('admin/login', 'refresh');
        }
        //$this->input->post('username')

    }

    // function makeuser()
    // {
    //     $this->load->model('admin_model');
    //     $this->admin_model->create_user('actnow', 'revolution', '1');
    // }


}
