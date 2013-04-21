<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class usuarios extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    
    public function buscarUsuario($nick,$pass){
        $this->db->select('*');
        $this->db->from('administradores');
        $this->db->where('nick', $nick);
        $this->db->where('password',  md5($pass));
        $res = $this->db->get();
        if ($res->num_rows()==1){
            return $res->row();
            
        }else{
            return false;
            
        }
    }
}

?>
