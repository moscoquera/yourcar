<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class info extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function guardar($nombre, $valor) {
        $datos = array('valor' => $valor);
        
        if (sizeof($this->informacion($nombre)) > 0) {
            $this->db->where('nombre',$nombre);
            $this->db->update('informacion',$datos);
            return true;
        }
        $datos['nombre']=$nombre;
        $this->db->insert('informacion', $datos);
        return true;
    }

    public function informacion($nombre) {
        return $this->db->where('nombre', $nombre)->get('informacion')->result();
    }

}

?>
