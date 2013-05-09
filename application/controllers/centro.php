<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class centro extends CI_Controller {

    static $datos = array();

    public function __construct() {
        parent::__construct();

        $this->load->model('Vehiculos');
        $this->load->model('usuarios');
        $this->load->model('reservas');
        $this->datos = array();
        $this->datos['linksmenu'] = array();

        $usr = $this->session->userdata('usuario');
        if ($usr != false) {
            $this->datos['usuario'] = $usr;
            if ($usr->rol_id == 1) {
                array_push($this->datos['linksmenu'], crearObjetoLink('PANEL DE USUARIOS', base_url() . 'index.php/gestionarUsuarios'));
            } else if ($usr->rol_id == 2) {
                array_push($this->datos['linksmenu'], crearObjetoLink('Mis Reservas', base_url() . 'index.php/GestorReservas'));
                array_push($this->datos['linksmenu'], crearObjetoLink('Gestionar Vehiculos', base_url() . 'index.php/gestionVehiculos'));
                array_push($this->datos['linksmenu'], crearObjetoLink('Modificar Información', base_url() . 'index.php/informacion/modificarInformacion'));
                array_push($this->datos['linksmenu'], crearObjetoLink('Mantenimientos', base_url() . 'index.php/mantenimientos'));
                array_push($this->datos['linksmenu'], crearObjetoLink('Registrar Voucher', base_url() . 'index.php/GestionVoucher/nuevoVoucher'));
                array_push($this->datos['linksmenu'], crearObjetoLink('Consultar Voucher', base_url() . 'index.php/GestionVoucher'));
            } else if ($usr->rol_id == 3) {
                array_push($this->datos['linksmenu'], crearObjetoLink('Mis Reservas', base_url() . 'index.php/GestorReservas'));
            }
        }
    }

    public function index() {
        if ($this->session->userdata('usuario') != false) {
            
        }
        $tmpfrenos = $this->Vehiculos->frenos();
        $frenos = array();
        foreach ($tmpfrenos as $obj) {
            $frenos[$obj->id] = $obj->nombre;
        }

        $tmpvehiculos = $this->Vehiculos->direccion();
        $direcciones = array();
        foreach ($tmpvehiculos as $obj) {
            $direcciones[$obj->id] = $obj->nombre;
        }

        $tmp = $this->Vehiculos->vehiculos();
        $this->datos['vehiculos'] = array();
        foreach ($tmp as $ve) {
            $ve->direccion = $direcciones[$ve->direccion];
            $ve->frenos = $frenos[$ve->frenos];
            array_push($this->datos['vehiculos'], $ve);
        }
        $this->load->view('headerPublico', $this->datos);
        $this->load->view('centro_view', $this->datos);
        $this->load->view('footerPublico');
    }

    public function cotizacion($placa = null) {
        $this->datos = array();
        $this->datos['lugares'] = $this->reservas->obtenerLugares();
        $this->load->view('headerPublico', $this->datos);

        if ($placa != null) {
            $res = $this->Vehiculos->buscarVehiculo($placa);
            if (sizeof($res) > 0) {
                $this->datos['vehiculo'] = $res[0];
            }
            $this->load->view('informacionVehiculo', $this->datos);
        }
        $cot = $this->input->post('btncotizar');
        if ($cot != false) {
            $this->form_validation->set_rules('horainicio', 'Hora de Inicio', 'required');
            $this->form_validation->set_rules('horafin', 'Hora de Fin', 'required');
            $this->form_validation->set_rules('lugarentrega', 'Lugar de Entrega', 'required');
            $this->form_validation->set_rules('lugarrecepcion', 'Lugar de Recepcion', 'required');
            if ($this->form_validation->run() != FALSE) {
                $usr = $this->input->post('email');
                if ($usr != false) {
                    $this->usuarios->anadirAPotencialesClientes($usr);
                }
                $horai = $this->input->post('horainicio');
                $horaf = $this->input->post('horafin');
                $horai = DateTime::createFromFormat('d/m/Y H:i', $horai);
                $horaf = DateTime::createFromFormat('d/m/Y H:i', $horaf);

                $placa = $this->input->post('placa');
                if ($horai > $horaf) {
                    $this->datos['resultado'] = 'errfecha';
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
                    $this->datos['resultado'] = 'si';
                    $this->datos['costo'] = $costo;
                }
            }
        }
        $this->load->view('Cotizacion', $this->datos);
        $this->load->view('footerPublico');
    }

}
?>


