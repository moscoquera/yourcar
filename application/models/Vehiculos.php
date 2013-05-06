<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Vehiculos extends CI_Model{
     
    public function __construct() {
        parent::__construct();
    }
 
    public function frenos(){
        $this->db->select('*')->from('frenosvehiculo');
        return $this->db->get()->result();
    }
    
    public function direccion(){
        $this->db->select('*')->from('direccionvehiculo');
        return $this->db->get()->result();
        
    }
    
    public function insertarVehiculo($placa,$marca,$modelo,$color,$cilindraje,$frenos,$direccion,$descripcion,$pasajeros,$fechasoat,$fechaseguro,$fecharevision,$tarifa,$garantia){
     
        if (sizeof($this->buscarVehiculo($placa))>0){
            return false;
        }
        $datos= array(
            'placa'=>$placa,
            'marca'=>$marca,
            'modelo'=>$modelo,
            'color'=>$color,
            'cilindraje'=>$cilindraje,
            'frenos'=>$frenos,
            'direccion'=>$direccion,
            'descripcion'=>$descripcion,
            'npasajeros'=>$pasajeros,
            'fechasoat'=>$fechasoat,
            'fechaseguro'=>$fechaseguro,
            'fecharevision'=>$fecharevision,
            'tarifa'=>$tarifa,
            'garantia'=>$garantia
            
        );
        $this->db->insert('vehiculo', $datos);
        return true;
    }
    
    
    public function buscarVehiculo($placa){
        $this->db->select('*')->from('vehiculo')->where('placa',$placa);
        return $this->db->get()->result();
    }
}
?>
