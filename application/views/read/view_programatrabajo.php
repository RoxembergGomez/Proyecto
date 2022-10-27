<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >EJECUCIÓN DE ACTIVIDADES</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
              <div class="row float-left">
                <?php 
                echo form_open_multipart('controller_programatrabajo/eliminados');?>
                    <button  type="submit" class="btn btn-success"><i class="fa fa-trash"></i> Actividades Eliminadas</button>
                <?php echo form_close();?>
              </div>  
    
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
              if ($this->session->userdata('idUsuario')==$row->idEmpleado || $this->session->userdata('tipo') =='jefe') {?>
                
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
                          <select name="proceso" class="col-sm-9 form-control" disabled="true" >
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
                          <select name="proceso" class="col-sm-9 form-control">
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
                          <select name="proceso" class="col-sm-9 form-control" >
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
                      <?php if (($row->estadoPrograma)=='1'){?> <p style="color:blue;font-weight: bold;" >En Proceso</p><?php }
                      if (($row->estadoPrograma)=='2'){?> <p style="color:orange; font-weight: bold;" >En Revisión</p><?php }
                      if (($row->estadoPrograma)=='3'){?> <p style="color:green; font-weight: bold;" >Aprobado</p><?php }?>
                    </td>
                    <td>
                        <ul >
                          <li   class="nav-item dropdown open" style="list-style:none;">
                            <a href="<?php echo base_url(); ?>gentelella/javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-align-justify"></i>
                            </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="padding: 0px;">
                              <?php if($row->estadoPrograma=='3'|| $row->estadoPrograma=='1' || $this->session->userdata('tipo')=='jefe'){

                                if($row->estadoPrograma=='3') { 
                                echo form_open_multipart('controller_requerimientoinformacion/agregar');?>

                                <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                                <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Crear Requerimiento</button>
                              <?php echo form_close();
                                }
                            
                                echo form_open_multipart('controller_programas/actividades');?> 
                                  <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                                    <button type="submit" class="dropdown-item" ><i class="fa fa-eye"></i>  Revisar</button>
                                <?php echo form_close();
 
                                echo form_open_multipart('controller_hallazgos/reportepdf');
                                ?>
                                  <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                                  <button type="submit" class="dropdown-item" ><i class="fa fa-file-pdf-o">  PDF</i></button>
                                </div>
                                <?php 
                                echo form_close();
                              }
                                ?>
                              </div>
                            </li>
                        </ul>
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

