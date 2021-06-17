<?php

class Articulos extends Controller {

    function __construct() {
        parent::__construct();
        session_start();
        if (!isset($_SESSION['id'])) {
            $this->view->redirect('login');
        }
    }

    private function validarSesion($rol) {
        if ($rol != $_SESSION['rol']) {
            //MENSAJE DE NO TIENE PERMITIDO INGRESAR A ESTA PAGINA
            $this->view->redirect('');
            return true;
        }
        return false;
    }

    private function rolRender($rol, $direcion) {
        switch ($rol) {
            case 1:
                $usuario = 'autor';
                break;
            case 2:
                $usuario = 'evaluador';
                break;
            case 3:
                $usuario = 'admin';
                break;
        }
        $this->view->render($usuario . '/' . $direcion);
    }

    //TODAS LAS SESIONES
    //{-------------------------------------------------------------------------

    private function alerta() {
        if (isset($_GET['m'])) {
            switch ($_GET['m']) {
                case 1:
                    $men="La tarea se ha realizado con exito.";
                    break;
                case -1:
                    $men="Ocurrió un error con el servidor.";
                    break;
                case 2:
                    $men="Se ha realizado el registro con exito.";
                    break;
                case -2:
                    $men="Ocurrió un error al realizar el registro.";
                    break;
                case -3:
                    $men="Ocurrió un error al subir el documento pdf.";
                    break;
                case -4:
                    $men="Formato de archivo incorrecto";
                    break;
                default:
                    break;
            }
            $mensajes = new Mensajes();
            $mensajes->show($men);
        }
    }

    function render() {
        $this->lista();
    }

    function lista() {
        $datos = array();
        switch ($_SESSION['rol']) {
            case 1:
                $datos = $this->model->listaArticulosAutor($_SESSION['id']);
                break;
            case 2:
                $datos = $this->model->listaArticulosAutor($_SESSION['id']);
                break;
            case 3:
                $datos = $this->model->listaArticulosPendiente();
                break;
        }
        $this->view->datos = $datos;
        $this->rolRender($_SESSION['rol'], 'listaArticulos');
        $this->alerta();
    }

    function detalles(){
    	$articulo = filter_input(INPUT_GET, "articulo");
        if (!isset($articulo)) {
            $this->view->redirect('articulos/lista');
            return;
        }
        $datos = $this->model->getArticulo($articulo);
        $rol = $_SESSION['rol'];
        switch ($rol) {
            case 1:
                $usuario = "autor";
                break;
            case 2:
                $usuario = "evaluador";
                break;
            case 3:
                $usuario = "admin";
                break;
        }
        $observacion = $this->model->getObservaciones($articulo);
        $evaluadores = $this->model->getEvaluadores($articulo);
        $evaluaciones = $this->model->getEvaluaciones($articulo);
        $this->view->datos = $datos;
        $this->view->observacion = $observacion;
        $this->view->evaluadores = $evaluadores;
        $this->view->evaluaciones = $evaluaciones;
        $this->view->render($usuario . '/detalles');
        $this->alerta();
    }

    function editar(){
        $articulo = filter_input(INPUT_GET, "articulo");
        if (!isset($articulo)) {
            $this->view->redirect('articulos/lista');
            return;
        }
        $datos = $this->model->getArticulo($articulo);
        $rol = $_SESSION['rol'];
        switch ($rol) {
            case 1:
                $usuario = "autor";
                break;
            case 2:
                $this->view->redirect('articulos/lista');
                return;
                break;
            case 3:
                $usuario = "admin";
                break;
        }
        $this->view->datos = $datos;
        $this->view->render($usuario . '/editarArticulo');
    }

    function editarArticulo(){
        $id = filter_input(INPUT_POST, "id");
        $titulo = filter_input(INPUT_POST, "titulo");
        $p_claves = filter_input(INPUT_POST, "p_claves");
        $resumen = filter_input(INPUT_POST, "resumen");
        $topico = filter_input(INPUT_POST, "topico");

        $datos = array('titulo' => $titulo, 'p_claves' => $p_claves, 'resumen' => $resumen,
                'topico' => $topico, 'id' => $id);
        $resp = $this->model->actualizarArticulo($datos);

        if ($resp) {
            //REGISTRO CORRECTO
            $this->view->redirect('articulos/detalles?m=1&articulo='.$id);
        } else {
            //ERROR AL REGISTRAR
            $this->view->redirect('articulos/detalles?m=-1&articulo='.$id);
        }

    }

    function descargarArticulo(){
        $articulo = filter_input(INPUT_POST, "articulo");
        $usuario = $_SESSION['id'];
        $this->model->descargarArticulo($articulo, $usuario);
    }

    //AUTORES
    //{--------------------------------------------

    function subirArticulo(){
        $rol = $_SESSION['rol'];
        switch ($rol) {
            case 1:
                $usuario = "autor";
                break;
            case 2:
                $usuario = "evaluador";
                break;
            case 3:
                $this->view->redirect('articulos/lista');
                return;
                break;
        }
    	$this->view->render($usuario.'/subirArticulo');
    	$this->alerta();
    }

