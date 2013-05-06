<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('gestormensajes');
        $this->load->helper('correo');
        $this->load->model('usuarios');
    }

    public function index() {
        if ($this->session->userdata('usuario') != false) {
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
            $usr = $this->usuarios->buscarUsuario($nick, $pass);
            if ($usr != false) {
                $usr = array('nick' => $usr->nick, 'nombres' => $usr->nombres, 'rol_id' => $usr->rol_id);
                $usr = (object) $usr;
                $datos = array(
                    'usuario' => $usr
                );
                $this->session->set_userdata($datos);
                redirect('centro');
            }
        }

        $this->load->view('headerPublico');
        $this->load->view('FormularioLogin');
        $this->load->view('footerPublico');
    }

    public function salir() {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        redirect('centro');
    }

    public function recuperarContrasena() {
        $datos = array();
        
        $this->form_validation->set_rules('nick', 'nick', 'required');
        $this->form_validation->set_rules('nombre', 'nombre completo', 'required');
        $this->form_validation->set_rules('documento', 'documento', 'required');

        $opcion = $this->input->post('opcion');
        $rec = $this->input->post('recuperar');

        if ($rec != false) {
            if ($this->form_validation->run() != false) {
                $nick = $this->input->post('nick');
                $nombre = $this->input->post('nombre');
                $documento = $this->input->post('documento');
                $usr = $this->usuarios->obtenerUsuarioPorNick($nick);
                if (sizeof($usr)==0){
                    $datos['resultado']='nousr';
                }else{
                    $usr=$usr[0];
                    if ($usr->nombres==$nombre && $usr->ndocumento == $documento){
                        $contra = time();
                        $this->usuarios->actualizarContrasena($nick,$contra);
                        $this->gestormensajes->enviarEmail($usr->email,'nueva contraseña',  nuevaContrasena($nombre, $nick, $contra));
                    }
                    $datos['resultado']='si';
                }
            }else{
                $opcion='formulario';
            }
        }

        if ($opcion == 'formulario') {
            $this->load->view('headerPublico');
            $this->load->view('FormularioRecurperarContrasena');
            $this->load->view('footerPublico');
        } else {
            $this->load->view('headerPublico');
            $this->load->view('indexRecuperarContrasena');
            $this->load->view('footerPublico');
        }
    }

}

?>
