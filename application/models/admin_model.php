<?php

class Admin_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    function change_chat_mode($mode, $user_id = "1")
    {
        if($this->session->userdata('role') == "1")
        {
            $data = array(
               'mode'       => $mode,
               'user_id'    => $user_id,
               'timestamp'  => time()
            );

            $this->db->insert('mode_status', $data);
        }
    }

    function change_chat_display($mode, $user_id = "1")
    {

    }


    function process_login($username, $password)
    {
        $this->load->library('bcrypt');

        $this->db->select('username,password,role')
            ->from('user_roles')
            ->where('username',$this->input->post('username'));
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->row_array();
            if ($this->bcrypt->check_password($password, $result['password']))
            {
                $this->session->set_userdata('role', $result['role']);
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    // function create_user($username, $password, $role_id)
    // {
    //     $this->load->library('bcrypt');
    //
    //     $hash = $this->bcrypt->hash_password($password);
    //
    //     $data = array(
    //        'username' => $username ,
    //        'password' => $hash,
    //        'role'     => $role_id
    //     );
    //
    //     $this->db->insert('user_roles', $data);
    // }


}
