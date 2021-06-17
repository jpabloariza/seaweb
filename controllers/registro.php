
<?php

class Registro extends Controller {

    function __construct() {
        parent::__construct();
        session_start();
        if (isset($_SESSION['id'])) {
            $this->view->redirect('');
        }
    }

    private function alerta() {
        if (isset($_GET['m'])) {
            switch ($_GET['m']) {
                case 0:
                    $men="Las contraseñas no coinciden.";
                    break;
                case -1:
                    $men="Ha ocurrido un error al registrarse.";
                    break;
                default:
                    break;
            }
            $mensajes = new Mensajes();
            $mensajes->show($men);
        }
    }

    function render() {
        $this->view->render('registro');
        $this->alerta();
    }

    function registrar() {
        $name = filter_input(INPUT_POST, "nombre");
        $apellido = filter_input(INPUT_POST, "apellido");
        $email = filter_input(INPUT_POST, "email");
        $orcid = filter_input(INPUT_POST, "orcid");
        $pass = filter_input(INPUT_POST, "pass");
        $pass2 = filter_input(INPUT_POST, "pass2");
        if ($pass != $pass2) {
            //ERROR NO COINCIDEN LAS CONTRASEÑAS
            $this->view->redirect('registro?m=0');
            return;
        }
        $datos = array('rol' => 1, 'nombre' => $name, 'apellido' => $apellido, 'email' => $email, 'password' => $pass, 'orcid' => $orcid);
        $resp = $this->model->registrar($datos);
        if ($resp) {
            //REGISTRO CORRECTAMENTE
            $this->view->redirect('login?m=1');
        } else {
            //OCURRIO UN ERROR AL REGISTRARSE
            $this->view->redirect('registro?m=-1');
        }
    }

    function registrarEvaluador() {
        $name = filter_input(INPUT_POST, "nombre");
        $apellido = filter_input(INPUT_POST, "apellido");
        $email = filter_input(INPUT_POST, "email");
        $orcid = filter_input(INPUT_POST, "orcid");
        $pass = filter_input(INPUT_POST, "pass");
        $pass2 = filter_input(INPUT_POST, "pass2");
        if ($pass != $pass2) {
            //ERROR NO COINCIDEN LAS CONTRASEÑAS
            $this->view->redirect('usuario/registrarEvaluador?m=-3');
            return;
        }
        $datos = array('nombre' => $name, 'apellido' => $apellido, 'email' => $email, 'password' => $pass, 'orcid' => $orcid);
        $resp = $this->model->registrarEvaluador($datos);
        if ($resp) {
            //REGISTRO CORRECTAMENTE
            $this->view->redirect('usuario/registrarEvaluador?m=2');
        } else {
            //OCURRIO UN ERROR AL REGISTRARSE
            $this->view->redirect('usuario/registrarEvaluador?m=-2');
        }
    }

}

?>