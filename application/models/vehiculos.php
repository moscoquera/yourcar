<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Vehiculos extends CI_Model{
     
    public function __construct() {
        parent::__construct();
    }
 
    public function frenos($id=null){
        $this->db->select('*')->from('frenosvehiculo');
        if ($id != null){
            $this->db->where('id',$id);
        }
        return $this->db->get()->result();
    }
    
    public function direccion($dir=null){
        $this->db->select('*')->from('direccionvehiculo');
        if ($dir != null){
            $this->db->where('id',$dir);
        }
        
        return $this->db->get()->result();
        
    }
    
    public function insertarVehiculo($placa,$marca,$modelo,$color,$cilindraje,$frenos,$direccion,$descripcion,$pasajeros,$fechasoat,$fechaseguro,$fecharevision,$tarifa,$garantia,$kmsdia,$iva,$gasolina,$lavada,$airbags,$conductor,$fechaaceite,$gama,$transmision,$traccion,$foto){
     
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
            'garantia'=>$garantia,
            'kmsdia'=>$kmsdia,
            'iva'=>$iva,
            'valorgasolina'=>$gasolina,
            'valorlavada'=>$lavada,
            'airbags'=>$airbags,
            'precioconductor'=>$conductor,
            'gama'=>$gama,
            'transmision'=>$transmision,
            'traccion'=>$traccion,
            'fechaaceite'=>$fechaaceite,
            'foto'=>$foto
            
        );
        $this->db->insert('vehiculo', $datos);
        return true;
    }
    
    
    public function buscarVehiculo($placa){
        $this->db->select('*')->from('vehiculo')->where('placa',$placa);
        return $this->db->get()->result();
    }
    
    public function actualizarVehiculo($placa,$marca,$modelo,$color,$cilindraje,$frenos,$direccion,$descripcion,$pasajeros,$fechasoat,$fechaseguro,$fecharevision,$tarifa,$garantia, $kmsdia, $iva, $gasolina, $lavada, $airbags, $conductor, $fechaaceite, $gama, $transmision, $traccion, $foto){
     
        if (sizeof($this->buscarVehiculo($placa))!=1){
            return false;
        }
        $datos= array(
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
            'garantia'=>$garantia,
            'kmsdia'=>$kmsdia,
            'iva'=>$iva,
            'valorgasolina'=>$gasolina,
            'valorlavada'=>$lavada,
            'airbags'=>$airbags,
            'precioconductor'=>$conductor,
            'gama'=>$gama,
            'transmision'=>$transmision,
            'traccion'=>$traccion,
            'fechaaceite'=>$fechaaceite
            
            
        );
        if ($foto != null){
            $datos['foto']=$foto;
        }
        $this->db->where('placa',$placa);
        $this->db->update('vehiculo',$datos);
        return true;
    }
    
    public function eliminarVehiculo($placa){
        if (sizeof($this->buscarVehiculo($placa))!=1){
            return false;
        }
         $this->db->where('placa',$placa)->delete('vehiculo');
         return true;
    }
    
    public function vehiculosDisponibles(){
        $res=$this->db->query('select distinct placa,marca,modelo,color,cilindraje,frenos,direccion,descripcion,npasajeros,fechasoat,fechaseguro,fecharevision,tarifa,garantia from vehiculo left join reserva on reserva.placavehiculo = vehiculo.placa where reserva.fechafin is null or reserva.fechafin < curdate();');
        return $res->result();
    }
    
    public function vehiculosAlquilados(){
        $res=$this->db->query('select distinct placa,marca,modelo,color,cilindraje,frenos,direccion,descripcion,npasajeros,fechasoat,fechaseguro,fecharevision,tarifa,garantia from vehiculo left join alquiler on alquiler.placavehiculo = vehiculo.placa where alquiler.fechafin > curdate();');
        return $res->result();
    }
    
    public function vehiculosReservados(){
        $res=$this->db->query('select distinct placa,marca,modelo,color,cilindraje,frenos,direccion,descripcion,npasajeros,fechasoat,fechaseguro,fecharevision,tarifa,garantia from vehiculo left join reserva on reserva.placavehiculo = vehiculo.placa where reserva.fechafin > curdate();');
        return $res->result();
    }
    
    public function vehiculos(){
        $this->db->select('*')->from('vehiculo');
        return $this->db->get()->result();
    }
    
    public function vehiculosPorAtributos($filtros){
        $this->db->select('*')->from('vehiculo');
        foreach ($filtros as $filtro => $valor){
            $this->db->where($filtro,$valor);
        }
        return $this->db->get()->result();
    }
    
    public function gamas(){
        return $this->db->get('gama_vehiculo')->result();
    }
    
    public function traccion(){
        return $this->db->get('traccion_vehiculos')->result();
    }
    
    public function transmision(){
        return $this->db->get('transmision_vehiculos')->result();
    }
}
?>
