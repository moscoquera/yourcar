<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class gestorReservas extends CI_Controller {

    static $lugares = array();
    static $datos;

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

        $this->datos = array();
        $this->datos['linksmenu'] = array();

        $usr = $this->session->userdata('usuario');
        $this->datos['usuario'] = $usr;
        if ($usr == false){
            
        }else if ($usr->rol_id == 1) {
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
        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect('login');
        }
        $bus = $this->input->post('buscar');
        if ($bus != false) {
            $this->form_validation->set_rules('id', 'id', 'required');
            if ($this->form_validation->run() != false) {
                $idb = $this->input->post('id');
                $res = $this->reservas->reserva($idb);
                if ($res == null || $usr->rol_id != 2) {
                    $this->datos['resultado'] = 'no';
                } else {
                    $res->lugarinicio = $this->lugares[$res->lugarinicio];
                    $res->lugarfin = $this->lugares[$res->lugarfin];
                    $this->datos['resultado'] = 'si';
                    $this->datos['reserva'] = $res;
                }
            }
        }

        $this->datos['reservas'] = array();
        $tmp = $this->reservas->reservasPorUsuario($usr->nick);
        foreach ($tmp as $t) {
            $t->lugarinicio = $this->lugares[$t->lugarinicio];
            $t->lugarfin = $this->lugares[$t->lugarfin];
            array_push($this->datos['reservas'], $t);
        }

        $this->load->view('headerPublico', $this->datos);
        $this->load->view('indexReservas', $this->datos);
        $this->load->view('footerPublico');
    }

    public function reservar() {
        $this->datos['lugares'] = $this->reservas->obtenerLugares();
        $this->datos['vehiculos'] = $this->Vehiculos->vehiculos();

        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect('login');
        }
        $this->datos['usuario'] = $this->usuarios->obtenerUsuarioPorNick($usr->nick);
        $this->datos['usuario'] = $this->datos['usuario'][0];

        $btn = $this->input->post('btnreservar');
        if ($btn != false) {
            $this->datos['horainicio'] = $this->input->post('horainicio');
            $this->datos['horafin'] = $this->input->post('horafin');
            $this->datos['lugarentrega'] = $this->input->post('lugarentrega');
            $this->datos['lugarrecepcion'] = $this->input->post('lugarrecepcion');
            $this->datos['costo'] = $this->input->post('costo');
            $this->datos['placa'] = $this->input->post('placa');
            if ($this->datos['placa'] != false) {
                $this->datos['vehiculo'] = $this->Vehiculos->buscarVehiculo($this->datos['placa']);
                $this->datos['vehiculo'] = $this->datos['vehiculo'][0];

                $res = $this->Vehiculos->direccion($this->datos['vehiculo']->direccion);
                if (sizeof($res) > 0) {
                    $this->datos['vehiculo']->direccion = $res[0]->nombre;
                }
                $res = $this->Vehiculos->frenos($this->datos['vehiculo']->frenos);
                if (sizeof($res) > 0) {
                    $this->datos['vehiculo']->frenos = $res[0]->nombre;
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

                    $horai2 = $horai->format('Y-m-d H:i:s');
                    $horaf2 = $horaf->format('Y-m-d H:i:s');

                    $res=$this->reservas->insertarReserva($usr->nick, $placa, $costo, $horai2, $horaf2, $lugari, $lugarf);
                    if (is_bool($res) && $res){
                        $this->datos['resultado'] = 'si';
                    }else {
                        $this->datos['resultado'] = 'no';
                        $this->datos['error'] = $res;
                    }
                    
                }
            }
        }
        $this->load->view('headerPublico', $this->datos);
        $this->load->view('FormularioCrearSolicitudReserva', $this->datos);
        $this->load->view('footerPublico');
    }

    public function ingresarPagos($id = null) {
        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect('login');
        }
        $reserva = $this->reservas->reserva($id);
        if ($reserva != null) {
            if ($reserva->usuarioid == $usr->nick || $reserva->rol_id == 2) {
                $reserva->lugarinicio = $this->lugares[$reserva->lugarinicio];
                $reserva->lugarfin = $this->lugares[$reserva->lugarfin];

                $this->datos['reserva'] = $reserva;
            }

            if ($this->input->post('btnguardar') != FALSE) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = '1024';
                $config['max_width'] = '1024';
                $config['max_height'] = '768';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('comprobante')) {
                    $this->datos['resultado'] = 'noup';
                    $this->datos['error'] = $this->upload->display_errors();
                } else {
                    $usuario = $this->usuarios->obtenerUsuarioPorNick($reserva->usuarioid);
                    $usuario = $usuario[0];
                    $nombre = $this->upload->data();
                    $nombre = $nombre['file_name'];
                    $this->reservas->actualizarPago($id, $nombre);
                    $emails = $this->usuarios->emailsAdministradoresEmpresa();
                    $this->gestormensajes->enviarEmail($emails, "Nuevo comprobante de Pago para la Reserva $id", nuevaPagoReserva($id, $usuario->nick, $usuario->nombres, $usuario->ndocumento));
                    $this->datos['resultado'] = 'si';
                    $this->datos['imagen']=$nombre;
                }
            }
        }
        $this->load->view('headerPublico', $this->datos);
        $this->load->view('formularioIngresarPago', $this->datos);
        $this->load->view('footerPublico');
    }

    public function aprobarPago($reserva = null) {
        $usr = $this->session->userdata('usuario');
        if ($usr == false || $usr->rol_id != 2) {
            redirect('login');
        }
        if ($reserva != null) {
            $re = $this->reservas->reserva($reserva);
            $usuario = $this->usuarios->obtenerUsuarioPorNick($re->usuarioid);
            $usuario = $usuario[0];
            $this->reservas->validarPago($reserva, true);
            $this->datos['resultado'] = 'siact';
            $this->gestormensajes->enviarEmail($usuario->email, 'Actualizacion de Estado de Reserva', actualizacionPago($reserva, $usuario->nombres, 'Aprobada'));
        } else {
            $this->datos['resultado'] = 'noact';
        }

        $this->load->view('headerPublico', $this->datos);
        $this->load->view('indexReservas', $this->datos);
        $this->load->view('footerPublico');
    }

    public function negarPago($reserva = null) {
        $usr = $this->session->userdata('usuario');
        if ($usr == false || $usr->rol_id != 2) {
            redirect('login');
        }
        if ($reserva != null) {
            $usuario = $this->usuarios->obtenerUsuarioPorNick($reserva->usuarioid);
            $usuario = $usuario[0];

            $this->reservas->validarPago($reserva, false);
            $this->datos['resultado'] = 'noact';

            $this->gestormensajes->enviarEmail($usuario->email, 'Actualizacion de Estado de Reserva', actualizacionPago($reserva->id, $usuario->nombres, 'Reprobado'));
        } else {
            $this->datos['resultado'] = 'noact';
        }
        $this->load->view('headerPublico', $this->datos);
        $this->load->view('indexReservas', $this->datos);
        $this->load->view('footerPublico');
    }

}

?>
