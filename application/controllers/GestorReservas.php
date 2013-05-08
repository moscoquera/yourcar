<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class GestorReservas extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('reservas');
        $this->load->model('usuarios');
        $this->load->model('Vehiculos');
        $this->output->enable_profiler(true);
    }
    
    public function  index(){
        $this->load->view('headerPublico');
        $this->load->view('indexReservas');
        $this->load->view('footerPublico');
    }
    
    public function reservar(){
        $datos['lugares']=$this->reservas->obtenerLugares();
        $datos['vehiculos']=$this->Vehiculos->vehiculos();
        
        $usr = $this->session->userdata('usuario');
        if ($usr==false){
            redirect('login');
        }
        $datos['usuario']=$this->usuarios->obtenerUsuarioPorNick($usr->nick);
        $datos['usuario']=$datos['usuario'][0];
        
        $btn = $this->input->post('btnreservar');
        if ($btn !=false){
            $datos['horainicio']=$this->input->post('horainicio');
            $datos['horafin']=$this->input->post('horafin');
            $datos['lugarentrega']=$this->input->post('lugarentrega');
            $datos['lugarrecepcion']=$this->input->post('lugarrecepcion');
            $datos['costo'] = $this->input->post('costo');
            $datos['placa'] = $this->input->post('placa');
            if ($datos['placa']!=false){
                $datos['vehiculo']=$this->Vehiculos->buscarVehiculo($datos['placa']);
                $datos['vehiculo']=$datos['vehiculo'][0];
                
                $res = $this->Vehiculos->direccion($datos['vehiculo']->direccion);
                if (sizeof($res)>0){
                    $datos['vehiculo']->direccion=$res[0]->nombre;
                }
                $res = $this->Vehiculos->frenos($datos['vehiculo']->frenos);
                if (sizeof($res)>0){
                    $datos['vehiculo']->frenos=$res[0]->nombre;
                }
            }
        }
        
        //reservando
        $reser = $this->input->post('reserva');
        if ($reser != false){
            $this->form_validation->set_rules('horainicio', 'Hora de Inicio', 'required');
            $this->form_validation->set_rules('horafin', 'Hora de Fin', 'required');
            $this->form_validation->set_rules('lugarentrega', 'Lugar de Entrega', 'required');
            $this->form_validation->set_rules('lugarrecepcion', 'Lugar de Recepcion', 'required');
            if ($this->form_validation->run() != FALSE) {
                $horai = $this->input->post('horainicio');
                $horaf = $this->input->post('horafin');
                $horai = DateTime::createFromFormat('d/m/Y H:i', $horai);
                $horaf = DateTime::createFromFormat('d/m/Y H:i', $horaf);

                $placa = $this->input->post('placa');
                if ($horai > $horaf) {
                    $datos['resultado'] = 'errfecha';
                } else {
                    $lugari = $this->input->post('lugarentrega');
                    $lugarf = $this->input->post('lugarrecepcion');
                    $tiempo = $horaf->diff($horai);
                    $veh = $this->Vehiculos->buscarVehiculo($placa);
                    $veh = $veh[0];
                    $costo = ($veh->tarifa * $tiempo->d);
                    $costo+= ($tiempo->h <= 6) ? ($veh->tarifa / 4) : $veh->tarifa;
                    
                    $tari = $this->reservas->obtenerLugares($lugari);
                    $costo+=$tari[0]->valor;
                    
                    $tari = $this->reservas->obtenerLugares($lugarf);
                    $costo+=$tari[0]->valor;
                    
                    $horai2=$horai->format('Y-m-d H:i:s');
                    $horaf2 = $horaf->format('Y-m-d H:i:s');

                    $this->reservas->insertarReserva($usr->nick,$placa,$costo,$horai2,$horaf2,$lugari,$lugarf);
                    $datos['resultado'] = 'si';
                    
                }
            }
        }
        $this->load->view('headerPublico');
        $this->load->view('FormularioCrearSolicitudReserva',$datos);
        $this->load->view('footerPublico');
    }
} 
?>
