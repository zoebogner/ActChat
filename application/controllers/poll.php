<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poll extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('Chat_model');
        $this->load->model('poll_model');
    }

    // polls
    public function start()
    {
        if($this->session->userdata('role') != "1")
        {
            // User is not logged in
            redirect('admin/login', 'refresh');
            exit();
        }

        $this->poll_model->start($this->input->post('message'));


    }

    public function stop()
    {
        if($this->session->userdata('role') != "1")
        {
            // User is not logged in
            redirect('admin/login', 'refresh');
            exit();
        }

        $data = $this->poll_model->stop();

        if(is_array($data))
        {
            print_r($data);
            // total responses collected:
            $total = $data['meta_count'];
            unset($data['meta_count']); // remove response count from data array

            foreach($data as $key => $value)
            {
                // Clean up results
                // Remove any values that aren't y, n, or a number
                // (should probably look at doing this back in the model, but I'm out of time!)
                switch($key)
                {
                    case "y":
                    case "n":
                    case is_numeric($key):
                        break;
                    default:
                        $total = $total - $value;
                        unset($data[$key]);
                        break;
                }
            }

            // Calculate percantages for remaining results
            foreach($data as $key => $value)
            {
                switch($key)
                {
                    case "y":
                    case "n":
                    case is_numeric($key):
                        $label[] = $key;
                        $percent[] = round(($value / $total) * 100, 0);
                        break;
                }

            }

            $count_labels = count($label);
            $string = "<table class='poll_results total_".$count_labels."'>";
            $string .= "<tr class='labels'>";
            foreach($label as $v)
            {
                // $string .= "<td>".$v."</td>";
                // Tidy up known label names a bit
                switch($v)
                {
                    case "y":
                        $string .= "<td>Yes</td>";
                        break;
                    case "n":
                        $string .= "<td>No</td>";
                        break;
                    case is_numeric($v):
                        $string .= "<td>".$v."</td>";
                        break;
                    default:
                        $string .= "<td>".$v."</td>";
                        break;
                }
            }
            $string .= "</tr><tr class='percents'>";
            foreach($percent as $v)
            {
                $string .= "<td>".$v."<span class='pcent'>%</span></td>";
            }
            $string .= "</tr></table>";

            // Display it!
            $this->Chat_model->insert_message($string);
        }

        return FALSE;

        //print_r($data); //debugging
        //return TRUE;
    }
}
