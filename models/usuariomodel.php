<?php

class UsuarioModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    //FUNCIONES DEL ADMIN
    //{

    //}

    //FUNCIONES TODAS LAS SESIONES
    //{
    public function informacion(){
        if(isset($_SESSION['id'])){
            $id=$_SESSION['id'];

            $sql="select * from usuario where id=".$id;
            $stmt=$this->db->connect()->query($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row=$stmt->fetch();

            $datos = array('id' => $row['id'], 'nombre' => $row['nombre'], 
                'apellido' => $row['apellido'], 'orcid' => $row['orcid'], 'email' => $row['email']);

            return $datos;
        }
        return [];
    }

    public function editar($datos=[]){
        $stmt = $this->db->connect()->prepare(
            "update usuario set nombre=?,apellido=?,email=?,orcid=? WHERE id=?");

        $stmt->bindValue(1, $datos['nombre']);
        $stmt->bindValue(2, $datos['apellido']);
        $stmt->bindValue(3, $datos['email']);
        $stmt->bindValue(4, $datos['orcid']);
        $stmt->bindValue(5, $datos['id']);
        try{
           $stmt->execute();
        } catch (PDOException $ex) {
            return false;
        }
        return true;
    }

    public function cerrarSesion(){
        session_start();
        session_unset();
        session_destroy();
    }
    //}

}

?>