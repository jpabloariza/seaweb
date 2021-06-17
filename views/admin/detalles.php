<?php
  require_once 'layout/admin_header_layout.php';
?>
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
		    <!-- Content Header (Page header) -->
		    <section class="content">
		        <div class="row">

		            <div class="col-xs-12">
		                <div class="box">
		                    <div class="box-header">
		                        <h3 class="box-title"><b>Detalles</b></h3>
		                    </div>
		                    <!-- /.box-header -->
		                    <div class="box-body">
		                        <table id="example2" class="table table-striped table-bordered table-hover">

		                            <tbody>

		                                <tr>
		                                    
		                                    <th>Titulo del Articulo:</th>

		                                    <th><?php
                                        echo $this->datos->titulo;
                                        ?></th>

		                                </tr>

		                                <tr>

		                                    <th>Resumen:</th>
		                                    <th><?php
                                        echo $this->datos->resumen;
                                        ?></th>

		                                </tr>

		                                <tr>

		                                    <th>Palabras claves:</th>
		                                    <th><?php
                                        echo $this->datos->p_claves;
                                        ?></th>

		                                </tr>

                                    <tr>

                                        <th>Autores:</th>
                                        <th><?php
                                        echo $this->datos->autores;
                                        ?></th>

                                    </tr>

                                    <tr>

                                        <th>Topico:</th>
                                        <th><?php
                                        echo $this->datos->topico;
                                        ?></th>

                                    </tr>

                                    <tr>

                                        <th>Fecha de envio:</th>
                                        <th><?php
                                        echo $this->datos->f_envio;
                                        ?></th>

                                    </tr>

		                                <tr>

		                                    <th>Estado:</th>
		                                    <th><?php
                                        echo $this->datos->estado;
                                        ?></th>

		                                </tr>

                                    <tr>

                                        <th>Documento pdf:</th>
                                        <th><form action="<?php echo constant('URL') ?>articulos/descargarArticulo" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="articulo" value=<?php echo '"' . $this->datos->id . '"'; ?>>
                                            <input type="submit"  class="btn btn-primary" value="Descargar">
                                        </form></th>

                                    </tr>

		                                <tr>
		                                    <tr>
                                        <th>
                                            <?php if($this->datos->estado != "aceptado" && $this->datos->estado != "rechazado"){?>
                                            <div>
                                                <form class="col-md-3" action= "<?php echo constant('URL'); ?>articulos/evaluadores" method="get">
                                                    <input type="hidden" name="articulo" value=<?php echo '"' . $this->datos->id . '"'; ?>>

                                                    <button type="submit" class="btn btn-primary">Asignar evaluador <i class="glyphicon glyphicon-pencil"></i></button>
                                                </form>
                                            </div>
                                            <?php } ?>
                                            <?php if($this->datos->estado != "aceptado" && $this->datos->estado != "rechazado"){?>
                                            <div>
                                                <form class="col-md-3" action= "<?php echo constant('URL'); ?>articulos/evaluar" method="get">
                                                    <input type="hidden" name="articulo" value=<?php echo '"' . $this->datos->id . '"'; ?>>
                                                    <button type="submit" class="btn btn-primary">Calificar <i class="glyphicon glyphicon-pencil"></i></button>
                                                </form>
                                            </div>
                                            <?php }?>
                                            <div>
                                                <form class="col-md-3" action= "<?php echo constant('URL'); ?>articulos/editar" method="get">
                                                    <input type="hidden" name="articulo" value=<?php echo '"' . $this->datos->id . '"'; ?>>

                                                    <button type="submit" class="btn btn-primary">Editar <i class="glyphicon glyphicon-pencil"></i></button>
                                                </form>
                                            </div>
                                        </th>
                                        </tr>
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

        <div class="content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Evaluadores asignados</h3>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($this->evaluadores)) {
                                        echo '<tr><td>No hay evaluadores asignados</td></tr>';
                                    } else {
                                        foreach ($this->evaluadores as $dato) {
                                            echo "<tr>";
                                            echo "<td>" . $dato->nombre . "</td>";
                                            echo "<td>" . $dato->apellido . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
          </div>
      </div>

      <div class="content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Veredicto</h3>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                    <tr>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($this->observacion)) {
                                        echo '<tr><td>No hay observaciones</td></tr>';
                                    } else {
                                        foreach ($this->observacion as $dato) {
                                            echo "<tr>";
                                            echo "<td>" . $dato . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
          </div>
      </div>

      <div class="content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Observaciones</h3>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                    <tr>
                                        <th>Evaluador</th>
                                        <th>Observación</th>
                                        <th>Fecha</th>
                                        <th>Veredicto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($this->evaluaciones)) {
                                        echo '<tr><td>No hay observaciones</td></tr>';
                                    } else {
                                        foreach ($this->evaluaciones as $dato) {
                                            echo "<tr>";
                                            echo "<td>" . $dato->evaluador . "</td>";
                                            echo "<td>" . $dato->observaciones . "</td>";
                                            echo "<td>" . $dato->fecha . "</td>";
                                            echo "<td>" . $dato->aprobacion . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
          </div>
      </div>

		</div>
		<!-- /.content -->

<?php
  require_once 'layout/admin_footer_layout.php';
?>