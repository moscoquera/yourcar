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
        $this->load->view('headerPublico');
        $this->load->view('footerPublico');
    }
}

?>


