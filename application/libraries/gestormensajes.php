<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class gestormensajes {

    var $ci;

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('email');
    }

    public function enviarEmail($receptor,$motivo, $mensaje) {
        $this->ci->email->set_newline("\r\n");
        $this->ci->email->from('ojalapasemoslabsoft@gmail.com', 'YourCar');
        $this->ci->email->to($receptor);
        $this->ci->email->subject($motivo);
        $this->ci->email->message($mensaje);
        $this->ci->email->send();
        if ($this->ci->email->send()) {
           return 'si';
        } else {
            return 'no';
            echo ($this->ci->email->print_debugger());
        }
    }

}

?>
