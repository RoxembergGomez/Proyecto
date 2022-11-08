<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <div class="row float-left " >
      <?php 
        echo form_open_multipart('controller_requerimientoinformacion/index');?>
        <button class="btn btn-primary float-center" data-toggle="tooltip" data-placement="top" title="Retroceder">
          <i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5 >REQUERIMIENTO POR UNIDADES </h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">

            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Unidad de Negocio</th>
                    <th class="text-center">Detalle Requerimiento</th> 
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($detallereq->result() as  $row)
              {?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td><?php echo $row->lineaNegocio;?></td>
                    <td class="text-center">
                    <?php 
                      echo form_open_multipart('controller_requerimientoinformacion/detallerequerimiento');
                    ?>
                    <div class="btn-group"> 
                      <input type="hidden" name="idunidad" value="<?php echo $row->idUnidadNegocio;?>">
                      <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                      <input type="hidden" name="requerimiento" value="<?php echo $row->estadoRequerimiento;?>">
                       <div class="col text-center">
                      <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detalle Sistema">
                            <i class="fa fa-desktop"></i></button>
                          </div>
                    <?php 
                    echo form_close();
                    ?>
                    <?php 
                      echo form_open_multipart('controller_requerimientoinformacion/reportepdf');
                    ?>
                      <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                      <input type="hidden" name="idunidad" value="<?php echo $row->idUnidadNegocio;?>">
                      <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Reporte PDF" formtarget="_blank"><i class="fa fa-file-pdf-o"></i></button>
                    <?php 
                    echo form_close();
                    ?>
                    </div>
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