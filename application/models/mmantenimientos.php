<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class mmantenimientos extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function tipos() {
        return $this->db->get('tipomantenimiento')->result();
    }

    public function guardarMantenimiento($placa, $descripcion, $tipo, $valor, $fi, $ff = null) {
        $datos = array(
            'vehiculo' => $placa,
            'descripcion' => $descripcion,
            'tipo' => $tipo,
            'valor' => $valor,
            'fecha_ingreso' => $fi
        );
        if ($ff != null) {
            $datos['fecha_fin'] = $ff;
        }
        $this->db->insert('mantenimientos', $datos);
        return true;
    }

    public function proximosMantenimientos() {
        $q="select * from vehiculo left join mantenimientos on vehiculo.placa = mantenimientos.vehiculo where datediff(adddate(curdate(),interval 30 day),adddate(mantenimientos.fecha_ingreso,interval 730 day)) < 10 || datediff(adddate(curdate(),interval 30 day),mantenimientos.fecha_ingreso)  is null";
        return $this->db->query($q)->result();
    }

}

?>
