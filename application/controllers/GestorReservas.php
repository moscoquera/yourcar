<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class GestorReservas extends CI_Controller {

    static $lugares = array();

    public function __construct() {
        parent::__construct();
        $this->load->model('reservas');
        $this->load->model('usuarios');
        $this->load->model('Vehiculos');
        $this->load->library('gestormensajes');
        $this->load->helper('correo');
        
        
        
        $ltmp = $this->reservas->obtenerLugares();
        foreach ($ltmp as $lugar) {
            $this->lugares[$lugar->id] = $lugar->nombre;
        }

        $this->output->enable_profiler(true);
    }
    
    
    

    public function index() {
        $datos = array();
        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect('login');
        }
        $bus = $this->input->post('buscar');
        if ($bus != false){
            $this->form_validation->set_rules('id','id','required');
            if ($this->form_validation->run() != false){
                $idb = $this->input->post('id');
                $res=$this->reservas->reserva($idb);
                if ($res==null || $usr->rol_id != 2){
                    $datos['resultado']='no';
                }else{
                    $res->lugarinicio=$this->lugares[$res->lugarinicio];
                    $res->lugarfin=$this->lugares[$res->lugarfin];
                    $datos['resultado']='si';
                    $datos['reserva']=$res;
                }
            }
        }
        
        $datos['reservas'] = array();
        $tmp = $this->reservas->reservasPorUsuario($usr->nick);
        foreach ($tmp as $t) {
            $t->lugarinicio = $this->lugares[$t->lugarinicio];
            $t->lugarfin = $this->lugares[$t->lugarfin];
            array_push($datos['reservas'], $t);
        }

        $this->load->view('headerPublico');
        $this->load->view('indexReservas', $datos);
        $this->load->view('footerPublico');
    }

    
    
    public function reservar() {
        $datos['lugares'] = $this->reservas->obtenerLugares();
        $datos['vehiculos'] = $this->Vehiculos->vehiculos();

        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect('login');
        }
        $datos['usuario'] = $this->usuarios->obtenerUsuarioPorNick($usr->nick);
        $datos['usuario'] = $datos['usuario'][0];

        $btn = $this->input->post('btnreservar');
        if ($btn != false) {
            $datos['horainicio'] = $this->input->post('horainicio');
            $datos['horafin'] = $this->input->post('horafin');
            $datos['lugarentrega'] = $this->input->post('lugarentrega');
            $datos['lugarrecepcion'] = $this->input->post('lugarrecepcion');
            $datos['costo'] = $this->input->post('costo');
            $datos['placa'] = $this->input->post('placa');
            if ($datos['placa'] != false) {
                $datos['vehiculo'] = $this->Vehiculos->buscarVehiculo($datos['placa']);
                $datos['vehiculo'] = $datos['vehiculo'][0];

                $res = $this->Vehiculos->direccion($datos['vehiculo']->direccion);
                if (sizeof($res) > 0) {
                    $datos['vehiculo']->direccion = $res[0]->nombre;
                }
                $res = $this->Vehiculos->frenos($datos['vehiculo']->frenos);
                if (sizeof($res) > 0) {
                    $datos['vehiculo']->frenos = $res[0]->nombre;
                }
            }
        }

        //reservando
        $reser = $this->input->post('reserva');
        if ($reser != false) {
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

                    $horai2 = $horai->format('Y-m-d H:i:s');
                    $horaf2 = $horaf->format('Y-m-d H:i:s');

                    $this->reservas->insertarReserva($usr->nick, $placa, $costo, $horai2, $horaf2, $lugari, $lugarf);
                    $datos['resultado'] = 'si';
                }
            }
        }
        $this->load->view('headerPublico');
        $this->load->view('FormularioCrearSolicitudReserva', $datos);
        $this->load->view('footerPublico');
    }

    public function ingresarPagos($id = null) {
        $datos = array();
        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect('login');
        }
        $reserva = $this->reservas->reserva($id);
        if ($reserva != null) {
            if ($reserva->usuarioid == $usr->nick || $reserva->rol_id == 2) {
                $reserva->lugarinicio = $this->lugares[$reserva->lugarinicio];
                $reserva->lugarfin = $this->lugares[$reserva->lugarfin];

                $datos['reserva'] = $reserva;
            }


            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '1024';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('comprobante')) {
                $datos['resultado'] = 'noup';
                $datos['error'] = $this->upload->display_errors();
            } else {
                $usuario = $this->usuarios->obtenerUsuarioPorNick($reserva->usuarioid);
                $usuario = $usuario[0];
                $nombre = $this->upload->data();
                $nombre = $nombre['file_name'];
                $this->reservas->actualizarPago($id, $nombre);
                $emails = $this->usuarios->emailsAdministradoresEmpresa();
                $this->gestormensajes->enviarEmail($emails, "Nuevo comprobante de Pago para la Reserva $id", nuevaPagoReserva($id,$usuario->nick,$usuario->nombres,$usuario->ndocumento ));
                $datos['resultado'] = 'si';
            }
        }
        $this->load->view('headerPublico');
        $this->load->view('formularioIngresarPago', $datos);
        $this->load->view('footerPublico');
    }
    
    public function aprobarPago($reserva = null){
        $datos = array();
        $usr = $this->session->userdata('usuario');
        if ($usr == false || $usr->rol_id != 2) {
            redirect('login');
        }
        if ($reserva != null){
            
            
        }
        
        $this->load->view('headerPublico');
        $this->load->view('formularioIngresarPago', $datos);
        $this->load->view('footerPublico');
    }
    
    public function negarPago($reserva = null){
        $this->load->view('headerPublico');
        $this->load->view('formularioIngresarPago', $datos);
        $this->load->view('footerPublico');
    }
}

?>