    function registrarArticulo() {
        $titulo = filter_input(INPUT_POST, "titulo");
        $p_claves = filter_input(INPUT_POST, "p_claves");
        $resumen = filter_input(INPUT_POST, "resumen");
        $topico = filter_input(INPUT_POST, "topico");
        $autores = filter_input(INPUT_POST, "autores");
        $usuario = $_SESSION['id'];

        $resp=$this->subirArchivo();
        if($resp){
            $archivo = $_FILES['archivo'];

            $fecha = new DateTime("NOW");
            
            $datos = array('titulo' => $titulo, 'p_claves' => $p_claves, 'resumen' => $resumen,
                'topico' => $topico, 'autores' => $autores, 'archivo' => $archivo['name'], 'usuario' => $usuario, 
                'fecha' => $fecha->format("Y-m-d"));
            $resp = $this->model->registrarArticulo($datos);

            if ($resp) {
                //REGISTRO CORRECTO
                $this->view->redirect('articulos/subirArticulo?m=2');
            } else {
                //ERROR AL REGISTRAR
                $this->view->redirect('articulos/subirArticulo?m=-2');
            }
        }
    }

    function subirArchivo() {
        if (isset($_FILES['archivo']) && $_FILES['archivo']['type'] == 'application/pdf') {
            $archivo = $_FILES['archivo'];
            $articulo = filter_input(INPUT_POST, "titulo");
            $autor = $_SESSION['user'];
            $resp = $this->model->subirArchivo($articulo, $archivo, $autor);
            if ($resp) {
                //SE SUBIO CORRECTAMENTE
                return true;
            } else {
                //EL ARCHIVO YA EXISTE U OCURRIO UN ERROR AL SUBIR
                $this->view->redirect('articulos/subirArticulo?m=-3');
                return false;
            }
        } else{
            $this->view->redirect('articulos/subirArticulo?m=-4');
            return false;
        }
    }

    //}--------------------------------------------

    //ADMIN
    //{--------------------------------------------
    
    function evaluar() {
        $rol = $_SESSION['rol'];
        switch ($rol) {
            case 1:
                $this->view->redirect('articulos/lista');
                return;
                break;
            case 2:
                $usuario = "evaluador";
                break;
            case 3:
                $usuario = "admin";
                break;
        }
        $this->view->render($usuario.'/evaluar');
    }

    function evaluadores(){
        $datos = $this->model->listaEvaluadores();
        $this->view->evaluadores = $datos;
        $this->view->render('admin/asignarEvaluador');
    }

    function asignarEvaluador(){
        $articulo = filter_input(INPUT_POST, "articulo");
        $evaluador = filter_input(INPUT_POST, "evaluador");

        $datos = array('articulo' => $articulo, 'evaluador' => $evaluador);
        $resp = $this->model->asignarEvaluador($articulo,$evaluador);
        if ($resp) {
            //REGISTRO CORRECTO
            $this->view->redirect('articulos/detalles?m=2&articulo='.$articulo);
        } else {
            //ERROR AL REGISTRAR
            $this->view->redirect('articulos/detalles?m=-2&articulo='.$articulo);
        }
    }

    function evaluarArticulo() {
        $articulo = filter_input(INPUT_POST, "articulo");
        $boton = filter_input(INPUT_POST, "aceptar");
        $admin = $_SESSION['id'];
        if(isset($boton)){
            $aceptar = 3;
        } else {
            $aceptar = 4;
        }
        $fecha = new DateTime("NOW");
        $observaciones = filter_input(INPUT_POST, "observaciones");
        $datos = array('admin' => $admin, 'articulo' => $articulo, 'fecha' => $fecha->format("Y-m-d"),
         'observaciones' => $observaciones, 'aceptar' => $aceptar);
        $resp = $this->model->evaluar($datos);
        if ($resp) {
            //REGISTRO CORRECTO
            $this->view->redirect('articulos/detalles?m=2&articulo='.$articulo);
        } else {
            //ERROR AL REGISTRAR
            $this->view->redirect('articulos/detalles?m=-2&articulo='.$articulo);
        }
    }
    //}--------------------------------------------
    //EVALUADOR
    //{--------------------------------------------
    function listaEvaluar(){
        $rol = $_SESSION['rol'];
        if($rol != 2){
            $this->view->redirect('articulos/lista');
            return;
        }
        $datos = $this->model->listaArticulosEvaluacion($_SESSION['id']);
        $this->view->datos = $datos;
        $this->view->render('evaluador/listaArticulosEvaluar');
    }

    function evaluacion(){
        $rol = $_SESSION['rol'];
        if($rol != 2){
            $this->view->redirect('articulos/lista');
            return;
        }
        $articulo = filter_input(INPUT_GET, "articulo");
        if (!isset($articulo)) {
            $this->view->redirect('articulos/listaEvaluar');
            return;
        }
        $datos = $this->model->getArticulo($articulo);
        $observaciones = $this->model->getEvaluaciones($articulo);
        $this->view->datos = $datos;
        $this->view->observaciones = $observaciones;
        $this->view->render('evaluador/detallesEvaluar');
        $this->alerta();
    }

    function calificar(){
        $articulo = filter_input(INPUT_POST, "articulo");
        $veredicto = filter_input(INPUT_POST, "veredicto");
        $observaciones = filter_input(INPUT_POST, "observaciones");
        $evaluador = $_SESSION['id'];
        $fecha = new DateTime("NOW");
        $datos = array('evaluador' => $evaluador, 'articulo' => $articulo, 'fecha' => $fecha->format("Y-m-d"),
         'observaciones' => $observaciones, 'veredicto' => $veredicto);
        $resp = $this->model->calificar($datos);
        if ($resp) {
            //REGISTRO CORRECTO
            $this->view->redirect('articulos/evaluacion?m=2&articulo='.$articulo);
        } else {
            //ERROR AL REGISTRAR
            $this->view->redirect('articulos/evaluacion?m=-2&articulo='.$articulo);
        }
    }
    //}--------------------------------------------
}

?>