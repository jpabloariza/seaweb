<?php
  require_once 'layout/admin_header_layout.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editar Articulo
        </h1>

    </section>

    <!-- Main content -->

    <div class="col-md-12">

        <section class="content container-fluid">


            <div class="register-box-body">
                <p class="login-box-msg"></p>

                <form action="<?php echo constant('URL'); ?>articulos/editarArticulo" method="post">

                    <input required type="hidden" name="id" value=<?php echo '"' . $this->datos->id . '"'; ?>>

                    <div class="form-group has-feedback">
                        <input required type="text" name="titulo" class="form-control" placeholder="Titulo" required 
                               value=<?php echo '"' . $this->datos->titulo . '"'; ?>>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input required type="text" name="p_claves" class="form-control" placeholder="Palabras clave" required 
                               value=<?php echo '"' . $this->datos->p_claves . '"'; ?>>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                    <textarea rows="10" cols="40" required id="resumen" name="resumen" class="form-control" placeholder="Resumen"><?php echo $this->datos->resumen; ?></textarea>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input required type="text" name="topico" class="form-control" placeholder="topico" required 
                               value=<?php echo '"' . $this->datos->topico . '"'; ?>>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>


                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-4"></div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Editar Informacion</button>
                        </div>
                        <!-- /.col -->
                    </div>

                </form>


            </div>

            <!--------------------------
            | Your Page Content Here |
            -------------------------->

        </section>
    </div>
    <!-- /.content -->
</div>

<?php
  require_once 'layout/admin_footer_layout.php';
?>