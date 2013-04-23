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
    
    public function obtenerRoles(){
        $this->db->select('*');
        $this->db->from('adminrol');
        return $this->db->get()->result();
    }
    
    public function insertarUsuario($nombre,$nick,$email,$contra,$rol){
        if (sizeof($this->obtenerUsuarioPorEmail($email))>0){
            return false;
        }
        
        if (sizeof($this->obtenerUsuarioPorNick($nick))>0){
            return false;
        }
        $datos = array(
            'nombres'=>$nombre,
            'nick' =>$nick,
            'email'=>$email,
            'password'=>  md5($contra),
            'rol_id'=>$rol
            
        );
        $this->db->insert('administradores',$datos);
        return true;
    }
    
    public function obtenerUsuarioPorEmail($email){
        $this->db->select();
        $this->db->from('administradores');
        $this->db->where('email', $email);
        return $this->db->get()->result();
        
    }
    
    public function obtenerUsuarioPorNick($nick){
        $this->db->select();
        $this->db->from('administradores');
        $this->db->where('nick', $nick);
        return $this->db->get()->result();
    }
    
}

?>
