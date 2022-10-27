<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >HALLAZGOS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
              <div class="row float-left">
                <?php 
                echo form_open_multipart('controller_programatrabajo/eliminados');?>
                    <button  type="submit" class="btn btn-success"><i class="fa fa-trash"></i> Observaciones Eliminadas</button>
                <?php echo form_close();?>
              </div>  
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Nro Informe</th>
                    <th class="text-center">Actividad</th> 
                    <th class="text-center">Fecha de Inicio</th>
                    <th class="text-center">Fecha de Conclusión</th>
                    <th class="text-center">Seguimiento de Hallazgos</th>
                    <th class="text-center">Hallazgos</th> 
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($programatrabajo->result() as  $row)
              {?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td class="text-center"><?php echo $row->numeroInforme;?></td>
                    <td ><?php echo $row->informe;?></td>
                    <td class="text-center"><?php echo formatearFecha($row->fechaInicio);?></td>
                    <td class="text-center"><?php echo formatearFecha ($row->fechaConclusion);?></td>
                    <td class="text-center">
                    <?php  echo form_open_multipart('controller_hallazgos/revision');
                      ?>
                      <div class="btn-group">
                        <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                        <select name="proceso" class="col-sm-10 form-control" >
                          <option value=" ">Seleccione...</option>
                          <?php if($this->session->userdata('tipo')=='jefe' && $row->estadoProceso=='2'){?>
                          <option value="1">Devolver</option>
                          <option value="3">Descargos</option>
                          <option value="4">Cerrar</option>
                          <?php }
                          if(($this->session->userdata('tipo')=='ejecutor' || $this->session->userdata('tipo')=='jefe') && $row->estadoProceso=='1' ){?>
                          <option value="2">Revisión</option>
                          <?php }
                          if($this->session->userdata('tipo')=='auditado' && $row->estadoProceso=='3'){?>
                            <option value="2">Devolver</option>
                          <?php } ?>
                          
                        </select>
                        <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Enviar" ><i class="fa fa-sign-out"></i></button>
                      </div> 
                    </td>

                    <?php 
                      echo form_close();
                       ?>
                    <td class="text-center">
                     
                      <?php echo form_open_multipart('controller_hallazgos/observaciones');?>
                      <div class="btn-group"> 
                            <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                            <div class="col text-center">
                            <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detalle de Observaciones">
                            <i class="fa fa-eye"></i>
                            </button>
                        </div>
                        <?php echo form_close();?>
              				<?php 
              				echo form_open_multipart('controller_hallazgos/reportepdf');
              				?>
              				  <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
              				  <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Reporte PDF" ><i class="fa fa-file-pdf-o"></i></button>
                      </div>
              				<?php 
              				echo form_close();
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
