<?php
  require_once 'layout/admin_header_layout.php';
?>

         <!--------------------------
        | Your Page Content Here |
        -------------------------->
		<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <div class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small>Evaluar</small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="register-box-body">
                <p class="login-box-msg">Evaluar Articulo</p>

                <form action="<?php echo constant('URL'); ?>articulos/evaluarArticulo" method="post">

                    <div class="form-group has-feedback">
                        <input required type="hidden" id="articulo" name="articulo" class="form-control" value=<?php echo '"' . $_GET['articulo'] . '"'; ?>>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <textarea rows="10" cols="40" required id="observaciones" name="observaciones" class="form-control" placeholder="Observaciones"></textarea>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-4"></div>
                        <div class="col-xs-4">
                            <button type="submit" name="aceptar" value="1" onclick="return confirm('¿esta seguro?, este proceso es irreversible')" class="btn btn-primary btn-block btn-flat">Aceptar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <br>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-4"></div>
                        <div class="col-xs-4">
                            <button type="submit" name="rechazar" value="1" onclick="return confirm('¿esta seguro?, este proceso es irreversible')" class="btn btn-primary btn-block btn-flat">Rechazar</button>
                        </div>
                        <!-- /.col -->
                    </div>

                </form>

            </div>

          </section>
      <!-- /.content -->
      </div>
      </div>

<?php
  require_once 'layout/admin_footer_layout.php';
?>