<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <div class="row float-left " >
      <?php 
        echo form_open_multipart('controller_programas/actividades');?>
            <input type="hidden" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
            <input type="hidden" name="estadoPrograma" value="<?php echo $_POST  ['estadoPrograma'];?>">
          <button class="btn btn-primary float-center" data-toggle="tooltip" data-placement="top" title="Lista de actividades activas"><i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5 >EJECUCIÓN DE ACTIVIDADES</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
        <div class="col-sm-12">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Detalle Subprocesos</th>
                    <th class="text-center">Criticidad</th> 
                    <th class="text-center">Descripción Actividad</th>
                    <?php if($_POST['estadoPrograma']=='3'){?>
                    <th class="text-center">Estado Revisión</th>
                    <th class="text-center">Cumple</th>
                    <th class="text-center">Respaldo</th>
                  <?php }?>
                    <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($actividades->result() as  $row)
              {
                if($row->estadoPrograma!='2' || $this->session->userdata('tipo')!='ejecutor'){?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td ><?php echo $row->descripcionSubProceso;?></td>
                    <td class="text-center"  ><?php echo $row->clasificacionCriticidad;?></td>
                    <td ><?php echo $row->actividad;?></td>
                  <?php if($row->estadoPrograma=='3') {?>
                    <td class="text-center"> <?php 
                    if (($row->verificacionActividad)=='0'){?> <p id="rojo">Pendiente</p><?php }
                         else {?> <p id="verde">Revisado</p><?php }?>
                    </td>
                    <td class="text-center"> <?php
                      if (($row->verificacionActividad)=='1'){?> <p id="verde">Si</p><?php }
                      if (($row->verificacionActividad)=='2'){?> <p id="rojo"  >Parcial</p><?php }
                      if (($row->verificacionActividad)=='3'){?> <p id="rojo"  >No</p><?php }
                      if (($row->verificacionActividad)=='4'){?> <p id="anaranjado">N/A</p><?php }?>
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
                    <?php }?>
                    <td class="text-center">
                          <?php if ($row->estadoPrograma=='1' || $row->estadoPrograma=='2') {
                            echo form_open_multipart('controller_programas/recuperarbd');?>        
                            <input type="hidden" name="idprograma" value="<?php echo $row->idProgramaTrabajo;?>">
                            <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>" >
                            <input type="hidden" name="idsubproceso" value="<?php echo $row->idSubProceso;?>">
                            <input type="hidden" name="estadoPrograma" value="<?php echo $row->estadoPrograma;?>" >
                            <button type="submit" name="botton" value="recuperar" class="btn btn-warning"><i class="fa fa-database"></i> Recuperar</button>
                          <?php echo form_close();
                        }?>    
                    </td>
                  </tr>
                    <?php
                    }
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
</div>