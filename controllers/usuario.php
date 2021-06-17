
<?php

class Usuario extends Controller{

    function __construct(){
        parent::__construct();
        session_start();
        if(!isset($_SESSION['id'])){
        	$this->view->redirect('login');
        }
    }

    private function validarSesion($rol){
        if($rol!=$_SESSION['rol']){
            //MENSAJE DE NO TIENE PERMITIDO INGRESAR A ESTA PAGINA
            $this->view->redirect();
            return true;
        }
        return false;
    }

    private function alerta() {
        if(isset($_GET['m'])){
            switch ($_GET['m']) {
                case 1:
                    $men="Información editada con éxito.";
                    break;
                case -1:
                    $men="Ocurrió un error al editar la información.";
                    break;
                case 2:
                    $men="Se ha realizado el registro con exito.";
                    break;
                case -2:
                    $men="Ocurrió un error al realizar el registro.";
                    break;
                case -3:
                    $men="Las contraseñas no coinciden.";
                    break;  
                default:
                    break;
            }
            $mensajes=new Mensajes();
            $mensajes->show($men);
        }
    }

    private function rolRender($rol, $direcion){
        switch ($rol) {
            case 1:
                $usuario='autor';
                break;
            case 2:
                $usuario='evaluador';
                break;
            case 3:
                $usuario='admin';
                break;
        }
        $this->view->render($usuario.'/'.$direcion);
    }

    private function cargarDatos(){
        $datos=array();
        $datos=$this->model->informacion();
        $this->view->datos=$datos;
    }

    function render(){
       $this->informacion();
    }

    function cerrarSesion(){
        $this->model->cerrarSesion();
        $this->view->redirect('login');
    }

    function informacion(){
        $this->cargarDatos();
        $this->rolRender($_SESSION['rol'], 'informacion');
        $this->alerta();
    }

    function editar(){
        $this->cargarDatos();
        $this->rolRender($_SESSION['rol'],'editar');
    }

    function editarInformacion(){
        $id = filter_input(INPUT_POST, "id");
        $nombre = filter_input(INPUT_POST, "nombre");
        $apellido = filter_input(INPUT_POST, "apellido");
        $email = filter_input(INPUT_POST, "email");
        $orcid = filter_input(INPUT_POST, "orcid");
        $datos=array('id'=>$id, 'nombre'=>$nombre, 'apellido'=>$apellido, 'email'=>$email, 
            'orcid'=>$orcid);
        $resp=$this->model->editar($datos);
        if($resp){
            $this->view->redirect('usuario/informacion?m=1');
        }else{
            $this->view->redirect('usuario/informacion?m=-1');
        }
    }


    function registrarEvaluador(){
        $this->view->render('admin/registrarEvaluador');
        $this->alerta();
    }

}

?>