<?php
class RegistroModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function registrar($datos){
        $sql="insert into usuario(nombre, apellido, password, email, orcid, rol)values(?,?,?,?,?,?)";
        
        try {
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(1, $datos['nombre']);
            $stmt->bindValue(2, $datos['apellido']);
            $stmt->bindValue(3, $datos['password']);
            $stmt->bindValue(4, $datos['email']);
            $stmt->bindValue(5, $datos['orcid']);
            $stmt->bindValue(6, 1);
            $stmt->execute();
        } catch (PDOException $e) {
            print($e);
            return false;
        }
        return true;
    }

    public function registrarEvaluador($datos){
        $sql="insert into usuario(nombre, apellido, password, email, orcid, rol)values(?,?,?,?,?,?)";
        
        try {
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(1, $datos['nombre']);
            $stmt->bindValue(2, $datos['apellido']);
            $stmt->bindValue(3, $datos['password']);
            $stmt->bindValue(4, $datos['email']);
            $stmt->bindValue(5, $datos['orcid']);
            $stmt->bindValue(6, 2);
            $stmt->execute();
        } catch (PDOException $e) {
            print($e);
            return false;
        }
        return true;
    }
}

?>