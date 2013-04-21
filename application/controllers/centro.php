<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class centro extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $datos = array();
        if ($this->session->userdata('usuario') != false){
            $datos['usuario']=$this->session->userdata('usuario');
        }
        
        $this->load->view('headerPublico');
        $this->load->view('centro_view',$datos);
        $this->load->view('footerPublico');
    }
}

?>


