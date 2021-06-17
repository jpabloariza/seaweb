<?php
  require_once 'layout/autor_header_layout.php';
?>
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
		<div class="content-wrapper">
		    <!-- Content Header (Page header) -->
		    <section class="content">
		        <div class="row">

		            <div class="col-xs-12">
		                <div class="box">
		                    <div class="box-header">
		                        <h3 class="box-title">Datos Personales</h3>
		                    </div>
		                    <!-- /.box-header -->
		                    <div class="box-body">
		                        <table id="example2" class="table table-bordered table-responsive table-striped table-hover">
		                            <tbody>

		                                <tr>
		                                    <td class="col-md-2" rowspan="7" >
		                                        <div class="pull-right">
		                                            <img src="<?php echo constant('URL'); ?>dist/img/avatar5.png" class="img-responsive img-circle" alt="">
		                                        </div>
		                                    </td>
		                                    <th>Nombre:</th>
		                                    <th><?php
                                        echo $this->datos['nombre'];
                                        ?></th>
		                                </tr>
		                                <tr>
		                                    <th>Apellido: </th>
		                                    <th><?php
                                        echo $this->datos['apellido'];
                                        ?></th>
		                                </tr>
		                                <tr>
		                                    <th>email: </th>
		                                    <th><?php
                                        echo $this->datos['email'];
                                        ?></th>
		                                </tr>
		                                <tr>
		                                    <th>Orcid: </th>
		                                    <th><?php
                                        echo $this->datos['orcid'];
                                        ?></th>
		                                </tr>
		                                <tr>
		                                    <th>
		                                        <form action="<?php echo constant('URL'); ?>usuario/editar" method="post">
		                                            <button type="submit"  class="btn btn-primary">Editar  <i class="glyphicon glyphicon-pencil"></i> </button>
		                                        </form>
		                                    </th>
		                                </tr>

		                            </tbody>


		                        </table>
		                    </div>
		                    <!-- /.box-body -->
		                </div>
		                <!-- /.box -->


		                <!-- /.box -->
		            </div>
		            <!-- /.col -->
		        </div>
		        <!-- /.row -->
		    </section>
		    <!-- /.content -->
		</div>
		<!-- /.content -->
		</div>

<?php
  require_once 'layout/autor_footer_layout.php';
?>