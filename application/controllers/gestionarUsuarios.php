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
    }

    public function index() {
        $datos = array();
        $datos['linksmenu'] = $this->menu;
        $datos['usuarios'] = $this->usuarios->obtenerUsuarios();
        $this->load->view('headerPublico', $datos);
        $this->load->view('PanelAdminTec', $datos);
        $this->load->view('footerPublico');
    }

    public function crearUsuario() {

        array_push($this->menu, crearObjetoLink('usuarios', base_url() . 'index.php/gestionarUsuarios'));
        $datos = array();
        $datos['linksmenu'] = $this->menu;
        $datos['roles'] = $this->usuarios->obtenerRoles();
        $datos['documentos'] = $this->usuarios->obtenerTiposDocumentos();
        $datos['generos'] = $this->usuarios->obtenerGeneros();
        $datos['tipousuarios'] = $this->usuarios->obtenerTiposUsuario();

        $this->form_validation->set_rules('nombrecompleto', 'Nombre', 'required|max_length[100]');
        $this->form_validation->set_rules('nick', 'nombre de usuario', 'required|max_length[45]|alpha_numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('contra', 'Contraseña', 'required');
        $this->form_validation->set_rules('repcontra', 'Contraseña 2', 'required|matches[contra]');
        $this->form_validation->set_rules('pais', 'pais', 'required|max_length[45]');
        $this->form_validation->set_rules('ciudad', 'ciudad', 'required|max_length[45]');
        $this->form_validation->set_rules('telefono', 'telefono', 'required|max_length[45]');
        $this->form_validation->set_rules('numdoc', 'documento de identidad', 'required|max_length[20]|alpha_numeric');

        //tipo de usuario
        $tip = $this->input->post('tipo');
        if ($tip != false) {
            //es una persona natural
            if ($tip == '1') {
                $this->form_validation->set_rules('fechanaci', 'fecha de nacimiento', 'required');
                $this->form_validation->set_rules('tiposangre', 'tipo sanguineo', 'required|max_length[3]');
                $this->form_validation->set_rules('genero', 'genero', 'required');
            } else if ($tip == '2') { //es un hotel
                $this->form_validation->set_rules('nombrecontacto', 'Nombre del representante', 'required|max_length[45]');
                $this->form_validation->set_rules('direccioncontacto', 'Dirección del representante', 'required|max_length[45]');
            }
        }
        //agregar
        if ($this->form_validation->run() != false) {
            $nombre = $this->input->post('nombrecompleto');
            $nick = $this->input->post('nick');
            $email = $this->input->post('email');
            $contra = $this->input->post('contra');
            $rol = $this->input->post('rol');
            $pais = $this->input->post('pais');
            $ciudad = $this->input->post('ciudad');
            $telefono = $this->input->post('telefono');
            $tipodoc = $this->input->post('tipodoc');
            $numdoc = $this->input->post('numdoc');
            $fechanaci = $this->input->post('fechanaci');
            $sangre = $this->input->post('tiposangre');
            $genero = $this->input->post('genero');
            $nomcont = $this->input->post('nombrecontacto');
            $dircont = $this->input->post('direccioncontacto');
            $tipo = $this->input->post('tipo');

            $res = false;
            if ($tipo == '1') {
                $res = $this->usuarios->insertarUsuario($nombre, $nick, $email, $contra, $rol, $tipodoc, $numdoc, $fechanaci, $pais, $ciudad, $sangre, $genero, $tipo);
                $this->usuarios->insertarContacto($nick, $nombre, $telefono, null);
            } else if ($tipo == '2') {
                $res = $this->usuarios->insertarUsuario($nombre, $nick, $email, $contra, $rol, $tipodoc, $numdoc, null, $pais, $ciudad, null, null, $tipo);
                $this->usuarios->insertarContacto($nick, $nomcont, $telefono, $dircont);
            }
            //$res = $this->usuarios->insertarUsuario($nombre, $nick, $email, $contra, $rol);
            if ($res) {
                $this->gestormensajes->enviarEmail($email, 'Registro de usuario', nuevoEmailRegistro($nombre, $nick, $contra));
                $datos['resultado'] = 'si';
            } else {
                $datos['resultado'] = 'no';
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
                $datos['documentos'] = $this->usuarios->obtenerTiposDocumentos();
                $datos['generos'] = $this->usuarios->obtenerGeneros();
                $datos['tipousuarios'] = $this->usuarios->obtenerTiposUsuario();
            }
        }

        $this->form_validation->set_rules('nombrecompleto', 'Nombre', 'required|max_length[100]');
        $this->form_validation->set_rules('nick', 'nombre de usuario', 'required|max_length[45]|alpha_numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('pais', 'pais', 'required|max_length[45]');
        $this->form_validation->set_rules('ciudad', 'ciudad', 'required|max_length[45]');
        $this->form_validation->set_rules('telefono', 'telefono', 'required|max_length[45]');
        $this->form_validation->set_rules('numdoc', 'documento de identidad', 'required|max_length[20]|alpha_numeric');

        //tipo de usuario
        $tip = $this->input->post('tipo');
        if ($tip != false) {
            //es una persona natural
            if ($tip == '1') {
                $this->form_validation->set_rules('fechanaci', 'fecha de nacimiento', 'required');
                $this->form_validation->set_rules('tiposangre', 'tipo sanguineo', 'required|max_length[3]');
                $this->form_validation->set_rules('genero', 'genero', 'required');
            } else if ($tip == '2') { //es un hotel
                $this->form_validation->set_rules('nombrecontacto', 'Nombre del representante', 'required|max_length[45]');
                $this->form_validation->set_rules('direccioncontacto', 'Dirección del representante', 'required|max_length[45]');
            }
        }

        $contra = $this->input->post('contra');
        if ($contra != null && $contra != '') {
            $this->form_validation->set_rules('contra', 'Contraseña', 'required');
            $this->form_validation->set_rules('repcontra', 'Contraseña 2', 'required|matches[contra]');
        }

        if ($this->form_validation->run() != false) {
            $nombre = $this->input->post('nombrecompleto');
            $nick = $this->input->post('nick');
            $email = $this->input->post('email');
            $contra = $this->input->post('contra');
            $rol = $this->input->post('rol');
            $pais = $this->input->post('pais');
            $ciudad = $this->input->post('ciudad');
            $telefono = $this->input->post('telefono');
            $tipodoc = $this->input->post('tipodoc');
            $numdoc = $this->input->post('numdoc');
            $fechanaci = $this->input->post('fechanaci');
            $sangre = $this->input->post('tiposangre');
            $genero = $this->input->post('genero');
            $nomcont = $this->input->post('nombrecontacto');
            $dircont = $this->input->post('direccioncontacto');
            $tipo = $this->input->post('tipo');

            if ($tipo == '1') {
                $res = $this->usuarios->actualizarUsuario($nombre, $nick, $email, $contra, $rol, $tipodoc, $numdoc, $fechanaci, $pais, $ciudad, $sangre, $genero, $tipo);
                $this->usuarios->actualizarContacto($nick, $nombre, $telefono, null);
            } else if ($tipo == '2') {
                $res = $this->usuarios->actualizarUsuario($nombre, $nick, $email, $contra, $rol, $tipodoc, $numdoc, null, $pais, $ciudad, null, null, $tipo);
                $this->usuarios->actualizarContacto($nick, $nomcont, $telefono, $dircont);
            }
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

    function eliminarUsuario($nick = null) {
        $datos = array();
        $datos['linksmenu'] = $this->menu;

        $this->load->view('headerPublico', $datos);
        $usr = $this->usuarios->obtenerUsuarioPorNick($nick);
        if (sizeof($usr) == 1) {
            $usr = $usr[0];
            $datos['usuario'] = $usr;
        }
        if ($this->input->post('eliminar') != false) {
            $nick = $this->input->post('nick');
            $yo = $this->session->userdata('usuario');
            if ($nick == $yo->nick) {
                $datos['estado'] = 'error';
            } else {
                $res = $this->usuarios->eliminarUsuario($nick);
                if ($res) {
                    $datos['estado'] = 'si';
                } else {
                    $datos['estado'] = 'no';
                }
            }
        }

        $this->load->view('formularioBorrarUsuario', $datos);
        $this->load->view('footerPublico');
    }

}

?>
