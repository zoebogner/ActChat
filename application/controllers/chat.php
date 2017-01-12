<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends CI_Controller {

  public function __construct()
  {
      parent::__construct();
      $this->load->model('Chat_model');
  }

  public function index() {

        // Assign a colour (ready for multicolour mode)
        $this->Chat_model->assign_colour();

        $this->load->view('_header');
        //$this->load->view('readonly/welcome');
        $this->load->view('chat-view');
    }

    // public function next() {
    //     $this->load->view('_header');
    //     $this->load->view('chat-view');
    // }

    public function get_chats() {

        echo json_encode($this->Chat_model->get_chat_after($_REQUEST["time"]));
    }

    public function insert_chat() 
    {
    
        if($this->input->get('message'))
        {
            $this->Chat_model->insert_message($this->input->get('message'));
        }

    /*
if($msg != NULL)
    {
        $this->Chat_model->insert_message($msg);
    } else {
        //$this->Chat_model->insert_message($_REQUEST["message"]);
    }
*/
    // echo $_REQUEST["message"];
    // $this->Chat_model->insert_message($_REQUEST["message"]);



  }

  public function time() {
    echo "[{\"time\":" +  time() + "}]";
  }


}?>
