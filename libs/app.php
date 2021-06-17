<?php
require_once 'controllers/mensajes.php';

class App{

    function __construct(){
        //echo "<p>Nueva app</p>";

        $url = isset($_GET['url']) ? $_GET['url']: null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);


        // cuando se ingresa sin definir controlador
        if(empty($url[0])){
            $archivoController = 'controllers/articulos.php';
            require_once $archivoController;
            $controller = new Articulos();
            $controller->loadModel('Articulos');
            $controller->render();
            return;
        }
        $archivoController = 'controllers/' . $url[0] . '.php';

        if(file_exists($archivoController)){
            require_once $archivoController;
            
            // inicializar controlador
            $controller = new $url[0];
            $controller->loadModel($url[0]);

            // si hay un método que se requiere cargar
            if(isset($url[1])){
                
                $controller->{$url[1]}();
            }else{
                $controller->render();
            }
        }else{
            $controller = new Mensajes();
        }
    }
}

?>