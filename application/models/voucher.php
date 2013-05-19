<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class voucher extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function ingresarVoucher($documento,$nombre, $franquicia, $autorizacion, $verificacion, $monto, $tarjeta, $banco) {
        $datos = array('doccliente' => $documento,
            'franquicia' => $franquicia,
            'verificacion' => $verificacion,
            'numvoucher' => $autorizacion,
            'monto' => $monto,
            'nuntarjeta' => $tarjeta,
            'nombre'=>$nombre,
            'banco' => $banco);
        $this->db->insert('voucher',$datos);
        return true;
    }

    public function obtenerInfoDelCliente($cedula){
        return $this->db->where('doccliente',$cedula)->get('voucher')->result();
    }
    
}

?>
