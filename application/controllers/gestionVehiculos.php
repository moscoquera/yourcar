<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class gestionVehiculos extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('Vehiculos');
    }
    
    public function index(){
        $usr = $this->session->userdata('usuario');
        if ($usr==false || $usr->rol_id != '2'){
            redirect(base_url());
        }
        
        $this->load->view('headerPublico');
        $this->load->view('indexVehiculos');
        $this->load->view('footerPublico');
    }
    
    public function crearVehiculo(){
        $usr = $this->session->userdata('usuario');
        if ($usr==false || $usr->rol_id != '2'){
            redirect(base_url());
        }
        
        $datos['frenos']=$this->Vehiculos->frenos();
        $datos['direccion']=$this->Vehiculos->direccion();
        
        $this->form_validation->set_rules('placa','placa','required|max_length[7]|alpha_numeric');
        $this->form_validation->set_rules('marca','marca','required|trim|max_length[45]');
        $this->form_validation->set_rules('modelo','modelo','required|max_length[45]');
        $this->form_validation->set_rules('color','color','required|max_length[45]');
        $this->form_validation->set_rules('cilindraje','cilindraje','required|is_natural');
        $this->form_validation->set_rules('frenos','cilindraje','required|is_natural');
        $this->form_validation->set_rules('direccion','cilindraje','required|is_natural');
        $this->form_validation->set_rules('descripcion','descripcion','required|max_length[1000]');
        $this->form_validation->set_rules('pasajeros','numero de pasajeros','required|is_natural');
        $this->form_validation->set_rules('fechasoat','fecha de compra del soat','required');
        $this->form_validation->set_rules('fechaseg','fecha de compra del seguro','required');
        $this->form_validation->set_rules('fechatec','fecha de revision tecnica','required');
        $this->form_validation->set_rules('tarifa','tarifa','required|is_natural');
        $this->form_validation->set_rules('garantia','garantia','required|is_natural');
        
        if ($this->form_validation->run() != FALSE){
            $placa=$this->input->post('placa');
            $marca= $this->input->post('marca');
            $modelo= $this->input->post('modelo');
            $color = $this->input->post('color');
            $cilindraje = $this->input->post('cilindraje');
            $frenos = $this->input->post('frenos');
            $direccion = $this->input->post('direccion');
            $descripcion = $this->input->post('descripcion');
            $pasajeros = $this->input->post('pasajeros');
            $fechasoat = $this->input->post('fechasoat');
            $fechaseg = $this->input->post('fechaseg');
            $fechatec = $this->input->post('fechatec');
            $tarifa = $this->input->post('tarifa');
            $garantia = $this->input->post('garantia');
            $res=$this->Vehiculos->insertarVehiculo($placa,$marca,$modelo,$color,$cilindraje,$frenos,$direccion,$descripcion,$pasajeros,$fechasoat,$fechaseg,$fechatec,$tarifa,$garantia);
            if ($res==true){
                $datos['estado']='si';
            }else{
                $datos['estado']='no';
            }
        }
        $this->load->view('headerPublico');
        $this->load->view('FormularioCrearVehiculo',$datos);
        $this->load->view('footerPublico');
    }
    
    public function modificarVehiculo(){
        $this->load->view('headerPublico');
        $this->load->view('FormularioCrearVehiculo',$datos);
        $this->load->view('footerPublico');
    }
    
}

?>
