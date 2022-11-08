<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <div class="row float-left " >
      <?php 
        echo form_open_multipart('controller_requerimientoinformacion/detallerequerimiento');?>
        <input type="hidden" name="idunidad" value="<?php echo $_POST['idunidad'];?>">
        <input type="hidden" name="idmpa" value="<?php echo $_POST['idmpa'];?>">
        <input type="hidden" name="requerimiento" value="<?php echo $_POST['requerimiento'];?>">
        <button class="btn btn-primary float-center" data-toggle="tooltip" data-placement="top" title="Lista de requerimientos">
          <i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5 >LISTA DE REQUERIMIENTOS ELIMINADOS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">

            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Detalle de Requerimiento</th>
                    <?php if ($_POST['requerimiento']=='1') {?>
                      <th class="text-center">Acciones</th>
                    <?php }

                    if ($_POST['requerimiento']=='2' && $this->session->userdata('tipo')=='jefe') {?>
                      <th class="text-center">Acciones</th>
                    <?php } ?>
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($reportereq->result() as  $row)
              {?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td><?php echo $row->requerimientoInformacion;?></td>
                    <?php if ($row->estadoRequerimiento=='1') {?>
                    <td class="text-center">
                    <?php echo form_open_multipart('controller_requerimientoinformacion/recuperarbd');?>
                        <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                        <input type="hidden" name="idunidad" value="<?php echo $row->idUnidadNegocio;?>">
                        <input type="hidden" name="idrequerimiento" value="<?php echo $row->idRequerimientoInformacion;?>">
                        <input type="hidden" name="requerimiento" value="<?php echo $row->estadoRequerimiento;?>">
                        <button type="submit" value="recuperar" class="btn btn-warning"><i class="fa fa-database"></i> Recuperar</button>
                      <?php echo form_close(); ?>
                  </td>
                  <?php
                    }

                  if ($row->estadoRequerimiento=='2' && $this->session->userdata('tipo')=='jefe') {?>
                    <td class="text-center">
                    <?php echo form_open_multipart('controller_requerimientoinformacion/recuperarbd');?>
                        <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                        <input type="hidden" name="idunidad" value="<?php echo $row->idUnidadNegocio;?>">
                        <input type="hidden" name="idrequerimiento" value="<?php echo $row->idRequerimientoInformacion;?>">
                        <input type="hidden" name="requerimiento" value="<?php echo $row->estadoRequerimiento;?>">
                        <button type="submit" value="recuperar" class="btn btn-warning"><i class="fa fa-database"></i> Recuperar</button>
                      <?php echo form_close(); ?>
                  </td>
                  <?php
                    }
                  ?>
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
