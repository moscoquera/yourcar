<?php

class reservas extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function obtenerLugares($lugar=null){
        if ($lugar==null){
            return $this->db->get('lugar')->result();
        }
           return $this->db->where('id',$lugar)->get('lugar')->result();
        
    }
    
    public function insertarReserva($usuario,$placa,$precio,$fechai,$fechaf,$lugarini,$lugarfin){
        
        $datos = array('usuarioid'=>$usuario,'placavehiculo'=>$placa,'precio'=>$precio,'fechainicio'=>$fechai,'fechafin'=>$fechaf,'lugarinicio'=>$lugarini,'lugarfin'=>$lugarfin);
        $this->db->insert('reserva',$datos);
        return true;
        
    }
    
}

?>
