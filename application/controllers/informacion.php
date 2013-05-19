<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class informacion extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('info');
    }

    public function modificarinformacion() {
        $datos = array();

        $usr = $this->session->userdata('usuario');
        if ($usr == false || $usr->rol_id != 2) {
            redirect(base_url());
        }

        $btn = $this->input->post('actualizar');
        if ($btn != false) {

            $this->form_validation->set_rules('polempresa', 'Politica de la Empresa', 'max_length[4500]');
            $this->form_validation->set_rules('mision', 'mision', 'max_length[4500]');
            $this->form_validation->set_rules('vision', 'vision', 'max_length[4500]');
            $this->form_validation->set_rules('objetivos', 'objetivos', 'max_length[4500]');
            if ($this->form_validation->run() != false) {
                $opt = $this->input->post('polempresa');
                if ($opt != false) {
                    $this->info->guardar('polempresa', $opt);
                }

                $opt = $this->input->post('mision');
                if ($opt != false) {
                    $this->info->guardar('mision', $opt);
                }

                $opt = $this->input->post('vision');
                if ($opt != false) {
                    $this->info->guardar('vision', $opt);
                }

                $opt = $this->input->post('objetivos');
                if ($opt != false) {
                    $this->info->guardar('objetivos', $opt);
                }
                $datos['resultado'] = 'si';
            }
        }

        $datos['polempresa'] = $this->info->informacion('polempresa');
        $datos['vision'] = $this->info->informacion('vision');
        $datos['mision'] = $this->info->informacion('mision');
        $datos['objetivos'] = $this->info->informacion('objetivos');


        $datos['polempresa'] = (sizeof($datos['polempresa']) > 0) ? $datos['polempresa'][0]->valor : '';
        $datos['vision'] = (sizeof($datos['vision']) > 0) ? $datos['vision'][0]->valor : '';
        $datos['mision'] = (sizeof($datos['mision']) > 0) ? $datos['mision'][0]->valor : '';
        $datos['objetivos'] = (sizeof($datos['objetivos']) > 0) ? $datos['objetivos'][0]->valor : '';

        $this->load->view('headerPublico');
        $this->load->view('modificarinformacion', $datos);
        $this->load->view('footerPublico');
    }

}

?>
