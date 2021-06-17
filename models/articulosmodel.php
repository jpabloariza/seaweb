<?php

include_once 'models/articulo.php';
include_once 'models/evaluador.php';
include_once 'models/evaluacion.php';

class ArticulosModel extends Model {

    public function __construct() {
        parent::__construct();
    }


    public function getArticulo($articulo){

        $sql = "select a.id as id, titulo, p_claves, resumen, autores, topico, archivo, f_envio, e.descripcion as estado "
        ." from articulo a join estado e on a.estado = e.id where a.id = ".$articulo;
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        $item = new Articulo();
        $item->id = $row['id'];
        $item->titulo = $row['titulo'];
        $item->p_claves = $row['p_claves'];
        $item->resumen = $row['resumen'];
        $item->topico = $row['topico'];
        $item->autores = $row['autores'];
        $item->f_envio = $row['f_envio'];
        $item->estado = $row['estado'];
        $item->archivo = $row['archivo'];

        return $item;
    }

    public function getObservaciones($articulo){
        $observaciones = array();
        $sql = "select observaciones from observacion where articulo = ".$articulo;
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $stmt->fetch()) {
            array_push($observaciones,$row['observaciones']);
        }
        return $observaciones;
    }

    public function getEvaluaciones($articulo){
        $observaciones = array();
        $sql = "select u.nombre as evaluador, observaciones, fecha, aprobacion ".
        "from evaluacion e join usuario u on e.evaluador = u.id ".
        "where NOT fecha='0000-00-00' and articulo = ".$articulo;
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $stmt->fetch()) {
            $item = new Evaluacion();
            $item->id = $articulo;
            $item->evaluador = $row['evaluador'];
            $item->observaciones = $row['observaciones'];
            $item->fecha = $row['fecha'];
            $item->aprobacion = $row['aprobacion'];
            array_push($observaciones,$item);
        }
        return $observaciones;
    }

    public function descargarArticulo($articulo, $usuario){
        echo "<p>articulo: ".$articulo." usuario: ".$usuario."</p>";
        $sql = "select archivo from articulo where id = ".$articulo;
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        $enlace = constant('ROOT') . 'archivos/' . $row['titulo'] . '/' . $usuario . '/' . $row['archivo'];
        header("Content-Disposition: attachment; filename=" . $row['archivo'] . " ");
        header("Content-Type: application/pdf");
        header("Content-Length: " . filesize($enlace));
        readfile($enlace);
    }

    public function actualizarArticulo($datos){
        $sql = "update articulo set titulo=?, p_claves=?, resumen=?, topico=? where id=?";

        try {
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(1, $datos['titulo']);
            $stmt->bindValue(2, $datos['p_claves']);
            $stmt->bindValue(3, $datos['resumen']);
            $stmt->bindValue(4, $datos['topico']);
            $stmt->bindValue(5, $datos['id']);
            $stmt->execute();
        } catch (PDOException $ex) {
            return false;
        }
        return true;
    }

    //Autor
    //{------------------------------------------------
    public function registrarArticulo($datos = []) {
        $sql = "insert into articulo(titulo,p_claves,resumen,autores,topico,archivo, f_envio,estado)" .
                " values (?,?,?,?,?,?,?,?)";

        try {
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(1, $datos['titulo']);
            $stmt->bindValue(2, $datos['p_claves']);
            $stmt->bindValue(3, $datos['resumen']);
            $stmt->bindValue(4, $datos['autores']);
            $stmt->bindValue(5, $datos['topico']);
            $stmt->bindValue(6, $datos['archivo']);
            $stmt->bindValue(7, $datos['fecha']);
            $stmt->bindValue(8, 1);
            $stmt->execute();
        } catch (PDOException $ex) {
            return false;
        }

        $sql = "select id from articulo where titulo = '".$datos['titulo']."'";
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        $sql = "insert into autor_articulo(autor,articulo) values (?,?)";
        try {
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(1, $datos['usuario']);
            $stmt->bindValue(2, $row['id']);
            $stmt->execute();
        } catch (PDOException $ex) {
            return false;
        }
        return true;
    }

    public function subirArchivo($articulo, $archivo, $persona) {

        $micarpeta = constant('ROOT') . 'archivos/' . $persona . '/' . $articulo . '/';
        if (!file_exists($micarpeta)) {
            mkdir($micarpeta, 0777, true);
        }
        $dirarch = constant('ROOT') . 'archivos/' . $persona . '/' . $articulo . '/' . $archivo['name'];
        if (file_exists($dirarch)) {
            return false;
        }
        move_uploaded_file($archivo['tmp_name'], $dirarch);
        return true;
    }

    public function listaArticulosAutor($usuario) {
        $datos = array();
        $sql = "select a.id as id, titulo, p_claves, resumen, autores, topico, archivo, f_envio, e.descripcion as estado ".
        "from (articulo a join autor_articulo aa on a.id = aa.articulo) join estado e on a.estado = e.id ".
        "where aa.autor = " . $usuario;
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $stmt->fetch()) {
            $item = new Articulo();
            $item->id = $row['id'];
            $item->titulo = $row['titulo'];
            $item->p_claves = $row['p_claves'];
            $item->resumen = $row['resumen'];
            $item->autores = $row['autores'];
            $item->topico = $row['topico'];
            $item->archivo = $row['archivo'];
            $item->f_envio = $row['f_envio'];
            $item->estado = $row['estado'];

            array_push($datos, $item);
        }
        return $datos;
    }

    //}------------------------------------------------

    //Admin
    //{------------------------------------------------

    public function listaArticulosPendiente() {
        $datos = array();
        $sql = "select a.id as id, titulo, p_claves, resumen, autores, topico, archivo, f_envio, e.descripcion as estado ".
        "from (articulo a join autor_articulo aa on a.id = aa.articulo) join estado e on a.estado = e.id ";
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $stmt->fetch()) {
            $item = new Articulo();
            $item->id = $row['id'];
            $item->titulo = $row['titulo'];
            $item->p_claves = $row['p_claves'];
            $item->resumen = $row['resumen'];
            $item->autores = $row['autores'];
            $item->topico = $row['topico'];
            $item->archivo = $row['archivo'];
            $item->f_envio = $row['f_envio'];
            $item->estado = $row['estado'];

            array_push($datos, $item);
        }
        return $datos;
    }

    public function listaEvaluadores(){
        $datos = array();
        $sql = "select id, nombre, apellido from usuario where rol =2";
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $stmt->fetch()) {
            $item = new Evaluador();
            $item->id = $row['id'];
            $item->nombre = $row['nombre'];
            $item->apellido = $row['apellido'];

            array_push($datos, $item);
        }
        return $datos;
    }

    public function asignarEvaluador($articulo, $evaluador){
        $sql = "insert into evaluacion(articulo,evaluador) values (?,?)";
        try {
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(1, $articulo);
            $stmt->bindValue(2, $evaluador);
            $stmt->execute();
        } catch (PDOException $ex) {
            return false;
        }

        $sql = "update articulo set estado = 2 where id = ".$articulo;
        try {
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->execute();
        } catch (PDOException $ex) {
            return false;
        }

        return true;
    }

    public function getEvaluadores($articulo){
        $evaluadores = array();
        $sql = "select u.nombre as nombre, u.apellido as apellido from evaluacion e join usuario u on e.evaluador = u.id ".
            "where articulo = ".$articulo;
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $stmt->fetch()) {
            $item = new Evaluador();
            $item->nombre = $row['nombre'];
            $item->apellido = $row['apellido'];
            array_push($evaluadores,$item);
        }
        return $evaluadores;
    }

    public function evaluar($datos = []){
        $sql = "insert into observacion(admin, articulo, fecha, observaciones)" .
                " values (?,?,?,?)";
        try {
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(1, $datos['admin']);
            $stmt->bindValue(2, $datos['articulo']);
            $stmt->bindValue(3, $datos['fecha']);
            $stmt->bindValue(4, $datos['observaciones']);
            $stmt->execute();
        } catch (PDOException $ex) {
            return false;
        }

        $sql = "update articulo set estado = ".$datos['aceptar']." where id = ".$datos['articulo'];
        try {
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->execute();
        } catch (PDOException $ex) {
            return false;
        }

        return true;
    }

    //}------------------------------------------------
    //Evaluador
    //{------------------------------------------------
        public function listaArticulosEvaluacion($evaluador) {
            $datos = array();
            $sql = "select a.id as id, titulo, p_claves, resumen, autores, topico, archivo, f_envio, e.descripcion as estado ".
            "from (articulo a join evaluacion ev on a.id = ev.articulo) join estado e on a.estado = e.id ".
            "where a.estado = 2 and ev.evaluador = ".$evaluador;
            $stmt = $this->db->connect()->query($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $stmt->fetch()) {
                $item = new Articulo();
                $item->id = $row['id'];
                $item->titulo = $row['titulo'];
                $item->p_claves = $row['p_claves'];
                $item->resumen = $row['resumen'];
                $item->autores = $row['autores'];
                $item->topico = $row['topico'];
                $item->archivo = $row['archivo'];
                $item->f_envio = $row['f_envio'];
                $item->estado = $row['estado'];
    
                array_push($datos, $item);
            }
            return $datos;
        }

        public function calificar($datos){
            $sql = "update evaluacion set fecha = ?, observaciones=?, aprobacion=? ".
                "where articulo=? and evaluador=?";
            try {
                $stmt = $this->db->connect()->prepare($sql);
                $stmt->bindValue(1, $datos['fecha']);
                $stmt->bindValue(2, $datos['observaciones']);
                $stmt->bindValue(3, $datos['veredicto']);
                $stmt->bindValue(4, $datos['articulo']);
                $stmt->bindValue(5, $datos['evaluador']);
                $stmt->execute();
            } catch (PDOException $ex) {
                return false;
            }
            return true;
        }
    
    //}------------------------------------------------

}

?>