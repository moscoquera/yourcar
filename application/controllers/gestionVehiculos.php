<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class gestionVehiculos extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Vehiculos');

        $this->output->enable_profiler(true);
    }

    public function index() {
        $usr = $this->session->userdata('usuario');
        if ($usr == false || $usr->rol_id != '2') {
            redirect(base_url());
        }

        $this->load->view('headerPublico');
        $this->load->view('indexVehiculos');
        $this->load->view('footerPublico');
    }

    public function crearVehiculo() {
        $usr = $this->session->userdata('usuario');
        if ($usr == false || $usr->rol_id != '2') {
            redirect(base_url());
        }

        $datos['frenos'] = $this->Vehiculos->frenos();
        $datos['direccion'] = $this->Vehiculos->direccion();

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
            $res = $this->Vehiculos->insertarVehiculo($placa, $marca, $modelo, $color, $cilindraje, $frenos, $direccion, $descripcion, $pasajeros, $fechasoat, $fechaseg, $fechatec, $tarifa, $garantia);
            if ($res == true) {
                $datos['estado'] = 'si';
            } else {
                $datos['estado'] = 'no';
            }
        }
        $this->load->view('headerPublico');
        $this->load->view('FormularioCrearVehiculo', $datos);
        $this->load->view('footerPublico');
    }

    public function modificarVehiculo() {
        $datos = array();
        $datos['frenos'] = $this->Vehiculos->frenos();
        $datos['direccion'] = $this->Vehiculos->direccion();

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
                    $datos['resultado'] = 'nove';
                } else {
                    $datos['vehiculo'] = $buscar[0];
                }
            }
        }

        //si modificando
        $mod = $this->input->post('modificar');
        if ($mod != false) {
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
            if ($this->form_validation->run() != false) {
                $usr = $this->Vehiculos->buscarVehiculo($buscar);
                if (sizeof($buscar) == 0) {
                    $datos['resultado'] = 'nove';
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
                    $res = $this->Vehiculos->actualizarVehiculo($placa, $marca, $modelo, $color, $cilindraje, $frenos, $direccion, $descripcion, $pasajeros, $fechasoat, $fechaseg, $fechatec, $tarifa, $garantia);
                    if ($res == true) {
                        $datos['resultado'] = 'si';
                        $usr = $this->Vehiculos->buscarVehiculo($placa);
                        $datos['vehiculo']=$usr[0];
                    } else {
                        $datos['resultado'] = 'no';
                    }
                }
            }
        }
        $this->load->view('headerPublico');
        $this->load->view('FormulariomodificarVehiculo', $datos);
        $this->load->view('footerPublico');
    }
    
    function eliminarVehiculo(){
        $datos = array();
        
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
                    $datos['resultado'] = 'nove';
                } else {
                    $datos['vehiculo'] = $buscar[0];
                }
            }
        }
        
        //si eliminar
        $elim = $this->input->post('eliminar');
        if ($elim != false){
            $placa = $this->input->post('placa');
            $buscar = $this->Vehiculos->buscarVehiculo($placa);
                if (sizeof($buscar) == 0) {
                    $datos['resultado'] = 'nove';
                } else {
                   $res= $this->Vehiculos->eliminarVehiculo($placa);
                   if ($res==true){
                       $datos['resultado'] = 'si';
                   }else{
                       $datos['resultado'] = 'no';
                   }
                }
        }
        
        $this->load->view('headerPublico');
        $this->load->view('FormularioEliminarVehiculo', $datos);
        $this->load->view('footerPublico');
        
    }
    
    public function vehiculosDisponibles(){
        $datos = array();
        
        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect(base_url());
        }
        
        $datos['disponibles']=$this->Vehiculos->vehiculosDisponibles();
        
        $this->load->view('headerPublico');
        $this->load->view('vehiculosDisponibles', $datos);
        $this->load->view('footerPublico');
    }
    
    public function ver($placa=null){
        $datos = array();
        
        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect(base_url());
        }
        
        if ($placa != null){
            $buscar = $this->Vehiculos->buscarVehiculo($placa);
            if (sizeof($buscar)>0){
                $datos['vehiculo']=$buscar[0];
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
        $this->load->view('headerPublico');
        $this->load->view('informacionVehiculo', $datos);
        $this->load->view('footerPublico');
    }
    
    public function vehiculosAlquilados(){
        $datos = array();
        
        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect(base_url());
        }
        
        $datos['alquilados']=$this->Vehiculos->vehiculosAlquilados();
        
        $this->load->view('headerPublico');
        $this->load->view('vehiculosAlquilados', $datos);
        $this->load->view('footerPublico');
        
    }

    public function vehiculosReservados(){
        $datos = array();
        
        $usr = $this->session->userdata('usuario');
        if ($usr == false) {
            redirect(base_url());
        }
        
        $datos['reservados']=$this->Vehiculos->vehiculosReservados();
        
        $this->load->view('headerPublico');
        $this->load->view('vehiculosReservados', $datos);
        $this->load->view('footerPublico');
        
    }
    
    public function vehiculosPorAtributos(){
        $datos = array();
        $datos['frenos'] = $this->Vehiculos->frenos();
        $datos['direccion'] = $this->Vehiculos->direccion();
        
        $bus = $this->input->post('buscar');
        if ($bus != FALSE){
            $filtro = array();
            if ($this->input->post('marca')!=false){
                $filtro['marca']=$this->input->post('marca');
            }
            if ($this->input->post('modelo')!=false){
                $filtro['modelo']=$this->input->post('modelo');
            }
            if ($this->input->post('color')!=false){
                $filtro['color']=$this->input->post('color');
            }
            if ($this->input->post('cilindraje')!=false){
                $filtro['cilindraje']=$this->input->post('cilindraje');
            }
            if ($this->input->post('frenos')!=false){
                $filtro['frenos']=$this->input->post('frenos');
            }
            if ($this->input->post('direccion')!=false){
                $filtro['direccion']=$this->input->post('direccion');
            }
            if ($this->input->post('pasajeros')!=false){
                $filtro['npasajeros']=$this->input->post('pasajeros');
            }
            if ($this->input->post('tarifa')!=false){
                $filtro['tarifa']=$this->input->post('tarifa');
            }
            if ($this->input->post('garantia')!=false){
                $filtro['garantia']=$this->input->post('garantia');
            }
            $res = $this->Vehiculos->vehiculosPorAtributos($filtro);
            $datos['vehiculos']=$res;
        }
        
        $this->load->view('headerPublico');
        $this->load->view('BuscarVehiculos', $datos);
        $this->load->view('footerPublico');
    }
}

?>
