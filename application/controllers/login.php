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
        $this->load->view('Formulariologin');
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
        $this->load->view('Formulariologin');
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
    
    public function crearCuenta(){
        $datos = array();
        $datos['roles'] = $this->usuarios->obtenerRoles();
        $tmp = array();
        foreach ($datos['roles'] as $rol){
            if ($rol->id != '1' && $rol->id != '2'){
                array_push($tmp, $rol);
            }
        }
        $datos['roles']=$tmp;
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
        $this->form_validation->set_rules('celular', 'celular', 'required|max_length[45]');
        $this->form_validation->set_rules('numdoc', 'documento de identidad', 'required|max_length[20]|alpha_numeric');
        $this->form_validation->set_rules('direccioncontacto', 'Dirección del representante', 'required|max_length[45]');
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


        $this->load->view('headerPublico', $datos);
        $this->load->view('formularioCrearUsuario', $datos);
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
    
}

?>
