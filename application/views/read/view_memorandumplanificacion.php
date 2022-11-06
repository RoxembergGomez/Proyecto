<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >MEMORANDUM DE PLANIFICACIÓN DE AUDITORÍA</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Nro Informe</th>
                    <th class="text-center">Actividad</th> 
                    <th class="text-center">Fecha de Inicio</th>
                    <th class="text-center">Fecha de Conclusión</th>
                  <?php
                  if($this->session->userdata('tipo')=='jefe')
                  {
                  ?> 
                    <th class="text-center">Responsable de Ejecución</th>                   
                <?php
                  }
                ?>
                <th class="text-center">Acciones</th> 
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($memorandumplanificacion->result() as  $row)
              {

                if ($this->session->userdata('tipo')=='jefe') {  ?> 
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td class="text-center"><?php echo $row->numeroInforme;?></td>
                    <td ><?php echo $row->informe;?></td>
                    <td class="text-center"><?php echo formatearFecha($row->fechaInicio);?></td>
                    <td class="text-center"><?php echo formatearFecha ($row->fechaConclusion);?></td>
                <?php
                  if($this->session->userdata('tipo')=='jefe')
                  {
                ?>   
                    <td ><?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?></td>
                    <td class="text-center">
                      <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i></button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <?php echo form_open_multipart('controller_programas/agregar');?>        
                              <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                              <input type="hidden" name="idPlanAnual" value="<?php echo $row->idPlanAnualTrabajo; ?>">
                              <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Crear Programa</button>
                            <?php echo form_close();
                            echo form_open_multipart('controller_memorandumplanificacion/modificar');?>
                              <input type="hidden" name="idEmpleado" value="<?php echo $row->idEmpleado;?>">        
                              <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                              <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar</button>
                            <?php echo form_close();
                            echo form_open_multipart('controller_memorandumplanificacion/cerrarmpa');?>    
                              <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                              <input type="hidden" name="idpat" value="<?php echo $row->idPlanAnualTrabajo;?>">
                              <button type="submit" name="botton" class="dropdown-item"><i class="fa fa-sign-out"></i>  Cerrar MPA</button>
                            <?php echo form_close();?>

                        </div>
                      </div>
                      <?php
                        } 
                      ?>
                    </td>

                  </tr> <?php
                } 
                else {if ($this->session->userdata('idUsuario')==$row->idEmpleado) {
                  ?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td class="text-center"><?php echo $row->numeroInforme;?></td>
                    <td ><?php echo $row->informe;?></td>
                    <td class="text-center"><?php echo formatearFecha($row->fechaInicio);?></td>
                    <td class="text-center"><?php echo formatearFecha ($row->fechaConclusion);?></td>
                    <td>
                      <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i></button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                          <?php echo form_open_multipart('controller_programas/agregar');?>        
                            <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                            <input type="hidden" name="idPlanAnual" value="<?php echo $row->idPlanAnualTrabajo; ?>">
                            <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Crear Programa</button>
                          <?php echo form_close();?>

                        </div>
                      </div>
                    </td>
                  </tr>
                    <?php
                  }
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