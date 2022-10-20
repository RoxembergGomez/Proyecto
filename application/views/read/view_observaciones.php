<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >HALLAZGOS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
              <div class="row float-left">
                <?php 
                echo form_open_multipart('controller_programatrabajo/eliminados');?>
                    <button  type="submit" class="btn btn-success"><i class="fa fa-trash"></i> Observaciones Eliminadas</button>
                <?php echo form_close();?>
              </div>  
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Observación</th>
                    <th class="text-center">Atención</th> 
                    <th class="text-center">Comentario del Responsable y Acción Correctiva </th>
                    <th class="text-center">Plazo Propuesto</th>
                    <th class="text-center">Responsable</th>
                    <th class="text-center">Acciones</th> 
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($observaciones->result() as  $row)
              {?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td><?php echo $row->descripcionHallazgo;?></td>
                    <td class="text-center"><?php echo $row->prioridadAtencion;?></td>
                    <td>
                      <?php if($row->comentarioResponsable==''){
                          ?> <p style="font-weight: bold; color: red; " >Sin Comentario del Responsable</p> <?php
                      } else{
                        echo $row->comentarioResponsable;
                      } ?>
                    </td>
                    <td class="text-center">
                      <?php if($row->plazoAccionCorrectiva=='0000-00-00'){
                          ?> <p style="font-weight: bold; color: red; " >Sin Fecha</p> <?php
                      } else{
                        echo $row->plazoAccionCorrectiva;
                      } ?>
                    </td>
                    <td>
                      <?php if($row->responsable==''){
                          ?> <p style="font-weight: bold; color: red; " >Sin Responsable</p> <?php
                      } else{
                        echo $row->responsable;
                      } ?>
                    </td>  
                    <td>
                      <ul >
                          <li   class="nav-item dropdown open text-center" style="list-style:none;">
                            <a href="<?php echo base_url(); ?>gentelella/javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-align-justify"></i>
                            </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="padding: 0px;">
                                <?php echo form_open_multipart('controller_hallazgos/modificar');?>        
                                <input type="hidden" name="idhallazgo" value="<?php echo $row->idHallazgo;?>">
                                <input type="hidden" name="idmpa" value="<?php echo $row->idMemorandumPlanificacion; ?>">
                                <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i> Accion Correctiva</button>
                              <?php echo form_close();
                              echo form_open_multipart('controller_memorandumplanificacion/modificar');?>        
                                <input type="hidden" name="idMemorandumPlanificacion" value="<?php echo $row->idMemorandumPlanificacion;?>">
                                <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar</button>
                              <?php echo form_close(); 
                              echo form_open_multipart('controller_memorandumplanificacion/eliminarbd');?>    
                                <input type="hidden" name="idMemorandumPlanificacion" value="<?php echo $row->idMemorandumPlanificacion;?>">
                                <button type="submit" name="botton" class="dropdown-item"><i class="fa fa-trash"></i>Eliminar</button>
                              <?php echo form_close();?>
                              </div>
                            </li>
                        </ul>
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
