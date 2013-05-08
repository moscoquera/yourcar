<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class mantenimientos extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Vehiculos');
        $this->load->model('mmantenimientos');
    }

    public function index() {
        if ($this->session->userdata('usuario') == false) {
            redirect(base_url());
        }

        $this->load->view('headerPublico');
        $this->load->view('indexMantenimientos');
        $this->load->vars('footerPublico');
    }

    public function mantenimientoCorrectivo() {
        if ($this->session->userdata('usuario') == false) {
            redirect(base_url());
        }

        $datos['vehiculos'] = $this->Vehiculos->vehiculos();
        $datos['tipos'] = $this->mmantenimientos->tipos();


        $btn = $this->input->post('btnagregar');
        if ($btn != false) {
            $this->form_validation->set_rules('placa', 'Vehiculo', 'required');
            $this->form_validation->set_rules('fechai', 'Fecha de Inicio', 'required');
            $this->form_validation->set_rules('fechaf', 'Fecha de Fin', 'required');
            $this->form_validation->set_rules('descripcion', 'descripcion', 'required|max_length[4500]');
            $this->form_validation->set_rules('tipo', 'tipo de Mantenimiento', 'required');
            $this->form_validation->set_rules('valor', 'valor', 'required');
            if ($this->form_validation->run() != false) {
                $placa = $this->input->post('placa');
                $descripcion = $this->input->post('descripcion');
                $tipo = $this->input->post('tipo');
                $valor = $this->input->post('valor');
                $fi = $this->input->post('fechai');
                $ff = $this->input->post('fechaf');
                $horai = DateTime::createFromFormat('Y-m-d', $fi);
                $horaf = DateTime::createFromFormat('Y-m-d', $ff);
                if ($horai > $horaf) {
                    $datos['resultado'] = 'errfe';
                } else {

                    $this->mmantenimientos->guardarMantenimiento($placa, $descripcion, $tipo, $valor, $fi, $ff);
                    $datos['resultado'] = 'si';
                }
            }
        }
        $this->load->view('headerPublico');
        $this->load->view('formularionuevomantenimiento', $datos);
        $this->load->vars('footerPublico');
    }

    public function mantenimientoPreventivo(){
        $proximos = $this->mmantenimientos->proximosMantenimientos();
        $datos['proximos']=$proximos;
        $this->load->view('headerPublico');
        $this->load->view('proximosmantenimientos',$datos);
        $this->load->vars('footerPublico');
    }
    
}

?>
