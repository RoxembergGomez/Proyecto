<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5>HALLAZGOS EN PROCESO</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            <?php echo form_open_multipart('controller_hallazgos/enrevision');?>
              <button  type="submit" class="btn btn-info btn-sm text-left" id="botleft" style="border-color:black;"><i class="fa fa-check-square"></i> Revisión Control</button>
            <?php echo form_close();?>
              <?php echo form_open_multipart('controller_hallazgos/enviadosdescargosuai');?>
                <button  type="submit" class="btn btn-info btn-sm" style="margin-left: 5px; border-color:black;"><i class="fa fa-eye"></i> Enviado a Descargo</button>
              <?php echo form_close();?>
              <?php echo form_open_multipart('controller_hallazgos/revisiondescargo');?>
                <button  type="submit" class="btn btn-info btn-sm text-left" style=" border-color:black;"><i class="fa fa-check-square"></i> Revisión Descargos</button>
              <?php echo form_close();?>
              <?php echo form_open_multipart('controller_hallazgos/concluidos');?>
                <button  type="submit" class="btn btn-info btn-sm text-left" style=" border-color:black;"><i class="fa fa-check-square"></i> Concluidos</button>
              <?php echo form_close();?>
        </div>
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Nro. de Informe</th>
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
              {
                if ($this->session->userdata('idUsuario')==$row->idEmpleado) {?>
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
                        <input type="hidden" name="idpat" value="<?php echo $row->idPlanAnualTrabajo;?>">
                        <select name="proceso" class="col-sm-10 form-control" value="<?php echo set_value('proceso'); ?>" >
                          <option value="">Seleccione...</option>
                          <option value="2">Revisión</option>
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
              				  <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Reporte PDF" formtarget="_blank"><i class="fa fa-file-pdf-o"></i></button>
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
