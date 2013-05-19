<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class gestionVoucher extends CI_Controller{
    static $datos = array();
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('usuarios');
        $this->load->model('voucher');
        
        $this->datos = array();
        $this->datos['linksmenu'] = array();

        $usr = $this->session->userdata('usuario');
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
    
    public function index(){
        $usr = $this->session->userdata('usuario');
        if ($usr == false){
            redirect(base_url().'index.php/login');
        }
        if ($usr->rol_id != 2){
            redirect(base_url());
        }
        
        $btn = $this->input->post('buscar');
        if ($btn != false){
            $docu = $this->input->post('documento');
            $usuario = $this->usuarios->obtenerUsuarioPorDocumento($docu);
            if (sizeof($usuario)==0){
                $this->datos['resultado']='no';
            }else{
                $this->datos['resultado']='si';
                $this->datos['usuario']=$usuario[0];
                
                $vouchers = $this->voucher->obtenerInfoDelCliente($docu);
                $this->datos['vouchers']=$vouchers;
            }
        }
        
        $this->load->view('headerPublico',$this->datos);
        $this->load->view('BuscarClientedeAlquiler',$this->datos);
        $this->load->view('footerPublico');
    }
    
    public function nuevoVoucher(){
        $usr = $this->session->userdata('usuario');
        if ($usr == false){
            redirect(base_url().'index.php/login');
        }
        if ($usr->rol_id != 2){
            redirect(base_url());
        }
        
        $btn = $this->input->post('ingresar');
        if ($btn != false){
            $this->form_validation->set_rules('documento','Numero de Documento','required');
            $this->form_validation->set_rules('nombre','Nombre del Cliente','required');
            $this->form_validation->set_rules('franquicia','Franquicia','required');
            $this->form_validation->set_rules('autorizacion','Numero de Autorizacion del Voucher','required|is_natural');
            $this->form_validation->set_rules('verificacion','Numero de Verificación de la Tarjeta','required|is_natural');
            $this->form_validation->set_rules('monto','Monto','required|is_numeric');
            $this->form_validation->set_rules('tarjeta','Numero de la Tarjeta','required|is_numeric');
            $this->form_validation->set_rules('banco','Banco','required|max_length[100]');
            if ($this->form_validation->run() != FALSE){
                $documento = $this->input->post('documento');
                $nombre = $this->input->post('nombre');
                $franquicia = $this->input->post('franquicia');
                $autorizacion = $this->input->post('autorizacion');
                $verificacion = $this->input->post('verificacion');
                $monto = $this->input->post('monto');
                $tarjeta = $this->input->post('tarjeta');
                $banco = $this->input->post('banco');
                $cliente=$this->usuarios->obtenerUsuarioPorDocumento($documento);
                if (sizeof($cliente)==0){
                    $this->datos['resultado']='errnocli';
                }else {
                    $cliente = $cliente[0];
                    $this->voucher->ingresarVoucher($documento,$nombre,$franquicia,$autorizacion,$verificacion,$monto,$tarjeta,$banco);
                    $this->datos['resultado']='si';
                    
                }
            }
        }
        
        $this->load->view('headerPublico',$this->datos);
        $this->load->view('FormularioVoucher',$this->datos);
        $this->load->view('footerPublico');
    }
    
}
?>
