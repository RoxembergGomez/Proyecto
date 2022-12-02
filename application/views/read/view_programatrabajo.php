<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 >EJECUCIÓN DE ACTIVIDADES</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
                <?php echo form_open_multipart('controller_programas/programascerrados');?>
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
                    <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($programatrabajo->result() as  $row)
              { 
             if (($this->session->userdata('idUsuario') == $row->idEmpleado || $this->session->userdata('tipo')=='jefe') && ($this->session->userdata('idUsuario') == $row->idEmpleado || $row->estadoPrograma == '2' || $row->estadoPrograma == '3' )) {?>
                
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td class="text-center"><?php echo $row->numeroInforme;?></td>
                    <td ><?php echo $row->informe;?></td>
                    <td class="text-center"><?php echo formatearFecha($row->fechaInicio);?></td>
                    <td class="text-center"><?php echo formatearFecha ($row->fechaConclusion);?></td>
                    <td class="text-center">
                      <?php  echo form_open_multipart('controller_programas/revision');
                        ?>
                        <div class="btn-group">
                          <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                          <?php if(($row->estadoPrograma=='2' || $row->estadoPrograma=='3') && $this->session->userdata('tipo')=='ejecutor'){?>
                          <select name="proceso" class="col-sm-9 form-control" disabled="true" value="<?php echo set_value('proceso'); ?>">
                            <option value=" ">Selecc...</option>
                            <?php if($this->session->userdata('tipo')=='jefe' && $row->estadoPrograma!='1'){?>
                            <option value="1">Devolver</option>
                            <option value="3">Aprobado</option>
                            <?php }
                            if(($this->session->userdata('tipo')=='ejecutor' || $this->session->userdata('tipo')=='jefe') && $row->estadoPrograma=='1' ){?>
                            <option value="2">Revisión</option>
                          <?php } ?>
                          </select>
                          <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Enviar" disabled="true" ><i class="fa fa-sign-out"></i></button>
                          <?php } ?>
                          <?php if(($row->estadoPrograma=='2' || $row->estadoPrograma=='3') && $this->session->userdata('tipo')=='jefe'){?>
                          <select name="proceso" class="col-sm-9 form-control" value="<?php echo set_value('proceso'); ?>">
                            <option value=" ">Selecc...</option>
                            <?php if($this->session->userdata('tipo')=='jefe' && $row->estadoPrograma!='1'){?>
                            <option value="1">Devolver</option>
                            <option value="3">Aprobado</option>
                            <?php }
                            if(($this->session->userdata('tipo')=='ejecutor' || $this->session->userdata('tipo')=='jefe') && $row->estadoPrograma=='1' ){?>
                            <option value="2">Revisión</option>
                          <?php } ?>
                          </select>
                          <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Enviar" ><i class="fa fa-sign-out"></i></button>
                          <?php } ?>
          
                        <?php if($row->estadoPrograma=='1'){?>
                          <select name="proceso" class="col-sm-9 form-control" value="<?php echo set_value('proceso'); ?>">
                            <option value=" ">Selecc...</option>
                            <?php if($this->session->userdata('tipo')=='jefe' && $row->estadoPrograma!='1'){?>
                            <option value="1">Devolver</option>
                            <option value="3">Aprobado</option>
                            <?php }
                            if(($this->session->userdata('tipo')=='ejecutor' || $this->session->userdata('tipo')=='jefe') && $row->estadoPrograma=='1' ){?>
                            <option value="2">Revisión</option>
                          <?php } ?>
                          </select>
                          <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Enviar"  ><i class="fa fa-sign-out"></i></button>
                          <?php } ?>
                        </div>
                      <?php echo form_close();?>
                    </td>
                    <td class="text-center"> 
                      <?php if (($row->estadoPrograma)=='1'){?> <p id="azul" >En Proceso</p><?php }
                      if (($row->estadoPrograma)=='2'){?> <p id="anaranjado" >En Revisión</p><?php }
                      if (($row->estadoPrograma)=='3'){?> <p id="verde" >Aprobado</p><?php }?>
                    </td>
                    <td class="text-center">
                      <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i></button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                              <?php if($row->estadoPrograma=='3'|| $row->estadoPrograma=='1' || $this->session->userdata('tipo')=='jefe'){

                                if($row->estadoPrograma=='3') { 
                                echo form_open_multipart('controller_requerimientoinformacion/agregar');?>

                                <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                                <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Crear Requerimiento</button>
                              <?php echo form_close();
                                }
                            
                                echo form_open_multipart('controller_programas/actividades');?> 
                                  <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                                  <input type="hidden" name="estadoPrograma" value="<?php echo $row->estadoPrograma;?>">
                                  <input type="hidden" name="estadoProceso" value="<?php echo $row->estadoProceso;?>">
                                  <button type="submit" class="dropdown-item" ><i class="fa fa-eye"></i>  Revisar</button>
                                <?php echo form_close();
                              }
                                ?>
                                </div>
                              </div>
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

