<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >EJECUCIÓN DE ACTIVIDADES</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
              <div class="row float-left">
                <?php 
                echo form_open_multipart('controller_programatrabajo/concluidos');?>
                    <button  type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Actividades Concluidas</button>
                <?php echo form_close();?>
              </div>  
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Detalle Subprocesos</th>
                    <th class="text-center">Criticidad</th> 
                    <th class="text-center">Descripción Actividad</th>
                    <th class="text-center">Estado Revisión</th>
                    <th class="text-center">Respaldo</th>
                    <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($actividades->result() as  $row)
              {?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td ><?php echo $row->descripcionSubProceso;?></td>
                    <td class="text-center"  ><?php echo $row->clasificacionCriticidad;?></td>
                    <td ><?php echo $row->actividad;?></td>
                    <td class="text-center"> <?php if (($row->verificacionActividad)=='0'){?> <p style="color:red; font-weight: bold;" >Pendiente</p><?php } else {?> <p style="color:#40E85F; font-weight: bold;" >Revisado</p><?php }?>
                    </td>
                    <td>
                    <?php 
                      $docRespaldo=$row->respaldo;
                      if ($docRespaldo=="Sin Respaldo") 
                      {
                        ?>
                        <p>Sin Respaldo</p>
                    <?php  
                      }
                      else
                      {
                    ?>
                        <a href="<?php echo base_url();?>/uploads/respaldoPrograma/<?php echo $docRespaldo?>"> Respaldo
                          <!--- <img src="<?php echo base_url();?>/uploads/logopdf.png" width="50px">-->
                        </a>
                    <?php  
                      }
                    ?>
                  </td> 
                    <td>
                      <ul class="col text-center">
                      <li class="nav-item dropdown open text-center" style="list-style:none;">
                         <a href="<?php echo base_url(); ?>gentelella/javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-align-justify"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="padding: 0px;">
                          <?php echo form_open_multipart('controller_programas/ejecutar');?>        
                            <input type="hidden" name="idprograma" value="<?php echo $row->idProgramaTrabajo;?>" >
                            <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>" >
                            <button type="submit" name="ejecutar" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Revisar</button>
                          <?php echo form_close();?>
                          <?php echo form_open_multipart('controller_actividades/modificar');?>        
                            <input type="hidden" name="idPlan" value="<?php echo $row->idProgramaTrabajo;?>" >
                            <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar</button>
                          <?php echo form_close();?>    
                            <input type="hidden" name="idPlan" >
                            <button type="submit" name="botton" value="Eliminar" class="dropdown-item" onclick="return confirm_modalFotos(<?php echo $row->idPlanAnualTrabajo; ?>)" ><i class="fa fa-trash"></i> Eliminar</button>  
                        </div>
                      </li>
                       </ul>
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