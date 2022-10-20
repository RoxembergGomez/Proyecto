<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >REQUERIMIENTO POR UNIDADES </h5> 
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
                    <th class="text-center">Generar Reporte</th>
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
                      <input type="hidden" name="idunidad" value="<?php echo $row->idUnidadNegocio;?>">
                      <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                      <button type="submit" class="btn btn-primary" >Ver Requerimiento</button>
                    <?php 
                    echo form_close();
                    ?>
                    </td>
                     <td class="text-center" >
                    <?php 
                      echo form_open_multipart('controller_requerimientoinformacion/reportepdf');
                    ?>
                      <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                      <input type="hidden" name="idunidad" value="<?php echo $row->idUnidadNegocio;?>">
                      <button type="submit" class="btn btn-success" >Reporte</button>
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