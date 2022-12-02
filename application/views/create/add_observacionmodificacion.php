<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
      <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >HALLAZGO</h5>
       
      </div> <br>
      <?php 
        foreach ($info->result() as $row) {
      ?>
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
      <?php 
      }
      echo form_open_multipart('controller_programas/agregarObservacion');
      ?>
        
      <input type="hidden" name="idprograma" value="<?php echo $_POST ['idprograma'];?>">
      <input type="hidden" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
      <input type="hidden" name="estadoPrograma" value="<?php echo $_POST ['estadoPrograma'];?>" >
        <div class="row">
          <div class="col-md-12">
            <label>HALLAZGO:</label>
            <textarea type="text" class="form-control input-lg" placeholder="Redacte la observación" name="observacion" value="<?php echo set_value('observacion'); ?>" ></textarea>
            <p style="color: red;"><?php echo form_error('observacion');?></p>
          </div>
        </div> <br>
        <div class="row">
        <div class="col-md-4">
          <label>PRIORIDAD ATENCIÓN:</label>
          <select type="text" class="form-control input-xlg" name="prioridad" value="<?php echo set_value('prioridad'); ?>">
              <option value="">Seleccione</option>
              <option value="ALTA">ALTA</option>
              <option value="MEDIA">MEDIA</option>
               <option value="BAJA">BAJA</option>
          </select>
          <p style="color: red;"><?php echo form_error('prioridad');?></p>
        </div>
        <div class="col-md-4">
          <label>EMPLEADO RESPONSABLE:</label>
           <select name="idEmpleado" class="col-md-12 form-control" autocomplete="off" value="<?php echo set_value('idEmpleado'); ?>">
            <option value="">Seleccione un responsable</option>
                <?php
                 foreach ($seleccion->result() as  $row)
              {?> <option value="<?php echo $row->idEmpleado;?>">
                <?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?>
                </option><?php
                }?>
          </select> <br> <br> <br>
           <p style="color: red;"><?php echo form_error('idEmpleado');?></p> 
        </div>
        <div class="col-md-4">
          <label>ANEXO:</label>
          <input type="file" class="col-md-12 form-control" name="userfile"> 
        </div>
        </div>
        <hr>
        <div class="row float-right">
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-database"></i>  Guardar</button>
      <?php 
      echo form_close();
      echo form_open_multipart('controller_programas/modificarejecucion');
          ?>
          <input type="hidden" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
          <input type="hidden" name="idprograma" value="<?php echo $_POST ['idprograma'];?>">
          <input type="hidden" name="estadoPrograma" value="<?php echo $_POST ['estadoPrograma'];?>" >
          <button type="submit" class="btn btn-secondary btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
        <?php echo form_close();?>
  </div> 
  </div>
</div>
    </div>
  </div>
</div>