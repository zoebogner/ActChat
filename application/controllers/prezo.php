<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prezo extends CI_Controller {
  /* The default function that gets called when visiting the page */

  public function index() {

    $this->load->model('admin_model');

    $this->load->view('prezo_header');
    $this->load->view('prezo-view');



  }

}
