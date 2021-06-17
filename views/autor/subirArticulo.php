
<?php
  require_once 'layout/autor_header_layout.php';
?>
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
		<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <small>Subir articulo</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <div class="register-box-body">
            <p class="login-box-msg">Registrar articulo</p>

            <form action="<?php echo constant('URL'); ?>articulos/registrarArticulo" method="post" enctype="multipart/form-data">

                <div class="form-group has-feedback">
                    <input required type="text" id="titulo" name="titulo" class="form-control" placeholder="Titulo">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="text" id="p_claves" name="p_claves" class="form-control" placeholder="Palabras Clave">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="text" id="resumen" name="resumen" class="form-control" placeholder="Resumen">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="text" id="autores" name="autores" class="form-control" placeholder="Autores">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="text" id="topico" name="topico" class="form-control" placeholder="Topicos">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback  ">
                    <label>Seleccione archivo en pdf:</label>
                    <input required type="file" id="archivo" name="archivo" class="form-control">
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
  require_once 'layout/autor_footer_layout.php';
?>