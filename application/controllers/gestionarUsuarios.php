<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class gestionarUsuarios extends CI_Controller{
    
    var $menu = array();
    
    
    public function __construct() {
        parent::__construct();
        $this->load->model('usuarios');
        $this->load->library('gestormensajes');
        $this->load->helper('correo');
        array_push($this->menu,crearObjetoLink('inicio',base_url()));
        
        $this->output->enable_profiler(true);
    }
    
    
    
    public function index(){
        $datos = array();
        $datos['linksmenu']=  $this->menu;
        $this->load->view('headerPublico',$datos);
        $this->load->view('PanelAdminTec');
        $this->load->view('footerPublico');
        
    }
    
    public function crearUsuario(){
            
        
        $datos = array();
        $datos['linksmenu']=  $this->menu;
        $datos['roles']=$this->usuarios->obtenerRoles();
        
        $this->form_validation->set_rules('nombrecompleto','Nombre','required|max_length[100]');
        $this->form_validation->set_rules('nick','nombre de usuario','required|max_length[45]|alpha_numeric');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('contra','Contraseña','required');
        $this->form_validation->set_rules('repcontra','Contraseña 2','required|matches[contra]');
        
        //agregar
        if ($this->form_validation->run() !=false){
            $nombre =$this->input->post('nombrecompleto');
            $nick = $this->input->post('nick');
            $email = $this->input->post('email');
            $contra = $this->input->post('contra');
            $rol = $this->input->post('rol');
            if ($nombre != false && $nick!=false && $email != false && $contra!=False){
                $res=$this->usuarios->insertarUsuario($nombre,$nick,$email,$contra,$rol);
                if ($res){
                    $this->gestormensajes->enviarEmail($email,'Registro de usuario',nuevoEmailRegistro($nombre, $nick, $contra));
                    $datos['resultado']='si';
                }else{
                    $datos['resultado']='no';
                }
            }
        }
        
        
        $this->load->view('headerPublico',$datos);
        $this->load->view('formularioCrearUsuario',$datos);
        $this->load->view('footerPublico');
        
    }
    
}
?>
