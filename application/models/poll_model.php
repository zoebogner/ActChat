<?php

class Poll_model extends CI_Model {

    function __construct()
    {
        /* Call the Model constructor */
        parent::__construct();
        $this->load->model('Chat_model');
    }

    function start($message) //test this
    {
        // $query = $this->db->select('time, message')
        //             ->from('Chats')
        //             ->where('id',$message_id)
        //             ->get();

        // if ($query->num_rows() == 1) //must be at least 2 values to make a comparison!
        // {
        //$r = $query->row_array();
        $data = array(
           'message'    => $message,
           'timestamp'  => time(),
           'action'     => "start"
        );

        $this->db->insert('polling', $data);

        //}


    }

    function stop()
    {
        $current_time = time();

        //grab last survey start from polling table
        $query = $this->db->select('*')
            ->from('polling')
            ->where('action', 'start')
            ->limit(1)
            ->order_by('polling_id', 'desc')
            ->get();

        if ($query->num_rows() == 1)
        {
            $insert = array(
                'action'    => 'stop',
                'timestamp' =>  $current_time
            );
            $this->db->insert('polling', $insert);

            $r = $query->row_array();
            //echo "start: ".$r['timestamp']." stop: $current_time";

            $data_array = $this->get_data($r['timestamp'], $current_time);

            if(!empty($data_array))
            {
                return $data_array;
            }
        }

        return FALSE;
    }

    // Grab all chats between two timestamps
    function get_data($start, $stop)
    {
        $query = $this->db->select('*')
                    ->from('Chats')
                    ->where('time >', $start) // Don't use >=, it will include the question in the tally
                    ->where('time <', $stop)
                    ->get();

        if ($query->num_rows() > 1) //must be at least 2 values to make a comparison!
        {
            $m = array();
            foreach ($query->result_array() as $r)
            {
                //$firstchar = substr($r['message'], 1);
                $txt = strip_tags($r['message']); // remove html-like symbols
                $txt = trim($txt); //remove whitespace
                $txt = strtolower($txt[0]); //make lowercase
                $txt = $txt[0]; //first letter/number only
                
               /*
 // consolidate y, yes, n, and no responses
                if($txt == 'yes')
                {
                    $txt = "y";
                }
                
                if($txt == 'no')
                {
                    $txt = "n";
                }
*/
                
                /*
switch($txt)
                {
                    case "yes":
                    case "yeah":
                    case "yeh":
                    case "yep":
                    case "yas";
                    case "yar":
                    case "fuck yeah":
                        $txt = "y";
                        break;
                    
                    case "no":
                    case "nope":
                    case "nah":
                    case "no way":
                    case "fuck no":
                        $txt = "n";
                        break;
                        
                    default:
                        break;
                }
                
                
*/
                
                $m[] = $txt;

            }

            $count = array_count_values($m);
            $count['meta_count'] = $query->num_rows();
            return $count;
        }
    }
}
