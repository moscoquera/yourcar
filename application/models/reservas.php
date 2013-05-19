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
        $q="select * from reserva where placavehiculo = '$placa' and ((fechainicio<='$fechaf' and fechafin>='$fechaf') or (fechainicio<='$fechai' and fechafin>='$fechai') or (fechainicio>='$fechai' and fechafin<='$fechaf'))";
        $q=$this->db->query($q)->result();
        if (sizeof($q)>0){
            return 'colision';
        }
        $datos = array('usuarioid'=>$usuario,'placavehiculo'=>$placa,'precio'=>$precio,'fechainicio'=>$fechai,'fechafin'=>$fechaf,'lugarinicio'=>$lugarini,'lugarfin'=>$lugarfin);
        $this->db->insert('reserva',$datos);
        return true;
        
    }
    public function reservasPorUsuario($nick){
      return  $this->db->where('usuarioid',$nick)->get('reserva')->result();
    }
    
    public function reserva($id){
        $res=$this->db->where('id',$id)->get('reserva')->result();
        if (sizeof($res)==0){
            return null;
        }else {
            return $res[0];
        }
        
    }
    
    public function actualizarPago($id,$ruta){
        $datos = array('prueba'=>$ruta);
        $this->db->where('id',$id)->update('reserva', $datos);
        return true;
    }
    
    public function validarPago($id,$valor){
        if ($valor == true){
            $valor='1';
        }else{
            $valor='0';
        }
        $datos = array('pagada'=>$valor);
        $this->db->where('id',$id)->update('reserva',$datos);
        return true;
    }
}

?>
