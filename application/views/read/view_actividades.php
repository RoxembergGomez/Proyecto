
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5>PLAN ANUAL DE TRABAJO</h5> 
    </div>
    <div class="x_content">

      <div class="row">
        <div class="col-md-2">
          <div class="">
                <?php echo form_open_multipart('controller_actividades/agregar');
                  if($this->session->userdata('tipo')=='jefe')
                  {
                ?>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-database"></i> Agregar</button>
                <?php
                }
                echo form_close();?>
            </div>
        </div>

      <div class="col-md-8">
      <?php echo form_open_multipart('controller_actividades/reporteporempleado');?>

        <div class="col-md-2 text-center">
          <h6 style="font-weight: bold; color: #000000; margin: 10px 0px 0px 0px;">Buscar:</h6>
        </div>
        <div class="row col-md-5">
         
          <select name="idEmpleado" class="col-md-12 form-control" value="<?php echo set_value('idEmpleado'); ?>">
            <option value="">Seleccione un empleado</option>
            <?php
                 foreach ($seleccion->result() as  $rowa)
              {?> <option value="<?php echo $rowa->idEmpleado;?>">
                <?php echo $rowa->nombres.' '.$rowa->primerApellido.' '.$rowa->segundoApellido;?>
                </option><?php
                }?>
          </select> <br>
          <p><?php echo form_error('idEmpleado');?></p>
        </div>
        <div class="col-md-4">
          <select name="estadoEjecucion" class="col-md-12 form-control"  value="<?php echo set_value('estadoEjecucion'); ?>">
            <option value="">Seleccione estado</option>
            <option value="1">Asignado</option>
            <option value="3">Ejecutado</option>
            <option value="">General</option>
          </select> <br>
           <p ><?php echo form_error('estadoEjecucion');?></p>
        </div>
        <div class="col-md-1">
          <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ver Reporte" ><i class="fa fa-sign-out"></i></button>
        </div>
        <?php echo form_close();?>
      </div>
      

        <div class="col-md-2">
          <div class="btn-group" role="group" >
                <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i>   Reportes Generales</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <?php echo form_open_multipart('controller_actividades/pendientes');?>
                    <button  type="submit" class="btn btn-outline-info btn-sm col-sm-12 text-left"><i class="fa fa-desktop"></i> Pendientes</button>
                <?php echo form_close();

                echo form_open_multipart('controller_actividades/ejecutadas');?>
                    <button  type="submit" class="btn btn-outline-info btn-sm col-sm-12 text-left"><i class="fa fa-desktop"></i> Ejecutadas</button>
                <?php echo form_close();

                echo form_open_multipart('controller_actividades/ejecutadasporempleado');?>
                    <button  type="submit" class="btn btn-outline-info btn-sm col-sm-12 text-left"><i class="fa fa-desktop"></i> Por Empleados</button>
                <?php echo form_close();

                echo form_open_multipart('controller_actividades/eliminados');?>
                    <button  type="submit" class="btn btn-outline-info btn-sm col-sm-12 text-left"><i class="fa fa-trash"></i> Eliminadas</button>
                <?php echo form_close();

                ?>
                </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">              
              
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Nro.</th>
                  <th class="text-center">Informe</th>
                  <th class="text-center">Objetivos</th>
                  <th class="text-center">Normativa Relacionada</th>
                  <th class="text-center">Fecha de Inicio</th>
                  <th class="text-center">Fecha de Conclusión</th>
                  <th class="text-center">Grado de Priorización</th>
                  <th class="text-center">Estado Proceso</th>
                <?php
                  if($this->session->userdata('tipo')=='jefe')
                  {
                ?> 
                    <th class="text-center">Acciones</th> 
                <?php
                  }
                ?>
                
                </tr>
              </thead>
              <tbody>
              <?php
              $indice=1;
              foreach ($plananualtrabajo->result() as  $row)
              {
              ?>
                 <tr>
                  <td class="text-center"><?php echo $indice;?></td>
                  <td ><?php echo $row->informe;?></td>
                  <td><?php echo $row->objetivo;?></td>
                  <td><?php echo $row->normativa;?></td>
                  <td class="text-center"><?php echo formatearFecha($row->fechaInicio);?></td>
                  <td class="text-center"><?php echo formatearFecha($row->fechaConclusion);?></td>
                  <td class="text-center"><?php echo $row->gradoPriorizacion;?></td>
                  <td class="text-center">
                    <?php if ($row->estadoEjecucion=='2'){?> <p id="anaranjado" >Programado</p><?php } else if ($row->estadoEjecucion=='1'){?> <p id="azul" >Asignado</p><?php } 
                    else if ($row->estadoEjecucion=='3'){?><p id="verde">Ejecutado</p><?php }?>
                  </td> 
                 <?php
                if($this->session->userdata('tipo')=='jefe')
                {?> 
                  <td class="text-center" >
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i></button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                          <?php echo form_open_multipart('controller_memorandumplanificacion/agregar');?>
                              <input type="hidden" name="idPlan" value="<?php echo $row->idPlanAnualTrabajo;?>"> 
                              <button type="submit" class="dropdown-item"><i class="fas glyphicon glyphicon-hand-up"></i> Asignar MPA</button>
                          <?php echo form_close();?>

                          <?php echo form_open_multipart('controller_procesos/agregar');?>
                              <input type="hidden" name="idPlan" value="<?php echo $row->idPlanAnualTrabajo;?>">
                              <button type="submit" class="dropdown-item"><i class="fa fa-database"></i>  Agregar Proceso</button>
                          <?php echo form_close();?>

                          <?php echo form_open_multipart('controller_procesos/index');?>
                              <input type="hidden" name="idPlan" value="<?php echo $row->idPlanAnualTrabajo;?>"> 
                              <button type="submit" class="dropdown-item"><i class="fa fa-list"></i> Lista de Procesos</button>
                          <?php echo form_close();

                          echo form_open_multipart('controller_actividades/modificar');?>        
                            <input type="hidden" name="idPlan" value="<?php echo $row->idPlanAnualTrabajo;?>" >
                            <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar Actividad</button>
                          <?php echo form_close();?>


                            <button type="submit" name="botton" value="Eliminar" class="dropdown-item" onclick="return confirm_modalFotos(<?php echo $row->idPlanAnualTrabajo; ?>)" ><i class="fa fa-trash"></i>  Eliminar Actividad</button>
                      </div>
                    </div>
                  <?php
                    } 
                  ?>
                  </td>
                </tr>
            <?php
              $indice++;
              }
            ?>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<!-- ALERTAS PARA ELIMINAR -->
<div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ELIMNAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <p style="font-size: 20px;">Estás seguro de eliminar los datos?</p>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
        <a id="url-delete" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i>  Eliminar</a>
      </div>
    </div>
  </div>
</div>

<script>
     function confirm_modalFotos(id) {
            var url = '<?php echo base_url() . "index.php/controller_actividades/eliminarbd/"; ?>';
            $("#url-delete").attr('href', url + id);
            $('#modalConfirmacion').modal('show');
        } 
</script>
