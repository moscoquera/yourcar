<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class usuarios extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    
    public function buscarUsuario($nick,$pass){
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('nick', $nick);
        $this->db->where('password',  md5($pass));
        $res = $this->db->get();
        if ($res->num_rows()==1){
            return $res->row();
            
        }else{
            return false;
            
        }
    }
    
    public function obtenerRoles(){
        $this->db->select('*');
        $this->db->from('rolusuarios');
        $this->db->order_by('id');
        return $this->db->get()->result();
    }
    
    public function obtenerTiposDocumentos(){
        $this->db->select('*')->from('tipo_documento')->order_by('id');
        return $this->db->get()->result();
       
    }
    
    public function obtenerGeneros(){
        $this->db->select('*')->from('genero_usuarios')->order_by('id');
        return $this->db->get()->result();
    }
    
    public function obtenerTiposUsuario(){
        $this->db->select('*')->from('tipo_usuarios');
        return $this->db->get()->result();
    }
    
    public function insertarUsuario($nombre, $nick, $email, $contra, $rol,$tipodoc,$numdoc,$fechanaci,$pais,$ciudad,$sangre,$genero,$tipo){
        if (sizeof($this->obtenerUsuarioPorEmail($email))>0){
            return 'email';
        }
        
        if (sizeof($this->obtenerUsuarioPorNick($nick))>0){
            return 'nick';
        }
        if (sizeof($this->obtenerUsuarioPorDocumento($numdoc))>0){
            return 'doc';
        }
        $datos = array(
            'nombres'=>$nombre,
            'nick' =>$nick,
            'email'=>$email,
            'password'=>  md5($contra),
            'rol_id'=>$rol,
            'tipo_doc'=>$tipodoc,
            'ndocumento'=>$numdoc,
            'fechanacimiento'=>$fechanaci,
            'pais'=>$pais,
            'ciudad'=>$ciudad,
            'tiposangre'=>  $sangre,
            'genero' => $genero,
            'tipo' => $tipo
            
        );
        $this->db->insert('usuarios',$datos);
        return true;
    }
    
    public function insertarContacto($nick,$nomcont,$telefono,$dircont,$celular){
        if (sizeof($this->obtenerUsuarioPorNick($nick))==0){
            return false;
        }
        $datos = array(
            'dueno'=>$nick,
            'nombre'=>$nomcont,
            'telefono'=>$telefono,
            'direccion'=>$dircont,
            'celular'=>$celular
        );
        $this->db->insert('contacto',$datos);
    }
    
    public function actualizarContacto($dueno,$nombre,$telefono,$direccion){
        $datos = array(
            'nombre'=>$nombre,
            'telefono'=>$telefono,
            'direccion'=>$direccion
        );
        
        $this->db->where('dueno', $dueno)->update('contacto',$datos);
        if ($this->db->affected_rows()==0){
            $this->insertarContacto($dueno, $nombre, $telefono, $direccion);
        }
        return true;
    }
    
    public function obtenerUsuarioPorEmail($email){
        $this->db->select();
        $this->db->from('usuarios');
        $this->db->where('email', $email);
        return $this->db->get()->result();
        
    }
    
    public function obtenerUsuarioPorNick($nick){
        $this->db->select();
        $this->db->from('usuarios');
        $this->db->where('nick', $nick)->join('contacto', 'usuarios.nick = contacto.dueno','left');
        return $this->db->get()->result();
    }
    
    public function obtenerUsuarioPorDocumento($doc){
        $this->db->select()->from('usuarios')->where('ndocumento', $doc);
        return $this->db->get()->result();
    }
    
    public function obtenerUsuarios(){
        $this->db->select('nick,email,nombres,nombre as rol');
        $this->db->from('usuarios');
        $this->db->join('rolusuarios','usuarios.rol_id = rolusuarios.id');
       return  $this->db->get()->result();
    }
 
    
    public function actualizarUsuario($nombre, $nick, $email, $contra, $rol, $tipodoc, $numdoc, $fechanaci, $pais, $ciudad, $sangre, $genero, $tipo){
        $usrporemail = $this->obtenerUsuarioPorEmail($email);
        if (sizeof($usrporemail)>0){
            $usrporemail = $usrporemail[0];
            if ($usrporemail->nick != $nick){
                return false;
            }
        }
        
        $usrpordoc = $this->obtenerUsuarioPorDocumento($numdoc);
        if (sizeof($usrpordoc)>0){
            $usrpordoc = $usrpordoc[0];
            if ($usrpordoc->nick != $nick){
                return false;
            }
        }
        
        if (sizeof($this->obtenerUsuarioPorNick($nick))!=1){
            return false;
        }
        $datos = array(
            'nombres'=>$nombre,
            'email'=>$email,
            'password'=>  md5($contra),
            'rol_id'=>$rol,
            'tipo_doc'=>$tipodoc,
            'ndocumento'=>$numdoc,
            'fechanacimiento'=>$fechanaci,
            'pais'=>$pais,
            'ciudad'=>$ciudad,
            'tiposangre'=>  $sangre,
            'genero' => $genero,
            'tipo' => $tipo
            
        );
        
        if ($contra != null){
            $datos['password']=  md5($contra);
            
        }
        $this->db->where('nick', $nick);
        $this->db->update('usuarios',$datos);
        return true;
    }
    
    public function eliminarUsuario($nick){
        if ($nick == null || $nick == ''){
            return false;
        }
        $this->db->where('nick',$nick);
        $this->db->delete('usuarios');
        return true;
        
    }
    
    public function actualizarContrasena($nick,$contra){
        $this->db->where('nick',$nick);
        $this->db->update('usuarios',array('password'=>  md5($contra)));
        return true;
    }
    
    public function anadirAPotencialesClientes($email){
        if (sizeof($this->db->where('email',$email)->get('potencialesclientes')->result()) == 0){
            $this->db->insert('potencialesclientes',array('email'=>$email));
        }
        return true;
    }
    
    public function emailsAdministradoresEmpresa(){
        $res= $this->db->select('email')->where('rol_id','2')->get('usuarios')->result();
        $tmp = array();
        foreach ($res as $obj){
            array_push($tmp, $obj->email);
        }
        
        return $tmp;
    }
    
}

?>
