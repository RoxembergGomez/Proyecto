<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5>VISTA GENERAL DE REQUERIMIENTO DE INFORMACIÓN </h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">

                <?php echo form_open_multipart('controller_requerimientoinformacion/cerrados');?>
                    <button  type="submit" class="btn btn-info btn-sm text-left float-right"><i class="fa fa-desktop"></i> Cerrados</button>
                <?php echo form_close();
                ?>

            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Nro Informe</th>
                    <th class="text-center">Actividad</th> 
                    <th class="text-center">Fecha de Inicio</th>
                    <th class="text-center">Fecha de Conclusión</th>
                    <th class="text-center">Revisión y Control</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Unidades</th> 
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($requerimiento->result() as  $row)
              {
                if (($this->session->userdata('idUsuario') == $row->idEmpleado || $this->session->userdata('tipo')=='jefe') && ($this->session->userdata('idUsuario') == $row->idEmpleado || $row->estadoRequerimiento == '2' || $row->estadoRequerimiento == '3' )) {?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td class="text-center"><?php echo $row->numeroInforme;?></td>
                    <td ><?php echo $row->informe;?></td>
                    <td class="text-center"><?php echo formatearFecha($row->fechaInicio);?></td>
                    <td class="text-center"><?php echo formatearFecha ($row->fechaConclusion);?></td>
                     <td class="text-center">
                      <?php  echo form_open_multipart('controller_requerimientoinformacion/revision');
                        ?>
                        <div class="btn-group">
                          <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                          <?php if(($row->estadoRequerimiento=='2' || $row->estadoRequerimiento=='3') && $this->session->userdata('tipo')=='ejecutor'){?>
                          <select name="proceso" class="col-sm-9 form-control" disabled="true" value="<?php echo set_value('proceso'); ?>" >
                            <option value=" ">Selecc...</option>
                            <?php if($this->session->userdata('tipo')=='jefe' && $row->estadoRequerimiento!='1'){?>
                            <option value="1">Devolver</option>
                            <option value="3">Aprobado</option>
                            <?php }
                            if(($this->session->userdata('tipo')=='ejecutor' || $this->session->userdata('tipo')=='jefe') && $row->estadoRequerimiento=='1' ){?>
                            <option value="2">Revisión</option>
                          <?php } ?>
                          </select> 
                          <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Enviar" disabled="true" ><i class="fa fa-sign-out"></i></button><br>
                          <?php } ?>
                          <?php if(($row->estadoRequerimiento=='2' || $row->estadoRequerimiento=='3') && $this->session->userdata('tipo')=='jefe'){?>
                          <select name="proceso" class="col-sm-9 form-control" value="<?php echo set_value('proceso'); ?>">
                            <option value=" ">Selecc...</option>
                            <?php if($this->session->userdata('tipo')=='jefe' && $row->estadoRequerimiento!='1'){?>
                            <option value="1">Devolver</option>
                            <option value="3">Aprobado</option>
                            <?php }
                            if(($this->session->userdata('tipo')=='ejecutor' || $this->session->userdata('tipo')=='jefe') && $row->estadoRequerimiento=='1' ){?>
                            <option value="2">Revisión</option>
                          <?php } ?>
                          </select>
                          <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Enviar" ><i class="fa fa-sign-out"></i></button>
                          <?php } ?>
          
                        <?php if($row->estadoRequerimiento=='1'){?>
                          <select name="proceso" class="col-sm-9 form-control" value="<?php echo set_value('proceso'); ?>" >
                            <option value=" ">Selecc...</option>
                            <?php if($this->session->userdata('tipo')=='jefe' && $row->estadoRequerimiento!='1'){?>
                            <option value="1">Devolver</option>
                            <option value="3">Aprobado</option>
                            <?php }
                            if(($this->session->userdata('tipo')=='ejecutor' || $this->session->userdata('tipo')=='jefe') && $row->estadoRequerimiento=='1' ){?>
                            <option value="2">Revisión</option>
                          <?php } ?>
                          </select><br>
                          <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Enviar"  ><i class="fa fa-sign-out"></i></button>
                          <?php } ?>
                        </div><br>
                      <?php echo form_close();?>
                    </td>
                    <td class="text-center"> 
                      <?php if (($row->estadoRequerimiento)=='1'){?> <p id="azul" >En Proceso</p><?php }
                      if (($row->estadoRequerimiento)=='2'){?> <p id="anaranjado" >En Revisión</p><?php }
                      if (($row->estadoRequerimiento)=='3'){?> <p id="verde" >Aprobado</p><?php }?>
                    </td>
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