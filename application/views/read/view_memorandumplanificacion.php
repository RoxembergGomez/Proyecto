<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >MEMORANDUM DE PLANIFICACIÓN DE AUDITORÍA</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
              <div class="row float-left">
                <?php 
                echo form_open_multipart('controller_memorandumplanificacion/eliminados');?>
                    <button  type="submit" class="btn btn-success"><i class="fa fa-trash"></i> MPA Eliminados</button>
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
                  <?php
                  if($this->session->userdata('tipo')=='jefe')
                  {
                  ?> 
                    <th class="text-center">Responsable de Ejecución</th>
                    <th class="text-center">Acciones</th> 
                <?php
                  }
                ?>
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($memorandumplanificacion->result() as  $row)
              {

                if ($this->session->userdata('tipo')=='jefe') {  ?> 
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td class="text-center"><?php echo $row->numeroInforme;?></td>
                    <td ><?php echo $row->informe;?></td>
                    <td class="text-center"><?php echo formatearFecha($row->fechaInicio);?></td>
                    <td class="text-center"><?php echo formatearFecha ($row->fechaConclusion);?></td>
                <?php
                  if($this->session->userdata('tipo')=='jefe')
                  {
                ?>   
                    <td ><?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?></td>
                    <td>
                        <ul >
                          <li   class="nav-item dropdown open text-center" style="list-style:none;">
                            <a href="<?php echo base_url(); ?>gentelella/javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-align-justify"></i>
                            </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="padding: 0px;">
                                <?php echo form_open_multipart('controller_programas/agregar');?>        
                                <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                                <input type="hidden" name="idPlanAnual" value="<?php echo $row->idPlanAnualTrabajo; ?>">
                                <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Crear Programa</button>
                              <?php echo form_close();
                              echo form_open_multipart('controller_requerimientoinformacion/agregar');?>        
                                <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                                <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Crear Requerimiento</button>
                              <?php echo form_close();
                              echo form_open_multipart('controller_memorandumplanificacion/modificar');?>        
                                <input type="hidden" name="idMemorandumPlanificacion" value="<?php echo $row->idMemorandumPlanificacion;?>">
                                <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar</button>
                              <?php echo form_close();
                              echo form_open_multipart('controller_memorandumplanificacion/cerrarmpa');?>    
                                <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion;?>">
                                <input type="hidden" name="idpat" value="<?php echo $row->idPlanAnualTrabajo;?>">
                                <button type="submit" name="botton" class="dropdown-item"><i class="fa fa-sign-out"></i>  Cerrar MPA</button>
                              <?php echo form_close();
                              echo form_open_multipart('controller_memorandumplanificacion/eliminarbd');?>    
                                <input type="hidden" name="idMemorandumPlanificacion" value="<?php echo $row->idMemorandumPlanificacion;?>">
                                <button type="submit" name="botton" class="dropdown-item"><i class="fa fa-trash"></i>  Eliminar</button>
                              <?php echo form_close();?>
                              
                              </div>
                            </li>
                        </ul>
                      <?php
                        } 
                      ?>
                    </td>

                  </tr> <?php
                } 
                else {if ($this->session->userdata('empleado')==$row->idEmpleado) {
                  ?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td class="text-center"><?php echo $row->numeroInforme;?></td>
                    <td ><?php echo $row->informe;?></td>
                    <td class="text-center"><?php echo formatearFecha($row->fechaInicio);?></td>
                    <td class="text-center"><?php echo formatearFecha ($row->fechaConclusion);?></td>
                  </tr>
                    <?php
                  }
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