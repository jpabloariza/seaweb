<?php
  require_once 'layout/admin_header_layout.php';
?>
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
		<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

            <small>Registrar evaluador </small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <div class="register-box-body">
            <p class="login-box-msg">Registro Evaluador</p>

            <form action="<?php echo constant('URL'); ?>registro/registrarEvaluador" method="post">
            
                <div class="form-group has-feedback">
                    <input required type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="email" id="email" name="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="text" id="orcid" name="orcid" class="form-control" placeholder="Orcid">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="password" id="pass" name="pass" class="form-control" placeholder="Contraseña">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="password" id="pass2" name="pass2" class="form-control" placeholder="Verificar Contraseña">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-4"></div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
                    </div>
                    <!-- /.col -->
                </div>

            </form>

        </div>


    	</section>
    	<!-- /.content -->
	</div>

<?php
  require_once 'layout/admin_footer_layout.php';
?>