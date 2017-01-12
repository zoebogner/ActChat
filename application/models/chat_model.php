<?php

class Chat_model extends CI_Model {

    function __construct()
    {
        /* Call the Model constructor */
        parent::__construct();
    }


    function get_last_item()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('Chats', 1);
        $err = $this->db->_error_message();
        show_error($err);
        return $query->result();
    }


    function insert_message($message)
    {
        echo $message;
        $mode_array = $this->get_chat_mode();
        print_r($mode_array);

        // Check chat mode
        // Don't post messages from non-admins while mode is set to "3"

        if( ($mode_array['mode'] == "1") || ($mode_array['mode'] == "2") || ($this->session->userdata('role') == "1") )
        {

            //$this->message = $message;

            // If colourful mode (2) on, wrap chat in colour tags

            if($this->session->userdata('role') == "1")
            {
                $insert['message'] = '<span class="admin_msg">'.$message.'</span>';

            } elseif($mode_array['mode'] == "2")
            {
                $insert['message'] = '<font color="#'.$this->session->userdata("chat_colour").'">'.$message.'</font>';
            } else {
                $insert['message'] = $message;
            }
            //print_r($mode_array);

            $insert['time'] = time();
            $this->db->insert('Chats', $insert);
            return $this->db->insert_id();
            //$err = $this->db->_error_message();
            //echo $err;
            //show_error($err);

        }
            // else chat is off. Ignore submitted chats from regular
            // users while in this mode.
    }

    function get_chat_after($time)
    {
        $this->db
            ->where('time >', $time)
            ->order_by('time', 'DESC')
            ->limit(60); //arrbitary limit for performance.
                //Raise and test if you find its cutting off responses.
        $query = $this->db->get('Chats');

        $results = array();

        foreach ($query->result() as $row)
        {
          //$results[] = array($row->message,$row->time);
          $results[] = array($row->message,$row->time);
        }
        //$messages = array_reverse($results);

        // Get chat mode (as a string)
        //$mode = "1";

        //return array("mode" => $mode, "messages" => $messages);

        return array_reverse($results);
    }

    // function create_table()
    // {
    //     /* Load db_forge - used to create databases and tables */
    //     $this->load->dbforge();
    //
    //     /* Specify the table schema */
    //     $fields = array(
    //                     'id' => array(
    //                                   'type' => 'INT',
    //                                   'constraint' => 5,
    //                                   'unsigned' => TRUE,
    //                                   'auto_increment' => TRUE
    //                               ),
    //                     'message' => array(
    //                                   'type' => 'TEXT'
    //                               ),
    //                     'time' => array(
    //                         'type' => 'INT'
    //                       )
    //               );
    //
    //     /* Add the field before creating the table */
    //     $this->dbforge->add_field($fields);
    //
    //
    //     /* Specify the primary key to the 'id' field */
    //     $this->dbforge->add_key('id', TRUE);
    //
    //
    //     /* Create the table (if it doesn't already exist) */
    //     $this->dbforge->create_table('Chats', TRUE);
    // }

    function assign_colour()
    {
        // Is a colour already assigned?
        if(!$this->session->userdata('chat_colour'))
        {
            // No colour assigned - lets assign one!
            $id = rand(1,8);
            $this->db->select('hex')->from('colour_lookup')->where('colour_id', $id);
            $query = $this->db->get();
            if($query->num_rows() > 0)
            {
                $r = $query->row();
                $this->session->set_userdata('chat_colour', $r->hex);
            }

            return FALSE; // unable to assign colour
        }

        return $this->session->userdata('session_id');


    }


    function get_chat_mode()
    {
        $query = $this->db->select('mode,user_id,timestamp')
                    ->from('mode_status')
                    ->order_by('timestamp', 'desc')
                    ->limit(1)
                    ->get();
        if($query->num_rows() > 0)
        {
            $r = $query->row_array();
            return $r; //returns array of mode, user_id and timestamp
        }
    }


}
