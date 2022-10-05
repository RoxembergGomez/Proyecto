<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >LISTA DE ACTIVIDADES</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="row float-left">
                <?php echo form_open_multipart('controller_actividades/agregar');
                  if($this->session->userdata('tipo')=='jefe')
                  {
                ?>
                    <button type="submit" class="btn btn-outline-info btn-sm"><i class="fa fa-database"></i> Agregar Actividad</button>
                <?php
                  } 
                echo form_close();

                echo form_open_multipart('controller_actividades/eliminados');?>
                    <button  type="submit" class="btn btn-outline-info btn-sm"><i class="fa fa-trash"></i> Actividades Eliminadas</button>
                <?php echo form_close();?>

              </div>  
    
            <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
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
                  <th class="text-center">Informe Adjunto</th>
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
                  <td class="text-center"><?php echo estado($row->fechaInicio);?></td>
                  <td>
                    <?php 
                      $docInforme=$row->docInforme;
                      if ($docInforme=="Sin Informe") 
                      {
                        ?>
                        <p>Sin Informe</p>
                    <?php  
                      }
                      else
                      {
                    ?>
                        <a href="<?php echo base_url();?>/uploads/<?php echo $docInforme?>">
                          <img src="<?php echo base_url();?>/uploads/logopdf.png" width="50px">
                        </a>
                    <?php  
                      }
                    ?>
                  </td> 
                 <?php
                if($this->session->userdata('tipo')=='jefe')
                {?> 
                  <td >
                    <ul class="col text-center">
                      <li class="nav-item dropdown open text-center" style="list-style:none;">
                         <a href="<?php echo base_url(); ?>gentelella/javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-align-justify"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="padding: 0px;">
                          <?php echo form_open_multipart('controller_actividades/modificar');?>        
                            <input type="hidden" name="idPlan" value="<?php echo $row->idPlanAnualTrabajo;?>" >
                            <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar</button>
                          <?php echo form_close();?>    
                            <input type="hidden" name="idPlan" value="<?php echo $row->idPlanAnualTrabajo;?>">
                            <button type="submit" name="botton" value="Eliminar" class="dropdown-item" onclick="return confirm_modalFotos(<?php echo $row->idPlanAnualTrabajo; ?>)" ><i class="fa fa-trash"></i> Eliminar</button>

                          <?php echo form_open_multipart('controller_memorandumplanificacion/agregar');?>
                              <input type="hidden" name="idPlan" value="<?php echo $row->idPlanAnualTrabajo;?>"> 
                              <button type="submit" class="dropdown-item"><i class="fas glyphicon glyphicon-hand-up"></i> Asignar MPA</button>
                          <?php echo form_close();?>  

                        </div>
                      </li>
                    </ul>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación Edición</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         Estás seguro de Eliminar?
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a id="url-delete" type="submit" class="btn btn-primary">Eliminar</a>
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
