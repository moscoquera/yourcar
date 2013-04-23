<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class centro extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $datos = array();
        $datos['linksmenu'] = array();
        if ($this->session->userdata('usuario') != false) {
            $usr = $this->session->userdata('usuario');
            $datos['usuario'] = $usr;
            if ($usr->rol_id == 1) {
                array_push($datos['linksmenu'], crearObjetoLink('panel', base_url() . 'index.php/gestionarUsuarios'));
            }
        }
        $this->load->view('headerPublico',$datos);
        $this->load->view('centro_view', $datos);
        $this->load->view('footerPublico');
    }

}
?>


