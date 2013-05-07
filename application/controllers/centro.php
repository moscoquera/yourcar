<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class centro extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Vehiculos');
    }

    public function index() {
        $datos = array();
        $datos['linksmenu'] = array();
        if ($this->session->userdata('usuario') != false) {
            $usr = $this->session->userdata('usuario');
            $datos['usuario'] = $usr;
            if ($usr->rol_id == 1) {
                array_push($datos['linksmenu'], crearObjetoLink('panel de usuarios', base_url() . 'index.php/gestionarUsuarios'));
            }else if ($usr->rol_id==2){
                array_push($datos['linksmenu'], crearObjetoLink('gestionar Vehiculos', base_url() . 'index.php/gestionVehiculos'));
            }
        }
        $tmpfrenos = $this->Vehiculos->frenos();
        $frenos = array();
        foreach ($tmpfrenos as $obj){
            $frenos[$obj->id]=$obj->nombre;
        }
        
        $tmpvehiculos = $this->Vehiculos->direccion();
        $direcciones = array();
        foreach ($tmpvehiculos as $obj){
            $direcciones[$obj->id]=$obj->nombre;
        }
        
        $tmp = $this->Vehiculos->vehiculos();
        $datos['vehiculos']=array();
        foreach ($tmp as $ve){
            $ve->direccion=$direcciones[$ve->direccion];
            $ve->frenos=$frenos[$ve->frenos];
            array_push($datos['vehiculos'], $ve);
        }
        $this->load->view('headerPublico',$datos);
        $this->load->view('centro_view', $datos);
        $this->load->view('footerPublico');
    }

    public function cotizacion(){
        
    }
    
}
?>


