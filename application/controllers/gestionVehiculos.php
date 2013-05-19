<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class gestionVehiculos extends CI_Controller {

    static $datos;

    public function __construct() {
        parent::__construct();

        $this->load->model('Vehiculos');
        $this->load->model('mmantenimientos');

        $this->datos = array();
        $this->datos['linksmenu'] = array();

        $usr = $this->session->userdata('usuario');
        $this->datos['usuario'] = $usr;
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

    public function index() {
        $usr = $this->session->userdata('usuario');
        if ($usr == false || $usr->rol_id != '2') {
            redirect(base_url());
        }

        $btn = $this->input->post('buscar');
        if ($btn != FALSE) {
            $this->form_validation->set_rules('texto', 'texto', 'required');
            if ($this->form_validation->run() != false) {
                $placa = $this->input->post('texto');
                $res = $this->Vehiculos->buscarVehiculo($placa);
                if (sizeof($res) > 0) {
                    redirect('gestionVehiculos/ver/' . $placa);
                } else {
                    $this->datos['res'] = 'no';
                }
            }
        }
        $this->load->view('headerPublico', $this->datos);
        $this->load->view('indexVehiculos', $this->datos);
        $this->load->view('footerPublico');
    }

    public function historialmantenimientos() {
        $usr = $this->session->userdata('usuario');
        if ($usr == false || $usr->rol_id != '2') {
            redirect(base_url());
        }

        $btn = $this->input->post('buscar');
        if ($btn != FALSE) {
            $this->form_validation->set_rules('texto', 'texto', 'required');
            if ($this->form_validation->run() != false) {
                $placa = $this->input->post('texto');
                $res = $this->Vehiculos->buscarVehiculo($placa);
                if (sizeof($res) > 0) {

                    $tip = $this->mmantenimientos->tipos();
                    $tipos = array();
                    foreach ($tip as $t) {
                        $tipos[$t->id] = $t->nombre;
                    }

                    $tmp = $this->mmantenimientos->mantenimientosPorPlaca($placa);

                    $this->datos['mantenimientos'] = array();
                    foreach ($tmp as $man) {
                        $man->tipo = $tipos[$man->tipo];
                        array_push($this->datos['mantenimientos'], $man);
                    }
                } else {
                    $this->datos['res'] = 'no';
                }
            }
        }
        $this->load->view('headerPublico', $this->datos);
        $this->load->view('historialMantenimiento', $this->datos);
        $this->load->view('footerPublico');
    }

    public function crearVehiculo() {
        $usr = $this->session->userdata('usuario');
        if ($usr == false || $usr->rol_id != '2') {
            redirect(base_url());
        }

        $this->datos['frenos'] = $this->Vehiculos->frenos();
        $this->datos['direccion'] = $this->Vehiculos->direccion();
        $this->datos['gamas'] = $this->Vehiculos->gamas();
        $this->datos['traccion'] = $this->Vehiculos->traccion();
        $this->datos['transmision'] = $this->Vehiculos->transmision();
        $this->form_validation->set_rules('placa', 'placa', 'required|max_length[7]|alpha_numeric');
        $this->form_validation->set_rules('marca', 'marca', 'required|trim|max_length[45]');
        $this->form_validation->set_rules('modelo', 'modelo', 'required|max_length[45]');
        $this->form_validation->set_rules('color', 'color', 'required|max_length[45]');
        $this->form_validation->set_rules('cilindraje', 'cilindraje', 'required|is_natural');
        $this->form_validation->set_rules('frenos', 'cilindraje', 'required|is_natural');
        $this->form_validation->set_rules('direccion', 'cilindraje', 'required|is_natural');
        $this->form_validation->set_rules('descripcion', 'descripcion', 'required|max_length[1000]');
        $this->form_validation->set_rules('pasajeros', 'numero de pasajeros', 'required|is_natural');
        $this->form_validation->set_rules('fechasoat', 'fecha de compra del soat', 'required');
        $this->form_validation->set_rules('fechaseg', 'fecha de compra del seguro', 'required');
        $this->form_validation->set_rules('fechatec', 'fecha de revision tecnica', 'required');
        $this->form_validation->set_rules('tarifa', 'tarifa', 'required|is_natural');
        $this->form_validation->set_rules('garantia', 'garantia', 'required|is_natural');
        $this->form_validation->set_rules('kmsdia', 'Kilometros por dia', 'required|is_natural');
        $this->form_validation->set_rules('iva', 'Iva', 'required|is_natural');
        $this->form_validation->set_rules('gasolina', 'Valor Galon de Gasolina', 'required|is_natural');
        $this->form_validation->set_rules('lavada', 'Valor de la Lavada', 'required|is_natural');
        $this->form_validation->set_rules('conductor', 'Precio del Conductor', 'required|is_natural');
        $this->form_validation->set_rules('fechaaceite', 'Fecha de Cambio de Aceite', 'required');
        $this->form_validation->set_rules('gama', 'Gama', 'required');
        $this->form_validation->set_rules('transmision', 'Transmision', 'required');
        $this->form_validation->set_rules('traccion', 'Traccion', 'required');

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = '1024';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            if ($this->form_validation->run() != FALSE) {
                $placa = $this->input->post('placa');
                $marca = $this->input->post('marca');
                $modelo = $this->input->post('modelo');
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
                $kmsdia = $this->input->post('kmsdia');
                $iva = $this->input->post('iva');
                $gasolina = $this->input->post('gasolina');
                $lavada = $this->input->post('lavada');
                $airbags = $this->input->post('airbags');
                $airbags = ($airbags != false);
                $conductor = $this->input->post('conductor');
                $fechaaceite = $this->input->post('fechaaceite');
                $gama = $this->input->post('gama');
                $transmision = $this->input->post('transmision');
                $traccion = $this->input->post('traccion');
                $foto = $this->upload->data();
                $foto = $foto['file_name'];
                $res = $this->Vehiculos->insertarVehiculo($placa, $marca, $modelo, $color, $cilindraje, $frenos, $direccion, $descripcion, $pasajeros, $fechasoat, $fechaseg, $fechatec, $tarifa, $garantia, $kmsdia, $iva, $gasolina, $lavada, $airbags, $conductor, $fechaaceite, $gama, $transmision, $traccion, $foto);
                if ($res == true) {
                    $this->datos['estado'] = 'si';
                } else {
                    $this->datos['estado'] = 'no';
                }
            }
        } else {
            $this->datos['estado'] = 'fotoerr';
            $this->datos['error'] = $this->upload->display_errors();
        }
        $this->load->view('headerPublico', $this->datos);
        $this->load->view('FormularioCrearVehiculo', $this->datos);
        $this->load->view('footerPublico');
    }

    public function modificarVehiculo() {
        $this->datos['frenos'] = $this->Vehiculos->frenos();
        $this->datos['direccion'] = $this->Vehiculos->direccion();
        $this->datos['gamas'] = $this->Vehiculos->gamas();
        $this->datos['traccion'] = $this->Vehiculos->traccion();
        $this->datos['transmision'] = $this->Vehiculos->transmision();

        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect(base_url());
        }
        //si buscar
        $buscar = $this->input->post('buscar');
        if ($buscar != false) {
            $this->form_validation->set_rules('busqueda', 'nick', 'required');
            if ($this->form_validation->run() != false) {
                $buscar = $this->input->post('busqueda');
                $buscar = $this->Vehiculos->buscarVehiculo($buscar);
                if (sizeof($buscar) == 0) {
                    $this->datos['resultado'] = 'nove';
                } else {
                    $this->datos['vehiculo'] = $buscar[0];
                }
            }
        }

        //si modificando
        $mod = $this->input->post('modificar');
        if ($mod != false) {
            $bus = $this->Vehiculos->buscarVehiculo($buscar);
            if (sizeof($bus) > 0) {
                $this->datos['vehiculo'] = $bus[0];
            }
            $this->form_validation->set_rules('placa', 'placa', 'required|max_length[7]|alpha_numeric');
            $this->form_validation->set_rules('marca', 'marca', 'required|trim|max_length[45]');
            $this->form_validation->set_rules('modelo', 'modelo', 'required|max_length[45]');
            $this->form_validation->set_rules('color', 'color', 'required|max_length[45]');
            $this->form_validation->set_rules('cilindraje', 'cilindraje', 'required|is_natural');
            $this->form_validation->set_rules('frenos', 'cilindraje', 'required|is_natural');
            $this->form_validation->set_rules('direccion', 'cilindraje', 'required|is_natural');
            $this->form_validation->set_rules('descripcion', 'descripcion', 'required|max_length[1000]');
            $this->form_validation->set_rules('pasajeros', 'numero de pasajeros', 'required|is_natural');
            $this->form_validation->set_rules('fechasoat', 'fecha de compra del soat', 'required');
            $this->form_validation->set_rules('fechaseg', 'fecha de compra del seguro', 'required');
            $this->form_validation->set_rules('fechatec', 'fecha de revision tecnica', 'required');
            $this->form_validation->set_rules('tarifa', 'tarifa', 'required|is_natural');
            $this->form_validation->set_rules('garantia', 'garantia', 'required|is_natural');
            $this->form_validation->set_rules('kmsdia', 'Kilometros por dia', 'required|is_natural');
            $this->form_validation->set_rules('iva', 'Iva', 'required|is_natural');
            $this->form_validation->set_rules('gasolina', 'Valor Galon de Gasolina', 'required|is_natural');
            $this->form_validation->set_rules('lavada', 'Valor de la Lavada', 'required|is_natural');
            $this->form_validation->set_rules('conductor', 'Precio del Conductor', 'required|is_natural');
            $this->form_validation->set_rules('fechaaceite', 'Fecha de Cambio de Aceite', 'required');
            $this->form_validation->set_rules('gama', 'Gama', 'required');
            $this->form_validation->set_rules('transmision', 'Transmision', 'required');
            $this->form_validation->set_rules('traccion', 'Traccion', 'required');

            if ($this->form_validation->run() != false) {

                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = '1024';
                $config['max_width'] = '1024';
                $config['max_height'] = '768';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);
                $foto = null;
                if (!$this->upload->do_upload('foto')) {
                    $datos = $this->upload->data();
                    if (!$datos['file_name'] == '') {
                        $foto = false;
                    }
                } else {
                    $foto = $this->upload->data();
                    $foto = $foto['file_name'];
                }
                if ($foto != false) {
                    $usr = $this->Vehiculos->buscarVehiculo($buscar);
                    if (sizeof($buscar) == 0) {
                        $this->datos['resultado'] = 'nove';
                    } else {
                        $placa = $this->input->post('placa');
                        $marca = $this->input->post('marca');
                        $modelo = $this->input->post('modelo');
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
                        $kmsdia = $this->input->post('kmsdia');
                        $iva = $this->input->post('iva');
                        $gasolina = $this->input->post('gasolina');
                        $lavada = $this->input->post('lavada');
                        $airbags = $this->input->post('airbags');
                        $airbags = ($airbags != false);
                        $conductor = $this->input->post('conductor');
                        $fechaaceite = $this->input->post('fechaaceite');
                        $gama = $this->input->post('gama');
                        $transmision = $this->input->post('transmision');
                        $traccion = $this->input->post('traccion');

                        $res = $this->Vehiculos->actualizarVehiculo($placa, $marca, $modelo, $color, $cilindraje, $frenos, $direccion, $descripcion, $pasajeros, $fechasoat, $fechaseg, $fechatec, $tarifa, $garantia, $kmsdia, $iva, $gasolina, $lavada, $airbags, $conductor, $fechaaceite, $gama, $transmision, $traccion, $foto);
                        if ($res == true) {
                            $this->datos['resultado'] = 'si';
                            $usr = $this->Vehiculos->buscarVehiculo($placa);
                            $this->datos['vehiculo'] = $usr[0];
                        } else {
                            $this->datos['resultado'] = 'no';
                        }
                    }
                } else {
                    $this->datos['resultado'] = 'fotoerr';
                    $this->datos['error'] = $this->upload->display_errors();
                }
            }
        }
        $this->load->view('headerPublico', $this->datos);
        $this->load->view('FormulariomodificarVehiculo', $this->datos);
        $this->load->view('footerPublico');
    }

    function eliminarVehiculo() {

        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect(base_url());
        }
        //si buscar
        $buscar = $this->input->post('buscar');
        if ($buscar != false) {
            $this->form_validation->set_rules('busqueda', 'nick', 'required');
            if ($this->form_validation->run() != false) {
                $buscar = $this->input->post('busqueda');
                $buscar = $this->Vehiculos->buscarVehiculo($buscar);
                if (sizeof($buscar) == 0) {
                    $this->datos['resultado'] = 'nove';
                } else {
                    $this->datos['vehiculo'] = $buscar[0];
                }
            }
        }

        //si eliminar
        $elim = $this->input->post('eliminar');
        if ($elim != false) {
            $placa = $this->input->post('placa');
            $buscar = $this->Vehiculos->buscarVehiculo($placa);
            if (sizeof($buscar) == 0) {
                $this->datos['resultado'] = 'nove';
            } else {
                $res = $this->Vehiculos->eliminarVehiculo($placa);
                if ($res == true) {
                    $this->datos['resultado'] = 'si';
                } else {
                    $this->datos['resultado'] = 'no';
                }
            }
        }

        $this->load->view('headerPublico', $this->datos);
        $this->load->view('FormularioEliminarVehiculo', $this->datos);
        $this->load->view('footerPublico');
    }

    public function vehiculosDisponibles() {

        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect(base_url());
        }

        $this->datos['disponibles'] = $this->Vehiculos->vehiculosDisponibles();

        $this->load->view('headerPublico', $this->datos);
        $this->load->view('vehiculosDisponibles', $this->datos);
        $this->load->view('footerPublico');
    }

    public function ver($placa = null) {

        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect(base_url());
        }

        if ($placa != null) {
            $buscar = $this->Vehiculos->buscarVehiculo($placa);
            if (sizeof($buscar) > 0) {
                $this->datos['vehiculo'] = $buscar[0];
                $res = $this->Vehiculos->direccion($this->datos['vehiculo']->direccion);
                if (sizeof($res) > 0) {
                    $this->datos['vehiculo']->direccion = $res[0]->nombre;
                }
                $res = $this->Vehiculos->frenos($this->datos['vehiculo']->frenos);
                if (sizeof($res) > 0) {
                    $this->datos['vehiculo']->frenos = $res[0]->nombre;
                }

                $res = $this->Vehiculos->gamas($this->datos['vehiculo']->gama);
                if (sizeof($res) > 0) {
                    $this->datos['vehiculo']->gama = $res[0]->nombre;
                }

                $res = $this->Vehiculos->traccion($this->datos['vehiculo']->traccion);
                if (sizeof($res) > 0) {
                    $this->datos['vehiculo']->traccion = $res[0]->nombre;
                }

                $res = $this->Vehiculos->transmision($this->datos['vehiculo']->transmision);
                if (sizeof($res) > 0) {
                    $this->datos['vehiculo']->transmision = $res[0]->nombre;
                }

                $tip = $this->mmantenimientos->tipos();
                $tipos = array();
                foreach ($tip as $t) {
                    $tipos[$t->id] = $t->nombre;
                }

                $tmp = $this->mmantenimientos->mantenimientosPorPlaca($placa);

                $this->datos['mantenimientos'] = array();
                foreach ($tmp as $man) {
                    $man->tipo = $tipos[$man->tipo];
                    array_push($this->datos['mantenimientos'], $man);
                }
            }
        }
        $this->load->view('headerPublico', $this->datos);
        $this->load->view('informacionVehiculo', $this->datos);
        $this->load->view('footerPublico');
    }

    public function vehiculosAlquilados() {

        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect(base_url());
        }

        $this->datos['alquilados'] = $this->Vehiculos->vehiculosAlquilados();

        $this->load->view('headerPublico', $this->datos);
        $this->load->view('vehiculosAlquilados', $this->datos);
        $this->load->view('footerPublico');
    }

    public function vehiculosReservados() {

        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect(base_url());
        }

        $this->datos['reservados'] = $this->Vehiculos->vehiculosReservados();

        $this->load->view('headerPublico', $this->datos);
        $this->load->view('vehiculosReservados', $this->datos);
        $this->load->view('footerPublico');
    }

    public function vehiculosPorAtributos() {
        $this->datos['frenos'] = $this->Vehiculos->frenos();
        $this->datos['direccion'] = $this->Vehiculos->direccion();

        $bus = $this->input->post('buscar');
        if ($bus != FALSE) {
            $filtro = array();
            if ($this->input->post('marca') != false) {
                $filtro['marca'] = $this->input->post('marca');
            }
            if ($this->input->post('modelo') != false) {
                $filtro['modelo'] = $this->input->post('modelo');
            }
            if ($this->input->post('color') != false) {
                $filtro['color'] = $this->input->post('color');
            }
            if ($this->input->post('cilindraje') != false) {
                $filtro['cilindraje'] = $this->input->post('cilindraje');
            }
            if ($this->input->post('frenos') != false) {
                $filtro['frenos'] = $this->input->post('frenos');
            }
            if ($this->input->post('direccion') != false) {
                $filtro['direccion'] = $this->input->post('direccion');
            }
            if ($this->input->post('pasajeros') != false) {
                $filtro['npasajeros'] = $this->input->post('pasajeros');
            }
            if ($this->input->post('tarifa') != false) {
                $filtro['tarifa'] = $this->input->post('tarifa');
            }
            if ($this->input->post('garantia') != false) {
                $filtro['garantia'] = $this->input->post('garantia');
            }
            $res = $this->Vehiculos->vehiculosPorAtributos($filtro);
            $this->datos['vehiculos'] = $res;
        }

        $this->load->view('headerPublico', $this->datos);
        $this->load->view('BuscarVehiculos', $this->datos);
        $this->load->view('footerPublico');
    }

}

?>
