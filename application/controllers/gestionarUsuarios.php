<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class gestionarUsuarios extends CI_Controller {

    var $menu = array();

    public function __construct() {
        parent::__construct();
        $this->load->model('usuarios');
        $this->load->library('gestormensajes');
        $this->load->helper('correo');
        array_push($this->menu, crearObjetoLink('inicio', base_url()));

        $this->output->enable_profiler(true);
    }

    public function index() {
        $datos = array();
        $datos['linksmenu'] = $this->menu;
        $datos['usuarios'] = $this->usuarios->obtenerAdministradores();
        $this->load->view('headerPublico', $datos);
        $this->load->view('PanelAdminTec', $datos);
        $this->load->view('footerPublico');
    }

    public function crearUsuario() {


        $datos = array();
        $datos['linksmenu'] = $this->menu;
        $datos['roles'] = $this->usuarios->obtenerRoles();

        $this->form_validation->set_rules('nombrecompleto', 'Nombre', 'required|max_length[100]');
        $this->form_validation->set_rules('nick', 'nombre de usuario', 'required|max_length[45]|alpha_numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('contra', 'Contraseña', 'required');
        $this->form_validation->set_rules('repcontra', 'Contraseña 2', 'required|matches[contra]');

        //agregar
        if ($this->form_validation->run() != false) {
            $nombre = $this->input->post('nombrecompleto');
            $nick = $this->input->post('nick');
            $email = $this->input->post('email');
            $contra = $this->input->post('contra');
            $rol = $this->input->post('rol');
            if ($nombre != false && $nick != false && $email != false && $contra != False) {
                $res = $this->usuarios->insertarUsuario($nombre, $nick, $email, $contra, $rol);
                if ($res) {
                    $this->gestormensajes->enviarEmail($email, 'Registro de usuario', nuevoEmailRegistro($nombre, $nick, $contra));
                    $datos['resultado'] = 'si';
                } else {
                    $datos['resultado'] = 'no';
                }
            }
        }


        $this->load->view('headerPublico', $datos);
        $this->load->view('formularioCrearUsuario', $datos);
        $this->load->view('footerPublico');
    }

    public function modificarUsuario($nick = null) {
        $datos = array();
        $datos['linksmenu'] = $this->menu;

        if ($nick != null) {
            $usr = $this->usuarios->obtenerUsuarioPorNick($nick);
            if (sizeof($usr) == 1) {
                $usr = $usr[0];
                $datos['usuario'] = $usr;
                $datos['roles'] = $this->usuarios->obtenerRoles();
            }
        }

        $nombre = $this->input->post('nombrecompleto');
        $nick = $this->input->post('nick');
        $email = $this->input->post('email');
        $contra = $this->input->post('contra');
        $rol = $this->input->post('rol');

        $this->form_validation->set_rules('nombrecompleto', 'Nombre', 'required|max_length[100]');
        $this->form_validation->set_rules('nick', 'nombre de usuario', 'required|max_length[45]|alpha_numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($contra != null && $contra != '') {
            $this->form_validation->set_rules('contra', 'Contraseña', 'required');
            $this->form_validation->set_rules('repcontra', 'Contraseña 2', 'required|matches[contra]');
        }

        if ($this->form_validation->run() != false) {
            $res = $this->usuarios->actualizarUsuario($nick, $nombre, $email, $rol, $contra);
            if ($res) {
                $datos['resultado'] = 'si';
                $usr = $this->usuarios->obtenerUsuarioPorNick($nick);
                $usr = $usr[0];
                $datos['usuario'] = $usr;
                
            } else {
                $datos['resultado'] = 'no';
            }
        }

        $this->load->view('headerPublico', $datos);
        $this->load->view('formularioModificarUsuario', $datos);
        $this->load->view('footerPublico');
    }

    function eliminarUsuario($nick=null){
        $datos = array();
        $datos['linksmenu'] = $this->menu;
        
        $this->load->view('headerPublico', $datos);
        $usr = $this->usuarios->obtenerUsuarioPorNick($nick);
        if (sizeof($usr) == 1){
            $usr = $usr[0];
            $datos['usuario']=$usr;
        }
        if ($this->input->post('eliminar') != false){
            $nick = $this->input->post('nick');
            $yo = $this->session->userdata('usuario');
            if ($nick == $yo->nick){
                $datos['estado']='error';
            }else{
                $res = $this->usuarios->eliminarUsuario($nick);
                if ($res){
                    $datos['estado']='si';
                }else{
                    $datos['estado']='no';
                }
            }
        }
        
        $this->load->view('formularioBorrarUsuario', $datos);
        $this->load->view('footerPublico');
        
    }
    
}

?>
