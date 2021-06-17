<?php
  require_once 'layout/evaluador_header_layout.php';
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

                <form action="<?php echo constant('URL'); ?>articulos/calificar" method="post">

                    <div class="form-group has-feedback">
                        <input required type="hidden" id="articulo" name="articulo" class="form-control" value=<?php echo '"' . $_GET['articulo'] . '"'; ?>>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <textarea rows="10" cols="40" required id="observaciones" name="observaciones" class="form-control" placeholder="Observaciones"></textarea>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="input-field col s12">
                        <select name="veredicto">
                            <option value="devuelto" selected>Devuelto</option>
                            <option value="aceptado">Aceptado</option>
                            <option value="rechazado">Rechazado</option>
                        </select>
                    </div>

                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-4"></div>
                        <div class="col-xs-4">
                            <button type="submit" onclick="return confirm('¿esta seguro?, este proceso es irreversible')" class="btn btn-primary btn-block btn-flat">Calificar</button>
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
  require_once 'layout/evaluador_footer_layout.php';
?>