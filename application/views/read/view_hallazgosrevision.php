<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <div class="row float-left " >
      <?php 
        echo form_open_multipart('controller_hallazgos/pendiente');?>
        <button class="btn btn-primary float-center" data-toggle="tooltip" data-placement="top" title="Lista de requerimientos" style="background: black;">
          <i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5 >HALLAZGOS - REVISIÓN CONTROL DE CALIDAD</h5> 
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
                    <?php if ($this->session->userdata('tipo') =='jefe'){?>
                    <th class="text-center">Seguimiento de Hallazgos</th>
                  <?php } ?>
                    <th class="text-center">Hallazgos</th> 
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($programatrabajo->result() as  $row)
              {
                if ($this->session->userdata('tipo') =='jefe'|| $this->session->userdata('idUsuario') ==$row->idEmpleado) {?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td class="text-center"><?php echo $row->numeroInforme;?></td>
                    <td ><?php echo $row->informe;?></td>
                    <td class="text-center"><?php echo formatearFecha($row->fechaInicio);?></td>
                    <td class="text-center"><?php echo formatearFecha ($row->fechaConclusion);?></td>
                    <?php if ($this->session->userdata('tipo') =='jefe'){?>
                    <td class="text-center">
                    <?php  echo form_open_multipart('controller_hallazgos/revision');
                      ?>
                      <div class="btn-group">
                        <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                        <input type="hidden" name="idpat" value="<?php echo $row->idPlanAnualTrabajo;?>">
                        <select name="proceso" class="col-sm-10 form-control" >
                          <option value="">Seleccione...</option>
                          <?php if($this->session->userdata('tipo')=='jefe' && $row->estadoProceso=='2'){?>
                          <option value="1">Devolver</option>
                          <option value="3">Enviar Descargos</option>
                          <?php }?>  
                        </select>
                        <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Enviar" ><i class="fa fa-sign-out"></i></button>
                      </div> 
                    </td>
                     <?php } ?>

                    <?php 
                      echo form_close();
                       ?>
                    <td class="text-center">
                     
                      <?php echo form_open_multipart('controller_hallazgos/observaciones');?>
                      <div class="btn-group"> 
                            <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                            <input type="hidden" name="estadoProceso" value="<?php echo $row->estadoProceso;?>">
                            <div class="col text-center">
                            <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detalle de Observaciones">
                            <i class="fa fa-desktop"></i>
                            </button>
                        </div>
                        <?php echo form_close();?>
              				<?php 
              				echo form_open_multipart('controller_hallazgos/reportepdfprevio');
              				?>
              				  <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                        <input type="hidden" name="estadoProceso" value="<?php echo $row->estadoProceso;?>">
              				  <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Reporte PDF" formtarget="_blank" ><i class="fa fa-file-pdf-o"></i></button>
                      </div>
              				<?php 
              				echo form_close();
              				?>
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
