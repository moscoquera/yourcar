<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class GestionVoucher extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('usuarios');
        $this->load->model('voucher');
    }
    
    public function index(){
        $datos = array();
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
                $datos['resultado']='no';
            }else{
                $datos['resultado']='si';
                $datos['usuario']=$usuario[0];
                
                $vouchers = $this->voucher->obtenerInfoDelCliente($docu);
                $datos['vouchers']=$vouchers;
            }
        }
        $this->load->view('headerPublico');
        $this->load->view('BuscarClientedeAlquiler',$datos);
        $this->load->view('footerPublico');
    }
    
    public function nuevoVoucher(){
        $datos = array();
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
            $this->form_validation->set_rules('franquicia','Franquicia','required');
            $this->form_validation->set_rules('autorizacion','Numero de Autorizacion del Voucher','required|is_natural');
            $this->form_validation->set_rules('verificacion','Numero de Verificación de la Transaccion','required|is_natural');
            $this->form_validation->set_rules('monto','Monto','required|is_numeric');
            $this->form_validation->set_rules('tarjeta','Numero de la Tarjeta','required|is_numeric');
            $this->form_validation->set_rules('banco','Banco','required|max_length[100]');
            if ($this->form_validation->run() != FALSE){
                $documento = $this->input->post('documento');
                $franquicia = $this->input->post('franquicia');
                $autorizacion = $this->input->post('autorizacion');
                $verificacion = $this->input->post('verificacion');
                $monto = $this->input->post('monto');
                $tarjeta = $this->input->post('tarjeta');
                $banco = $this->input->post('banco');
                $cliente=$this->usuarios->obtenerUsuarioPorDocumento($documento);
                if (sizeof($cliente)==0){
                    $datos['resultado']='errnocli';
                }else {
                    $cliente = $cliente[0];
                    $this->voucher->ingresarVoucher($documento,$franquicia,$autorizacion,$verificacion,$monto,$tarjeta,$banco);
                    $datos['resultado']='si';
                    
                }
            }
        }
        
        $this->load->view('headerPublico');
        $this->load->view('FormularioVoucher',$datos);
        $this->load->view('footerPublico');
    }
    
}
?>
