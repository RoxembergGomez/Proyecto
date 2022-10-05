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
                echo form_open_multipart('controller_programatrabajo/concluidos');?>
                    <button  type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Actividades Concluidas</button>
                <?php echo form_close();?>
              </div>  
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Detalle Subprocesos</th>
                    <th class="text-center">Criticidad</th> 
                    <th class="text-center">Descripción Actividad</th>
                    <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($actividades->result() as  $row)
              {?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td ><?php echo $row->descripcionSubProceso;?></td>
                    <td class="text-center"  ><?php echo $row->clasificacionCriticidad;?></td>
                    <td ><?php echo $row->actividad;?></td>
                    <td>
                      <ul class="col text-center">
                      <li class="nav-item dropdown open text-center" style="list-style:none;">
                         <a href="<?php echo base_url(); ?>gentelella/javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-align-justify"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="padding: 0px;">
                          <?php echo form_open_multipart('controller_actividades/modificar');?>        
                            <input type="hidden" name="idPlan" value="<?php echo $row->idProgramaTrabajo;?>" >
                            <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar</button>
                          <?php echo form_close();?>    
                            <input type="hidden" name="idPlan" >
                            <button type="submit" name="botton" value="Eliminar" class="dropdown-item" onclick="return confirm_modalFotos(<?php echo $row->idPlanAnualTrabajo; ?>)" ><i class="fa fa-trash"></i> Eliminar</button>  

                              <?php $v='<button type="button" name="prueva" class="dropdown-item" data-toggle="modal" data-target="#modal_form_vertical" ><i class="fas glyphicon glyphicon-hand-up" onclick="return confirm_modalFotos(<?php echo $row->idProgramaTrabajo; ?>)"></i> Revisar</button>'?>
                           

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




<div id="modal_form_vertical" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">REVISIÓN DE ACTIVIDADES</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body col-md-12">

                <fieldset class="content-group">
                    <div class="form-group">
                        <div class="col-md-12">
                          <input type="text" value="<?php echo $v ?>" >
                            <div class="row">
                                <div class="col-md-6">
                                        <label>Verificación</label>
                                        <select type="text" class="form-control input-xlg"
                                           id="txtNombres" name="txtNombres">
                                            <option value="">Seleccione</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                             <option value="N/A">N/A</option>
                                        </select>
                                </div>
                                <div class="col-md-6">
                                        <label>Respaldo</label>
                                        <input type="text" class="form-control input-lg"
                                            placeholder="Seleccione Archivo" id="txtPrimerApellido"
                                            name="txtPrimerApellido">
                                </div>
                            </div> <br>

                            <div class="row">
                                <div class="col-md-12">
                                        <label>Observación</label>
                                        <input type="text" class="form-control input-lg"
                                            placeholder="Redacte la observación" id="txtSegundoApellido"
                                            name="txtPrimerApellido">
                                </div>
                            </div> <br>

                            <div class="row">
                                <div class="col-md-6">
                                        <label>Prioridad de Atención</label>
                                        <select type="text" class="form-control input-xlg"
                                           id="txtNombres" name="txtNombres">
                                            <option value="">Seleccione</option>
                                            <option value="ALTA">ALTA</option>
                                            <option value="MEDIA">MEDIA</option>
                                             <option value="BAJA">BAJA</option>
                                        </select>
                                </div>
                                <div class="col-md-6">
                                        <label>Respaldo</label>
                                        <input type="text" class="form-control input-lg"
                                            placeholder="Seleccione un anexo" id="txtPrimerApellido"
                                            name="txtPrimerApellido">
                                </div>
                            </div> <br>

                            </div>
                        </div>
                </fieldset>

                <div class="text-right">
                    <a class="btn btn-primary" type="button" class="close" data-dismiss="modal" class="fa fa-arrow-circle-left"></i> Cancelar</a>
                    <!-- <button type="submit" class="btn btn-primary" id="btnGuardar" name="btnGuardar">Guardar
                        <i class="icon-arrow-right14 position-right"></i></button> -->
                        <button class="btn btn-success" onclick="registrarCliente()">Generar Cliente</button>
                </div>

            
            </div>

        </div>
    </div>
</div> class="text-right">
                    <a class="btn btn-primary" type="button" class="close" data-dismiss="modal" class="fa fa-arrow-circle-left"></i> Cancelar</a>
                    <!-- <button type="submit" class="btn btn-primary" id="btnGuardar" name="btnGuardar">Guardar
                        <i class="icon-arrow-right14 position-right"></i></button> -->
                        <button class="btn btn-success" onclick="registrarCliente()">Generar Cliente</button>
                </div>

            
            </div>

        </div>
    </div>
</div>

<script>
     function confirm_modalFotos(id) {
            var url =id;
        } 
</script>