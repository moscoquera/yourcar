<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class gestionarUsuarios extends CI_Controller {

    var $menu = array();
    static $datos;
    public function __construct() {
        parent::__construct();
        $this->load->model('usuarios');
        $this->load->library('gestormensajes');
        $this->load->helper('correo');
        
        $this->datos = array();
        $this->datos['linksmenu'] = array();

        $usr = $this->session->userdata('usuario');
        $this->datos['usuario'] = $usr;
        if ($usr->rol_id == 1) {
            array_push($this->datos['linksmenu'], crearObjetoLink('PANEL DE USUARIOS', base_url() . 'index.php/gestionarUsuarios'));
        } else if ($usr->rol_id == 2) {
            array_push($this->datos['linksmenu'], crearObjetoLink('Reservas', base_url() . 'index.php/gestorReservas'));
            array_push($this->datos['linksmenu'], crearObjetoLink('Gestionar Vehiculos', base_url() . 'index.php/gestionVehiculos'));
            array_push($this->datos['linksmenu'], crearObjetoLink('Modificar Información', base_url() . 'index.php/informacion/modificarinformacion'));
            array_push($this->datos['linksmenu'], crearObjetoLink('mantenimientos', base_url() . 'index.php/mantenimientos'));
            array_push($this->datos['linksmenu'], crearObjetoLink('Registrar Voucher', base_url() . 'index.php/gestionVoucher/nuevoVoucher'));
            array_push($this->datos['linksmenu'], crearObjetoLink('Consultar Voucher', base_url() . 'index.php/gestionVoucher'));
        } else if ($usr->rol_id == 3) {
            array_push($this->datos['linksmenu'], crearObjetoLink('Reservas', base_url() . 'index.php/gestorReservas'));
        }
    }

    public function index() {
        $this->datos['usuarios'] = $this->usuarios->obtenerUsuarios();
        $this->load->view('headerPublico', $this->datos);
        $this->load->view('PanelAdminTec', $this->datos);
        $this->load->view('footerPublico');
    }

    public function crearUsuario() {

        array_push($this->menu, crearObjetoLink('usuarios', base_url() . 'index.php/gestionarUsuarios'));
        
        $this->datos['linksmenu'] = $this->menu;
        $this->datos['roles'] = $this->usuarios->obtenerRoles();
        $this->datos['documentos'] = $this->usuarios->obtenerTiposDocumentos();
        $this->datos['generos'] = $this->usuarios->obtenerGeneros();
        $this->datos['tipousuarios'] = $this->usuarios->obtenerTiposUsuario();

        $this->form_validation->set_rules('nombrecompleto', 'Nombre', 'required|max_length[100]');
        $this->form_validation->set_rules('nick', 'nombre de usuario', 'required|max_length[45]|alpha_numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('contra', 'Contraseña', 'required');
        $this->form_validation->set_rules('repcontra', 'Contraseña 2', 'required|matches[contra]');
        $this->form_validation->set_rules('pais', 'pais', 'required|max_length[45]');
        $this->form_validation->set_rules('ciudad', 'ciudad', 'required|max_length[45]');
        $this->form_validation->set_rules('telefono', 'telefono', 'required|max_length[45]|is_natural');
        $this->form_validation->set_rules('celular', 'celular', 'required|max_length[45]|is_natural');
        $this->form_validation->set_rules('numdoc', 'documento de identidad', 'required|max_length[20]|is_natural');

        //tipo de usuario
        $tip = $this->input->post('tipo');
        if ($tip != false) {
            //es una persona natural
            if ($tip == '1') {
                $this->form_validation->set_rules('fechanaci', 'fecha de nacimiento', 'required|callback_edad');
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
            $celular = $this->input->post('celular');
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
                
            } else if ($tipo == '2') {
                $res = $this->usuarios->insertarUsuario($nombre, $nick, $email, $contra, $rol, $tipodoc, $numdoc, null, $pais, $ciudad, null, null, $tipo);
                
            }
            if (is_bool($res) && $res){
                $this->usuarios->insertarContacto($nick, $nomcont, $telefono, $dircont,$celular);
                $this->gestormensajes->enviarEmail($email, 'Registro de usuario', nuevoEmailRegistro($nombre, $nick, $contra));
                $datos['resultado'] = 'si';
            } else {
                $datos['resultado'] = 'no';
                $datos['error']=$res;
                
            }
            
        }


        $this->load->view('headerPublico', $this->datos);
        $this->load->view('formularioCrearUsuario', $this->datos);
        $this->load->view('footerPublico');
    }

        public function edad($edad){
        $hoy = new DateTime("now");    
        $fecha = DateTime::createFromFormat('Y-m-d', $edad);
         $inter = date_diff($hoy,$fecha);
         if ($inter->y>=21){
             return true;
         }else{
             $this->form_validation->set_message('edad', 'Debe ser mayor de 21 años');
             return false;
         }
         
    }
    
    public function modificarUsuario($nick = null) {
        
        $this->datos['linksmenu'] = $this->menu;

        if ($nick != null) {
            $usr = $this->usuarios->obtenerUsuarioPorNick($nick);

            if (sizeof($usr) == 1) {
                $usr = $usr[0];
                $this->datos['usuario'] = $usr;
                $this->datos['roles'] = $this->usuarios->obtenerRoles();
                $this->datos['documentos'] = $this->usuarios->obtenerTiposDocumentos();
                $this->datos['generos'] = $this->usuarios->obtenerGeneros();
                $this->datos['tipousuarios'] = $this->usuarios->obtenerTiposUsuario();
            }
        }

        $this->form_validation->set_rules('nombrecompleto', 'Nombre', 'required|max_length[100]');
        $this->form_validation->set_rules('nick', 'nombre de usuario', 'required|max_length[45]|alpha_numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('pais', 'pais', 'required|max_length[45]');
        $this->form_validation->set_rules('ciudad', 'ciudad', 'required|max_length[45]');
        $this->form_validation->set_rules('telefono', 'telefono', 'required|max_length[45]');
        $this->form_validation->set_rules('celular', 'celular', 'required|max_length[45]');
        $this->form_validation->set_rules('numdoc', 'documento de identidad', 'required|max_length[20]|alpha_numeric');
        $this->form_validation->set_rules('direccioncontacto', 'Dirección del representante', 'required|max_length[45]');
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
            $celular = $this->input->post('celular');

            if ($tipo == '1') {
                $res = $this->usuarios->actualizarUsuario($nombre, $nick, $email, $contra, $rol, $tipodoc, $numdoc, $fechanaci, $pais, $ciudad, $sangre, $genero, $tipo);
            } else if ($tipo == '2') {
                $res = $this->usuarios->actualizarUsuario($nombre, $nick, $email, $contra, $rol, $tipodoc, $numdoc, null, $pais, $ciudad, null, null, $tipo);
            }
            $this->usuarios->actualizarContacto($nick, $nomcont, $telefono, $dircont,$celular);
            if ($res) {
                $this->datos['resultado'] = 'si';
                $usr = $this->usuarios->obtenerUsuarioPorNick($nick);
                $usr = $usr[0];
                $this->datos['usuario'] = $usr;
            } else {
                $this->datos['resultado'] = 'no';
            }
        }

        $this->load->view('headerPublico', $this->datos);
        $this->load->view('formularioModificarUsuario', $this->datos);
        $this->load->view('footerPublico');
    }

    function eliminarUsuario($nick = null) {
        
        $this->datos['linksmenu'] = $this->menu;

        $this->load->view('headerPublico', $this->datos);
        $usr = $this->usuarios->obtenerUsuarioPorNick($nick);
        if (sizeof($usr) == 1) {
            $usr = $usr[0];
            $this->datos['usuario'] = $usr;
        }
        if ($this->input->post('eliminar') != false) {
            $nick = $this->input->post('nick');
            $yo = $this->session->userdata('usuario');
            if ($nick == $yo->nick) {
                $this->datos['estado'] = 'error';
            } else {
                $res = $this->usuarios->eliminarUsuario($nick);
                if ($res) {
                    $this->datos['estado'] = 'si';
                } else {
                    $this->datos['estado'] = 'no';
                }
            }
        }

        $this->load->view('formularioBorrarUsuario', $this->datos);
        $this->load->view('footerPublico');
    }

}

?>
