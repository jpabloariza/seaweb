<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Evaluación de Articulos</title>

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!--CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo constant('URL'); ?>css/style.css">



    </head>
    <body>

        <div class="container ">
            <div id="contenido">

                <div>
                    <h3></h3>
                </div>

                <div >
                    <img src="<?php echo constant('URL'); ?>imagenes/logo.jpg" id="icon" alt="logo" />
                </div>

                <form action="<?php echo constant('URL'); ?>registro/registrar" method="POST">

                    <input required type="text" id="nombre" class="fadeIn second" name="nombre" placeholder="Nombre">

                    <input required type="text" id="apellido" class="fadeIn second" name="apellido" placeholder="Apellido">

                    <input required type="text" id="orcid" class="fadeIn second" name="orcid" placeholder="Orcid">

                    <input required type="email" id="email" class="fadeIn second" name="email" placeholder="Correo electronico">

                    <input required type="password" id="pass" class="fadeIn third" name="pass" placeholder="Contraseña">

                    <input required type="password" id="pass2" class="fadeIn third" name="pass2" placeholder="Verificar Contraseña">

                    <input type="submit" class="fadeIn fourth" value="Registrar">
                </form>
            </div>
        </div>

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">

        </script>


        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   
    </body>

</html>