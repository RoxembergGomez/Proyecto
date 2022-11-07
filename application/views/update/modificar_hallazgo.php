<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
      <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >HALLAZGO</h5>
       
      </div> <br>
     <?php 
     echo form_open_multipart('controller_hallazgos/modificarbd');
      ?>
      <?php 
        foreach ($info->result() as $row) {
      ?>
      <input type="hidden" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
      <input type="hidden" name="idhallazgo" value="<?php echo $_POST ['idhallazgo'];?>">
      <input type="hidden" name="estadoProceso" value="<?php echo $_POST ['estadoProceso'];?>">
      <input type="hidden" name="idprograma" value="<?php echo $_POST ['idprograma'];?>">
      <h5 >DATOS</h5> <br>
      <div class="row">
        <div class="col-md-10">
          <label class="float-left">SUBPROCESO:</label>
          <input type="text" class="col-md-12 form-control" value="<?php echo $row->descripcionSubProceso; ?>" disabled >
        </div>
        <div class="col-md-2">
          <label class="float-left">GRADO PRIORIZACIÓN:</label>
          <input type="text" class="col-md-12 form-control" value="<?php echo $row->clasificacionCriticidad; ?>" disabled  >
        </div> 
      </div><br>
        <div class="row">
        <div class="col-md-12">
          <label class="float-left">DESCRICIÓN DE ACTIVIDAD:</label>
          <input type="text" class="col-md-12 form-control" value="<?php echo $row->actividad; ?>" disabled >
        </div>
      </div> <br> <hr>

      <h5>OBSERVACIÓN</h5> <br>

        <div class="row">
          <div class="col-md-12">
            <label>HALLAZGO:</label>
            <input type="text" class="form-control input-lg" value="<?php echo $row->descripcionHallazgo;?>" name="observacion"></input>
          </div>
        </div> <br>
        <div class="row">
        <div class="col-md-4">
          <label>PRIORIDAD ATENCIÓN:</label>
          <select type="text" class="form-control input-xlg" name="prioridad">
              <option value="<?php echo $row->prioridadAtencion;?>"><?php echo $row->prioridadAtencion;?></option>
              <option value="ALTA">ALTA</option>
              <option value="MEDIA">MEDIA</option>
               <option value="BAJA">BAJA</option>
          </select>
        </div>
        <div class="col-md-4">
          <label>EMPLEADO RESPONSABLE:</label>
           <select name="idEmpleado" class="col-md-12 form-control" required autocomplete="off">
            <option value="<?php echo $row->idEmpleado;?>"><?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?></option>
                <?php
                 foreach ($seleccion->result() as  $rowa)
              {?> <option value="<?php echo $rowa->idEmpleado;?>">
                <?php echo $rowa->nombres.' '.$rowa->primerApellido.' '.$rowa->segundoApellido;?>
                </option><?php
                }?>
          </select> <br><br><br>  
        </div>
        <div class="col-md-4">
          <label>ANEXO:</label>
          <input type="file" class="col-md-12 form-control" name="userfile"> 
        </div>
        </div>
        <hr>
        <div class="row float-right">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalConfirmacion"><i class="fa fa-edit (alias)"></i>  Modificar</button>

         <!-- ALERTA PARA ACCIONES-->
          <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-right" id="exampleModalLongTitle">MODIFICAR</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <p style="font-size: 20px;">Estás seguro de modificar los datos?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit (alias)"></i>  Modificar</button>
                </div>
              </div>
            </div>
          </div>
      <?php 
    }
      echo form_close();
      echo form_open_multipart('controller_hallazgos/observaciones');
          ?>
          <input type="hidden" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
          <input type="hidden" name="idhallazgo" value="<?php echo $_POST ['idhallazgo'];?>">
          <input type="hidden" name="estadoProceso" value="<?php echo $_POST ['estadoProceso'];?>">
          <button type="submit" class="btn btn-secondary btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
        <?php echo form_close();?>
  </div> 
  </div>
</div>
    </div>
  </div>
</div>