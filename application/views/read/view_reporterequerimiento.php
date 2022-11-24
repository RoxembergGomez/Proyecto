<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <div class="row float-left " >
      <?php 
        echo form_open_multipart('controller_requerimientoinformacion/unidadRequerimiento');?>
        <input type="hidden" name="idunidad" value="<?php echo $_POST['idunidad'];?>">
        <input type="hidden" name="idmpa" value="<?php echo $_POST['idmpa'];?>">
        <input type="hidden" name="requerimiento" value="<?php echo $_POST['requerimiento'];?>">
        <button class="btn btn-primary float-center" data-toggle="tooltip" data-placement="top" title="Retroceder" style="background: black;">
          <i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5 >REPORTE REQUERIMIENTO POR UNIDAD DE NEGOCIO</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">

          <?php echo form_open_multipart('controller_requerimientoinformacion/eliminados');?>
                <input type="hidden" name="idunidad" value="<?php echo $_POST['idunidad'];?>">
                <input type="hidden" name="idmpa" value="<?php echo $_POST['idmpa'];?>">
                <input type="hidden" name="requerimiento" value="<?php echo $_POST['requerimiento'];?>">
                <button  type="submit" class="btn btn-info btn-sm float-right"><i class="fa fa-trash"></i>  Eliminados</button>
                <?php echo form_close();
                ?>

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
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i></button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                         <?php echo form_open_multipart('controller_requerimientoinformacion/modificar');?>        
                            <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                            <input type="hidden" name="idunidad" value="<?php echo $row->idUnidadNegocio;?>">
                            <input type="hidden" name="idrequerimiento" value="<?php echo $row->idRequerimientoInformacion;?>">
                            <input type="hidden" name="requerimiento" value="<?php echo $row->estadoRequerimiento;?>">
                            <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar</button>
                          <?php echo form_close();?>

                          <?php echo form_open_multipart('controller_requerimientoinformacion/eliminarbd');?>        
                            <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                            <input type="hidden" name="idunidad" value="<?php echo $row->idUnidadNegocio;?>">
                            <input type="hidden" name="idrequerimiento" value="<?php echo $row->idRequerimientoInformacion;?>">
                            <input type="hidden" name="requerimiento" value="<?php echo $row->estadoRequerimiento;?>">
                            <button type="submit" class="dropdown-item" ><i class="fa fa-trash"></i>  Eliminar</button>
                          <?php echo form_close();?>
                      </div>
                    </div>
                  </td>
                  <?php }
                   if ($row->estadoRequerimiento=='2' && $this->session->userdata('tipo')=='jefe') {?>
                    <td class="text-center">
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i></button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                         <?php echo form_open_multipart('controller_requerimientoinformacion/modificar');?>        
                            <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                            <input type="hidden" name="idunidad" value="<?php echo $row->idUnidadNegocio;?>">
                            <input type="hidden" name="idrequerimiento" value="<?php echo $row->idRequerimientoInformacion;?>">
                            <input type="hidden" name="requerimiento" value="<?php echo $row->estadoRequerimiento;?>">
                            <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar</button>
                          <?php echo form_close();?>

                          <?php echo form_open_multipart('controller_requerimientoinformacion/eliminarbd');?>        
                            <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                            <input type="hidden" name="idunidad" value="<?php echo $row->idUnidadNegocio;?>">
                            <input type="hidden" name="idrequerimiento" value="<?php echo $row->idRequerimientoInformacion;?>">
                            <input type="hidden" name="requerimiento" value="<?php echo $row->estadoRequerimiento;?>">
                            <button type="submit" class="dropdown-item" ><i class="fa fa-trash"></i>  Eliminar</button>
                          <?php echo form_close();?>
                      </div>
                    </div>
                    </td>
                  <?php } ?>
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
