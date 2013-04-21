<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('usuarios');
        
    }

    public function index() {
        if ($this->session->userdata('usuario') != false){
            redirect('centro');
        }
        
        $this->load->view('headerPublico');
        $this->load->view('FormularioLogin');
        $this->load->view('footerPublico');
    }

    public function hacerlogin() {
        
        $nick = $this->input->post('nick');
        $pass = $this->input->post('password');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('nick', 'nombre de usuario', 'required|min_length[1]|max_length[20]|alphanumeric');
        $this->form_validation->set_rules('password', 'contraseña', 'required|min_length[1]|max_length[20]|alphanumeric');

        if ($this->form_validation->run() != false) {
            $usr = $this->usuarios->buscarUsuario($nick,$pass);
            if ($usr != false){
                $datos = array(
                    'usuario'=>$usr
                    
                );
                $this->session->set_userdata($datos);
                redirect('centro');
            }
            
        }

            $this->load->view('headerPublico');
            $this->load->view('FormularioLogin');
            $this->load->view('footerPublico');
        
    }

    public function salir(){
            $this->session->unset_userdata();
            $this->session->sess_destroy();
            redirect('centro');
        
    }
    
}

?>
