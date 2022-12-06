<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <div class="row float-left " >
      <?php 
        echo form_open_multipart('controller_requerimientoinformacion/index');?>
        <button class="btn btn-primary float-center" data-toggle="tooltip" data-placement="top" title="Retroceder" style="background: black;">
          <i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5>VISTA GENERAL DE REQUERIMIENTO DE INFORMACIÓN CERRADOS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div> 
          </div><br> <br>

            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Nro Informe</th>
                    <th class="text-center">Actividad</th> 
                    <th class="text-center">Fecha de Inicio</th>
                    <th class="text-center">Fecha de Conclusión</th>
                    <th class="text-center">Detalle por Unidades</th> 
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($requerimiento->result() as  $row)
              {?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td class="text-center"><?php echo $row->numeroInforme;?></td>
                    <td ><?php echo $row->informe;?></td>
                    <td class="text-center"><?php echo formatearFecha($row->fechaInicio);?></td>
                    <td class="text-center"><?php echo formatearFecha ($row->fechaConclusion);?></td>
                    <td>
                        <?php echo form_open_multipart('controller_requerimientoinformacion/unidadRequerimiento');?> 
                            <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                            <div class="col text-center">
                            <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Requerimiento por Unidades">
                            <i class="fa fa-eye"></i>
                            </button>
                            </div>
                        <?php echo form_close();?>
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