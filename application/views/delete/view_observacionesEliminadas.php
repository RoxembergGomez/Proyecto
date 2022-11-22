<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    
    <div class="x_title">
      <div class="row float-left " >
      <?php 
        echo form_open_multipart('controller_hallazgos/observaciones');?>
          <input type="hidden" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
          <input type="hidden" name="estadoProceso" value="<?php echo $_POST ['estadoProceso'];?>">
          <button class="btn btn-primary float-center" data-toggle="tooltip" data-placement="top" title="Retroceder" style="background: black;">
          <i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5 class="text-center" >HALLAZGOS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12"> 
            <input type="hidden" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
            <input type="hidden" name="estadoProceso" value="<?php echo $_POST ['estadoProceso'];?>">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Observación</th>
                    <th class="text-center">Atención</th>
                      <?php
                      if ($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor') { ?>
                          <th class="text-center">Responsable Proceso</th>
                      <?php  }   
                    if ($_POST['estadoProceso']=='1' || $this->session->userdata('tipo')=='jefe') {?>
                    <th class="text-center">Acciones</th> 
                  <?php } ?>
                   
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($observaciones->result() as  $row)
              { ?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td><?php echo $row->descripcionHallazgo;?></td>
                    <td class="text-center"><?php echo $row->prioridadAtencion;?></td>
                    <td class="text-center"><?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?></td>
                   <?php
                   if($this->session->userdata('tipo')=='jefe' || $row->estadoProceso=='1')
                  {
                  ?> 
                  <td class="text-center">
                      <?php echo form_open_multipart('controller_hallazgos/recuperarbd');?>
                        <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                          <input type="hidden" name="idhallazgo" value="<?php echo $row->idHallazgo;?>">
                          <input type="hidden" name="estadoProceso" value="<?php echo $row->estadoProceso;?>">
                          <input type="hidden" name="idprograma" value="<?php echo $row->idProgramaTrabajo;?>">
                          <input type="hidden" name="estado" value="<?php echo $row->estado;?>">
                        <button type="submit" value="recuperar" class="btn btn-warning"><i class="fa fa-database"></i> Recuperar</button>
                      <?php echo form_close(); ?>
                  <?php
                    } 
                  ?>
                  </td>
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
